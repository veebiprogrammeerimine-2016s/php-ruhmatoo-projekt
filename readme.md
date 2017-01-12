hello# PHP rühmatöö projekt
 -**Rühmatööde demo päev** on valitud eksamipäev jaanuaris, kuhu tullakse terve rühmaga koos!
 -
 -## Tööjuhend
 -1. Üks rühma liikmetest _fork_'ib endale käesoleva repositooriumi ning annab teistele kirjutamisõiguse/ligipääsu (_Settings > Collaborators_)
 -1. Muudate vastavalt _git config_'ut
 -```
 -git config user.name "Romil Robtsenkov"
 -git config user.email romilrobtsenkov@users.noreply.github.com
 -```
 -1. Üks rühma liikmetest teeb esimesel võimaluse _Pull request_'i (midagi peab olema repositooriumis muudetud)
 -1. Muuda repositooriumi README.md faili vastavalt nõutele
 -1. Tee valmis korralik veebirakendus
 -
 -### Nõuded
 -
 -1. **README.md sisaldab:**
 -    * suurelt projekti nime;
 -    * suurelt projekti veebirakenduse pilt;
 -    * rühma liikmete nimed;
 -    * eesmärki (3-4 lauset, mis probleemi üritate lahendada);
 -    * kirjeldus (sihtrühm, eripära võrreldes teiste samalaadsete rakendustega – kirjeldada vähemalt 2-3 sarnast rakendust mida eeskujuks võtta);
 -    * funktsionaalsuse loetelu prioriteedi järjekorras, nt
 -        * v0.1 Saab teha kasutaja ja sisselogida
 -        * v0.2 Saab lisada huviala
 -        * ...
 -    * andmebaasi skeem loetava pildina + tabelite loomise SQL laused (kui keegi teine tahab seda tööle panna);
 -    * **kokkuvõte:** mida õppisid juurde? mis ebaõnnestus? mis oli keeruline? (kirjutab iga tiimi liige).
 -
 -
 -2. **Veebirakenduse nõuded:**
 -    * rakendus on terviklik (täidab mingit funktsiooni ja sellega saab midagi teha);
 -    * terve arenduse ajal on kasutatud _git_'i ja _commit_'ide sõnumid annavad edasi tehtud muudatuste sisu; 
 -    * kasutusel on vähemalt 6 tabelit;
 -    * kood on jaotatud klassidesse;
 -    * koodis kasutatud muutujad/tabelid on inglise keeles;
 -    * rakendus on piisava funktsionaalsusega ja turvaline;
 -    * kõik tiimi liikmed on panustanud rakenduse arendusprotsessi.
 -
 -## Abiks
 -* **Testserver:** greeny.cs.tlu.ee, [tunneli loomise juhend](http://minitorn.tlu.ee/~jaagup/kool/java/kursused/09/veebipr/naited/greenytunnel/greenytunnel.pdf)
 -* **Abiks tunninäited (rühmade lõikes):** [I rühm](https://github.com/veebiprogrammeerimine-2016s?utf8=%E2%9C%93&query=-I-ruhm), [II rühm](https://github.com/veebiprogrammeerimine-2016s?utf8=%E2%9C%93&query=-II-ruhm), [III rühm](https://github.com/veebiprogrammeerimine-2016s?utf8=%E2%9C%93&query=-III-ruhm)
 -* **Stiilijuhend:** [Coding Style Guide](http://www.php-fig.org/psr/psr-2/)
 -* **GIT õpetus:** [Become a git guru.](https://www.atlassian.com/git/tutorials/)
 -* **Abimaterjale:** [Veebirakenduste loomine PHP ja MySQLi abil](http://minitorn.tlu.ee/~jaagup/kool/java/loeng/veebipr/veebipr1.pdf), [PHP with MySQL Essential Training] (http://www.lynda.com/MySQL-tutorials/PHP-MySQL-Essential-Training/119003-2.html)
 
 
 Liikmed: Regina Junkina, Edgar Selihov
 
 Projekti nimetus: "Notebook repair"
 
 Eesmärk:
		Luua veebisait arvuti parandamiseks, et iseseisavalt võiks registreerida ja jälgida remondi seisund.
		
Funktsionaalsuse loetelu:
		1 leht Welcome (about us)
		2 leht Search your item
		3 leht Register your computer to repair
		4 leht contacts
		5 leht Sign in (for admins)
		6 leht edit0 (show all registred devices to admin)
		7 leht edit (allows to edit data [only for admins])

SQL laused:

	CREATE TABLE logindata (
	id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
 	email VARCHAR (255) UNIQUE,
 	password VARCHAR(180),
 	created timestamp,
 	user_status VARCHAR(180) UNIQUE);
	
	CREATE TABLE repairing (
	id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	paid_warranty VARCHAR (30),
	serialnumber VARCHAR (20),
	device VARCHAR (30),
	model VARCHAR (50),
	date_of_purchase DATE,
	first_lastname VARCHAR (75),
	country VARCHAR (30),
	city VARCHAR (30),
	address VARCHAR (30),
	postcode INT,
	email VARCHAR (50),
	number INT,
	problem TEXT,
	add_info TEXT,
	rma VARCHAR (10),
	status VARCHAR (20),
	deleted DATE NULL

	);
	
Kokkuvõtte:
	
	Regina - Tegelesin disainiga, kirjutasin funktsioonid nagu generatePassword(), parandasin vigu andmete salvestamise kohta andmebaasile.
	
	Edgar - luuasin andmebaas "repairing" ja "logindata", tegin et edit page andis parandada andmed, luuasin HTML tabeli, tegin "search".
	
	