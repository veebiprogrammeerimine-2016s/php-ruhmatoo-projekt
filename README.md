#TREENI.EE
* [Veebileht](http://greeny.cs.tlu.ee/~marikraav/php-ruhmatoo-projekt/page/login.php)

##Liikmed
* Mariann Kraav, Elise Pals, Karoliina Kullamaa

##Eesmärk
Veebirakenduse eesmärk on muuta inimesed füüsiliselt aktiivsemaks võimaldades neil treeningpäevikusse oma andmeid tehtud treeningute kohta salvestada, foorumis kaastreenijatega suhelda, teineteist motiveerida ning soovi korral leida treeningpartner. 

##Eeskuju, sihtrühm, eripära
Antud veebirakenduse eeskujuks on võetud forums.fitness.ee, kus kasutajad saavad lisada erinevaid spordialaseid teemasid. 
Rakenduse sihtrühmaks on kõikidest vanusegruppidest inimesed, kes soovivad enda füüsilist vormi parandada. 
Meie rakenduse eripäraks on kasutaja enda treeningpäeviku osa kalendrina, kuhu saab sisestada andmeid tehtud treeningute kohta.

##Funktsionaalsus
* **Funktsionaalsuse loetelu prioriteedi järjekorras:**
* v0.1 Avalehel saab luua uue kasutaja ja sisselogida
* v0.2 Foorumis on näha teiste kasutajate poolt sisestatud teemasid
* v0.3 Kasutaja saab foorumisse ise sisestada teema või teemale vastuse (koos pildiga)
* v0.4 Kasutaja saab enda sisestatud teemat muuta/kustutada
* v0.5 Treeningpäevikus on võimalus näha kasutajaandmeid ning neid muuta
* v0.6 Treeningpäevikusse saab sisestada kalendri abil andmeid tehtud treeningute kohta
* v0.7 Tehtud treeningute andmed kuvatakse tabelina

##Andmebaasi skeem loetava pildina + tabelite loomise SQL laused

```
CREATE TABLE users(
	id INT(11), NOT NULL, AUTO INCREMENT, PRIMARY KEY
	username VARCHAR(300), NOT NULL
	firstname VARCHAR(300), NOT NULL
	lastname VARCHAR(300), NOT NULL
	email VARCHAR(255), NOT NULL
	password VARCHAR(128), NOT NULL
	gender VARCHAR(20), NOT NULL
	phonenumber VARCHAR(300), NOT NULL
	created TIMESTAMP, NOT NULL, DEFAULT CURRENT TIMESTAMP
);

CREATE TABLE topics(
	id INT(11), NOT NULL, AUTO INCREMENT, PRIMARY KEY
	user_id INT(11), NOT NULL
	username VARCHAR(300), NOT NULL
	subject VARCHAR(300), NOT NULL
	content TEXT, NOT NULL
	category VARCHAR(300), NOT NULL
	file VARCHAR(500), NOT NULL
	created TIMESTAMP, NOT NULL, DEFAULT CURRENT TIMESTAMP
	deleted DATE, NULL
);

CREATE TABLE replies(
	id INT(11), NOT NULL, AUTO INCREMENT, PRIMARY KEY
	user_id INT(11), NOT NULL
	username VARCHAR(300), NOT NULL
	topic_id INT(11), NOT NULL
	content TEXT, NOT NULL
	file VARCHAR(500), NOT NULL
	created TIMESTAMP, NOT NULL, DEFAULT CURRENT TIMESTAMP
	deleted DATE, NULL
);

CREATE TABLE replies(
	id INT(11), NOT NULL, AUTO INCREMENT, PRIMARY KEY
	user_id INT(11), NOT NULL
	exercise VARCHAR(255), NOT NULL
	sets VARCHAR(255), NOT NULL
	repeats VARCHAR(255), NOT NULL
	notes TEXT, NOT NULL
	training_time VARCHAR(255), NOT NULL
	deleted DATE, NULL
);
```

##Kokkuvõte:
* **Mariann:** 
	* **Mida õppisid juurde?**
	* **Mis ebaõnnestus?**
	* **Mis oli keeruline?**
	
* **Elise:**
	* **Mida õppisid juurde?**
	* **Mis ebaõnnestus?**
	* **Mis oli keeruline?**
	
* **Karoliina:**
	* **Mida õppisid juurde?** Õppisin juurde, kuidas töötab foorum ning funktsioonide liikumine selle siseselt; kuidas muuta parooli ning kuidas siduda omavahel kalender ja kasutaja sisestatud andmed; veebirakenduse disaini.
	* **Mis ebaõnnestus?** Aja planeerimine
	* **Mis oli keeruline?** Errorite lahendamine ja treeningpäevikusse kalendri lisamine, kuhu kasutaja saaks ka andmeid sisestada.