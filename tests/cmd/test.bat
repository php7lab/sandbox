@echo off

set rootDir="%~dp0/../../../../.."
set selfPackageDir="%rootDir%/vendor/php7lab/sandbox"

cd %selfPackageDir%
phpunit

pause