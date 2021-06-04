#Local DB de laravel adında database oluşturulmalı
 
#Kurulum
 
composer install

#Tabloların ve Dataların Oluşturulması

php artisan migrate

php artisan db:seed 

#Console Komutları Providerların içeri import edilmesi

php artisan task:update

#Oluşturulan dataların viewda gösterilmesi

php artisan key:generate

php artisan serve