<?PHP

//Variablen allgemein
$LDja="    Ja    ";
$LDnein="  Nein  ";

//Variablen für sub_modul_neu.php
$LDNeuesModulanlegen = 'Create';
$LD_sub_NeuesModulAnlegenTxt= "creates a new module with your own defaults";
$LD_Hinweise="references";
$LD_HinweiseTxt="references for the supply of a login within the new module";


//Variablen für edv_modul_neu.php
$modul_titel="Title of the new module:";
$menue_eintrag_ja="Should there be made an entry in the standard menue(standard value).";
$menue_eintrag_nein="No thanks, no entry. A submenu of another module will be created manually.";
$modulanlegen="create module";
$LD_menufolge_txt1="Please choose the position, where you want to insert the entry for the new module.";
$LD_menufolge_txt2="if no changes are given, standard would be the end of the menu.";
$LD_automatic="automatic";
$LD_stelle="position";
$LD_weiter="next page...";
$LD_mit_untermenu="Check this field if you plan to create more than one submenu, a file with a submenu for easy expansion will be generated automatically.";


//Variablen für edv_modul_neu_2.php
$blank_eingabe="You have entered more than one word or space characters. That´s not allowed. Recommended would be to keep the stripped-down version. Klick \"No\" to change your entry.";
$fehleingabe="Empty module names are not allwed.";
$kontrollmeldung_1="The modules´new name would be:";
$kontrollmeldung_2="called";
$kontrollmeldung_3="Create a module with the title shown above?";

//Variablen für edv_modul_neu_3.php
$weiter_info="Please click \"contiue\" for creating the main file. Some more information is necessary.";
$wichtige_info="Click here for important advices for adjusting the files \"Modulname\"-main-pass.php and test_person_search.php";

//Variablen für check_patientwahl.php
$LD_headline_frage="Please choose. If nothing is changed, a patient based module will be generated.";
$haken_info="The module is patient based. When starting it, you have the ability to choose a patient number.";

//Variablen für radio_tabwahl.php
$LD_wahl1="edit an existing table using dbForm (type the name into the field below)";
$LD_wahl2="Send CREATE TABLE STATEMENT (a default querey is given in an editoring field)";
//$LD_wahl3=" Load a DB-designer-file into MySQL (import function)";
$LD_wahl3="No more changes NOW,create an empty file.";
$setback_fields="Set back fields";

//Variablen für radio_tabwahl.php  U N D  radio1_memofeld.php
$nenne_tabelle="specify the table name";
$nenne_tabelle2="<strong>(the same like in the memo field!)</strong>";
$nenne_suchfeld="specify the search field (normally \"id\")";
$nenne_tab_bezeichner="specify a string name for the table headline";
$nenne_anzeigefeld="specify the field shown in the search list (e.g. name/firstname)";
$nenne_server="specify the database server";
$fertig="create table and finish module $ModulNeuBez.";

//Variablen für radio1_memofeld.php
$infoline="Change the example table as you wish.</br>";

//Variablen für editsql.php
$sql_meldung="The following SQL string was executed in your database.";

//Variablen aus inc_datei_array.de
$err_ida_var_fehlt="The variables root_path or MoulNeuBez are empty. path of goal couldn't be aquired.";
$err_keinpfad="Break. The path does not exist. This is an error from the file inc_datei_array.php.";
$err_mainpass_copy="Copying the main-pass-file failed!";
$err_kopieren="Error accured while copying ";
$err_fehlgeschlagen=" .<br/>";

//Variablen aus Schlusssatz.php
$ld_gratulation="Congratulation, the module <strong> $ModulNeuBez</strong>is finish.";


?>
