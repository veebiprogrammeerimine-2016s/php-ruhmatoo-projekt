# PHP rühmatöö projekt


# MinuTunne

PROJEKTI rühmaliikmed: Inna Sammel, Marii Viita, Elias Rubiales

Veebirakenduse MinuTunne eesmärgiks on oma enesetundest, kaalust ja üleüldisest heaolust lugu pidavale inimesele võimaldada monitoorida enda enesetunde muutusi, liikumisaktiivsust ning vastavalt soovile jälgida kehamassiindeksi (KMI) ja kaalu muutusi. 
Rakendus on hea abimees meeleolu ja liikumisaktiivsuse seostamisel võimalike kaalumuutustega ning aitab vajadusel alustada kaalu langetamist või tõstmist. 
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

//3. Avaneb uus vaade --> kliendile kuvatakse ülevaatlik pilttabel KMI vahemikest ning sisestamiseks järgmised kohustuslikud väljad:

            *pikkus (cm);
            *kaal (kg).
            
            NING
            
            *vajutab "Arvuta".         
            
Kuvatakse kasutaja KMI. 
  
Lisame juurde  andmebaasi skeemi loetava pildina + tabelite loomise SQL laused (kui keegi teine tahab seda tööle panna).

ANDMEBAASI SKEEM PILDINA


KOKKUVÕTE

Mida õppisin juurde? Mis ebaõnnestus? Mis oli keeruline?

MARII
1) Kindlasti arendasin töö käigus oma koostööoskusi – õppisin kuulama teisi ja arvestama teiste soovide ja ideedega. Rühmatöö oli minu esimene suurim IT-alane projekt, mis tuli otsast lõpuni teistega koos valmis teha. See andis juurde palju praktilisi kogemusi, samas nõudis suure töö tegemini ka omajagu motivatsiooni ja püsivust.
2) Mitmed asialgu plaanitud funktsionaalsused jäid rakendusse lisamata. Samuti oleks kujundus võinud olla terviklikum. See-eest töötavad ja ootavad kasutamist rakenduse otstarvet silmas pidades kõige olulisemad funktsioonid.
3) Minu jaoks oli kõige keerulisem kujunduse loomine. See nõudis palju internetist otsimist ja loogilist mõtlemist. Koodi õppisime tundides rohkem kirjutama, nii et sellega oli veidi lihtsam hakkama saada.

INNA
1) Õppisin töötama meeskonnana ning jagama vastutust. Koodi poolelt sain selgemaks div elemendid ning nende kasutamise, kuidas muuta lehekülge ekraanisõbralikumaks ning kuidas kujundada nuppe nii, et need ei mõjuks maitselagedalt.
2) Oleks soovinud veidi rohkem lisada võimalusi kasutajale veebileheküljel toimetamiseks. 
3) Keeruline oligi tegelikult vajaliku osa koodist jagada ja grupeerida nõnda, et soovitud kasutajasõbralik funktsionaalsus just brauserivaate mõõtmete muutmise korral välja tuleks. 

ELIAS
1) Õppisin PHPst palju. Õppisin andmeid AB’i saatma, õppisin üldiselt põhilisi asju, mida on vaja, et PHP abil lihtsat veebilehte teha. Lisaks sellele õppisin enam-vähem, kuidas githubis tehtud töid jagada.
2) Oleks tahtnud palju rohkem funktsionaalsust lehele lisada, et kasutajal oleks olnud võimalust palju rohkem veebilehel teha. Oleks tahtnud kõik funktsioonid ilusti klassidesse sorteerida.
3) Keeruline oli minu jaoks just funktsioonide jagamine klassidesse, see andis mulle palju erroreid ja lõpuks ei saanudki sellega hakkama. Keeruline oli ka üleüldse kõikide vigade parandamine.  



