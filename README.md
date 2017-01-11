
# SneakerMarket
![Preview](esileht.png)
Karl-Erik Borkmann, Georg Andreas Valgerist

## Eesmärk
Keskkond kuhu saab üles panna kuulutusi ketside ostmiseks ja müümiseks.


## Kirjeldus
* sihtrühm: noored (vanus 16-30)


sarnased lehed: http://www.kixify.com/ , https://stockx.com/sneakers
 * pildid esilehel
 * otsingu võimalused
 * sisselogimine
 
## Funktsionaalsus
 * kuulutuse loomine
 * kuulutuse muutmine
 * kuulutuse kustutamine
 * kuulutuse kommenteerimine
 * kuulutuse reportimine
 * admin paneel reporditud kuulutuse muutmine/kustutamine


![Preview](db.png)

1 - kasutajate tabel

CREATE TABLE sm_users(
	id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	firstname VARCHAR(100),
	lastname VARCHAR(100),
	dateofbirth DATE,
	gender VARCHAR(30),
	username VARCHAR(30) NOT NULL,
	email VARCHAR(255) NOT NULL,
	password VARCHAR(128) NOT NULL,
	created TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	userlevel INT,
	UNIQUE (username),
	UNIQUE (email)
);



2 - kasutaja muu info

CREATE TABLE sm_userinfo(
	userid INT,
	country VARCHAR(100),
	city VARCHAR(100),
	shoesize INT (2),
	fav_brand VARCHAR(100),
	fav_model VARCHAR(100),
	FOREIGN KEY(userid) REFERENCES sm_users(id)
);



3 - piltide tabel

CREATE TABLE sm_uploads(
	id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	name VARCHAR(50),
	primarypic INT,
	picdeleted DATETIME,
	picflagged DATETIME,
	piccreated TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	postid INT,
	FOREIGN KEY(postid) REFERENCES sm_posts(id)
);


4 - kuulutuste tabel

CREATE TABLE sm_posts(
	id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	poststarted DATETIME,
	postcompleted DATETIME,
	status INT(1),
	userid INT,
	FOREIGN KEY(userid) REFERENCES sm_users(id)
);


5 - kuulutuse info tabel

CREATE TABLE sm_postinfo(
	id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	postid INT,
	heading VARCHAR(50),
	brand VARCHAR(50),
	model VARCHAR(100),
	size INT(2),
	type VARCHAR(30),
	sneakercondition VARCHAR(30),
	price DECIMAL(8, 2),
	description VARCHAR(255),
	postdeleted DATETIME,
	postflagged DATETIME,
	postcreated TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	status INT(2),
	FOREIGN KEY(postid) REFERENCES sm_posts(id)
);


6 - kommentaaride tabel

CREATE TABLE sm_comments(
	id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	postid INT,
	userid INT,
	comment VARCHAR(255),
	created TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	FOREIGN KEY(postid) REFERENCES sm_posts(id),
	FOREIGN KEY(userid) REFERENCES sm_users(id)
);

 


 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 