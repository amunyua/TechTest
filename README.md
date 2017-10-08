# TechTest
# Installation process
1) clone the repo on you computer
2) using a command prompt, run composer update
3) Create a database, name it techtest
4) edit your .env file located on the root directory of the cloned repo, under database, change the database credentials to match yours. 
5) run php artisan key:generate
6) run php artisan migrate --seed ; this will create the table and seed the user data as required.
7) run php artisan serve.

Everything should work now
