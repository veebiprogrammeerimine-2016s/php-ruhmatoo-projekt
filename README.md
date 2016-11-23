# PHP rühmatöö projekt


# MinuTunne

PROJEKTI rühmaliikmed: Inna Sammel, Marii Viita, Elias Rubiales

Veebirakenduse MinuTunne eesmärgiks on oma enesetundest, kaalust ja üleüldisest heaolust lugu pidavahele inimesele võimaldada monitoorida enda enesetunde muutusi, liikumisaktiivsust ning vastavalt soovile jälgida kehamassiindeksi (KMI) ja kaalu muutusi. 
Inimene leiab veebirakendusest tuge oma enesetunde monitoorimisel ning selle seostamisel võimalike kaalutmuudatustega. Samuti on rakendus hea abimees kaalumuudatuse motiveerimiseks. 
Kasutajal on võimalik tutvuda enda varasemate enesetunde hinnangutega, liikumisaktiivsusega ning neid vastavalt vajadusele analüüsida. 

Veebirakenduse sihtrühm on lai, sest sobib kõikidele indiviididele, kes peavad mõistlikuks ja vajalikuks oma enesetunde ja liikumisaktiivsuse muutusi jälgida. Olgu tegemist naise või mehega, noore või vanemapoolsega - rakendus on sobilik kasutamiseks kõigile. Ühelt poolt pakub rakendus ülevaadet enesetunde muutusest ning teisalt võib rohkemal määral inimest muudatuste teostamiseks (nt kehalise aktiivsuse suurendamiseks) motiveerida. 

Võrreldes teiste samaväärsete rakendustega on eristavaks asjaoluks enesetunde ja liikumisaktiivsuse muutuse monitoorimine ehk inimesel on võimalus oma varasemaid tundeid andmebaasis talletada ning neid kuvatakse talle igal uuel kuupäeval enesetunnet ja aktiivsust hinnates, andmaks lihtsustatud ülevaadet võimalikest muutustest ajalises järjekorras. 

Eeskujuks võtame http://kaaluabi.ee, projekti koostamisel on veel toetavateks keskkondadeks http://www.kalkulaator.ee/?lang=1&page=24, mis lubab soovijal välja arvutada sisestatavate näitajate abil KMI. 
  
 Järgnevalt projekti funktsionaalsuse loetelu:
    
//1. Klient saab registreeruda kasutajaks või sisse logida. Sisse logimiseks on vajalik:

            
            *e-mail;
            *parool
            
            
 Kasutajaks registreerumiseks:
            
            *e-mail;
            *parool;
            *sünniaeg ;
            *sugu.
            
Logib sisse või registreerub.

//2. Avaneb uus vaade --> klient sisestab järgnevad andmed:

            *tänane kuupäev;
            *enesetunne (rippmenüüs viis valikut erinevatest enesetunnetest);
            *päevas läbitud sammude arv;
            
            NING
            
            *vajutab "Salvesta".
            
Kliendil on võimalik soovi korral ka välja logida.
         
Kasutajale kuvatakse tema enesetunne samal leheküljel vormistatud tabelis, kus enesetunded ja sammude arvud on vastavalt kuupäevalisele kahenemisele sorteeritud.  Tabeli all kuvatakse nupp "Mis on minu KMI?", millele vajutades suunatakse kasutaja järgmisele leheküljele.

//3. Avaneb uus vaade --> kliendile kuvatakse ülevaade KMIst (mis see on, lisaks ülevaatlik pilttabel KMI vahemikest) ning sisestamiseks järgmised kohustuslikud väljad:

            *pikkus (cm);
            *kaal (kg).
            
            NING
            
            *vajutab "Arvuta".
            
            
//4. Avaneb uus vaade uuel leheküljel --> kuvatakse kasutaja KMI ning vastavalt KMI vahemikku arvesse võttes soovitus nt pöördumiseks toitumisnõustaja/treeneri poole, et üle vaadata oma päeva kaloraaž ning saada nõu liikumisharjumuste muutmiseks (vajaduse selgitab välja spetsialist). 
  
Lisame juurde  andmebaasi skeemi loetava pildina + tabelite loomise SQL laused (kui keegi teine tahab seda tööle panna). Jooksvalt.


KOKKUVÕTE
