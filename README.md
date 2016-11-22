# PHP rühmatöö projekt


KAALUST ALLA 

PROJEKTI rühmaliikmed: Inna Sammel, Marii Viita

Kaalust alla veebirakenduse eesmärgiks on oma tervisest ja kaalust lugu pidavale inimesele võimaldada välja arvutada enda kehamassiindeks (KMI). Inimene saab veebirakendusest tuge kaalulangetamise/tõstmise protsessis, kuna kuvab kasutaja poolt ka varasemalt sisestatud andmeid. Need lubavad jälgida kaalunäitaja muutusi.

Veebirakenduse sihtrühm on lai, sest sobib kõikidele indiviididele, kes peavad mõistlikuks ja vajalikuks oma kaalumuutusi jälgida. Olgu tegemist naise või mehega, noore või vanemapoolsega - rakendus on sobilik rakendamiseks kõigile. Ühelt poolt pakub rakendus ülevaadet kaalunumbrite muutusest ning teisalt võib rohkemal määral inimest muudatuste teostamiseks (nt kehalise aktiivsuse suurendamiseks) motiveerida. 

Võrreldes teiste samaväärsete rakendustega on eristavaks asjaoluks kaalunumbri muutuse monitoorimine ehk inimesel on võimalus oma varasemaid kaalunumbreid andmebaasis talletada ning neid kuvatakse talle igal sisselogimisel, andmaks lihtsustatud ülevaadet võimalikest muutustest ajalises järjekorras. 

Eeskujuks võtame http://kaaluabi.ee, projekti koostamisel on veel toetavateks keskkondadeks http://www.kalkulaator.ee/?lang=1&page=24, mis lubab soovijal välja arvutada sisestatavate näitajate abil KMI. 
  
 Järgnevalt projekti funktsionaalsuse loetelu:
    
1. Klient saab registreeruda kasutajaks või sisse logida
2. Avaneb uus vaade --> klient sisestab järgnevad andmed:

            *enda pikkuse;
            *kaalunumbri;
            *kaalumise kuupäeva;
            *füüsilise aktiivsuse (rippmenüüst erinevad kehalise aktiivsuse valikud)
            *sugu
            
            NING
            
            *vajutab "Arvuta KMI".
            
3. Avaneb uus vaade --> kliendile kuvatakse tema poolt sisestatud andmete põhjal:

            *KMI (kehamassiindeks);
            *hinnang liikumisaktiivsusele (vähene, piisav, liigu rohkem);
            *hinnang kaalule (väike, normaalkaal, ülekaal);
            
            *kuvatakse varasemalt sisestatud kaaluandmed kuupäevaliselt kahanevas järjekorras;
            *klient saab soovi korral välja logida.
            
            
Lisame juurde  andmebaasi skeemi loetava pildina + tabelite loomise SQL laused (kui keegi teine tahab seda tööle panna). Jooksvalt.


KOKKUVÕTE
