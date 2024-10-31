## Setup
- `cp .env.example .env`
- Now change `.env` file
- Change configuration DB and Pusher
- Run `composer install`
- Run `php artisan migrate`
- Run `npm install`
- Run `npm run dev`
- Run `php artisan db:seed`
- Run `php artisan key:generate`
- Run `php artisan storage:link`
- Run `php artisan serve`


## Postman
Documenter API : https://documenter.getpostman.com/view/9885485/2sAY4vh325

## configuration pusher in frontend
    ```javascript
    import Echo from "laravel-echo";
    window.Pusher = require('pusher-js');

    window.Echo = new Echo({
        broadcaster: 'pusher',
        key: process.env.MIX_PUSHER_APP_KEY,
        cluster: process.env.MIX_PUSHER_APP_CLUSTER,
        forceTLS: true
    });

    window.Echo.private(`chatroom.${chatroomId}`)
        .listen('MessageSent', (e) => {
            console.log(e.message);
        });
    ```