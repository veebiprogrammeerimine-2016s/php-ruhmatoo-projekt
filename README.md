# PHP rühmatöö projekt

<img src="https://cloud.githubusercontent.com/assets/22025409/21752453/db5e6170-d5e0-11e6-91bc-85b5ebd43709.png" width="90%"></img> 




<img src="https://cloud.githubusercontent.com/assets/22025409/21752463/0ef264be-d5e1-11e6-81e6-6df57a1b6a3d.png" width="90%"></img> 
 
 
 Stas Majevski, Pjotr Iljukov, Juri Gussarov
	

# Esmark

Projekti eesmark on anda rehvihavetuse punkti omanikutele valja pakkuda oma teenused, 
ning lihtsustab auto omanikutele otsida endale soobiv aeg ja hind. Rakendus annab voimalus vorrelda erinevad punktid 
ja kohe broneerida sobiv aeg.

# Kirjeldus 

* Sihtruhm:
	Vanus Auto omanikud 18-70+
	Sugu: pole oluline
	
* Eripara: Rakendused nagu kummiproff.ee ja kumm.ee mis pakkuvad sarnased voimalused. 
Me proovisime teha oma rakendus lihtsam ja rohkem kasutaja sobralikum. Lisasime vaid koige vavalikumad
voimalused ja teenused.

* Funktsionaalsus: 
		
		*Omanikule:  Sisse logimine
					Oma puntki lisamine
					Oma broneeringute vaatamine
					Hinnade lisamine\muutmine 
		
		*Kasutaja:	Punkti ulevade
					Hinna vaade
					Aja broneerimine



# Andmebaasi skeem ja tabelite loomise SQL laused

					
<img src="https://cloud.githubusercontent.com/assets/22025409/21752392/af6cd7a0-d5df-11e6-9ed8-4dcc5dfb58cf.png" width="45%"></img> 
	
CREATE TABLE p_open_time(
id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
day INT,
open TIME,
close TIME,
lunch_begin TIME,
lunch_end,
tyre_fitting_id INT,
FOREING KEY(tyre_fitting_id) REFERENCES p_tyre_fittings(id)
);

CRATE TABLE p_owners(
id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
username VARCHAR(30),
password VARCHAR(254)
);

CREATE TABLE p_orders(
id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
name VARCHAR(30),
email VARCHAR(30),
phone VARCHAR(30),
note TEXT,
service VARCHAR(30),
carnumber VARCHAR(30),
booktime VARCHAR(30),
tyre_fitting_id INT,
FOREIGN KEY(tyre_fitting_id) REFERENCES p_tyre_fittings(id)
);

CREATE TABLE p_tyre_fittings_services(
id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
name VARCHAR(30),
description TEXT,
category VARCHAR(30),
size FLOAT,
price DECIMAL(10,0),
tyre_fitting_id INT,
FOREIGN KEY(tyre_fitting_id) REFERENCES p_tyre_fittings(id)
);

CREATE TABLE p_tyre_fittings(
id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
name VARCHAR(30),
logo VARCHAR(254),
description TEXT,
location TEXT,
pricelist TEXT,
owner_id INT,
FOREIGN KEY(owner_id) REFERENCES p_owners(id)
);


# Kokkuvote

Mida oppisid jurde? Mis ebaonnestus? Mis oli raske?

	*Juri: Oppisin kuidas ruhmas tootada, oppisin CSS ja PDF kasutada. 
	Oppisin oma aja planeerida. PDF vormistaine ebaonnestus? loodan parast saan rohkem sellest teada ja parandan.
	Keeruline oli gruppis hakkama saama sest oli koige norgem osa.

	*Stas:
	
	*Pjotr:








## Abiks
* **Testserver:** greeny.cs.tlu.ee, [tunneli loomise juhend](http://minitorn.tlu.ee/~jaagup/kool/java/kursused/09/veebipr/naited/greenytunnel/greenytunnel.pdf)
* **Abiks tunninäited (rühmade lõikes):** [I rühm](https://github.com/veebiprogrammeerimine-2016s?utf8=%E2%9C%93&query=-I-ruhm), [II rühm](https://github.com/veebiprogrammeerimine-2016s?utf8=%E2%9C%93&query=-II-ruhm), [III rühm](https://github.com/veebiprogrammeerimine-2016s?utf8=%E2%9C%93&query=-III-ruhm)
* **Stiilijuhend:** [Coding Style Guide](http://www.php-fig.org/psr/psr-2/)
* **GIT õpetus:** [Become a git guru.](https://www.atlassian.com/git/tutorials/)
* **Abimaterjale:** [Veebirakenduste loomine PHP ja MySQLi abil](http://minitorn.tlu.ee/~jaagup/kool/java/loeng/veebipr/veebipr1.pdf), [PHP with MySQL Essential Training] (http://www.lynda.com/MySQL-tutorials/PHP-MySQL-Essential-Training/119003-2.html)
