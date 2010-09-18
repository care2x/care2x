<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'include/core/inc_environment_global.php');
require_once($root_path.'include/core/inc_img_fx.php');
?>
<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<?php html_rtl($lang); ?>
<HEAD>
<meta http-equiv="Content-Type" content="text/html; charset=utf8">
 <TITLE>Προειδοποίηση αποτυχημένης πρόσβασης</TITLE>
</HEAD>

<BODY bgcolor="#ffffff">

<table width=100% border=1>
<tr>
<td bgcolor="navy">
<FONT  COLOR="white"  SIZE=+3  FACE="Arial"><STRONG>&nbsp;Προσπάθεια μη εξουσιοδοτημένης πρόσβασης σελίδων</STRONG></FONT>
</td>
</tr>
<tr>
<td ><p><br>


<center>
<FONT    SIZE=3 color=red  FACE="Arial">
<b>Δεν έχετε άδεια πρόσβασης σε αυτό το έγγραφο!</b></font><p>
<FORM >
<INPUT type="button"  value=" OK "  onClick="<?php if ($mode=="close") print 'window.close()'; else print 'history.back()'; ?>"></FORM>
<p>
</font>
</center>
<p>
<ul>
<font size=3 face="verdana,arial">
Πιθανές αιτίες του προβλήματος:
</FONT><p>
<font size=2 face="verdana,arial">
<img <?php echo createComIcon('../../','achtung.gif') ?>>
Μπορεί να έχετε χρησιμοποιήσει τα κουμπιά "πίσω" ή "εμπρός" του περιηγητή(browser) ιστοσελίδων. Αποφύγετε αυτά τα κουμπιά.<br>
<img <?php echo createComIcon('../../','achtung.gif') ?>>
Μπορεί να έχετε απορρίψει ένα cookie. Το πρόγραμμα εξαρτάται από τα cookies για να λειτουργήσει σωστά. Παρακαλώ να δέχεστε τα cookies.
<br>
<img <?php echo createComIcon('../../','achtung.gif') ?>>
Ο περιηγητής σας μπορεί να μην δέχεται τα cookies. Παρακαλώ ρυθμίστε τον περιηγητή σας ώστε να δέχεται τα cookies αυτόματα.
<br>
<img <?php echo createComIcon('../../','achtung.gif') ?>>
Ο περιηγητής σας μπορεί να μην είναι σε θέση να τρέξει javascript ή το javascript να έχει τεθεί εκτός λειτουργίας. Παρακαλώ ενεργοποιήστε το javascript στον περιηγητή σας.
<br>
<img <?php echo createComIcon('../../','achtung.gif') ?>>
Σε σπάνιες περιπτώσεις μπορεί να έχει υπάρξει ένα λάθος στη μεταφορά
των στοιχείων.  Για να διορθώσετε την κατάσταση κάντε κλικ στο κουμπί "ανανέωση" του περιηγητή ιστοσελίδων.
<p>
</FONT>
<p>
</ul>
</td>
</tr>
</table>        
<p>

<?php
require($root_path.'include/core/inc_load_copyrite.php'); 
?>
</FONT>


</BODY>
</HTML>
