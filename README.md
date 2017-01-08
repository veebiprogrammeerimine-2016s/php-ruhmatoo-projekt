# RAAMATURIIUL

![Preview](image/index.jpg)
Karin Rikkinen

    * eesmärki (3-4 lauset, mis probleemi üritate lahendada);
    * kirjeldus (sihtrühm, eripära võrreldes teiste samalaadsete rakendustega – kirjeldada vähemalt 2-3 sarnast rakendust mida eeskujuks võtta);
    * funktsionaalsuse loetelu prioriteedi järjekorras, nt
        * v0.1 Saab teha kasutaja ja sisselogida
        * v0.2 Saab lisada huviala
        * ...
## Andmebaasi skeem ja tabelite loomise SQL laused
![Preview](image/skeem.jpg)

```
CREATE TABLE project_users (
    -> user_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    -> username VARCHAR(50) NOT NULL,
    -> email VARCHAR(128) NOT NULL,
    -> password VARCHAR(128) NOT NULL,
    -> joined TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    -> UNIQUE(email)
    -> );
	
CREATE TABLE project_books (
    -> book_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    -> cat VARCHAR(255) NOT NULL,
    -> title VARCHAR(255) NOT NULL,
    -> author VARCHAR(128) NOT NULL,
    -> year INT(4),
	-> bookCondition VARCHAR(50) NOT NULL,
	-> location VARCHAR(128) NOT NULL,
	-> description TEXT,
	-> points INT(2),
	-> created TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	-> deleted DATE DEFAULT NULL
	-> image VARCHAR(500),
	-> user_id INT(11),
	-> FOREIGN KEY (user_id) REFERENCES project_users(user_id)
	-> );
	
CREATE TABLE project_points (
	book_id INT NOT NULL UNIQUE,
	user_id_give INT NOT NULL,
	user_id_get INT,
	points INT(10) NOT NULL,
	created TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	status VARCHAR(10),
	FOREIGN KEY (book_id) REFERENCES project_books(book_id)
	);
	
CREATE TABLE project_messages(
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    sender_id INT(11) NOT NULL,
    receiver_id INT(11) NOT NULL,
    title VARCHAR(256),
    message TEXT,
    sent TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    received DATETIME DEFAULT NULL,
	sender_deleted VARCHAR(3),
	receiver_deleted VARCHAR(3)
    );
```
 * kokkuvõte:** mida õppisid juurde? mis ebaõnnestus? mis oli keeruline? (kirjutab iga tiimi liige).


