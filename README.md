# PHP rühmatöö projekt





    * Rehvivahetuse online rakendus;
    
    * Stas Majevski, Pjetr Iljukov, Juri Gussarov;
	
    * Veebirakendus mis seotaks koik rehvivahetuse burood ja annaks voimalus broneerida/uurida mitme too kohta korraga.  ;
    * Loodame et rakendus tuleb vaja inimestele kellel on probleemid rehvivahetusega kui sesoon lopeb. Uritame teha oma rakendus voimalikult lihtne ja kasutajale sobralik.;
	  Saransed rakendused mida eeskujuks votta - https://www.kummiproff.ee/rehvivahetus/, https://www.kumm.ee/, http://www.rehvitakso.ee/;
    * Funtksionaalsus;
        * saab valida kumb lehele minna, kas klient voi buroo omanik
        * kui klient siis saab valida teeenused ja registreerida ennast
        * kui omanik siis saab oma burood registreerida
		* saab kommentarii jatta
		* hindada burood
    * andmebaasi skeem 
	ORDER
1. ID
2. DATE
3. TIME VARCHAR
4. CLIENT_ID FOREIGN KEY
5. REHVIVAHETUS_PUNKT_ID FOREIGN KEY REFERENCES REHVIVAHETUS_PUNKT.ID

CLIENT
1. ID
2. NAME
3. CAR_NUMBER
4. TELEPHONE_NUMBER

COMMETNS
1. ID
2. REHVIVAHETUS_PUNKT_ID FOREIGN KEY REFERENCES REHVIVAHETUS_PUNKT.ID
3. BODY

RATING
1. ID
2. REHVIVAHETUS_PUNKT_ID FOREIGN KEY REFERENCES REHVIVAHETUS_PUNKT.ID
3. RATE

REHVIVAHETUS PUNKTI OMANIKU PAGE:
1. TIRE PUNKT REGISTRATION
2. ORDER STATISTICS PAGE

REHVIVAHETUS PUNKTI OMANIK
1. ID PRIMARY KEY
2. username -> email? UNIQUE VALUE
3. password -> bcrypt crypted

REHVIVAHETUS PUNKT
1. ID PRIMARY KEY
2. NAME
3. ADDRESS
4. OWNER_ID -> FOREIGN KEY REFERENCES OMANIK-ID

TIRE_CHANGE_SERVICES
1. ID PRIMARY KEY
2. TIRE_CHANGE_PUNKT_ID FOREIGN KEY
3. NAME
4. DESCRIPTION
5. PRICE;




## Abiks
* **Testserver:** greeny.cs.tlu.ee, [tunneli loomise juhend](http://minitorn.tlu.ee/~jaagup/kool/java/kursused/09/veebipr/naited/greenytunnel/greenytunnel.pdf)
* **Abiks tunninäited (rühmade lõikes):** [I rühm](https://github.com/veebiprogrammeerimine-2016s?utf8=%E2%9C%93&query=-I-ruhm), [II rühm](https://github.com/veebiprogrammeerimine-2016s?utf8=%E2%9C%93&query=-II-ruhm), [III rühm](https://github.com/veebiprogrammeerimine-2016s?utf8=%E2%9C%93&query=-III-ruhm)
* **Stiilijuhend:** [Coding Style Guide](http://www.php-fig.org/psr/psr-2/)
* **GIT õpetus:** [Become a git guru.](https://www.atlassian.com/git/tutorials/)
* **Abimaterjale:** [Veebirakenduste loomine PHP ja MySQLi abil](http://minitorn.tlu.ee/~jaagup/kool/java/loeng/veebipr/veebipr1.pdf), [PHP with MySQL Essential Training] (http://www.lynda.com/MySQL-tutorials/PHP-MySQL-Essential-Training/119003-2.html)
