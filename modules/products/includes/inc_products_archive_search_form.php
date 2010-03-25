<form action="<?php echo $searchfile?>" method="post" name="suchform" onSubmit="return pruf(this)">
  <table border=0 cellspacing=2 cellpadding=3>
    <tr bgcolor=#ffffdd>
      <td align=center colspan=2><FONT face="Verdana,Helvetica,Arial" size=2 color="#800000"><?php echo $LDSearch4OrderList ?>:</td>
    </tr>
    <tr bgcolor=#ffffdd>
      <td align=right><FONT face="Verdana,Helvetica,Arial" size=2><?php echo $LDOrderListKey ?></td>
      <td><input type="text" name="keyword" size=40 maxlength=40 value="<?php if(!$keyword) print $dept; else print $keyword; ?>">
          </td>
    </tr>
    <tr bgcolor=#ffffdd>
      <td align=right valign=top><FONT face="Verdana,Helvetica,Arial" size=2><?php echo $LDSearchIn ?></td>
      <td><FONT face="Verdana,Helvetica,Arial" size=2>	
	  		<input type="checkbox" name="such_date" value="1" <?php if(($such_date)||(!$mode)) print " checked"; ?>> <?php echo $LDDate ?><br>
          	<input type="checkbox" name="such_dept" value="1" <?php if(($such_dept)||(!$mode)) print " checked"; ?>> <?php echo $LDDept ?><br>
          	<input type="checkbox" name="such_prio" value="1" <?php if(($such_prio)||(!$mode)) print " checked"; ?>> <?php echo $LDPrio ?><br>
          </td>
    </tr>

    <tr >
     
      <td><input type="reset" value="<?php echo $LDReset ?>" onClick="document.suchform.keyword.focus()">
                      </td>
     <td align=right><input type="submit" value="<?php echo $LDSearch ?>">
           </td>
    </tr>
  </table>
  <input type="hidden" name="sid" value="<?php echo $sid?>">
  <input type="hidden" name="lang" value="<?php echo $lang?>">
  <input type="hidden" name="userck" value="<?php echo $userck?>">
  <input type="hidden" name="cat" value="<?php echo $cat?>">
    <input type="hidden" name="mode" value="search">
</form>
