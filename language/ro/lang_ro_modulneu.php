<?PHP

//Variablen allgemein
$LDja="    Da    ";
$LDnein="  Nu    ";

//Variablen für sub_modul_neu.php
$LDNeuesModulanlegen = 'Creeaza';
$LD_sub_NeuesModulAnlegenTxt= "creeaza un nou modul cu propriile tale greseli";
$LD_Hinweise="referinte";
$LD_HinweiseTxt="referinte pentru a suplimenta legarea cu noul modul";


//Variablen für edv_modul_neu.php
$modul_titel="Titlul noului modul:";
$menue_eintrag_ja="Ar trebui facuta o intrare in meniul standard(valori standard).";
$menue_eintrag_nein="Nu multumesc, nici o intrare. Submeniul altui modul va fi creat manual.";
$modulanlegen="creaza modul";
$LD_menufolge_txt1="Va rog alegeti pozitia, unde doriti sa introduceti intrarea pentru noul modul.";
$LD_menufolge_txt2="daca nu sunt date schimbari, standardul va fi la sfarsitul meniului.";
$LD_automatic="automat";
$LD_stelle="pozitie";
$LD_weiter="pagina urmatoare...";
$LD_mit_untermenu="Verifica acest camp daca planuiesti sa creezi mai mult de un submeniu, o fisa cu un submeniu pentru o expansiune usoara care va fi generata imediat automat.";


//Variablen für edv_modul_neu_2.php
$blank_eingabe="Ati introdus mai mult de un caracter sau un cuvant. Aceasta nu e permis. Se recomanda sa tineti versiunea de jos. Apasa \"Nr\" sa schimbi intrarea.";
$fehleingabe="Modulele fara nume nu sunt permise.";
$kontrollmeldung_1="Noul nume al modulului va fi:";
$kontrollmeldung_2="numit";
$kontrollmeldung_3="Creaza un modul cu titlul afisat mai jos?";

//Variablen für edv_modul_neu_3.php
$weiter_info="Va rog apasati \"continuare\" pentru a crea fisierul principal. Cateva informatii suplimentare sunt necesare.";
$wichtige_info="Apasati aici pentru sfaturi importante pentru a ajusta fisierul\"Modulname\"-main-pass.php si test_person_search.php";

//Variablen für check_patientwahl.php
$LD_headline_frage="Va rugam alegeti. Daca nimic nu este schimbat, va fi generat un modul de baza pentru pacient.";
$haken_info="Modulul este bazat pe pacient. Cand il incepi, trebuie sa poti alege numarul pacientului.";

//Variablen für radio_tabwahl.php
$LD_wahl1="editeaza un tabel deja existent folosind dbForm (scrie numele in campul de mai jos)";
$LD_wahl2="Trimite CREATE TABLE STATEMENT (un fisier gresit a fost dat in campul editorial)";
//$LD_wahl3=" Incarca un DB-designer-fisier in MySQL (functie importanta)";
$LD_wahl3="Nici o schimbare ACUM,creaza un fisier gol.";
$setback_fields="Seteaza fisierele din spate";

//Variablen für radio_tabwahl.php  U N D  radio1_memofeld.php
$nenne_tabelle="specifica numele tabelului";
$nenne_tabelle2="<strong>(acelasi ca si in campul de memorie!)</strong>";
$nenne_suchfeld="specifica campul de cautare (normal \"id\")";
$nenne_tab_bezeichner="specifica un nume pentru capul de tabel";
$nenne_anzeigefeld="specifica campul aratat in lista de cautare (e.g. nume/prenume)";
$nenne_server="specifica servarul cu baza de date";
$fertig="creaza tabelul si incheie modulul $ModulNeuBez.";

//Variablen für radio1_memofeld.php
$infoline="Schimba tabelul exemplu cum vrei tu.</br>";

//Variablen für editsql.php
$sql_meldung="Urmatorul SQL a fost creat in baza ta de date.";

//Variablen aus inc_datei_array.de
$err_ida_var_fehlt="Variabilele root_path sau MoulNeuBez sunt goale. scopul nu a putut fi atins.";
$err_keinpfad="Break. Calea nu exista. Aceasta este o eroare de la fisierul inc_datei_array.php.";
$err_mainpass_copy="Copierea fisierului main-pass-file a cazut!";
$err_kopieren="A aparut o eroare in timpul copierii ";
$err_fehlgeschlagen=" .<br/>";

//Variablen aus Schlusssatz.php
$ld_gratulation="Felicitari, modulul <strong> $ModulNeuBez</strong>este terminat.";

?>
