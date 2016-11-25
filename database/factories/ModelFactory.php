<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Article::class, function (Faker\Generator $faker) {
    $userIds = App\User::pluck('id')->all();
    $childCategoryIds = App\ChildCategory::pluck('id')->all();
    $categoryIds = App\Category::pluck('id')->all();
    return [
        'title' => $faker->sentence(),
        'logo'=>$faker->imageUrl(),
        'content' => $faker->paragraph,
        'user_id'=>$faker->randomElement($userIds),
        'intro'=>$faker->sentence(),
        'child_category_id'=>$faker->randomElement($childCategoryIds),
        'category_id'=>$faker->randomElement($categoryIds),
    ];
});


$factory->define(App\Skill::class, function (Faker\Generator $faker) {
    $userIds = \App\User::pluck('id')->toArray();
    return [
        'name' => $faker->randomElement(['php','ruby','javascript','android','ios']),
        'time' => $faker->randomElement(['1年','1年半','半年','二年']),
        'user_id'=>$faker->randomElement($userIds),
        'score'=>$faker->numberBetween(30,80)
    ];
});

$factory->define(App\Comment::class, function (Faker\Generator $faker) {
    $userIds = \App\User::pluck('id')->toArray();
    $articleIds = \App\Article::pluck('id')->toArray();
    return [
        'content' => $faker->paragraph(1,true),
        'user_id'=>$faker->randomElement($userIds),
        'article_id'=>$faker->randomElement($articleIds),
    ];
});

$factory->define(App\Collect::class, function (Faker\Generator $faker) {
    $userIds = \App\User::pluck('id')->toArray();
    $articleIds = \App\Article::pluck('id')->toArray();
    return [
        'user_id'=>$faker->randomElement($userIds),
        'article_id'=>$faker->randomElement($articleIds)
    ];
});

$factory->define(App\Category::class, function (Faker\Generator $faker) {
    $userIds = \App\User::pluck('id')->all();
    return [
        'name' => $faker->randomElement(['前端','后端','android','IOS']),
        'user_id'=>$faker->randomElement($userIds),
    ];
});

$factory->define(App\ChildCategory::class, function (Faker\Generator $faker) {
    $userIds = \App\User::pluck('id')->all();
    $categories = \App\Category::pluck('id')->all();
    return [
        'name' => $faker->randomElement(['HTML','javascript','ps','mysql','php','ruby','java']),
        'user_id'=>$faker->randomElement($userIds),
        'category_id'=>$faker->randomElement($categories),
    ];
});
