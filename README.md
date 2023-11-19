# M-Cast

Laravel and NuxtJs base micro blogging site. Also user has social network chain.

### Database Schema
https://dbdiagram.io/d/Heleevo-640db72a296d97641d87425d

### Postman Collection link
Import this link on your postman client for API collections: 
`https://api.postman.com/collections/1531522-7c558042-7e97-4f2a-b11d-c30708ab4b68?access_key=PMAT-01HFMHQ0CAP7V1T1FPC6PFPNAK`

This application has two separate folder.
- **Backend**: For Api and build with laravel10
- **Frontend**: For client view and build with NuxtJS3

## Installation Steps
```text
- PHP 8.1.0 or greater & Composer 2.2.0 Required for backend setup 
- NodeJs 18 or greater Required for fronted setup
```

**First:** clone the project 
```shell
git clone git@github.com:Azim1993/mCast.git
```
**Then:** `cd mCast\Backend`

Backend application install steps:
1. install dependency 
```shell
    composer install
```
2. copy .env.example to .env for environment setup by `cp .env.example .env`. Also set a application key by `php artisan generate:key`
3. For migration the db schema
```shell
    php artisan migrate
```
3. For demo data seed
```shell
    php artisan migrate
```
4. If you are using file disk `public`, then set `FILESYSTEM_DISK=public`. Also link up the storage with public folder by `php artisan storage:link`

**After completing those steps, just go back to the project root. `cd ..`**. Then go to the frontend folder `cd frontend`
then follow the below steps:
1. install dependency  `yarn install`
2. Then run `cp .env.example .env` and set the backend api url with `/api`
3. Then run the server by `yarn run dev`

**VOILA, now you can browse the application**


## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
