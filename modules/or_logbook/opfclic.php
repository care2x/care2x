<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'include/core/inc_environment_global.php');
/**
* CARE2X Integrated Hospital Information System Deployment 2.1 - 2004-10-02
* GNU General Public License
* Copyright 2002,2003,2004,2005 Elpidio Latorilla
* elpidio@care2x.org, 
*
* See the file "copy_notice.txt" for the licence notice
*/
//parse_str($ck_comdat,$varia);
parse_str($_SESSION['sess_comdat'],$varia);
$fileforward="oplogtimebar.php?sid=$sid&lang=$lang&enc_nr=".$varia['enc_nr']."&op_nr=".$varia['op_nr']."&dept_nr=".$varia['dept_nr']."&saal=".$varia['saal']."&pyear=".$varia['pyear']."&pmonth=".$varia['pmonth']."&pday=".$varia['pday']."&scrolltab=$time";
//echo $g;
//echo $fileforward;
$g=$group;
$v=$time;
switch($g)
{
	case "entry_out": $title="Einschleusse- Ausschleusezeiten";
							$element="entry_out";
							$startid="Ein";
							$endid="Aus";
							//$maxelement=10;
							break;
	case "cut_close": $title="Schnitt- Nahtzeiten";
							$element="cut_close";
							$startid="Schnitt";
							$endid="Naht";
							//$maxelement=10;
							break;

	case "wait_time": $title="Wartezeiten";
							$element="wait_time";
							//$maxelement=10;
							break;

	case "bandage_time": $title="Gipszeiten";
							$element="bandage_time";
							$startid="Anfang";
							$endid="Ende";
							//$maxelement=10;
							break;
	case "repos_time": $title="Repositionszeiten";
							$element="repos_time";
							$startid="Anfang";
							$endid="Ende";
							//$maxelement=10;
							break;
	default:{header("Location: invalid-access-warning.php?mode=close"); exit;}; 
}
//echo $g;

require($root_path.'include/care_api_classes/class_core.php');
$core = & new Core;

$dbtable='care_encounter_op';

			// check if entry is already existing
				$sql="SELECT $element FROM $dbtable 
						WHERE encounter_nr='".$varia['enc_nr']."' 
						AND dept_nr='".$varia['dept_nr']."' 
						AND op_room='".$varia['saal']."' 
						AND op_nr='".$varia['op_nr']."'";
				if($ergebnis=$db->Execute($sql))
       			{
					//echo $sql." checked <br>";
					
					$rows=$ergebnis->RecordCount();
					if($rows==1)
						{
							$content=$ergebnis->FetchRow();
    						if((trim($content[$element])!="")&&($content[$element]!=NULL))
							{							
								//echo "im here";
								//echo $content[$element];
								$ebuf=explode("~",trim($content[$element]));

								sort($ebuf,SORT_REGULAR);
								$laste=(float) 0;
								$append=0;
								//echo $v."<br>";
								$vf=(float) $v;
								$esize=sizeof($ebuf);
								for($i=0;$i<$esize;$i++)
								{
									parse_str(trim($ebuf[$i]),$elem);
									//if(!$elem[s]) continue;
									$sf=(float) $elem[s];
									$ef=(float) $elem[e];
									if($g=="wait_time")
									{
										if($sf==$vf)
										{ if($elem[e]==""){ array_splice($ebuf,$i,1);$append=0;break;}
										}
										if($ef==$vf)
										{
											if($elem[s]!="") {$ebuf[$i]="s=".$elem[s]."&e=&r=".$elem[r]; $append=0;break;}
										}
										if($elem[s]!="")
										{
									 		//if($vf>$sf)
											{ if (($elem[e]=="")||(($vf<$ef)&&($vf>$sf))) {$ebuf[$i]="s=".$elem[s]."&e=".$v."&r=".$elem[r];$append=0; break;}
											}
											//else{ $append=0; break;}
										}
										else{$ebuf[$i]="s=".$v."&e=&r=".$elem[r]; $append=0;break;}
										//if($ef>$laste)  $laste=$ef; $append=1;
									}
									else
									{
										//if(($v>$elem[s])&&($v<$elem[e])) break;
										if($sf==$vf)
										{ if($elem[e]==""){ array_splice($ebuf,$i,1);$append=0; if(!$i) $resetmainput=1;break;}
										}
										if($ef==$vf)
										{
											if($elem[s]!="") {$ebuf[$i]="s=".$elem[s]."&e="; $append=0; if(!$i) $resetmainput=1;break;}
										}
										if($elem[s]!="")
										{
									// 			if($vf>$sf)
											//echo "its here in the elem";
											{ if (($elem[e]=="")||(($vf<$ef)&&($vf>$sf))) {$ebuf[$i]="s=".$elem[s]."&e=".$v;$append=0;  if(!$i) $resetmainput=1;break;}
											}
											//else{ $append=0; break;} 
											
										}
										else {$ebuf[$i]="s=".$v."&e="; $append=0; if(!$i) $resetmainput=1;break;}
									}
									if($ef>$laste) $laste=$ef; $append=1;
									//$laste=$ef; $append=1;
								}	//end of for $i
							
								if($append&&($vf>$laste)) 
								{
									if($g=="wait_time") $ebuf[]="s=$v&e=&r=-";
										else $ebuf[]="s=$v&e=";
								}
								sort($ebuf,SORT_REGULAR);
								$dbuf=implode("~",$ebuf);
								if($i==0) $resetmainput=1;
								//echo $dbuf;
				 			}// end of if (sizeof (ebuf)
							else
							{
								if($g=="wait_time") $dbuf="s=$v&=&r=";
								 else $dbuf="s=$v&=";
								if(($g=="entry_out")||($g=="cut_close")) $resetmainput=1;
							}	
					 		// $dbuf=htmlspecialchars($dbuf);
							//echo $dbuf;
							$sql="UPDATE $dbtable SET $element='$dbuf'
										WHERE encounter_nr='".$varia['enc_nr']."'
										AND dept_nr='".$varia['dept_nr']."' 
										AND op_room='".$varia['saal']."' 
										AND op_nr='".$varia['op_nr']."'";
											
							if($ergebnis=$core->Transact($sql))
       							{
									//echo $sql." new update <br> resetmain= $resetmainput";
									
									//if((($g=="entry_out")||($g=="cut_close"))&&$resetmainput) header("Location: $fileforward&resetmainput=1");
 											//else header("Location: $fileforward");									
									header("Location: $fileforward&resetmainput=$resetmainput");
									exit;
								}
								else
								{
									echo $sql;
									echo "<p>Something wrong happened here. The patient seems to be non-existent in the OR journal. Plese close this
									module and reopen it again. If this problem persists please notify your IT department or <a \"mailto:info@care2x.net\". Thank you.";
									exit;
								}//end of else
						
		 				}// end of if rows
		 				else
		 				{
							echo $sql;
									echo "<p>Something wrong happened here. The patient seems to be non-existent in the OR journal. Plese close this
									module and reopen it again. If this problem persists please notify your IT department or <a \"mailto:info@care2x.net\". Thank you.";
									exit;
							}
				
	 			}else echo "<p>".$sql."<p>$LDDbNoRead"; 

header("Location: $fileforward");
?>
