NIMI: KODULOOMADE RENT - Koduloom24

EESMÄRK: Koduloomade väljarentimine inimestele, kes ei taha pikaajalist kohustust nende ees. 
Rendime varjupaigaloomi, et neil päeva paremaks teha ja samuti ka inimesele, kes tahab looma endale natukeseks ajaks.
Loomi saab rentida ka laste sünnipeävapidudele.

SIHTRÜHM: Kõik inimesed, aga rentida saavad ainult täiskasvanud.

Vanus: 18-??

Sugu: M või N

Sotsiaalne majanduslik staatus: põhiharidus - kõrgharidus

Muu: Stabiilne sissetulek

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
	- Cleven
	- Henri
	- Tanel - Õppisin juurde nii kujunduse kui ka funktsioonide koostamist.
Töö koostamise käigus jäin tihti hätta ning sain otsida internetist uusi lahendusi, mis mind õpetasid edaspidi vigu vältima.


Autorid: Henri Vajak, Tanel Maasalu, Cleven Lehispuu

