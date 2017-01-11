1) NAME: 		e-Diary

2) TARGET:		Save the brain by saving tasks and contacts for whatever purpose. 

3) TARGET GROUP: 	Young people, Age 16-28.

4) ALTERNATIVES: Google Docs

5) DEVELOPER: Andry Žagars

6) VERSIONS:
v0.1 - Login / Sign-Up Screen
v0.2 - Home Screen
v0.3 - About Screen
v0.4 - Home Screen (Add Task)
v0.5 - Home Screen (Change/Delete Task)
v0.6 - Contacts Screen
v0.7 - Contacts Screen (Change/Delete Task (Code is not working here properly))
v0.8 - Design 
v0.9 - Design v2
v1.0 - The Real MVP
v1.1 - Leave a message and contact

8) DATABASE SCHEME:
user_sample (For Sign-Up and Login)
task_and_dates (For saving tasks)
contacts (For saving contacts)
user_contacts (For further developement, Can share contacts)

9) CONCLUSION:
Final version is going to be socialized e-diary, where users can share contacts, tasks and even set tasks for other person.
Õppisin juurde erinevate funktsioonide kasutamist ja nende sidumist. Lisaks andmebaaside sidumist php-s, mida hetkel ei ole kuvatud, kuid tuleb momendil kui juurdearenduses saab kontakte jagada.
Ebaõnnestus kontakti muutmine/kustutamine.
__________________________
# PHP rühmatöö projekt
**Rühmatööde demo päev** on valitud eksamipäev jaanuaris, kuhu tullakse terve rühmaga koos!

## Tööjuhend
1. Üks rühma liikmetest _fork_'ib endale käesoleva repositooriumi ning annab teistele kirjutamisõiguse/ligipääsu (_Settings > Collaborators_)
1. Muudate vastavalt _git config_'ut
```
git config user.name "Romil Robtsenkov"
git config user.email romilrobtsenkov@users.noreply.github.com
```
1. Üks rühma liikmetest teeb esimesel võimaluse _Pull request_'i (midagi peab olema repositooriumis muudetud)
1. Muuda repositooriumi README.md faili vastavalt nõutele
1. Tee valmis korralik veebirakendus

### Nõuded

1. **README.md sisaldab:**
    * suurelt projekti nime;
    * suurelt projekti veebirakenduse pilt;
    * rühma liikmete nimed;
    * eesmärki (3-4 lauset, mis probleemi üritate lahendada);
    * kirjeldus (sihtrühm, eripära võrreldes teiste samalaadsete rakendustega – kirjeldada vähemalt 2-3 sarnast rakendust mida eeskujuks võtta);
    * funktsionaalsuse loetelu prioriteedi järjekorras, nt
        * v0.1 Saab teha kasutaja ja sisselogida
        * v0.2 Saab lisada huviala
        * ...
    * andmebaasi skeem loetava pildina + tabelite loomise SQL laused (kui keegi teine tahab seda tööle panna);
    * **kokkuvõte:** mida õppisid juurde? mis ebaõnnestus? mis oli keeruline? (kirjutab iga tiimi liige).


2. **Veebirakenduse nõuded:**
    * rakendus on terviklik (täidab mingit funktsiooni ja sellega saab midagi teha);
    * terve arenduse ajal on kasutatud _git_'i ja _commit_'ide sõnumid annavad edasi tehtud muudatuste sisu; 
    * kasutusel on vähemalt 6 tabelit;
    * kood on jaotatud klassidesse;
    * koodis kasutatud muutujad/tabelid on inglise keeles;
    * rakendus on piisava funktsionaalsusega ja turvaline;
    * kõik tiimi liikmed on panustanud rakenduse arendusprotsessi.

## Abiks
* **Testserver:** greeny.cs.tlu.ee, [tunneli loomise juhend](http://minitorn.tlu.ee/~jaagup/kool/java/kursused/09/veebipr/naited/greenytunnel/greenytunnel.pdf)
* **Abiks tunninäited (rühmade lõikes):** [I rühm](https://github.com/veebiprogrammeerimine-2016s?utf8=%E2%9C%93&query=-I-ruhm), [II rühm](https://github.com/veebiprogrammeerimine-2016s?utf8=%E2%9C%93&query=-II-ruhm), [III rühm](https://github.com/veebiprogrammeerimine-2016s?utf8=%E2%9C%93&query=-III-ruhm)
* **Stiilijuhend:** [Coding Style Guide](http://www.php-fig.org/psr/psr-2/)
* **GIT õpetus:** [Become a git guru.](https://www.atlassian.com/git/tutorials/)
* **Abimaterjale:** [Veebirakenduste loomine PHP ja MySQLi abil](http://minitorn.tlu.ee/~jaagup/kool/java/loeng/veebipr/veebipr1.pdf), [PHP with MySQL Essential Training] (http://www.lynda.com/MySQL-tutorials/PHP-MySQL-Essential-Training/119003-2.html)


