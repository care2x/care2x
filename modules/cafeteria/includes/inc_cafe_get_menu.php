<?php
$dbtable_menu='care_cafe_menu';

/* Check whether the content is language dependent */
if(defined('LANG_DEPENDENT') && (LANG_DEPENDENT==1)) {
	/* Set the sql query for fetching the menu */
    $sql_menu="SELECT menu FROM $dbtable_menu WHERE cdate='".date("Y-m-d")."' AND lang='".$lang."'";
}
else {
	/* Set the sql query for fetching the menu */
    $sql_menu="SELECT menu FROM $dbtable_menu WHERE cdate='".date("Y-m-d")."'";
}

if($ergebnis=$db->Execute($sql_menu)) {
    
	if($rows=$ergebnis->RecordCount()) {
	    $menu = $ergebnis->FetchRow();
	}
	else {
	    $menu['menu']=$LDNoMenu;
    }
}

if(!$menu['menu']) $menu['menu']=$LDNoMenu;

?>
