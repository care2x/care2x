<?php
/**
 * Original Copyright Joachim Mollin <mollin@hccgmbh.com> & Healthcare Consulting GmbH
 *
 * This is the javascript drop down menu tree developed by J. Mollin. 
 * It uses the dtree.js script Copyright (c) 2002-2003 Geir Landrö
 * This script was slightly modified by Elpidio Latorilla to accomodate user selectable menu tree style system
 * This script was modified by Emir Prcic to add collapsible hierarchy tree to wards and depts (2004-12-08)
 * This file will not run alone. This file is included by /main/gui_bridge/gui_indexframe.php.
 */
#
# Mod: 2004-07-29 EL
#
# Lese neue Menuestruktur.
# Read new menu structure


$sql = "SELECT a.name, a.LD_var AS \"LD_var\",a.url, b.s_main_nr, b.s_name, b.s_LD_var AS \"s_LD_var\", b.s_url, b.s_image,b.s_open_image, b.s_status, " . "b.s_ebene, b.s_url_ext FROM care_menu_main as a LEFT  JOIN care_menu_sub as b on a.nr=b.s_main_nr " . "WHERE a.is_visible=1  OR LD_var='LDEDP' OR LD_var='LDLogin'  ORDER BY a.sort_nr, b.s_sort_nr";

$result1 = $db->Execute ( $sql );

#
# If sql query ok, generate the javascript menu tree
#


if ($result1) {
	
	?>

<link rel="stylesheet" href="menu/dtree/dtree.css" type="text/css" />
<script language="javascript" src="menu/dtree/dtree.js" type="text/javascript"></script>

<script language="javascript">
<!--

function runModul (ziel) {
   //alert (ziel);
   //parent.frames[1].location.href=ziel;
	 window.parent.CONTENTS.location.href=ziel;
}

m = new dTree('m');
m.config.useIcons=true;
m.config.useLines=true;
m.config.closeSameLevel=true;
m.config.useSelection=false;
m.config.useCookies=false;

<?php

  //$jsTemp = '<script type="javascript">';
  echo "\n m.add(0,-1,'<b>Menu</b>','','','','img/trash.gif','../gui/img/common/default/address_book2.gif');\n";
  //echo "</script>\n";
	$my_ebene = 0;
	$p_last = 0;
	$p_akt = 0;
	$ip = 0;
	$i = 0;
	$j = 1;
	while ( $menu = $result1->FetchRow () ) {
		if (eregi ( 'LDLogin', $menu ['LD_var'] )) {
			if ($_COOKIE ['ck_login_logged' . $sid] == 'true') {
				$menu ['url'] = 'main/logout_confirm.php';
				$menu ['LD_var'] = 'LDLogout';
			}	
		}
		if ($menu ['s_ebene'] != 0) {
		//if ($menu['s_url']!='') {
        //$my_menu_call=$root_path.$menu['s_url'].URL_APPEND.$menu['s_url_ext'];
			$my_menu_call = $menu ['s_url'] . URL_APPEND . $menu ['s_url_ext'];
			$my_menu_LDvar = $menu ['s_LD_var'];
			$my_menu_name = $menu ['s_name'];
			$my_menu_img = $menu ['s_image'];
			$my_menu_open_img = $menu ['s_open_image'];
        //$i=$ip;
        //$i=$p_last;
		} else {
			$my_menu_call = $root_path . $menu ['url'] . URL_APPEND;
			$my_menu_LDvar = $menu ['LD_var'];
			$my_menu_name = $menu ['name'];
			$my_menu_img = $menu ['s_image'];
			$my_menu_open_img = $menu ['s_open_image'];
        //$ip=$j;
        //$i=0;
        }
		if (isset ( $$my_menu_LDvar ) && $$my_menu_LDvar != '') //text durch Inhalt LD_var ersetzen; get the language dependent text
			$my_menu_item = $$my_menu_LDvar; else
			$my_menu_item = $my_menu_name;

    //echo $my_menu_item;
		if ($menu ['s_ebene'] == '') {
			$menu ['s_ebene'] = 0;
        }
		if ($menu ['s_ebene'] == $my_ebene) {
        //$p_alt[$menu['s_ebene']]=$j;
        }
		if ($menu ['s_ebene'] < $my_ebene) {
        //if ($p_alt[$menu['s_ebene']]=='') $p_alt[$menu['s_ebene']]=0;
			$p_akt = $p_alt [$menu ['s_ebene']];
			$my_ebene = $menu ['s_ebene'];
		}
		if ($menu ['s_ebene'] > $my_ebene) {
			$p_akt = $j - 1;
			$p_alt [$menu ['s_ebene']] = $j - 1;
			$my_ebene = $menu ['s_ebene'];
		}
		
		if ($e == $e_alt) {
			$i = $in [$e_alt];
			$in [$e + 1] = $pos;
		}
		if ($e > $e_alt) {
			$i = $in [$e_alt + 1];
			$in [$e + 1] = $pos;
		}
		if ($e < $e_alt) {
			$i = $in [$e];
			$in [$e + 1] = $pos;
        }
		
		if ($p_akt == '')
			$p_akt = 0;
		$erg = "m.add($j,$p_akt,'$my_menu_item','javascript:runModul(\'$my_menu_call\')','','','$my_menu_img','$my_menu_open_img');";
		$j += 1;
    //echo '<script type="text/javascript">';
    echo "\n$erg\n";
    //echo "</script>\n";


		if ($menu ['s_status'] == '[station]') { //Station anzeigen; display station
			$i_stat = $j;
			$i2_stat = $j - 1;
	   
	   //$db->debug=1;
		

	   #
	   # 2004-12-08
	   # Modified by Emir Prcic to add tree hierarchy to the wards and depts
	   #
	   //$sqldep="select (select care_department.id from care_department where care_department.nr=care_ward.dept_nr) as did, (select care_department.name_short from care_department where care_department.nr=care_ward.dept_nr) as dname,  (select care_department.LD_var from care_department where care_department.nr=care_ward.dept_nr) as \"LD_var\", dept_nr from care_ward where is_temp_closed=0 group by dept_nr order by dept_nr";


	   #
	  # 2004-12-09
	  # Modified by Elpidio Latorilla to avoid cascaded select query
	  #
			$sqldep = "SELECT d.id  AS did,   d.name_short  AS  dname,   d.LD_var as \"LD_var\",   w.dept_nr AS dept_nr FROM care_ward AS w  LEFT   JOIN care_department AS d ON d.nr = w.dept_nr   WHERE w.is_temp_closed=0 GROUP BY w.dept_nr,d.id,d.name_short,d.LD_var ORDER by w.dept_nr ";

			$res_dept = $db->Execute ( $sqldep );
	   // begin departmens and wards
	   //begin department
	   
	   
			while ( $dept3 = $res_dept->FetchRow () ) {
				$d_id = $dept3 ['dept_nr'];
				$d_name = $dept3 ['dname'];
				$d_var = $dept3 ['LD_var'];
				$d_did = $dept3 ['did'];
				
				if (isset ( $$d_var ) && $$d_var != '') //text durch Inhalt LD_var ersetzen; get the language dependent text
					$my_d_name = $$d_var; else
					$my_d_name = $d_name;
	   
				$erg2 = "m.add($j,$i2_stat,'$my_d_name','','','../main/img/folderopen.gif','../main/img/folder.gif');";
  	   echo "\n$erg2\n"; 
	       
				$j += 1;
			 
		  //begin wards  
				$sql = "select nr, dept_nr, ward_id, name from care_ward where is_temp_closed=0 and dept_nr=" . $d_id . " order by dept_nr";
				$res_stat = $db->Execute ( $sql );
	        
				while ( $stat = $res_stat->FetchRow () ) {
					$st_name = $stat ['name'];
					$st_nr = $stat ['nr'];
					$st_ward_id = $stat ['ward_id'];
					$st_dept = $stat ['dept_nr'];
			  
					$erg = "m.add($j,$i_stat,'$st_name','javascript:runModul(\'../modules/nursing/nursing-station-pass.php" . URL_APPEND . "&rt=pflege&edit=1&station=$st_ward_id&location_id=$st_ward_nr&ward_nr=$st_nr\')','','','../gui/img/common/default/blue_bullet.gif');";
					$j += 1;
			
            echo "\n$erg\n";

				}
				$i_stat = $j;

			}
      
      } //Station anzeigen Ende; End of station display


	}
	//echo $jsTemp;
	?>

        document.write(m);
        //x= m.openAll();
//-->
</script>
<?php
	#
# If menu tree cannot be generated, revert to default menu tree
#
} else {
	include ('menu/default/mainmenu.inc.php');
}

//mysql_free_result($Recordset1); // <- This creates a warning message. Not needed because php releases resources at the end of script
?>