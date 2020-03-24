# Tech contra virus

This repository contains the code for a PHP, Laravel-based website listing ideas for 
how technology can help in the 2020 coronavirus crisis. Visitors can submit new ideas, 
comment on them, and vote +1 / -1 indicating their support.

## Running

I'm assuming you have PHP, Composer and NPM installed and set up.

Set up a MariaDB / MySQL database and schema to be used by the application.

Then, run the following commands:

    git clone https://github.com/epforgpl/techkontrawirus.git
    cd techkontrawirus
    composer install
    npm install
    npm run dev
    cp .env.example .env
    php artisan key:generate
    
At this point, please edit the `.env` file, setting at least the variables
responsible for DB connection.

To create all the required tables in the database and seed it with example data, run:

    php artisan migrate
    php artisan db:seed

Finally, run:

    php artisan serve
    
A locally running website will then be available at [http://localhost:8000](http://localhost:8000).

## Author

The code in this repository was produced by [Fundacja ePaństwo](https://epf.org.pl).

## License

The code in this repository is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
