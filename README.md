Thuê xe sân bay Vĩnh Tín - https://thuexesanbayvinhtin.com

install:

git clone https://github.com/dungld96/thueoto.git

composer install

cp .env.example .env && php artisan key:generate

php artisan migrate

php artisan db:seed

open mysql and run sql script in /database/data