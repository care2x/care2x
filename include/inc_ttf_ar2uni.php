<?php
	#====================================================================================================#
	# ar2uni v0.1 (Arabic-win1256 encoder to Unicode)                                                                                                            # 
	#====================================================================================================#
	# Information:                                                                                       #
	#        This is PHP function for covert Arabic encoding string to                                   #
	#        unicode that can use to show Arabic charactor in  function ImageTTFText().                  #
	#        It Tested and worked with Multilanguage arial.ttf V2.98                                     #
	#                                                                                                    #
	# Version History:                                                                                   #
	#        version 0.1 : First release. created on ( 22/01/2004) By Walid Fathalla                     #
	#                                                                                                    #
	# Bug Report and Suggestion to:                                                                      #
	#        Walid Fathalla                                                                              #
	#        fathalla_w@hotmail.com                                                                      #
	#                                                                                                    #
	#====================================================================================================#
	# Example:                                                                                           #
	#        include_once($root_path.'inc_ttf_ar2uni.php');                                              #
	#        ImageTTFText ($image, 8, 0, 3, 15, $white, "arial.ttf",ar2uni("$ArabicString"));            #
	#====================================================================================================#
	# For Arabic Website: If you thing this module useful to you, please send to                         #
	#                     me back to my email fathalla_w@hotmail.com.                                    #
	#                                                                                                    #
	#====================================================================================================#
 
    #================================================// Arabic character maps//=============================================
	$ar2unimap = array( // One bit character isolated form
	',' => "&#1548;", 'º' => "&#1563;", '¿' => "&#1567;", 'Á' => "&#1569;", 'Â' => "&#1570;", 'Ã' => "&#1571;", 'Ä' => "&#1572;",
	'Å' => "&#1573;", 'Æ' => "&#1574;", 'Ç' => "&#1575;", 'È' => "&#1576;", 'É' => "&#1577;", 'Ê' => "&#1578;", 'Ë' => "&#1579;",
	'Ì' => "&#1580;", 'Í' => "&#1581;", 'Î' => "&#1582;", 'Ï' => "&#1583;", 'Ð' => "&#1584;", 'Ñ' => "&#1585;", 'Ò' => "&#1586;",
	'Ó' => "&#1587;", 'Ô' => "&#1588;", 'Õ' => "&#1589;", 'Ö' => "&#1590;", 'Ø' => "&#1591;", 'Ù' => "&#1592;", 'Ú' => "&#1593;",
	'Û' => "&#1594;", 'Ü' => "&#1600;", 'Ý' => "&#1601;", 'Þ' => "&#1602;", 'ß' => "&#1603;", 'á' => "&#1604;", 'ã' => "&#1605;",
	'ä' => "&#1606;", 'å' => "&#1607;", 'æ' => "&#1608;", 'ì' => "&#1609;", 'í' => "&#1610;", 'ð' => "&#1611;", 'ñ' => "&#1612;",
	'ò' => "&#1613;", 'ó' => "&#1614;", 'õ' => "&#1615;", 'ö' => "&#1616;", 'ø' => "&#1617;", 'ú' => "&#1618;");

	$ar2unimap2 = array( // One bit character initial form
	'Â' => "&#65153;", 'Ã' => "&#65155;", 'Ä' => "&#65157;", 'Å' => "&#65159;", 'Æ' => "&#65163;", 'Ç' => "&#65165;", 'È' => "&#65169;",
	'Ê' => "&#65175;", 'Ë' => "&#65179;", 'Ì' => "&#65183;", 'Í' => "&#65187;", 'Î' => "&#65191;", 'Ï' => "&#65193;", 'Ð' => "&#65195;",
	'Ñ' => "&#65197;", 'Ò' => "&#65199;", 'Ó' => "&#65203;", 'Ô' => "&#65207;", 'Õ' => "&#65211;", 'Ö' => "&#65215;", 'Ø' => "&#65219;",
	'Ù' => "&#65223;", 'Ú' => "&#65227;", 'Û' => "&#65231;", 'Ý' => "&#65235;", 'Þ' => "&#65239;", 'ß' => "&#65243;", 'á' => "&#65247;",
	'ã' => "&#65251;", 'ä' => "&#65255;", 'å' => "&#65259;", 'æ' => "&#65261;", 'í' => "&#65267;");

	$ar2unimap3 = array( // One bit character medial form
	'Æ' => "&#65164;", 'È' => "&#65170;", 'Ê' => "&#65176;", 'Ë' => "&#65180;", 'Ì' => "&#65184;", 'Í' => "&#65188;", 'Î' => "&#65192;",
	'Ó' => "&#65204;", 'Ô' => "&#65208;", 'Õ' => "&#65212;", 'Ö' => "&#65216;", 'Ø' => "&#65220;", 'Ù' => "&#65224;", 'Ú' => "&#65228;",
	'Û' => "&#65232;", 'Ý' => "&#65236;", 'Þ' => "&#65240;", 'ß' => "&#65244;", 'á' => "&#65248;", 'ã' => "&#65252;", 'ä' => "&#65256;",
	'å' => "&#65260;", 'í' => "&#65268;");

	$ar2unimap4 = array( // One bit character final form
	'Â' => "&#65154;", 'Ã' => "&#65156;", 'Ä' => "&#65158;", 'Å' => "&#65160;", 'Æ' => "&#65162;", 'Ç' => "&#65166;", 'È' => "&#65168;",
	'É' => "&#65172;", 'Ê' => "&#65174;", 'Ë' => "&#65178;", 'Ì' => "&#65182;", 'Í' => "&#65186;", 'Î' => "&#65190;", 'Ï' => "&#65194;", 
	'Ð' => "&#65196;", 'Ñ' => "&#65198;", 'Ò' => "&#65200;", 'Ó' => "&#65202;", 'Ô' => "&#65206;", 'Õ' => "&#65210;", 'Ö' => "&#65214;",
	'Ø' => "&#65218;", 'Ù' => "&#65222;", 'Ú' => "&#65226;", 'Û' => "&#65230;", 'Ý' => "&#65234;", 'Þ' => "&#65238;", 'ß' => "&#65242;",
	'á' => "&#65246;", 'ã' => "&#65250;", 'ä' => "&#65254;", 'å' => "&#65258;", 'æ' => "&#65262;", 'ì' => "&#65264;", 'í' => "&#65266;");

	$ar2unimap5 = array( // Two bit character isolated & initial form
	'áÂ' => "&#65269;", 
	'áÃ' => "&#65271;",
	'áÅ' => "&#65273;",
    'áÇ' => "&#65275;");

    $ar2unimap6 = array( // Two bit character final form 
    'áÂ' => "&#65270;", 
    'áÃ' => "&#65272;",
    'áÅ' => "&#65274;",
    'áÇ' => "&#65276;");
    #================================================// end of character maps//=============================================
	
	function ar2uni($sti){
	global $ar2unimap,$ar2unimap2,$ar2unimap3,$ar2unimap4,$ar2unimap5,$ar2unimap6;
	
	# START: (FIX) By Tarek Alwerfally on 16/12/2005
	if( ($sti[0]>='A' && $sti[0]<='Z') || ($sti[0]>='a' && $sti[0]<='z') )	return( $sti );
	# END: By Tarek Alwerfally on 16/12/2005
	
	# Patch by Elpidio 2004-02-06
	# If the text is encoded in unicode, reverse the order and return
	if(strstr($sti,'&#')&&strstr($sti,';')){
		$buf=explode(';',$sti);
		$buf=array_reverse($buf);
		# Remove the first element which is empty
		unset($buf[0]);
		$sti=implode(';',$buf);
	 	return trim($sti).';';
	 }else{
		
	$sti .= " ";
    $temp = $sti;
    $sti = strrev($temp);
    $sti .= " ";
	$sto='';
	$len=strlen($sti);
	
	for ($i=1; $i < $len-1; $i++){
	#=========================// for one bit character have 4 forms//================
	if($ar2unimap3[$sti{$i}]){
	
	if($sti{$i-1}==" " and $sti{$i+1}==" "){
	$sto .=$ar2unimap[$sti{$i}];
	
	}elseif($sti{$i-1}==" "){
	
	if($ar2unimap3[$sti{$i+1}]){
	$sto .=$ar2unimap4[$sti{$i}];
	}else{
	$sto .=$ar2unimap[$sti{$i}];
	}

	}elseif($sti{$i+1}==" "){
    $sto .=$ar2unimap2[$sti{$i}];
	}else{
	
	if($ar2unimap3[$sti{$i+1}]){
    $sto .=$ar2unimap3[$sti{$i}];
	}else{
    $sto .=$ar2unimap2[$sti{$i}];
	}
	}
	#=========================// for one bit character have 3 forms//================
	}elseif($ar2unimap2[$sti{$i}]){
	
	if($sti{$i-1}==" " and $sti{$i+1}==" "){
	$sto .=$ar2unimap[$sti{$i}];
	
	}elseif($sti{$i-1}==" "){
	
	if($ar2unimap3[$sti{$i+1}]){
	
	if($sti{$i}=="Â" and $sti{$i+1}=="á"){// to check lam alef  Two bit character
	if($ar2unimap3[$sti{$i+2}]){
	$sto .=$ar2unimap6["áÂ"];
	}else{
	$sto .=$ar2unimap5["áÂ"];
	}
	$i++;
	}elseif($sti{$i}=="Ã" and $sti{$i+1}=="á"){
	if($ar2unimap3[$sti{$i+2}]){
	$sto .=$ar2unimap6["áÃ"];
	}else{
	$sto .=$ar2unimap5["áÃ"];
	}
	$i++;
	}elseif($sti{$i}=="Å" and $sti{$i+1}=="á"){
	if($ar2unimap3[$sti{$i+2}]){
	$sto .=$ar2unimap6["áÅ"];
	}else{
	$sto .=$ar2unimap5["áÅ"];
	}
	$i++;
	}elseif($sti{$i}=="Ç" and $sti{$i+1}=="á"){
	if($ar2unimap3[$sti{$i+2}]){
	$sto .=$ar2unimap6["áÇ"];
	}else{
	$sto .=$ar2unimap5["áÇ"];
	}
	$i++;
	}else{
	$sto .=$ar2unimap4[$sti{$i}];
	}
	
	}else{
	$sto .=$ar2unimap[$sti{$i}];
	}

	}elseif($sti{$i+1}==" "){
    $sto .=$ar2unimap[$sti{$i}];
	}else{
    
	if($ar2unimap3[$sti{$i+1}]){
	
	if($sti{$i}=="Â" and $sti{$i+1}=="á"){// to check lam alef  Two bit character
	if($ar2unimap3[$sti{$i+2}]){
	$sto .=$ar2unimap6["áÂ"];
	}else{
	$sto .=$ar2unimap5["áÂ"];
	}
	$i++;
	}elseif($sti{$i}=="Ã" and $sti{$i+1}=="á"){
	if($ar2unimap3[$sti{$i+2}]){
	$sto .=$ar2unimap6["áÃ"];
	}else{
	$sto .=$ar2unimap5["áÃ"];
	}
	$i++;
	}elseif($sti{$i}=="Å" and $sti{$i+1}=="á"){
	if($ar2unimap3[$sti{$i+2}]){
	$sto .=$ar2unimap6["áÅ"];
	}else{
	$sto .=$ar2unimap5["áÅ"];
	}
	$i++;
	}elseif($sti{$i}=="Ç" and $sti{$i+1}=="á"){
	if($ar2unimap3[$sti{$i+2}]){
	$sto .=$ar2unimap6["áÇ"];
	}else{
	$sto .=$ar2unimap5["áÇ"];
	}
	$i++;
	}else{
	$sto .=$ar2unimap4[$sti{$i}];
	}
	
	}else{
    $sto .=$ar2unimap[$sti{$i}];
	}
	}
	#=========================// for one bit character have 2forms//================
	}elseif($ar2unimap4[$sti{$i}]){
	
	if($sti{$i-1}==" " and $sti{$i+1}==" "){
	$sto .=$ar2unimap[$sti{$i}];
	
	}elseif($sti{$i-1}==" "){

    if($ar2unimap3[$sti{$i+1}]){
	$sto .=$ar2unimap4[$sti{$i}];
	}else{
	$sto .=$ar2unimap[$sti{$i}];
	}

	}elseif($sti{$i+1}==" "){
    $sto .=$ar2unimap[$sti{$i}];
    }else{

    if($ar2unimap3[$sti{$i+1}]){
	$sto .=$ar2unimap4[$sti{$i}];
	}else{
	$sto .=$ar2unimap[$sti{$i}];
	}	
	}
	#=========================// for one bit character have 1 form//================
	}elseif($ar2unimap[$sti{$i}]){
	$sto .=$ar2unimap[$sti{$i}];
	}else{
	$sto .= $sti{$i};
	}
	}
	return $sto;
	}
	}
?>
