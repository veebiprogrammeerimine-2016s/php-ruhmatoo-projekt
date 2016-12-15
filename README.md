Php rühmatöö projekt

FacePlänt 

Liikmed  - MARIAM REINTOP, HEILI TREIER

Projekti nimi: FacePlänt 
Eesmärk: Mugav ja lihtsalt kasutatav meeldetuletus/tasklist taimede hooldamiseks 
Sihtgrupp: inimesed kelle kodus kasvab taim. Suuremas osas naised 25+ 
Sarnased lehed: - 
Struktuur: 
1. Pealeht-sisse logimata - keel, lehe tutvustus, login vorm, registreerimise vorm, navigatsioon(foorum, oma taimed, pood, oma info, recommended hooldus) 
1.2 Pealeht - sisse logitud - keel, kalender, to-do list, lisa/kustuta/muuda link 
2. Recommended hooldus - saab valida recommended hooldus tsükli, kõigile kättesaadav
3. taimede info - most popular&muu sorteerimine
Funktsionaalsus - Saab luua kasutaja. Sisestada taimed ja nende tsüklid. Ning kasutada to-do listi. Saab lisada endale taime meie soovitatud taimede hulgast.

SQL käsklused.

CREATE TABLE f_user(
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50),
    email VARCHAR(50),
    password VARCHAR(20)
);

CREATE TABLE f_plant(
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50),
    watering_days INT,
    fertilize_days INT,
    sun INT,
    private INT NULL
);

CREATE TABLE f_tips(
    plantID INT,
    tip VARCHAR(100),
    FOREIGN KEY(plantID) REFERENCES f_plant(id)
);

CREATE TABLE f_userplants(
    plantID INT,
    userID INT,
    lastwatered timestamp,
    lastfertilized timestamp,
    deleted INT,
    FOREIGN KEY(plantID) REFERENCES f_plant(id),
    FOREIGN KEY(userID) REFERENCES f_user(id),
    FOREIGN KEY(deleted) REFERENCES f_plant(id)
);

EESMÄRK
Teha endal ja teistel toataimede eest hoolitsemise muretumaks.
    
    

     * suurelt projekti veebirakenduse pilt;
   
    * andmebaasi skeem loetava pildina + tabelite loomise SQL laused (kui keegi teine tahab seda tÃ¶Ã¶le panna);
    * **kokkuvÃµte:** mida Ãµppisid juurde? mis ebaÃµnnestus? mis oli keeruline? (kirjutab iga tiimi liige).

