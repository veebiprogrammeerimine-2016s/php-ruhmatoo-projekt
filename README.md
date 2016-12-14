# PHP rühmatöö projekt
**Rühmatööde demo päev** on valitud eksamipäev jaanuaris, kuhu tullakse terve rühmaga koos!

## Tööjuhend
1. Üks rühma liikmetest _fork_'ib endale käesoleva repositooriumi ning annab teistele kirjutamisõiguse/ligipääsu (_Settings > Collaborators_)
1. Muudate vastavalt _git config_'ut
```
git config user.name "Romil Robtsenkov"
git config user.email romilrobtsenkov@users.noreply.github.com
```
1. Üks rühma liikmetest teeb esimesel võimaluse _Pull request_'i (midagi peab olema repositooriumis muudetud)
1. Muuda repositooriumi README.md faili vastavalt nõutele
1. Tee valmis korralik veebirakendus

### Nõuded
# TLU CarPooling


Joosep Juhanson, Taaniel Kõmmus

Kui vaadata TLU lähedal asuvaid parklaid (kasvõi Mare maja oma), siis näeb et kasutajaid ja
autoga ülikooli sõitvaid töötajaid/õpilasi ikka leidub.
Samas on tihti näha, et autodes istub laias laastus ainult juht.
Sellest tulenevalt ka idee luua TLU-sisene autode jagamise leht, sest eeldada võib,
et sama marsruuti sõitvaid ning sarnaste ajagraafikutega inimesi peaks TLU's olema küllalt.


Sihtrühmaks on eelkõige sõbralikud ja keskkonnast lugupidavad autoomanikud, kes on nõus
oma autot jagama teiste TLU kodanikega ning lisaks ka kõik, kes soovivad autoomaniku
pakutavat "teenust" kasutada.
Enamasti tegelevad carpoolingu teenust pakkuvad lehed pikemate vahemaadega ala Tallinn-Tartu jne.
Meie lahendus piirduks algselt selgelt TLU'sse ja TLU'st sõitmisega ning kasutada saaksid ainult
TLU emaili omavad isikud.

### Sarnased rakendused :
  * Karzoo - Euroopa carpooling
  * Wisemile - sotsiaalne transpordi võrgustik, mis ühendab vahendustasudeta vabu istekohti või pagasiruumi
  omavad autojuhid reisijate või pakisaatjatega.

### Funktsionaalsuse loetelu:
1. Saab teha kasutaja(nimi, kontakt, autonr. jne) ja sisselogida
2. Saab lisada sõidu (stardi asukoht, stardi kellaaeg, sihtkoht, orienteeruv kohale jõudmise kellaaeg, ?hind?)
3. Saab näha registreeritud sõite ja soovi korral sobivale end registreerida + näeb autoomaniku kontakte, et vajadusel ühendust võtta.
4. Autojuht näeb, kes on sõidule registreerinud + kõikide kontakte, et vajadusel ühendust võtta
5. Saab lisada tagasisidet/kommentaare reisijate/autojuhtide kohta
6. Saab näha iga kasutaja kohta kirjutatud kommentaare ja hinnanguid

### Andmebaas:
* Tabel1 - Kasutajad (cp_users)
* Tabel2 - Registreeritud sõidud (cp_rides)
* Tabel3 - Registreeritud kasutajad sõitudele (cp_rideusers)
* Tabel4 - Tagasiside/kommentaarid/hinnangud (cp_feedback)


*kokkuvõte: mida õppisid juurde? mis ebaõnnestus? mis oli keeruline? (kirjutab iga tiimi liige).

2. **Veebirakenduse nõuded:**
    * rakendus on terviklik (täidab mingit funktsiooni ja sellega saab midagi teha);
    * terve arenduse ajal on kasutatud _git_'i ja _commit_'ide sõnumid annavad edasi tehtud muudatuste sisu;
    * kasutusel on vähemalt 6 tabelit;
    * kood on jaotatud klassidesse;
    * koodis kasutatud muutujad/tabelid on inglise keeles;
    * rakendus on piisava funktsionaalsusega ja turvaline;
    * kõik tiimi liikmed on panustanud rakenduse arendusprotsessi.

## Abiks
* **Testserver:** greeny.cs.tlu.ee, [tunneli loomise juhend](http://minitorn.tlu.ee/~jaagup/kool/java/kursused/09/veebipr/naited/greenytunnel/greenytunnel.pdf)
* **Abiks tunninäited (rühmade lõikes):** [I rühm](https://github.com/veebiprogrammeerimine-2016s?utf8=%E2%9C%93&query=-I-ruhm), [II rühm](https://github.com/veebiprogrammeerimine-2016s?utf8=%E2%9C%93&query=-II-ruhm), [III rühm](https://github.com/veebiprogrammeerimine-2016s?utf8=%E2%9C%93&query=-III-ruhm)
* **Stiilijuhend:** [Coding Style Guide](http://www.php-fig.org/psr/psr-2/)
* **GIT õpetus:** [Become a git guru.](https://www.atlassian.com/git/tutorials/)
* **Abimaterjale:** [Veebirakenduste loomine PHP ja MySQLi abil](http://minitorn.tlu.ee/~jaagup/kool/java/loeng/veebipr/veebipr1.pdf), [PHP with MySQL Essential Training] (http://www.lynda.com/MySQL-tutorials/PHP-MySQL-Essential-Training/119003-2.html)
