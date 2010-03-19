<?php
	#====================================================================================================#
	# ar2uni v0.1 (Arabic-win1256 encoder to Unicode)                                                    # 
	#====================================================================================================#
	# Information:                                                                                       #
	#        This is PHP function for covert Arabic encoding string to                                   #
	#        unicode that can use to show Arabic charactor in  PDF Documents.                  #
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
	',' => 161, 'º' => 162, '¿' => 163, 'Á' => 164, 'Â' => 165, 'Ã' => 166, 'Ä' => 167,
	'Å' => 168, 'Æ' => 169, 'Ç' => 170, 'È' => 171, 'É' => 172, 'Ê' => 174, 'Ë' => 176,
	'Ì' => 177, 'Í' => 178, 'Î' => 179, 'Ï' => 180, 'Ð' => 182, 'Ñ' => 184, 'Ò' => 185,
	'Ó' => 186, 'Ô' => 187, 'Õ' => 188, 'Ö' => 189, 'Ø' => 190, 'Ù' => 191, 'Ú' => 192,
	'Û' => 193, 'Ü' => 194, 'Ý' => 195, 'Þ' => 196, 'ß' => 197, 'á' => 198, 'ã' => 199,
	'ä' => 200, 'å' => 201, 'æ' => 202, 'ì' => 203, 'í' => 204);

	$ar2unimap2 = array( // One bit character initial form
	'Â' => 165, 'Ã' => 166, 'Ä' => 167, 'Å' => 168, 'Æ' => 205, 'Ç' => 170, 'È' => 206,
	'Ê' => 207, 'Ë' => 208, 'Ì' => 209, 'Í' => 210, 'Î' => 211, 'Ï' => 180, 'Ð' => 182,
	'Ñ' => 184, 'Ò' => 185, 'Ó' => 212, 'Ô' => 213, 'Õ' => 214, 'Ö' => 215, 'Ø' => 190,
	'Ù' => 191, 'Ú' => 216, 'Û' => 217, 'Ý' => 218, 'Þ' => 219, 'ß' => 220, 'á' => 221,
	'ã' => 222, 'ä' => 223, 'å' => 224, 'æ' => 202, 'í' => 225);

	$ar2unimap3 = array( // One bit character medial form
	'Æ' => 205, 'È' => 206, 'Ê' => 207, 'Ë' => 208, 'Ì' => 209, 'Í' => 210, 'Î' => 211,
	'Ó' => 212, 'Ô' => 213, 'Õ' => 214, 'Ö' => 215, 'Ø' => 190, 'Ù' => 191, 'Ú' => 226,
	'Û' => 227, 'Ý' => 228, 'Þ' => 229, 'ß' => 220, 'á' => 221, 'ã' => 222, 'ä' => 223,
	'å' => 230, 'í' => 225);

	$ar2unimap4 = array( // One bit character final form
	'Â' => 231, 'Ã' => 232, 'Ä' => 167, 'Å' => 233, 'Æ' => 234, 'Ç' => 235, 'È' => 171,
	'É' => 236, 'Ê' => 174, 'Ë' => 176, 'Ì' => 237, 'Í' => 238, 'Î' => 239, 'Ï' => 180, 
	'Ð' => 182, 'Ñ' => 184, 'Ò' => 185, 'Ó' => 186, 'Ô' => 187, 'Õ' => 188, 'Ö' => 189,
	'Ø' => 190, 'Ù' => 191, 'Ú' => 240, 'Û' => 241, 'Ý' => 195, 'Þ' => 196, 'ß' => 197,
	'á' => 198, 'ã' => 199, 'ä' => 200, 'å' => 242, 'æ' => 202, 'ì' => 243, 'í' => 244);

	$ar2unimap5 = array( // Two bit character isolated & initial form
	'áÂ' => 245, 
	'áÃ' => 246,
	'áÅ' => 247,
    'áÇ' => 248);

    $ar2unimap6 = array( // Two bit character final form 
    'áÂ' => 249, 
    'áÃ' => 250,
    'áÅ' => 251,
    'áÇ' => 252);



    #================================================// end of character maps//=============================================
	
	function ar2uni($sti){
	global $ar2unimap,$ar2unimap2,$ar2unimap3,$ar2unimap4,$ar2unimap5,$ar2unimap6;

	# START: (FIX) By Tarek Alwerfally on 16/12/2005
	if( ($sti[0]>='A' && $sti[0]<='Z') || ($sti[0]>='a' && $sti[0]<='z') )	return( $sti );
	# END: By Tarek Alwerfally on 16/12/2005
	

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
	$sto .=chr($ar2unimap[$sti{$i}]);
	
	}elseif($sti{$i-1}==" "){
	
	if($ar2unimap3[$sti{$i+1}]){
	$sto .=chr($ar2unimap4[$sti{$i}]);
	}else{
	$sto .=chr($ar2unimap[$sti{$i}]);
	}

	}elseif($sti{$i+1}==" "){
    $sto .=chr($ar2unimap2[$sti{$i}]);
	}else{
	
	if($ar2unimap3[$sti{$i+1}]){
    $sto .=chr($ar2unimap3[$sti{$i}]);
	}else{
    $sto .=chr($ar2unimap2[$sti{$i}]);
	}
	}
	#=========================// for one bit character have 3 forms//================
	}elseif($ar2unimap2[$sti{$i}]){
	
	if($sti{$i-1}==" " and $sti{$i+1}==" "){
	$sto .=chr($ar2unimap[$sti{$i}]);
	
	}elseif($sti{$i-1}==" "){
	
	if($ar2unimap3[$sti{$i+1}]){
	
	if($sti{$i}=="Â" and $sti{$i+1}=="á"){// to check lam alef  Two bit character
	if($ar2unimap3[$sti{$i+2}]){
	$sto .=chr($ar2unimap6["áÂ"]);
	}else{
	$sto .=chr($ar2unimap5["áÂ"]);
	}
	$i++;
	}elseif($sti{$i}=="Ã" and $sti{$i+1}=="á"){
	if($ar2unimap3[$sti{$i+2}]){
	$sto .=chr($ar2unimap6["áÃ"]);
	}else{
	$sto .=chr($ar2unimap5["áÃ"]);
	}
	$i++;
	}elseif($sti{$i}=="Å" and $sti{$i+1}=="á"){
	if($ar2unimap3[$sti{$i+2}]){
	$sto .=chr($ar2unimap6["áÅ"]);
	}else{
	$sto .=chr($ar2unimap5["áÅ"]);
	}
	$i++;
	}elseif($sti{$i}=="Ç" and $sti{$i+1}=="á"){
	if($ar2unimap3[$sti{$i+2}]){
	$sto .=chr($ar2unimap6["áÇ"]);
	}else{
	$sto .=chr($ar2unimap5["áÇ"]);
	}
	$i++;
	}else{
	$sto .=chr($ar2unimap4[$sti{$i}]);
	}
	
	}else{
	$sto .=chr($ar2unimap[$sti{$i}]);
	}

	}elseif($sti{$i+1}==" "){
    $sto .=chr($ar2unimap[$sti{$i}]);
	}else{
    
	if($ar2unimap3[$sti{$i+1}]){
	
	if($sti{$i}=="Â" and $sti{$i+1}=="á"){// to check lam alef  Two bit character
	if($ar2unimap3[$sti{$i+2}]){
	$sto .=chr($ar2unimap6["áÂ"]);
	}else{
	$sto .=chr($ar2unimap5["áÂ"]);
	}
	$i++;
	}elseif($sti{$i}=="Ã" and $sti{$i+1}=="á"){
	if($ar2unimap3[$sti{$i+2}]){
	$sto .=chr($ar2unimap6["áÃ"]);
	}else{
	$sto .=chr($ar2unimap5["áÃ"]);
	}
	$i++;
	}elseif($sti{$i}=="Å" and $sti{$i+1}=="á"){
	if($ar2unimap3[$sti{$i+2}]){
	$sto .=chr($ar2unimap6["áÅ"]);
	}else{
	$sto .=chr($ar2unimap5["áÅ"]);
	}
	$i++;
	}elseif($sti{$i}=="Ç" and $sti{$i+1}=="á"){
	if($ar2unimap3[$sti{$i+2}]){
	$sto .=chr($ar2unimap6["áÇ"]);
	}else{
	$sto .=chr($ar2unimap5["áÇ"]);
	}
	$i++;
	}else{
	$sto .=chr($ar2unimap4[$sti{$i}]);
	}
	
	}else{
    $sto .=chr($ar2unimap[$sti{$i}]);
	}
	}
	#=========================// for one bit character have 2forms//================
	}elseif($ar2unimap4[$sti{$i}]){
	
	if($sti{$i-1}==" " and $sti{$i+1}==" "){
	$sto .=chr($ar2unimap[$sti{$i}]);
	
	}elseif($sti{$i-1}==" "){

    if($ar2unimap3[$sti{$i+1}]){
	$sto .=chr($ar2unimap4[$sti{$i}]);
	}else{
	$sto .=chr($ar2unimap[$sti{$i}]);
	}

	}elseif($sti{$i+1}==" "){
    $sto .=chr($ar2unimap[$sti{$i}]);
    }else{

    if($ar2unimap3[$sti{$i+1}]){
	$sto .=chr($ar2unimap4[$sti{$i}]);
	}else{
	$sto .=chr($ar2unimap[$sti{$i}]);
	}	
	}
	#=========================// for one bit character have 1 form//================
	}elseif($ar2unimap[$sti{$i}]){
	$sto .=chr($ar2unimap[$sti{$i}]);
	}else{
	$sto .= $sti{$i};
	}
	}
	return $sto;
	}
?>
