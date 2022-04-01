# Laravel subscription app
This project was developed with docker so if you don't have docker compose then I suggest to go to the .env file and change the settings. (Database mainly but I used mailhog as well)

If you have docker then its very simple spin it up with this simple command:
- On linux ```docker-compose up (or start)```
- On windows ```docker compose up (or start)```

NOTE: On linux you might need to use ```sudo``` that depends on your docker setup.

You can migrate with this command ```docker-compose exec app php artisan migrate```.
After that you are able to seed the database with websites by running the ```docker-compose exec app php artisan db:seed```.
For users and posts I have exported a collection from my thunder client. (which should be compatible with postman)
If the thunder client export is not compatible I have also included a postman export.

Laravel: localhost:8000

(If used with docker)
PhpMyAdmin: localhost:8078
Mailhog: localhost:8025
