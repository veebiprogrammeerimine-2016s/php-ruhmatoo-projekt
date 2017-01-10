# TireJack

![Alt text](img/rehv.png?raw=true "Home")

## Rühma liikmed

Kristjan Liiva ja Kert Aavik

## Eesmärk

Kuna rehvivahetusega on pidevalt probleeme(pikad järjekorrad näiteks), siis on meie veebirakenduse
eesmärgiks pakkuda võimalust kõige kiiremaks rehvivahetuseks.

## Kirjeldus

Sihtrühmaks on kõik inimesed (olenemata vanusest), kellel on olemas juhiload ning sõiduk (Kaubik, maastur jne). Eripäraks
meie veebirakenduse juures on see, et me pakume välja kõige kiirema aja inimestele (olenemata asukohast).

## Funktsionaalsuse loetelu

v0.1 Saab esilehel tagasisidet anda
v0.2 Saab broneerida aega (algne olek - puudub veel kalendri salvestus)
v0.3 Tagasiside nyyd eralide lehena (Pääseb ligi broneeringu lehelt)
v0.4 Saab Broneeringu salvestada andmebaasi (Double bookingu probleem)

## Andmebaasi skeem pildina + tabelite loomise SQL laused

CREATE TABLE Reservation_Data(
id INT AUTO_INCREMENT PRIMARY KEY,
Registration_Nr TEXT,
Veichle_Type TEXT,
Car_Brand TEXT,
Car_Model TEXT,
Telephone_Nr INT(11)
);

![Alt text](img/Andmebaas.png?raw=true "Andmebaas")

## Kokkuvõte

Algselt oli plaan teha ka kasutaja loomise leht aga sellleni ei jõudnud ning näha oli ka, et selle jaoks puudus
eriline vajadus, sest põhiline rõhk oli broneerimislehel. Projekt oli oodatust suurem ning seetõttu tekitas see ka raskusi.
Edasi oleks seda veebirakendust võimalik ka lahendada - lisades juurde näiteks otsingu meetod erirehvide jaoks, kasutaja loomise leht,
et oleks kergem broneerimisvormi täita jne.

