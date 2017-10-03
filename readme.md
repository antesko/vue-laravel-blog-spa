# SimpleBlog - Vue.js 2 + Laravel 5 SPA

SimpleBlog is a single-page demo blog project which uses Laravel 5.4 and Vue.js 2. 

## Features
* User login/registration
* Displaying paginated list of blog posts
* Creating and editing blog posts
* Writing post comments
* Editing user profile
* Viewing other authors' profiles
* Image upload

## Built With
* Backend (API):[Laravel 5.4](https://laravel.com/docs/5.4)
* Frontend:[Vue.js 2](https://vuejs.org/)
* Routing:[vue-router 2](https://router.vuejs.org/en/)
* Authentication: OAuth2 with[Laravel Passport](https://laravel.com/docs/5.4/passport)
* HTTP client: [Axios](https://github.com/axios/axios)

## Installation

* Copy the `.env.example` to `.env` and edit the parameters to match your environment. Set `APP_URL` and DB config variables.
* `composer install`
* `npm install`
* `npm run dev`
* Generate the app key: `php artisan key:generate`
* Migrate and seed the DB: `php artisan migrate --seed`
* Configure Laravel Passport ([LINK](https://laravel.com/docs/5.4/passport)):
  * Generate encription keys: `php artisan passport:keys`
  * Generate new password grant client: `php artisan passport:client --password`  
Write down the `Client ID` and `Client Secret` and add them to your `.env` file
* **You're done!**   
You can now register a new user, or use one from the DB. All users have a default password: 'secret'


### Acknowledgments

* Hat tip to Renato from [devlob](http://www.devlob.com/) for his authentication package tutorial
