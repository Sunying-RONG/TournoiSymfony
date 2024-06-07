# TournoiSymfony
- lanch XAMPP, start MySQL Database
- http://localhost/phpmyadmin/ 

Construct php script of migration to evaluate all defined entities and their differences with actual status in DB.  
$bin/console make:migration

execut migration from entities to DB
$bin/console doctrine:migrations:migrate

$composer req twig

$bin/console make:controller Tournoi
