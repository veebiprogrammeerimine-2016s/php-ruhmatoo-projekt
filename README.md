#WasteChase

#Rühmaliikmed: 

Krister Tarnamaa, Martin Holtsmeier, Rait Keernik

#Eesmärk:

Eesmärgiks on teha leht, kust sa saad sisestada enda ostud ja nende sisud, neid kategoriseerida, ja vaadata
enda nädalaseid/kuuseid väljaminekuid, ning välja tuua, ning sorteerida välja kasutud ja kasulikud raiskamised
nagu näiteks: Ost #15: 2.20€ pitsa (Rämpstoit), 5,60€ After-shave Nivea (Hügieen) , 1.89€ Krõpsud (Rämpstoit)
Näitaks ka veel võimalus valida välja kindlaid kategooriaid, millest hoidudes säästaksid x eurot kuu jooksul

Hans Põldoja interaction design methods

#Kirjeldus
Lehe sihtrühm on inimesed, kellel on tahtmine hoida järge enda ostudest ja võimalusel raha raiskamist
vähendada. Põhiliselt oleme mõelnud seda Kutse- ja Ülikoolide õpilastele, kuid kes tahab see kasutab.

Oma rakenduse eripära võrreldes näiteks pankadega, kes hoiavad raiskamisest logi, on võimalik täpselt
näha, mille peale raha läks ja võimalik välja filtreerida kindla kategooria ostud, et näha palju on
võimalik kokku hoida, kui hoidud näiteks kategooriast: Alkohol.

#Funktsionaalsuse Loetelu

	Login ja Registreerimise leht
	Leht andmete jaoks
	leht ostude muutmiseks + poodide muutmiseks
	funktsioonid ja classid
	Stiil: Vaatame hiljem
	
TBD

Tabeliloomise laused

CREATE TABLE WasteChase_User(
ID INT(8) NOT NULL AUTO_INCREMENT PRIMARY KEY,
Email varchar(30) NOT NULL,
Password varchar(130),
FirstName varchar(20),
LastName varchar(20),
Gender varchar(10),
Registered timestamp
);

CREATE TABLE WasteChase_Shops(
ID INT(8) NOT NULL AUTO_INCREMENT PRIMARY KEY,
AddedBY int(8) NOT NULL,
StoreName Varchar(20) NOT NULL,
Created timestamp,
FOREIGN KEY (AddedBY) REFERENCES WasteChase_User(ID)
);

CREATE TABLE WasteChase_Purchases(
ID INT(8) NOT NULL AUTO_INCREMENT PRIMARY KEY,
AddedBY int(8),
FromShop varchar(20),
Created timestamp,
FOREIGN KEY (AddedBY) REFERENCES WasteChase_User(ID)
);

CREATE TABLE WasteChase_PurchaseContents(
ID INT(8) NOT NULL AUTO_INCREMENT PRIMARY KEY,
ProductName Varchar(20) NOT NULL,
ProductPrice int(8) NOT NULL,
CategoryID int(8) NOT NULL,
PurchaseID int(8) NOT NULL,
FOREIGN KEY (CategoryID) REFERENCES WasteChase_Categories(ID),
FOREIGN KEY (PurchaseID) REFERENCES WasteChase_Purchases(ID)
);

CREATE TABLE WasteChase_Categories(
ID INT(8) NOT NULL AUTO_INCREMENT PRIMARY KEY,
Category Varchar(20) NOT NULL
);

ERD: https://drive.google.com/open?id=0B7r2XlMnEQ43OUx3Y2RmX25QTTQ