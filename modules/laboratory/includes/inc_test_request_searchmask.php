<?php
if(!$searchform_count)
{
?>

            <script language="javascript">
            <!-- 
            function chkSearch(d)
            {
               if((d.searchkey.value=="") || (d.searchkey.value==" "))
			   {
				  d.searchkey.focus();
			      return false;
			   }
                else 
				{
				  return true;
				}
            }
           // -->
           </script>
<?php
}
?>

		  <table border=0 cellspacing=5 cellpadding=5>
            <tr bgcolor="<?php if($searchmask_bgcolor)  echo $searchmask_bgcolor; else echo "#ffffff"; ?>">
            <td>
			
			 <form action="<?php echo $root_path; ?>modules/laboratory/labor_test_request_search_patient.php" method="post" 
			           name="searchform<?php if($searchform_count) echo "_".$searchform_count; ?>" 
					   onSubmit="return chkSearch(this)">&nbsp;<br>
					   
	         <FONT    SIZE=2  FACE="Arial"><?php echo $LDSearchPatient ?>:<br>
			 
	         <input type="text" name="searchkey" size=40 maxlength=40><p>
             <input type="image" <?php echo createLDImgSrc($root_path,'searchlamp.gif','0','absmiddle') ?>>
             <input type="hidden" name="sid" value="<?php echo $sid; ?>">
	         <input type="hidden" name="lang" value="<?php echo $lang; ?>">
	         <input type="hidden" name="noresize" value="<?php echo $noresize; ?>">
	         <input type="hidden" name="target" value="<?php echo $target; ?>">
	         <input type="hidden" name="user_origin" value="<?php echo $user_origin; ?>">
	         <input type="hidden" name="mode" value="search">
			 
	         </form>
			
			</td>
            </tr>
          </table>
