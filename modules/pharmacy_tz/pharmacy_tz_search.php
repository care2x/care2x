<?php
require('./roots.php');


require($root_path.'include/core/inc_environment_global.php');
error_reporting($ErrorLevel);
require($root_path.'include/care_api_classes/class_tz_pharmacy.php');


/**
* CARE2X Integrated Hospital Information System Deployment 2.1 - 2004-10-02
* GNU General Public License
* Copyright 2005 Robert Meggle based on the development of Elpidio Latorilla (2002,2003,2004,2005)
* elpidio@care2x.org, meggle@merotech.de
*
* See the file "copy_notice.txt" for the licence notice
*/
$lang_tables[]='pharmacy.php';
define('NO_2LEVEL_CHK',1);
require($root_path.'include/core/inc_front_chain_lang.php');

require_once($root_path.'include/care_api_classes/class_tz_pharmacy.php');
$debug=FALSE;

$product_obj = new Product();

if ($debug) {
  function print_debug_info($name, $value) {
  if (isset($value))
    echo $name." is set to value: ".$value."<br>";
  }
  print_debug_info("Search pattern", $keyword);
  print_debug_info("Category", $category);
}

// prepare the category-select box:
$classfication_options='';
$all_cassifications_array = $product_obj->get_all_categories();
while ($classification_array = $all_cassifications_array->FetchRow()) {
	if ($category==$classification_array[0]) {

		$classfication_options=$classfication_options."<option selected>".$classification_array[0]."</option>\n";
	} else {
		$classfication_options=$classfication_options."<option>".$classification_array[0]."</option>\n";
	}
}

if (!empty($keyword) || !empty($category)) {
  // We have work...


  if (empty($keyword)) $keyword ="*";


  $search_results = $product_obj->get_array_search_results($keyword,$category);

  $number_of_search_results = $search_results->RecordCount();

  $bg_color_change = 1;

  while ($search_element = $search_results->FetchRow()) {
    if ($bg_color_change) {
      $http_buffer.="<tr bgcolor='#ffffaa' id='hovv'>";
      $bg_color_change = 0;
    } else {
      $http_buffer.="<tr bgcolor='#ffffdd' id='hovv'>";
      $bg_color_change = 1;
    }

    $item_id = $search_element['item_id'];
    $part_code = $search_element['partcode'];
    $item_plausibility = $search_element['plausibility'];
    $item_description = $product_obj->get_description($item_id);
    $item_number = $product_obj->get_itemnumber($item_id);
    $item_classification = $product_obj->get_item_classification($item_id);
    $item_unit_price = $product_obj->get_all_prices($item_id);
	$inuse = $search_element['not_in_use'];
    $check = ($inuse==1)?'checked=\"checked\"':'';

    $http_buffer.=" <td class=\"b r\">".$item_number."</td>
                    <td class=\"b r\">".$part_code."&nbsp;</td>
                    <td class=\"b r\">".str_replace(strtolower(trim($keyword)),"<b>".trim($keyword)."</b>",strtolower($item_description))."</td>
		   			<td class=\"b r\">".$item_classification."&nbsp;</td>
					<td class=\"b r\" align=\"right\">".$item_unit_price."&nbsp;</td>
                    <td class=\"b r\" align=\"right\">".$item_plausibility."&nbsp;</td>
                    <td class=\"b r\"><div align=\"center\"><a href=\"pharmacy_tz_new_product.php?mode=show&item_id=".$item_id."&keyword=".$keyword."\"><img src=\"".$root_path."gui/img/common/default/common_infoicon.gif\" width=\"16\" height=\"16\" border=\"0\"></a></td>
                    <td class=\"b r\"><div align=\"center\"><a href=\"pharmacy_tz_new_product.php?mode=edit&item_id=".$item_id."&GOBACKTOSEARCH=TRUE&category=".$category."&keyword=".$keyword."\"><img src=\"".$root_path."gui/img/common/default/hammer.gif\" width=\"16\" height=\"16\" border=\"0\"></a></td>
                    <td class=\"b r\"><div align=\"center\"><a href=\"pharmacy_tz_new_product.php?mode=erase&item_id=".$item_id."&keyword=".$keyword."\"><img src=\"".$root_path."gui/img/common/default/delete.gif\" width=\"16\" height=\"16\" border=\"0\"></a></td>
                    <td class=\"b\" nowrap id=\"nav".$item_id."\" class=\"redd\"><input type=\"checkbox\" id=\"itemx".$item_id."\"  value=\"itemx".$item_id."\" ".$check." onclick=\"sendQest(".$item_id.")\" ></td>";
    $http_buffer.="</tr>";
  }
}


require ("gui/gui_pharmacy_tz_search.php");
exit();
?>
