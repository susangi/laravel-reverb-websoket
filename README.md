## Broadcasting (Laravel Websoket)

## Installation

Clone the repository

    git clone https://github.com/susangi/laravel-reverb-websoket.git

Switch to the repo folder

    cd laravel-reverb-websoket

Install all the dependencies using composer

    composer install

Install NPM Dependencies

    npm install

Copy the example env file and make the required configuration changes in the .env file

    cp .env.example .env

Generate a new application key

    php artisan key:generate
    
We need to generate migration and create tables for a queue.

    php artisan queue:table

Run the database migrations 

    php artisan migrate

Add the variable `BROADCAST_DRIVER` to the .env file with the value set to `reverb`. This environment variable specifies the broadcasting channels. Additionally, set unique values for `REVERB_APP_ID`, `REVERB_APP_KEY`, and `REVERB_APP_SECRET` in order to configure the broadcasting channels for the project. `QUEUE_CONNECTION` value change to `database`

**_Note_** : Set up supervisor for queues run.
Please run these commands

    sudo apt-get install supervisor

Set up Supervisor configurations by copying the `laravel-worker.conf` and `reverb-websocket.conf` files from the project's `config` folder and paste them into the `/etc/supervisord.d/` directory.

start supervisor

    sudo supervisorctl reload
    sudo supervisorctl update
    sudo supervisorctl start reverb-websocket:*
    sudo supervisorctl start laravel-worker:*
