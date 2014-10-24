<?PHP
function shorten($string){
trim($string); //Leerzeichen eliminieren

$laenge=strlen($string);
//Array anlegen; Wert 0 = Modulbez., Wert 1 = blank_flag.
$neuerstring=array(2);
$neuerstring[0]="";
$i=0;
while ($i<$laenge){
       $text=$string{$i};
		if ($text==" " and $i !=0){ // $i um mehrere Worte zu melden
      	$neuerstring[1]="true";
	      break;
		   }
   else {
	      $neuerstring[1]="false";
			  $neuerstring[0]=$neuerstring[0].$text;
        $i++;
        }
}
return $neuerstring;
}
?>
