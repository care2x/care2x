<?php
/* Günni <guenni1981 at lycos dot de> */
	// Erstellen der neuen Klasse
  class ladezeit
  {
   // Festlegen der von der Klasse intern genutzten Variablen
   var $starttime;
   var $endtime;

   // Erstellen der Funktion start()
   function start()
   {
    // Microsekunden und sekundenn in Variablen speichern
	list($usec, $sec) = explode(" ",microtime());

	// Speichern des Ergebnisses in der internen Variable $starttime
    $this->starttime = ((float)$usec + (float)$sec);
   }
   
   function ende()
   {
    list($usec, $sec) = explode(" ",microtime());
    $this->endtime = ((float)$usec + (float)$sec);
   }
   
   function ausgabe()
   {
   	// Endzeit - Startzeit = gebrauchte ladezeit
    $time = $this->endtime - $this->starttime;
	
	// Ausgabe des Ergebnisses
    echo 'Page generation time: '.$time;
   }
  }
?>
