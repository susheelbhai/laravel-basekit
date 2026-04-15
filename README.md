# Starter Kit for Laravel Project

## Installation

### Laravel
Require this package in your composer.json and update composer. This will download the package.

:warning: This package must be installed just after creating new laravel project. Installing in working project may cause overwriting your important files.

    composer require susheelbhai/laravel-basekit

## Configuration

### Required command order
Run these **3 commands in the same order**:

Installs required **Composer** and **NPM** packages used by the starter kit (already present packages are skipped automatically).

  ```
  php artisan basekit:install_package
  ```

Publishes starter kit resources into your app (config, routes, views including Blade themes under `resources/views/themes`, assets, storage scaffolding, tests, etc).

  ```
  php artisan basekit:publish
  ```

Applies initial project setup (updates `.env` values and writes required config keys like `app.render_type`, mail flags, timezone, etc).

  ```
  php artisan basekit:initial_settings
  ```


### Migrate database

Migrate  databse tables and seed with the following commands

  ```
  php artisan migrate
  php artisan db:seed
  
  ```

Alternatively you can refresh the database and seed with the following commands

  ```
  php artisan migrate:fresh --seed
  
  ```

### Final Settings
Change Final settings by runnung the command

  ```
  php artisan basekit:final_settings

  ```

### Link your storage folder to public folder


  ```
  php artisan storage:link

  ```

### Create a build

Make production build

  ```
  npm run build

  ```

run development environment

  ```
  npm run dev
  
  ```


## Installation with single action

  create a new folder with the appropriate project name, open terminal and run the following command.

  ```
  laravel new
  
  ```


  #### navigate to the directory and run the following commands

  ```
  composer require susheelbhai/laravel-basekit
  
  php artisan basekit:install_package
  php artisan basekit:publish
  php artisan basekit:initial_settings
  php artisan migrate:fresh --seed
  php artisan basekit:final_settings
  php artisan storage:link
  npm run build
  npm run dev

  ``` 

## Installation (step-by-step)

See the **Installation with single action** section below for the one-shot command list, or follow the detailed steps under **Configuration** (required command order → migrate database → final settings → storage link → build/dev).

  ### start development server.
  #### if php artisan serve is not working, you use the alternative command
  ```
  php -S 127.0.0.1:23456 -t public
  ```
  

## Deployment checklist
 
 ### update .env file
  ```
  APP_ENV=production
  APP_DEBUG=false
  APP_URL="actual url"
  ```

  ### AppServiceProvider
  replace public_html with your actual public folder name

  ### Create symlink
  
  ```
  https://yourdomain.com/link-storage
  ```  


### License

This Laravel Starter Kit Package is developed by susheelbhai for personal use software licensed under the [MIT license](http://opensource.org/licenses/MIT)
