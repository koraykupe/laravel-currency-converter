## Currency Converter

This project allows to check exchange rates by given amount and currency. It uses an external services to fetch the data.
The data can be updated manually, but also updated daily via a cron job.

- Based on newest Laravel 6.2 version
- Followed Laravel way by keeping decoupling
- Avoided from over-engineering
- Has an admin role to list/add/delete users and authorized IPs
- It requires to register and login to use the service. Client IP must be in the authorized IPs table.
- Allowed currencies can be configured on config file (config/currencies.php)
- Bootstrap and some npm packages are used for frontend
- Requests are validated
- Some useful logging is enabled for successful imports, errors etc. If the API gives an error, it will be logged and error message will be shown on console output.
- DB transaction is used when updating records. If something goes wrong, old data won’t be deleted (or rollback)
- Popular [Guzzle](http://docs.guzzlephp.org/en/stable/) library is used for HTTP
- I didn’t make the service URL interchangable. It would be overkill for such a simple project. But if we want to do that, we could create an interface, use dependency injection and IoC.
- I didn’t want to make design busy by showing rate updated time.
- For IP restriction check I used guards. Middleware could be another option, but it is a simple check and guards are more authorisation specific.
- Gates and policies are for checking ‘abilities’ for a user. User groups are out of scope. (You can still use them btw) Hence, I created a middleware for my simple admin group check.


## Installation
The project has a docker compose, so you may run it on containers. Alternatively, you may use Laravel Valet.

- Run `composer install` to install dependency packages
- Run `npm install && npm run dev` for frontend stuff
- Run `docker-compose build` and `docker-compose up`
- Run `docker exec -i currency_converter_app php artisan migrate` to build up database
- Run `php artisan import:exchange-rates` to update the data
- The project should be run on `http://localhost:8002/` but it depends on your docker configuration too.
- You will see a message that says your IP is not in authorized IP list. You can add your IP address to the list using `php artisan add:authorized-ip {your ip}`
- If you want to run the daily scheduler, you may check [Laravel task scheduling setup](https://laravel.com/docs/6.x/scheduling)
- I created a seeder to create an admin account. You can run `php artisan db:seed` to add it to the db. After you run it you can login with `koray@localhost` email and `secretpassword` password as an admin.

## How to Update The Exchange Rates?
- You can manually run `php artisan import:exchange-rates`. It will fetch all allowed currency data, but if you want you fetch one specific currency, you can use it with an optional parameter. e.g: `php artisan import:exchange-rates AUD`.  I didn’t add validation, so you may import some data even if code is not in the allowed currencies list.

## What would be done if it is a big scale project?
- Allowed currencies for source and target currencies could be set separately
- Currency symbol support
- In some currencies symbol/code may be written after the amount
- For better permission management, `spatie/laravel-permission` is a nice package
- Creating REST APIs and consume them on frontend
- For admin group, instead of gates, policies could be better
- Logs could be moved to events
- Pagination could be added to user listing
- Edit for users and IPs
- Multi language support
- Logging exchange rate history
