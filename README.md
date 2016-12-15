Projekti nimi - TireJack

Pilt - veel tegemisel

Rühma liikmed - Kristjan Liiva ja Kert Aavik

Eesmärk - Kuna rehvivahetusega on pidevalt probleeme(pikad järjekorrad näiteks), siis on meie veebirakenduse
eesmärgiks pakkuda võimalust kõige kiiremaks rehvivahetuseks.

Kirjeldus - Sihtrühmaks on kõik inimesed, kellel on olemas juhiload ning sõiduk (Kaubik, maastur jne). Eripäraks
meie veebirakenduse juures on see, et me pakume välja kõige kiirema aja inimestele (olenemata asukohast).

Funktsionaalsuse loetelu - v0.1 Saab esilehel tagasisidet anda, v0.2 Saab broneerida aega (algne olek - puudub veel kalendri salvestus),
v0.3 Plaanitud (Saada tööle kalendri aja salvestuse)

Andmebaasi skeem pildina + tabelite loomise SQL laused -

CREATE TABLE Reservation_Data(
id INT AUTO_INCREMENT PRIMARY KEY,
Registration_Nr TEXT,
Veichle_Type TEXT,
Car_Brand TEXT,
Car_Model TEXT,
Telephone_Nr INT(11)
);

Kokkuvõte - tegemisel