<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        DB::table('users')->insert([
            'name' => '陈立',
            'email' => 'huaxiachenli@hotmail.com',
            'password' => bcrypt('11111111'),
        ]);
        factory(App\User::class,30)->create();

        factory(App\Category::class,50)->create();
        factory(\App\ChildCategory::class,100)->create();
        factory(App\Article::class,400)->create();

        factory(\App\Skill::class,10)->create();
        factory(\App\Comment::class,200)->create();
    }
}
