<?php

	    $sql="SELECT type,value FROM care_config_global WHERE type LIKE '$config_type'";
	 //   $sql='SELECT type,value FROM care_config_global';

	    $global_result=$db->Execute($sql);
		
		//echo $sql;
	
        if($global_result)
        {
  		    while($data_result= $global_result->FetchRow())
			    {
                      
                     $$data_result['type']=$data_result['value'];				   
			     }
	   		
			    $global_config_ok=1; 
		}
		 else
		 {
		 	$global_config_ok=0;
		}	

?>
