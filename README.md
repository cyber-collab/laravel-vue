# Laravel 9 + Vue 3 + Vite

# Deploy repository

Please, clone this repository form github, by this options:

| Option | Links                                                                                      |
| ------ | ------------------------------------------------------------------------------------------ |
| SHH    | [git@github.com:cyber-collab/laravel-vue.git](git@github.com:cyber-collab/laravel-vue.git) |
| HTTPS  | [https://github.com/cyber-collab/laravel-vue](https://github.com/cyber-collab/laravel-vue) |

## Services exposed outside your environment

Create a .env file copy from env.example.
Add key ZOHO in .env file for connecting to ZOHO API
In .env file add password for db connection.
Restart the container!

| Service   | Address outside containers    |
| --------- | ----------------------------- |
| Webserver | [localhost](http://localhost) |

# Deploye project

1. Please, open the terminal in repository, run `composer install` and `php artisan sail:install`.
2. Run `sail artisan migrate` and `sail artisan db:seed` for add tabels in db and data
3. Run `sail artisan key:generate` for generate key.
4. Run `php artisan storage:link` for create symbolic link, for upload images to public folder
5. Run `npm install` and `npm run build`, you need have 16 versions node or higher, for build vue
6. After that press to Login button and enter "admin@admin.com" and "password"
7. And you can see results
