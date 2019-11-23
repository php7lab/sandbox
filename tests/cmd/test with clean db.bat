@echo off

set rootDir="%~dp0/../../../../.."
set eloquentBinDir="%rootDir%/vendor/php7lab/eloquent/bin"
set selfPackageDir="%rootDir%/vendor/php7lab/sandbox"

cd %eloquentBinDir%
php console db:migrate:down --withConfirm=0
php console db:delete-all-tables --withConfirm=0
php console db:migrate:up --withConfirm=0
php console db:fixture:import --withConfirm=0

cd %selfPackageDir%
phpunit

pause