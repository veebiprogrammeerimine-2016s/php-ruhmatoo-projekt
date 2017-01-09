#TREENI.EE
* [Veebileht](http://greeny.cs.tlu.ee/~marikraav/php-ruhmatoo-projekt/page/login.php)
Esileht
![Preview](Esileht.jpg)

##Liikmed
* Mariann Kraav, Karoliina Kullamaa, Elise Pals

##Eesmärk
Veebirakenduse eesmärk on muuta inimesed füüsiliselt aktiivsemaks võimaldades neil treeningpäevikusse oma andmeid tehtud treeningute kohta salvestada, foorumis kaastreenijatega suhelda, teineteist motiveerida ning soovi korral leida treeningpartner. 

##Eeskuju, sihtrühm, eripära
Antud veebirakenduse eeskujuks on võetud forums.fitness.ee, kus kasutajad saavad lisada erinevaid spordialaseid teemasid. Teiseks eeskujuks on fiile.ee, kus on nii kalender kui ka foorum, kuid mis on oma disainiga juba ajast maha jäänud ning seda on ebamugav kasutada.
Rakenduse sihtrühmaks on kõikidest vanusegruppidest inimesed, kes soovivad enda füüsilist vormi parandada. 
Meie rakenduse eripäraks on kasutaja enda treeningpäeviku osa kalendrina, kuhu saab sisestada andmeid tehtud treeningute kohta.

##Funktsionaalsus
* **Funktsionaalsuse loetelu prioriteedi järjekorras:**
* v0.1 Avalehel saab luua uue kasutaja ja sisse logida
* v0.2 Foorumis on näha teiste kasutajate poolt sisestatud teemad, mida saab otsida ning sorteerida
* v0.3 Kasutaja saab foorumisse ise sisestada teema (soovil koos pildiga)
* v0.4 Kasutaja saab enda sisestatud teema kustutada
* v0.5 Kasutaja saab teedadele vastada (soovil koos pildiga)
* v0.6 Kasutaja saab oma vastuseid muuta/kustutada
* v0.7 Treeningpäevikus on võimalus näha kasutajaandmeid ning neid muuta
* v0.8 Treeningpäevikusse saab sisestada kalendri abil andmeid tehtud treeningute kohta
* v0.9 Tehtud treeningute andmed kuvatakse tabelina, kust on võimalik treeninguid otsida ja neid sorteerida
* v0.10 Treeningute andmeid saab kustutada

* Andmebaasi skeem loetava pildina + tabelite loomise SQL laused (kui keegi teine tahab seda tööle panna);
![Preview](Andmebaasi_skeem.jpg)

##Kokkuvõte:
* **Mariann:** 
	* **Mida õppisid juurde?** Rühmatöö käigus õppisin juurde andmetabelite sidumist andmebaasis, mis mul eelenvalt oli segaseks jäänud, kuid mis tegelikult polnudki keeruline. Näiteks õppisin veel juurde ka seda, kuidas kasutajad saaksid pilte foorumisse üles laadida ning kuidas neid pärast kasutajatele lehel ka kuvada, kuidas navigatsiooni riba koostada nii suurele kui ka väikesele brauseriaknale ja teisi bootstrapi võimalusi.
	* **Mis ebaõnnestus?** Otseselt ei ebaõnnestunud midagi, kuid esilehel ja treeningpäeviku lehel võiksid asjad võib-olla natukene paremini liikuda brauseriakna muutmisel.
	* **Mis oli keeruline?** Keeruline oli lehele kujunduse tegemine nii, et leht näeks ka brauseriakna väiksemaks tegemisel normaalne välja (divi'de paigutamine ja suuruste määramine) ning muidugi tuli ette ka erinevaid keerulisi php erroreid.
	
* **Elise:**
	* **Mida õppisid juurde?**
	* **Mis ebaõnnestus?**
	* **Mis oli keeruline?**
	
* **Karoliina:**
	* **Mida õppisid juurde?** Õppisin juurde, kuidas töötab foorum ning funktsioonide liikumine selle siseselt; kuidas muuta parooli ning kuidas sisuda omavahel kalender ja kasutaja sisestatud andmed; veebirakenduse disaini.
	* **Mis ebaõnnestus?** Aja planeerimine
	* **Mis oli keeruline?** Errorite lahendamine ja treeningpäevikusse kalendri lisamine, kuhu kasutaja saaks ka andmeid sisestada.