#WasteChase

#R�hmaliikmed: 

Krister Tarnamaa, Martin Holtsmeier, Rait Keernik

#Eesm�rk:

Eesm�rgiks on teha leht, kust sa saad sisestada enda ostud ja nende sisud, neid kategoriseerida, ja vaadata
enda n�dalaseid/kuuseid v�ljaminekuid, ning v�lja tuua, ning sorteerida v�lja kasutud ja kasulikud raiskamised
nagu n�iteks: Ost #15: 2.20� pitsa (R�mpstoit), 5,60� After-shave Nivea (H�gieen) , 1.89� Kr�psud (R�mpstoit)
N�itaks ka veel v�imalus valida v�lja kindlaid kategooriaid, millest hoidudes s��staksid x eurot kuu jooksul

Hans P�ldoja interaction design methods

#Kirjeldus
Lehe sihtr�hm on inimesed, kellel on tahtmine hoida j�rge enda ostudest ja v�imalusel raha raiskamist
v�hendada. P�hiliselt oleme m�elnud seda Kutse- ja �likoolide �pilastele, kuid kes tahab see kasutab.

Oma rakenduse erip�ra v�rreldes n�iteks pankadega, kes hoiavad raiskamisest logi, on v�imalik t�pselt
n�ha, mille peale raha l�ks ja v�imalik v�lja filtreerida kindla kategooria ostud, et n�ha palju on
v�imalik kokku hoida, kui hoidud n�iteks kategooriast: Alkohol.

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
Date DATE,
FOREIGN KEY (AddedBY) REFERENCES WasteChase_User(ID)
);

CREATE TABLE WasteChase_PurchaseContents(
ID INT(8) NOT NULL AUTO_INCREMENT PRIMARY KEY,
ProductName Varchar(20) NOT NULL,
ProductPrice int(8) NOT NULL,
CategoryID int(8) NOT NULL,
PurchaseID int(8) NOT NULL,
AddedBY int(8) NOT NULL,
FOREIGN KEY (AddedBY) REFERENCES WasteChase_User(ID),
FOREIGN KEY (CategoryID) REFERENCES WasteChase_Categories(ID),
FOREIGN KEY (PurchaseID) REFERENCES WasteChase_Purchases(ID)
);

CREATE TABLE WasteChase_Categories(
ID INT(8) NOT NULL AUTO_INCREMENT PRIMARY KEY,
Category Varchar(20) NOT NULL,
Kirjeldus TEXT
);
