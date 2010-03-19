<!---
/* ==================================================== */
/* check date                                           */
/* 13.07.2002 Thomas Wiedmann   create                  */
/* 16.07.2002 Thomas Wiedmann   add yyyy-MM-dd          */
/* 13.08.2002 Thomas Wiedmann   parseInt(x,10) Decimal  */
/* 15.08.2002 Thomas Wiedmann   leading zero            */
/*                                                      */
/* sDate =  DateString to check                         */
/* sFormat = "dd.MM.yyyy" or "MM/dd/yyyy" or yyyy-MM-dd */
/* ==================================================== */

/**
* EL140802 = Modifications by Elpidio Latorilla 14.08.02
*/

/**
* AMR040903 = Modifications by Agus M. Ramdan 04.09.03  (jkt/bdg time)
*    + Creating simple and read able for modification
*    + add sFormat indoensia (dd/MM/yyyy)
*    + modification splitting day Month Year with eval (" arrDate = splitdateformat"+sLang+"(sDate);");
*    + fix error in IE 5 for case 1,3,5,7,8,10,12: and case 4,6,9,11:
*    + Modification leap year checked if month February (2)
*
* AMR050903 = Modifications by Agus M. Ramdan 05.09.03  (jkt/bdg time)
*    + Modular program  combine checkdate.js and setdatetime.js
*    + add shortcuts Indonesia lang
*      (h = hariini "today" & k = kemarin y = "yesterday")
*      (s = sekaran "now" & s = segera "immediately")
*
* AMR060903 = Modifications by Agus M. Ramdan 06.09.03  (jkt/bdg time)
*    + using regex for sspliting dd mm yyyy for paticulare/general format acepted
*    + try avoid switch case
*    + format not depend to lang
*
* AMR070903
*    + change you can chage regex to capture formate date to
var formatregex=/^[ ]*(dd|MM|yyyy)(\/|-|.)(dd|MM)(\/|-|.)(dd|yyyy)[ ]*$/;
* add variable errValueFormat
*
* Modification for setdate error yesterday
* if now 1st date or 1st date in January
* add functions
*
* function checkY2K(nYear)
* function checkLeapYear(nYear)
* function checkMonth(nMonth)
* function checkDay(nYear,nMonth,nDay)
* function formatdate2string(nYear,nMonth,nDay,formatlang)
* function getShortcutsDate(lang)
* function getShortcutsTime(lang)
* function endOfMonth(nMonth,nYear)
* function num2digitstr(n)
*
*/
var bDebug = true;
var errValueFormat = "wrong value";
var parserregex = Array();
parserregex["HH"]="\\d{1,2}";   //hour
parserregex["mm"]="\\d{1,2}";   //minute
parserregex["ss"]="\\d{1,2}";   //second

parserregex["dd"]="\\d{1,2}";
parserregex["MM"]="\\d{1,2}";   //  mounth
parserregex["yyyy"]="\\d{1,}";  // acepting 1 digit or more
parserregex["\/"]="\\\/";
parserregex["-"]="-";
parserregex["."]=".";
var formatregex=/^[ ]*(dd|MM|yyyy)(\/|-|.)(dd|MM)(\/|-|.)(dd|yyyy)[ ]*$/;
function IsValidDate(objDate,strFormat)
{
   strDate=objDate.value;  /* EL140802 */
   //var sLang = ""; /* Language type */ //not needed any more
   var nDay = 0, nMonth = 0, nYear = 0;
   var bOk = true;
   var sErrorMsg= errDate + ":\n";  /* EL140802 */
   /* get standar formate regeg*/
   if(strDate.length == 0) return false;/*  AMR040903  */  /* EL140802 */

   // standard
   /* AMR060903 */
//   var formatregex=/^[ ]*(dd|mm|yyyy)(\/|-|.)(dd|mm)(\/|-|.)(dd|yyyy)[ ]*$/;
   var formatmatch=strFormat.match(formatregex);
   if (formatmatch){
       //build regex for strdate
        eval("var dateregex=\/^[ ]*[0]?"+"("+parserregex[formatmatch[1]]+")"
        +"["+parserregex[formatmatch[2]]+"]"+"[0]?("+parserregex[formatmatch[3]]+")"
        +"["+parserregex[formatmatch[4]]+"]"+"[0]?("+parserregex[formatmatch[5]]+")"
        +"[ ]*$\/;");
        
        // compare strdate and dateregek
        var datematch=strDate.match(dateregex);
        if (datematch){
           // put date 2 array because we do not know positon dd mm yyyy
           // & Avoid using switch case for this operation
           var arrdate = Array();
           arrdate[formatmatch[1]]=datematch[1];
           arrdate[formatmatch[3]]=datematch[2];
           arrdate[formatmatch[5]]=datematch[3];
           /*  // try direct convert to date object
           var tmpdate=new Date(arrdate["yyyy"],parseInt(arrdate["mm"],10)-1,arrdate["dd"]);
           if (tmpdate.getDate()==parseInt(match[2],10) && tmpdate.getFullYear()==parseInt(match[3],10) && (tmpdate.getMonth()+1)==parseInt(match[1],10)){
                return true;
           }else{
               return false;
           } */
           nYear  = checkY2K(parseInt(arrdate["yyyy"],10));  /*  AMR040903  */
           nMonth = parseInt(arrdate["MM"],10); /*  AMR040903  */
           nDay   = parseInt(arrdate["dd"],10); /*  AMR040903  */
        }
        else {
           if (bDebug) sErrorMsg+= errValueFormat + "\n"; /* EL140802 */
           bOk = false;
        }
   }else{
       if (bDebug) sErrorMsg+= errDateFormat + "\n"; /* EL140802 */
       bOk = false;
   }

   /* check nYear must between 1800 and 9999 */
   /* EL140802 */
   if ((nYear < 1800) || (nYear > 9999))
   {
        if (bDebug)   sErrorMsg+= errYear + "\n"; /* EL140802 */
        bOk = false;
   }
   /* check nMonth */
   /* EL140802 */
   if (!checkMonth(nMonth))  /*  AMR040903  */
   {
        if (bDebug) sErrorMsg+= errMonth + "\n"; /* EL140802 */
        bOk = false;
   }
   /* check nDay */
   if (!checkDay(nYear,nMonth,nDay)) /*  AMR040903  */
   {
       if (bDebug)  sErrorMsg+= errDay + "\n"; /* EL140802 */
       bOk = false;

   }
   /* -- Result of check */
   if (bOk == true)
   {
     /* formatting back to string to get some leading zero */
     /*objDate.value = num2digitstr(arrdate[formatmatch[1]])+formatmatch[2]
                   + num2digitstr(arrdate[formatmatch[3]])+formatmatch[4]
                   + num2digitstr(arrdate[formatmatch[5]]);
                   */
     objDate.value = formatdate2string(nYear,nMonth,nDay,strFormat);
   }
   else
   {
     objDate.select();  /* EL140802 */
     objDate.focus();   /* EL140802 */
     alert(sErrorMsg);  /* EL140802 */
     /**
     * Die focus() & select() funktionen tun offensichtlich nicht richtig bei Mozilla.
     * Wir brauchen hier cross-programming.
     */
   }
   return bOk;
}

/* check checkY2K */
/*  AMR040903  */
function checkY2K(nYear) {
   if (nYear < 70){
        return (nYear + 2000);
   }else if (nYear < 100){  /*  AMR040903  */
        return (nYear + 1900);
   }else return nYear;
}

/* check LeapYear */
/*  AMR040903  */
function checkLeapYear(nYear)  {
   return ((nYear % 400 == 0) || ((nYear % 4 == 0) && (nYear % 100 != 0))) ;
}

/* check Month */
/*  AMR040903  */
function checkMonth(nMonth)  {
   return (nMonth >= 1) && (nMonth <= 12) ;
}

/* check nDay */
/*  AMR040903  */
function checkDay(nYear,nMonth,nDay){
   return (checkMonth(nMonth)&&(nDay >= 1 )&& (endOfMonth(nMonth,nYear) >= nDay)) ;
}

/* AMR060903 */
function formatdate2string (nYear,nMonth,nDay,strFormat){
/* formatting back to string to get some leading zero */


 //  var formatregex=/^[ ]*(dd|mm|yyyy)(\/|-|.)(dd|mm)(\/|-|.)(dd|yyyy)[ ]*$/;
   var formatmatch=strFormat.match(formatregex);
   if (!formatmatch){
      formatmatch="yyyy-MM-dd".match(formatregex);
   }
   var dd = num2digitstr(nDay);
   var MM = num2digitstr(nMonth);
   var yyyy = nYear.toString(10);

   eval(" str= "+formatmatch[1]+"+\""+formatmatch[2]+ "\"+"+formatmatch[3]+"+\""+formatmatch[4]+"\"+"+formatmatch[5]+";");
   return  str ;
}

/**
*  Functions to set date and time according to a given format
*  The date and time can be set semi-automatically by pressing the
*  appropriate key. This key is dependent on the current language
*  used by the user
*
*  Elpidio Latorilla 2002-10-18
*/

/*  AMR040903  */
function getShortcutsDate(lang){
    //today == arr[0], yesterday == arry[1];

	switch(lang.toLowerCase())
	{
	   case 'de':  return  'hg';   // h = heute  g = gestern
	   case 'it':  return  'oi';   // o = oggi  i = ieri
	   case 'es':  return  'ha';   // h = hoy  a = ayer
	   case 'fr':  return  'ah';   // h = aujourd'hui   // a = hier
       case 'id' :  return 'hk';   // h = hariini  k = kemarin
       case 'en':
	   default: return 'ty';   // t = today y = yesterday
	}
}

/**
*  setDate will set the date
*  param elindex = a form object of the type input text
*  param date = the date format any one of ff:  yyyy-mm-dd, dd.mm.yyyy, mm/dd/yyyy
*  param lang = the ISO code of the language
*  return true if date is created, other wise false and the input entry will be erased
*/

function setDate(elindex, date_format, lang){

    var make_time = 0;
	var actual = '';

    /* Prepare the language dependent shortcuts */
    var arrs ;
    arrs = getShortcutsDate(lang); /* AMR050903 */
    today  = arrs.charAt(0);
    yesterday = arrs.charAt(1);

	/* Extract the value of the input element an convert to lower case to be sure */
	buf = elindex.value;
    buf = buf.toLowerCase();
	buf = buf.charAt(buf.length - 1);
	/* Check whether it is a possible shortcut */
	if (((buf<".")|| (buf > "9")) && (buf!="/") && (buf!='-'))
    {
	    /* Get the date today */
	    jetzt=new Date();
	    datum=jetzt.getDate();
	    monat=jetzt.getMonth()+1;
	    jahr=jetzt.getFullYear();

		if(buf == today)  make_time = 1;
	    else if(buf == yesterday)  //* If yesterday, move one day backwards
		{
			datum--;
			if(datum<1)
			{

				monat--;
				if(monat<1)
				{
					monat = 12;
					jahr--;
				}
                datum = endOfMonth(monat,jahr); /* AMR050903 */
			}
			make_time =1;
		}
		//* If a short cut compose date according to format
		actual = (make_time == 1)? formatdate2string (jahr,monat,datum,date_format):'';   /* AMR050903 */
  
	    elindex.value=actual; //* Now set the value of the element
	    return true;
	}
	else
	{
	   return false;
	}
}

/*  AMR040903  */
function getShortcutsTime(lang){
    //today == arr[0], yesterday == arry[1];

	switch(lang.toLowerCase())
	{
	   case 'de':  return  'jj.';   // j = jetzt  j = jetzt
	   case 'it':  return  'aa:';   // a = adesso  a = adesso
	   case 'es':  return  'yi:';   // y = Ya i = inmediatamente
	   case 'fr':  return  'mm:';   // y = maintenant  i = maintenant
       case 'id' :  return 'ss:';   // s = sekarang   s = segera
       case 'en':
	   default: return 'nn:';   //  n = now   n = now
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

	//* Prepare the trigger input based on the current user language
    arrs = getShortcutsTime(lang);
    now   = arrs.charAt(0);
    now_2 = arrs.charAt(1);
    separator = arrs.charAt(2);
	time=new Date();
	zeit=''; // Default is empty string to erase the input
 	//* Prepare the time
	min=num2digitstr(time.getMinutes());
	stunde=num2digitstr(time.getHours());

	//* Extract the input value and convert to lower case to be sure
	buf = indexel.value.toLowerCase();
    buf = buf.charAt(buf.length - 1);
	//* If it is shortcut, compose the time
	if ((buf<".")||(buf>"9")||(buf=="/")){
		if((buf== now) || (buf == now_2)) {
			zeit=stunde + separator + min;
			//* if seconds flag is set, append seconds
			if(sec_flag == 1)   zeit = zeit + separator + num2digitstr(time.getSeconds());
		}

		indexel.value=zeit;  //* Set the time in the input element

		return true;
	}
	else
	{
	    return false;
	}

}
 /*  AMR040903  */
 var arrendOfMonth = Array(31,28,31,30,31,30,31,31,30,31,30,31);

 function endOfMonth(nMonth,nYear){
   if ( !checkMonth(nMonth))  return false; // error month
   return (( nMonth == 2 && checkLeapYear(nYear))? 29:arrendOfMonth[nMonth-1]);
}

/*  AMR040903  */
function num2digitstr(n){return (n < 10 ? '0'+ n.toString(10): n.toString(10));}

-->
