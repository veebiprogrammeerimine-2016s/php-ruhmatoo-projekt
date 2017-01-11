Nimi: IDEAS FOR WEBSITE PROJECT
Liikmed: Anna Gubskaja, Mihhail Kuzmin
Eesmärk: 
	Luua veebisait nende inimeste jaoks, kes otsivad endale lihtsaid ja originaalseid veebilehtede ideid ning nendele, kes soovivad enda ideid pakkuda.
	Selline veebisait oleks kasulik tulevatele tudengitele kes otsivad ideid projektide loomiseks, kuna me ise raiskasime palju aega selleks, et
	leida huvitav idee enda projekti jaoks.
Kirjeldus: 
	Veebileht on suunatud kõigile inimestele, kes on huvitatud veebiprogrammeerimisest, aga peamine sihtrühm on Informaatika eriala üliõppilased.
	Pakutud ideed ei pea olema väga keerulised, sest orienteeriv kasutajate sihtrühm ei ole veebiprogrammeerimises väga osakas.
Funktsionaalsuse loetelu:
	Leht 1 Signup ja login
	Leht 2 Tabel pakutud ideedega
	Leht 3 Kasutaja leht - võimalus valida lemmik programmeerimise keel või lisada enda oma
	Aken 1 Idee lisamine - selle nimetus ja kirjeldus
SQL-laused:
	CREATE TABLE user_sample (id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	email VARCHAR (255) UNIQUE,
	password VARCHAR(180),
	created timestamp,
	nickname VARCHAR(180) UNIQUE);
	
	CREATE TABLE idea_description (id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	idea VARCHAR(255) UNIQUE,
	description TEXT,
	deleted DATE,
	user VARCHAR(255),
	FOREIGN KEY user REFERENCES user_sample(email));
	
	CREATE TABLE user_level (id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	level VARCHAR(255));
	
	CREATE TABLE user_levels (id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	user_id INT,
	level_id INT,
	FOREIGN KEY user_id REFERENCES user_sample(id),
	FOREIGN KEY level_id REFERENCES user_level(id));
	
Kokkuvõte:
	Anna - õppisin juurde funktsioonide kirjutamist, bootstrapi kasutamist, parandasin ja täiendasin teadmisi SQL tabelite muutmise kohta.
	Välja ei tulnud Edit-lehe funktsioneerimine ja submit-nupu loomine mis käituks nagu href ning samuti salvestaks sisestatud andmeid.
	
	Mihhail - õppisin juurde bootstrapi kasutamist. Välja ei tulnud hindamis-süsteemi loomine.
	

**************************************************************************************************************************************************************
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


asdsadasdsasds
