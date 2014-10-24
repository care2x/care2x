<?php 
require_once('../include/core/inc_date_format_functions.php');
 ?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title></title>
</head>
<body>
<font face="Verdana, Arial" size=3 color="#000099"><b>Tips & tricks in searching a person</b></font>
<p>
<img <?php echo createComIcon('../','warn.gif','0') ?>>
<font color="#990000" face="Verdana, Arial" ><b></a>
Important to remember!</b></font>
<font face="Verdana, Arial" size=2>
<blockquote>
Any word that you enter will be considered as a probable beginning of the information.<p>
So, if for example you entered "Adam", Care2x will search for all family names (or first names) that begin with "adam". A  search result will probably
contain names like "Adam", "Adamson", "Adamo", etc.
<p>
</blockquote>

<p>
<img <?php echo createComIcon('../','frage.gif','0') ?>>
<font color="#990000" face="Verdana, Arial" ><b></a>
What is the fastest way to search for a person?</b></font>
<font face="Verdana, Arial" size=2>
<blockquote>
<li>Type his full personal ID number (PID).
</blockquote>
<p>
<img <?php echo createComIcon('../','frage.gif','0') ?>>
<font color="#990000" face="Verdana, Arial" ><b></a>
How to search by family name?</b></font>
<font face="Verdana, Arial" size=2>
<blockquote>
<li>Just enter the name or few beginning characters in the input.
<li>Click the "Search" button.<br>
<img src="../help/en/img/en_search_fname.png">
<p>
</blockquote>
<p>
<img <?php echo createComIcon('../','frage.gif','0') ?>>
<font color="#990000" face="Verdana, Arial" ><b></a>
Why include the first name in searching?</b></font>
<font face="Verdana, Arial" size=2>
<blockquote>
<li>If the "Search for first names too" radio button is shown, you need to click it (activate) to force Care2x to search by both family and first names.
Otherwise (if button is un-clicked), only the family names will be searched.
<br>
<img src="../help/en/img/en_search_radio.png">
</blockquote>

<p>
<img <?php echo createComIcon('../','frage.gif','0') ?>>
<font color="#990000" face="Verdana, Arial" ><b></a>
Why should I limit my search by family names alone?</b></font>
<font face="Verdana, Arial" size=2>
<blockquote>
<li>The search will be faster.

</blockquote>

<p>
<img <?php echo createComIcon('../','frage.gif','0') ?>>
<font color="#990000" face="Verdana, Arial" ><b></a>
FAST search by first name alone!</b></font>
<font face="Verdana, Arial" size=2>
<blockquote>
<li>Type the first name, type space, then type <b>*</b>.
<br>
<img src="../help/en/img/en_search_quickfirst.png">

</blockquote>
<p>
<img <?php echo createComIcon('../','frage.gif','0') ?>>
<font color="#990000" face="Verdana, Arial" ><b></a>
Searching by first and family name.</b></font>
<font face="Verdana, Arial" size=2>
<blockquote>
<li>Type the first and family name separating them with a space
<br>
<img src="../help/en/img/en_search_firstlast.png">
<p>
<img <?php echo createComIcon('../','warn.gif','0') ?>> Note: The abovemost notice applies. The first and second words will be 
considered as probable beginning of first and family names respectively. So, the above entry example would probably return a list that also contains the
"Adamson Smithsonian", "Adams Smiths", "Adamhoe Smitheren", etc.
</blockquote>
<p>
<img <?php echo createComIcon('../','frage.gif','0') ?>>
<font color="#990000" face="Verdana, Arial" ><b></a>
Searching by family and first name.</b></font>
<font face="Verdana, Arial" size=2>
<blockquote>
<li>If you want to type the family name first followed by the first name:
<li>Type the family name followed immediately by a comma, then a space, and finally the first name.
<br>
<img src="../help/en/img/en_search_lastfirst.png">
</blockquote>
<p>
<img <?php echo createComIcon('../','frage.gif','0') ?>>
<font color="#990000" face="Verdana, Arial" ><b></a>
Searching for all persons born in November 1, 1967 (01.10.1967).</b></font>
<font face="Verdana, Arial" size=2>
<blockquote>
<li>Type the complete date of birth following your current date format.
<br>
<img src="../help/en/img/en_search_fullbday.png">
</blockquote>

<p>
<img <?php echo createComIcon('../','frage.gif','0') ?>>
<font color="#990000" face="Verdana, Arial" ><b></a>
What is my current date format?</b></font>
<font face="Verdana, Arial" size=2>
<blockquote>
<li>Your current date format is <font color="red"><?php echo $date_format.'</font>. Today is = ('.@formatDate2Local(date('Y-m-d'),$date_format).')'; ?>

</blockquote>

<p>
<img <?php echo createComIcon('../','frage.gif','0') ?>>
<font color="#990000" face="Verdana, Arial" ><b></a>
Searching for all adam's smith's born in year 1947.</b></font>
<font face="Verdana, Arial" size=2>
<blockquote>
<li>Type the first name , the family name and the year of birth
<br>
<img src="../help/en/img/en_search_firstlastyear.png">
</blockquote>

<p>
<img <?php echo createComIcon('../','frage.gif','0') ?>>
<font color="#990000" face="Verdana, Arial" ><b></a>
Searching for all persons born in year 1989.</b></font>
<font face="Verdana, Arial" size=2>
<blockquote>
<li>Type the *, type space, type *, type space, type the year of birth
<br>
<img src="../help/en/img/en_search_allyear.png">
</blockquote>

<p>
<img <?php echo createComIcon('../','frage.gif','0') ?>>
<font color="#990000" face="Verdana, Arial" ><b></a>
Searching for all adam's smith's born in 20th century (1900 to 1999).</b></font>
<font face="Verdana, Arial" size=2>
<blockquote>
<li>Type "adam", type space, type "smith", type space, type "19".
<br>
<img src="../help/en/img/en_search_firstlastcent.png">
</blockquote>


</body>
</html>
