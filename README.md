# judoshiai.eu [![StyleCI](https://github.styleci.io/repos/282250229/shield?branch=master)](https://github.styleci.io/repos/282250229?branch=master)

The idea of this project is to develop a platform for managing competition activities for, primarily Judo competitions.

Can be used for registration of competitions, contestants, live results, live streaming and finally also a complete competition system.

Everyone is welcome to contribute and above all learn more about PHP, Laravel, MySql, Github etc.

For more information please visit the [Wiki](https://github.com/rogasp/judoshiai.eu/wiki) or contact roger.aspelin@hotmail.se

## Installation
### Prerequisites
* To run this project, you must have PHP 7 installed.
* You should setup a host on your web server for your local domain. For this you could also configure Laravel Homestead or Valet.
* If you want use Redis as your cache driver you need to install the Redis Server. You can either use homebrew on a Mac or compile from source (https://redis.io/topics/quickstart).
### Step 1
Begin by cloning this repository to your machine, and installing all Composer & NPM dependencies.  
```bash
git clone git@github.com:rogasp/judoshiai.eu.git
cd judoshiai.eu && composer install && npm install
php artisan key:generate
npm install && npm run dev
```
### Step 2
* Create a new database and name it judoshiai.eu

Next, boot up a server and visit your website. If using a tool like Laravel Valet, of course the URL will default to http://judoshiai.test.  

* Visit: http://judoshiai.test/register to register a new account.
## License
[MIT](https://github.com/rogasp/judoshiai.eu/blob/master/LICENSE)
## JudoShiai.EU Sponsors

If you are interested in becoming a sponsor, please visit the Laravel [Patreon page](https://patreon.com/judoshiai).


