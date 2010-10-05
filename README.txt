NBlog
=====

NBlog is web application written in PHP 5.3. It require Apache 2 web server, PHP 5.3,
Nette Framework 2-dev and  ORM library Doctrine 2 (beta 4). These are not included in repo!
NBlog strive to be compatible with actual nightly builds of Nette Framework 2-dev for PHP 5.3.

NBlog represents simple blogging solution. It is intended as education project, it is not proper
solution for production environment. However new function appears quickly, so you can expect
that NBlog will be soon representing fully qualified blogging stack.

At this point NBlog can/supports:
- listing of articles excerpts on the homepage with associated tags and number of comments
- listing of articles excerpts filtered by concrete tag
- listing of full article with associated tags and comments
- adding of new comments to the article (by AJAX!)
- login/logout to/from administration
- Texy! processing of articles and comments


Installation
============

- Download source codes of NBlog, by cloning repository or as an archive.
- Place files in DocumentRoot of your Apache webserver or create new virtualhost (recomended).
- Make sure that folder `var` (and all subfolders) is writable by webserver (file permissions 777).
- Copy Nette Framework 2 (nightly build) and Doctrine 2 (beta 4) libraries to `libs` folder.
- Setup your DB connection in `app/config.ini`
- Change default setting (fill another random string) of so-called "salt" in `app/config.ini`, in all sections.
- Create structure of database:
  - by command line interface `doctrine-cli`:
    - linux: `./scripts/doctrine orm:schema-tool:create`
    - windows `php -f scripts/doctrine-cli.php orm:schema-tool:create`
  - by running SQL script `resources/database/dump.sql` (run on already created database!)


Note: Nette Framework 2-dev has bug - new snippets does not work. So it is needed to do small "hack".
  Open file `libs/Nette/Templates/Filers/LatteFilter.php` and change line 137 to:

list(, $macro, $value, $modifiers) = String::match($matches['macro'], '#^(/?[a-z0-9.]+)?(.*?)(\\|[a-z](?:'.Tokenizer::RE_STRING.'|[^\'"]+)*)?$()#is');
