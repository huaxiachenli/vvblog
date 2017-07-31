
<p align="center">🎈 vvblog is an open source blog built with Laravel <a href="https://vvblog.top">https://vvblog.top</a></p>
<p align="center"><img src="https://vvblog.top/path/95b1b26f3e1b622b640229112d92fac4.png"/></p>


# **VVB**log

This is a powerful blog, I try to build the blog more beautiful, more convenient. 

`Laravel 5.*` and `adminlte` combined with the establishment of a good response and quickly dashboard.

I believe it will be better and better. If you are interested in this, you can join and enjoy it.


## Basic Features

- beautiful dashboard for users
- Statistical tables
- Content moderation
- Own markdown comments system
- multiple users write blog
- Multiple tags for the articles
- Multiple categories for the articles
- beautiful preview in article images
- Markdown Editor
- and more...

[vvblog](https://github.com/huaxiachenli/vvblog) Laravel 5.4

## Server Requirements

- PHP >= 5.6.4
- Node >= 6.x
- OpenSSL PHP Extension
- PDO PHP Extension
- Mbstring PHP Extension
- Tokenizer PHP Extension
- XML PHP Extension

## Preview

<https://vvblog.top/users/1/articles/4>

## Install

### 1. Clone the source code or create new project.

```shell
git clone https://github.com/jcc/blog.git
```


### 2. Set the basic config

```shell
cp .env.example .env
```

Edit the `.env` file and set the `database` and other config for the system after you copy the `.env`.example file.

### 2. Install the extended package dependency.

Install the `Laravel` extended repositories: 

```shell
composer install
```

### 3. Run the artisan migrate command, the command will run the `migrate` command and generate test data.

```shell
php artisan migrate
```

### 4. Run the artisan key:generate command, the command will generate the key in `.env` file

```shell
php artisan key:generate
```

### 4. Run the artisan serve command, the command will run the `php -S localhost:8000` for the Application,you can open the browser in <http://127.0.0.1> for preview

```shell
php artisan serve
```

## Contributors

- [huaxiachenli](http://github.com/huaxiachenli)


## License

The project is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT).

contact me :<huaxiachenli@hotmail.com>