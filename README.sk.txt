NBlog
=====

NBlog je webová aplikácia napísaná v jazyku PHP 5.3. K svojmu behu vyžaduje webový server Apache 2,
PHP 5.3,  Nette Framework 2-dev a ORM knižnicu Doctrine 2 (beta 4). Tie nie sú súčasťou repozitára!
NBlog sa snaží byť kompatibilný s aktuálnym vydaním Nette 2-dev nightly build PHP 5.3.

NBlog predstavuje jednoduché blogovacie riešenie. Je určený na edukatívne účely, momentálne
nie je vhodný do ostrého nasadenia ako fungujúca aplikácia. Funkcie však rýchlo pribúdajú
a je preto možné predpokladať, že sa čoskoro z neho stane plnohodnotná aplikácia.

Momenálne podporuje/funguje:
- výpis skrátených článkov (perexy) na titulnej stranke s informáciou o tagoch a počte komentárov
- výpis skrátených článkov (perexy) filtrovaných podľa tagu
- výpis plného článku aj s tagmi a komentármi
- pridávanie komentárov k článku (AJAXovo!)
- prihlásenie/odhlásenie do/z administrácie


Inštalácia
==========

- Stiahnite si zdrojové kódy NBLog buď pomocou `git clone` alebo ako archív.
- Uložte súbory do zložky DocumentRoot webového servera Apache, alebo vytvorte nový virtualhost (doporučované).
- Zložke `var` (a všetkým jej podzložkám) nastavte práva na 777.
- Nakopírujte do zložky `libs` knižnice Nette Framework 2 (nightly build)  a Doctrine 2 (beta 4).
- Nastavte databázové pripojenie v súbore `app/config.ini`
- Zmeňte defaultné nastavenie tzv. "soli" v `app/config.ini`, riadok 37 - vyplňte INÝ náhodný reťazec.
- Vytvorte štruktúru databázy:
  - pomocou konzolového rozhrania `doctrine-cli`:
    - linux: `./scripts/doctrine orm:schema-tool:create`
    - windows `php -f scripts/doctrine-cli.php orm:schema-tool:create`
  - pomocou SQL scriptu `resources/database/dump.sql` (script spustite nad vytvorenou databázou!)


Pozn.: Nette Framework 2-dev momentálne obsahuje bug - nefungujú nové snippety. Je preto treba
  vykonať v jeho knižniciach malú "opravu".
  Otvorte súbor `libs/Nette/Templates/Filers/LatteFilter.php` a zmeňte riadok 137 na:

list(, $macro, $value, $modifiers) = String::match($matches['macro'], '#^(/?[a-z0-9.]+)?(.*?)(\\|[a-z](?:'.Tokenizer::RE_STRING.'|[^\'"]+)*)?$()#is');
