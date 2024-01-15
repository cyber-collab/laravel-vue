# Laravel 9 + Vue 3 + Vite

# Deploy repository

Please, clone this repository form github, by this options:

| Option | Links                                                                                      |
| ------ | ------------------------------------------------------------------------------------------ |
| SHH    | [git@github.com:cyber-collab/laravel-vue.git](git@github.com:cyber-collab/laravel-vue.git) |
| HTTPS  | [https://github.com/cyber-collab/laravel-vue](https://github.com/cyber-collab/laravel-vue) |

# How to run docker

Dependencies:

-   docker. See [https://docs.docker.com/engine/installation](https://docs.docker.com/engine/installation)
-   docker-compose. See [docs.docker.com/compose/install](https://docs.docker.com/compose/install/)

Once you're done, simply `cd` to your project and run `composer install`. After this make `php artisan sail install && sail up -d`, this will initialise and start all the
containers, then leave them running in the background.

## Services exposed outside your environment

Create a .env file copy from env.example
Restart the container!

| Service   | Address outside containers    |
| --------- | ----------------------------- |
| Webserver | [localhost](http://localhost) |

# Deploye project

1. Please, open the terminal in repository, run `sail artisan migrate` and `sail artisan db:seed` for add tabels in db and data
2. Run `npm install` and `npm run build`, you need have 16 versions node or higher
3. After that press to Login button and enter "admin@admin.com" and "password"
4. And you can see results
