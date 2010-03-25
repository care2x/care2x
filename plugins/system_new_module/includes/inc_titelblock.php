<!-- Seitenkopf, der Blaue Balken generieren -->
<!--Tabelle für oberen blauen Balken mit Standard Schaltflächen erstellen -->
<table width=100% border=0 cellspacing=0 height=100%>

<tr valign=top height=10>

<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>" height="45"><FONT  COLOR="<?php echo $cfg['top_txtcolor']; ?>"  SIZE=+2  FACE="Arial">
<!-- Titeltext aus Variablen zusammensetzen -->
<STRONG> &nbsp; <?php echo $thismodulname; //echo $LDEDP . " - " . $LDNeuesModulanlegen; ?></STRONG></FONT></td>
<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>" height="10" align=right>

<!-- Buttons in Titelleiste generieren -->

<?php if($cfg['dhtml'])echo'<a href="'.$returnfile.'"><img '.createLDImgSrc($root_path,'back2.gif','0').'  class="fadeOut" >';?></a><a href="javascript:gethelp('<?php echo $new_hlp_file?>','<?php echo $LDEDP?>')"><img <?php echo createLDImgSrc($root_path,'hilfe-r.gif','0') ?>  <?php if($cfg['dhtml'])echo'class="fadeOut" >';?></a><a href="<?php echo $breakfile;?>"><img <?php echo createLDImgSrc($root_path,'close2.gif','0') ?> alt="<?php echo $LDClose ?>"  <?php if($cfg['dhtml'])echo'class="fadeOut" >';?></a></td>
</tr>
<tr valign=top >
<td bgcolor=<?php echo $cfg['body_bgcolor']; ?> valign=top colspan=2><p><br>
