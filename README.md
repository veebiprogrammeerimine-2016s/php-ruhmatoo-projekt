NIMI: KODULOOMADE RENT - Koduloom24

EESMÄRK: Koduloomade väljarentimine inimestele, kes ei taha pikaajalist kohustust nende ees. 
Rendime varjupaigaloomi, et neil päeva paremaks teha ja samuti ka inimesele, kes tahab looma endale natukeseks ajaks.
Loomi saab rentida ka laste sünnipeävapidudele.

SIHTRÜHM: Kõik inimesed, aga rentida saavad ainult täiskasvanud.

Vanus: 18-??

Sugu: M või N

Sotsiaalne majanduslik staatus: põhiharidus - kõrgharidus

Muu: Stabiilne sissetulek

Projekti veebirakenduse pilt: http://puu.sh/tgW9e/c3fd2a0556.jpg

LEHED:
	Sisselogimine
		- email, eesnimi, perekonnanimi, parool
	Registreerimine
		- email, parool, eesnimi, perekonnanimi
	Loomade vaatamine
		- Iga looma kohta eraldi leht tema pildiga.
	Loomade broneerimine
	Loomade registreerimine
	Andmete muutmine ehk edit
	Kasutaja info ehk user
	Varjupaikade vaatamine
	Varjupaikade lisamine
	Kontakt
	Avaleht
	
ANDMEBAASI SKEEM:
Veebilehe koostamiseks kasutasime kuute andmebaasi tabelit:
	- animals (id, type, name, url(pildi jaoks), shelter, deleted, booked)
		- Vajalik loomade sisestamiseks varjupaikadesse ning nende kuvamiseks kliendile. Samuti näitab, kas loom on broneeritud.
	- animalshelters(id, name, county, city)
		- Loomavarjupaikade loeng. Vajalik nende sisestamiseks ning kuvamiseks kliendile.
	- booking (id, animal_id, created, animal_return)
		- Vajalik looma broneerimiseks ning vabastamiseks.
	- interests(id, interest)
		- Huvide loetelu, mida klient saab omale lisada.
	- user_interests (id, user_id, interest_id)
		- Kliendi lisatud huvid eelnevast loetelust.
	- user_sample (id, email, password, created)
		- Registreerunud kasutajad. Vajalik nii registreerimiseks kui ka logimiseks.

KOKKUVÕTE:
	
	- Henri - Sain rohkem aimu ja kätt siluda nii funktsioonide kui ka kujundamisega. Õppisin rohkem tähele panema vigu, mis on kahe silma vahele jäänud. Grupitööd tehes, sain uusi teadmisi grupikaaslastelt, mida mul varem polnud.
	Keeruliseks osutas peast funktsiooni loomine ja siis selle realiseerimine. 
	- Tanel - Õppisin juurde nii kujunduse kui ka funktsioonide koostamist.
	Töö koostamise käigus jäin tihti hätta ning sain otsida internetist uusi lahendusi, mis mind õpetasid edaspidi vigu vältima.
	- Cleven - Õppisin juurde paljutki. Tundides läbitu oli küll väga kasulik, 
	aga teadmiste proovile panek valitud teema probleemide lahendamiseks 
	kinnitas omandatud teadmisi väga palju. Isiklikult õppisin kõige
	rohkem tundma php koodimiskeeles back-endi, mis tuleb tulevikus 
	kindlasti väga kasuks. Oskan kasutada funktsioone ja saan aru, kuidas
	käib suhtlus andmebaasiga. Kõlab elementaarselt, aga asjadest aru
	saamine ja protsesside käigu mõistmine on vägagi tähtis ning tihti
	on see algajate jaoks väga raske.
	Lisaks koodimisele oleks tähtis ära mainida ka Githubi kasutamisoskuse.
	Github on tänapäeval nagu open source koodijate keskus ja selle tundmine
	aitab tulevikus asju ajada.
	Ebaõnnestusin alguses enamikes asjades mida püüdsin iseseisvalt lahendada.
	Aitasid mind sõbrad ja internet ning ebaõnnestumised muutusid õnnestumisteks.
	Võin väita, et lõpuks ei olnud ma ebaõnnestunud üheski kriteeriumis, mis
	antud aine eesmärgiks õpetada oli.
	Keeruline oli tegeleda kujundusega. Seda sellepärast, et ma pöörasin
	sellele minimaalselt tähelepanu ja ei püüdnudki sellese teemasse süveneda.
	Järgmine semester tuleb Veebidisain, siis on aega sellesega tegeleda.


Autorid: Henri Vajak, Tanel Maasalu, Cleven Lehispuu

