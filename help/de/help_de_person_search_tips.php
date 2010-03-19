<?php
require_once('../include/inc_date_format_functions.php');
 ?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title></title>
</head>
<body>
<font face="Verdana, Arial" size=3 color="#000099"><b>Tips für die Personensuche</b></font>
<p>
<img <?php echo createComIcon('../','warn.gif','0') ?>>
<font color="#990000" face="Verdana, Arial" ><b></a>
Wichtige Grundregeln:</b></font>
<font face="Verdana, Arial" size=2>
<blockquote>
Jede Eingabe wird von Care2x als Beginn des gesuchten Wortes aufgefasst.<p> Wenn Sie zum Beispiel "Adam"
eingeben, wird nach allen Familiennamen oder Vornamen gesucht, die mit "Adam" beginnen. Das Ergebnis wird also
Namen wie "Adam", "Adamson", "Adami", etc. enthalten.
<p>
</blockquote>

<p>
<img <?php echo createComIcon('../','frage.gif','0') ?>>
<font color="#990000" face="Verdana, Arial" ><b></a>
Wie finde ich eine Person am schnellsten?</b></font>
<font face="Verdana, Arial" size=2>
<blockquote>
<li>Indem Sie die vollständige Personen-Identifikationsnummer (PID) eingeben.
</blockquote>
<p>
<img <?php echo createComIcon('../','frage.gif','0') ?>>
<font color="#990000" face="Verdana, Arial" ><b></a>
Wie kann ich nach einem bestimmten Familiennamen suchen?</b></font>
<font face="Verdana, Arial" size=2>
<blockquote>
<li>Geben Sie den Namen oder die ersten paar Buchstaben des Namens ein.
<li>Klicken Sie auf "Suchen".<br>
<img src="../help/en/img/en_search_fname.png">
<p>
</blockquote>
<p>
<img <?php echo createComIcon('../','frage.gif','0') ?>>
<font color="#990000" face="Verdana, Arial" ><b></a>
Warum wird auch nach Vornamen gesucht?</b></font>
<font face="Verdana, Arial" size=2>
<blockquote>
<li>Wenn der Auswahlknopf "Auch nach Vornamen suchen" angezeigt wird, muss dieser angeklickt (aktiviert) sein,
damit Care2x auch Vornamen in die Suche einbezieht. Sonst (wenn der Knopf nicht aktiviert ist) wird nur nach
dem Familiennamen gesucht.
<br>
<img src="../help/en/img/en_search_radio.png">
</blockquote>

<p>
<img <?php echo createComIcon('../','frage.gif','0') ?>>
<font color="#990000" face="Verdana, Arial" ><b></a>
Warum sollte ich die Suche auf die Familiennamen beschränken?</b></font>
<font face="Verdana, Arial" size=2>
<blockquote>
<li>Die Suche wird dadurch beschleunigt.

</blockquote>

<p>
<img <?php echo createComIcon('../','frage.gif','0') ?>>
<font color="#990000" face="Verdana, Arial" ><b></a>
SCHNELLE Suche nach Vornamen!</b></font>
<font face="Verdana, Arial" size=2>
<blockquote>
<li>Geben Sie den Vornamen ein, dann einen Leerschritt, dann ein <b>*</b>.
<br>
<img src="../help/en/img/en_search_quickfirst.png">

</blockquote>
<p>
<img <?php echo createComIcon('../','frage.gif','0') ?>>
<font color="#990000" face="Verdana, Arial" ><b></a>
Suche nach Vor- und Familiennamen.</b></font>
<font face="Verdana, Arial" size=2>
<blockquote>
<li>Trennen Sie den Vornamen und den Familiennamen durch ein Leerzeichen.<br>
<img src="../help/en/img/en_search_firstlast.png">
<p>
<img <?php echo createComIcon('../','warn.gif','0') ?>> Anmerkung: Die Reihenfolge der Einträge entscheidet! So
wird das erste und das zweite eingetragene Wort als Vor- und Nachname aufgefasst. Die oben angezeigte Suche
wird also auch Namen wie "Adamson Smithsonian", "Adams Smiths", "Adamhoe Smitheren", etc. liefern.
</blockquote>
<p>
<img <?php echo createComIcon('../','frage.gif','0') ?>>
<font color="#990000" face="Verdana, Arial" ><b></a>
Suche nach Familien- und Vornamen</b></font>
<font face="Verdana, Arial" size=2>
<blockquote>
<li>Wenn Sie den Familiennamen zuerst eingeben wollen:
<li>Geben Sie den Familiennamen ein, unmittelbar gefolgt von einem Komma, dann ein Leerzeichen, dann den Vornamen.
<br>
<img src="../help/en/img/en_search_lastfirst.png">
</blockquote>
<p>
<img <?php echo createComIcon('../','frage.gif','0') ?>>
<font color="#990000" face="Verdana, Arial" ><b></a>
Suche nach allen Personen, die am 11. November 1967 geboren sind (01.11.1967).</b></font>
<font face="Verdana, Arial" size=2>
<blockquote>
<li>Geben Sie das komplette Geburtsdatum entsprechend Ihrem gültigen Datumsformat ein.
<br>
<img src="../help/en/img/en_search_fullbday.png">
</blockquote>

<p>
<img <?php echo createComIcon('../','frage.gif','0') ?>>
<font color="#990000" face="Verdana, Arial" ><b></a>
Was ist mein gültiges Datumsformat?</b></font>
<font face="Verdana, Arial" size=2>
<blockquote>
<li>Ihr gültiges Datumsformat ist <font color="red">
<?php echo $date_format.'</font>. Today is = ('.@formatDate2Local(date('Y-m-d'),$date_format).')'; ?>

</blockquote>

<p>
<img <?php echo createComIcon('../','frage.gif','0') ?>>
<font color="#990000" face="Verdana, Arial" ><b></a>
Suche nach allen "adam smith", die 1947 geboren sind.</b></font>
<font face="Verdana, Arial" size=2>
<blockquote>
<li>Geben Sie erst den Vornamen, dann den Familiennamen und schließlich das Geburtsjahr ein
<br>
<img src="../help/en/img/en_search_firstlastyear.png">
</blockquote>

<p>
<img <?php echo createComIcon('../','frage.gif','0') ?>>
<font color="#990000" face="Verdana, Arial" ><b></a>
Suche nach allen Personen, die im Jahr 1989 geboren wurden.</b></font>
<font face="Verdana, Arial" size=2>
<blockquote>
<li>Geben Sie einen *, dann ein Leerzeichen, dann wieder *, Leerzeichen und schließlich das Jahr ein
<br>
<img src="../help/en/img/en_search_allyear.png">
</blockquote>

<p>
<img <?php echo createComIcon('../','frage.gif','0') ?>>
<font color="#990000" face="Verdana, Arial" ><b></a>
Suche nach allen "adam smith", die im 20. Jahrhundert geboren wurden (1900 bis 1999).</b></font>
<font face="Verdana, Arial" size=2>
<blockquote>
<li>Eingabe "adam", Leerzeichen, "smith", Leerzeichen, "19".
<br>
<img src="../help/en/img/en_search_firstlastcent.png">
</blockquote>


</body>
</html>
