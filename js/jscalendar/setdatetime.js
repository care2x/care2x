function setDate(elindex, date_format, lang){

  var make_time = 0;
	var actual = '';
	
    /* Prepare the language dependent shortcuts */
	switch(lang.toLowerCase())
	{
	   case 'de': today = 'h';  		// h = heute
	              yesterday = 'g';  // g = gestern
				  break;
	   case 'it': today = 'o';       // o = oggi
	              yesterday = 'i';   // i = ieri
				  break;
	   case 'es':  today = 'h';       // h = hoy
	              yesterday = 'a';   // a = ayer
				  break; 
	   case 'fr':  today = 'a';       // h = aujourd'hui
	              yesterday = 'h';   // a = hier
				  break; 
		case 'sq':  today = 's';       // s = sot //#43
	              yesterday = 'd';   // d = dje //#43
	              tomorrow = 'n'	 // n = neser //#43
				  break;   
	   default: today = 't';         // t = today
	            yesterday = 'y';     // y = yesterday
	}
	/* Extract the value of the input element an convert to lower case to be sure */
	buf = elindex.value;
    buf = buf.toLowerCase();
	buf = buf.charAt(buf.length - 1);
	/* Check whether it is a possible shortcut */
	if (((buf<".")|| (buf > "9")) && (buf!="/") && (buf!='-')) {
	    /* Get the date today */
	    jetzt=new Date();
	    datum=jetzt.getDate();
	    monat=jetzt.getMonth();
	    jahr=jetzt.getFullYear();
	
		if(buf == today) { 
		    make_time = 1;
		} else if(buf == yesterday) { //* If yesterday, move one day backwards
			datum--;
			
			if(datum<1) {
				datum = 1;
				monat--;
				
				if(monat<0) {
					monat = 0; 
					jahr--;
				}
			}
			
			make_time =1;
		} else if(buf == tomorrow) { //* If tomorrow, move one day afterwards
			datum++;
			
			if(datum<1) {
				datum = 1;
				monat++;
				
				if(monat<0) {
					monat = 0; 
					jahr++;
				}
			}
			
			make_time =1;
		} else {
		       actual=''; //* Set to empty to erase the input
		 }
	    
		//* If a short cut compose date according to format 
		if(make_time == 1) {
		
		    //* Adjust month to correspond to 12 = December, 1 = January, etc. 
	        monat++; 
			
			//* Adjust the day and month to show 1= '01' etc. 
		    if (datum<10) datum="0" + datum;
	        if (monat<10) {monat="0" + monat;}
			
		
	        //* Now compose the date according to the format 
		    switch(date_format.toLowerCase()) {
		        case 'yyyy-mm-dd': actual = jahr + '-' + monat + '-' + datum;
				                    break;
						case 'dd.mm.yyyy':  actual = datum + '.' + monat + '.' + jahr;
				                    break;
						case 'mm/dd/yyyy':  actual = monat + '/' + datum + '/' + jahr;
				                   break;
						case 'dd/mm/yyyy':  actual = datum + '/' + monat + '/' + jahr;
				                    break;
	            //default: actual = jahr + '-' + monat + '-' + datum; //* Default format is the standard yyyy-mm-dd
				default: actual = ""; // Return empty by default 
			}
			
	   }		
	
	    elindex.value=actual; //* Now set the value of the element
	    return true;
	} else {
	   return false;
	}
}

/**
*  setTime will set the time according to the trigger input
*  the trigger input (a single letter) is language dependent
*  It is possible to enter one of two possible letters to generate the "now" time
*  param indexel = form object of the text type
*  param lang = the ISO language code
*  param sec_flag = optional flag for outputting the seconds 
*  return true = the time is created and the time is inserted in the form element
*        else false = no time created and the input is erased
*  The output time separator char is also language dependent 
*    e.g. german = '.' = 12.30
*    e.g. english or default = ':' = 12:30
*  
*/
function setTime(indexel, lang, sec_flag){

    var now = 'n';             //* n = now  , default
		var now_2 = 'n'           //* n = now  , default (in case of multiple letters)
		var separator = ':';       //* default separator
	
	//* Prepare the trigger input based on the current user language
    switch(lang)
	{
	   case 'de': now = 'j';         //*j = jetzt
	              now_2 = 'j';       //*j = jetzt
				  separator = '.';
				  break;
	   case 'it': now = 'a';         //* a = adesso
				  now_2 = 'a';       			 //* a = adesso
				  break;
	   case 'es': now = 'y';         //* y = Ya
	              now_2 = 'i';       //* i = inmediatamente
				  break;
	   case 'es': now = 'm';         //* y = maintenant
	              now_2 = 'm';       //* i = maintenant
				  break;
	   case 'sq': now = 't';         //* y = maintenant
	              now_2 = 't';       //* i = maintenant
				  break;				  
	}

	time=new Date();
	
	zeit=''; // Default is empty string to erase the input 
		
	//* Prepare the time 
	min=time.getMinutes();
	if (min<10) min="0" + min;
	stunde=time.getHours();
	if (stunde<10) stunde="0" + stunde;
	
	//* Extract the input value and convert to lower case to be sure
	buf = indexel.value;
	
	buf = buf.toLowerCase();
    
	//* If it is shortcut, compose the time
	if ((buf<".")||(buf>"9")||(buf=="/")){
		if((buf == now) || (buf == now_2)) {
			zeit=stunde + separator + min;
			
			//* if seconds flag is set, append seconds
			if(sec_flag == 1)
			{
	            sekunde=time.getSeconds();
	            if (sekunde<10) sekunde="0" + sekunde;
			    zeit = zeit + separator + sekunde;
		    }
		}

		indexel.value=zeit;  //* Set the time in the input element
		
		return true;
	}
	else
	{
	    return false;
	}
	
}