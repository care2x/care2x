function IsValidDate(objDate,sFormat)
{
   sDate=objDate.value;  /* EL140802 */

   if((sDate == "" )||(sDate==" ")) return; /* EL140802 */

   var sLang = ""; /* Language type */
   var nSize = 0;  /* size sDate */
   var sTempDate = ""; /* WorkString */

   var nDay = 0, nMonth = 0, nYear = 0;
   var sDay = "", sMonth = "", sYear = "";
   var bIsLeapYear = false;
   var bOk = true;
   var bDebug = true;
   var sErrorMsg= errDate + ":\n";  /* EL140802 */
   var sLangTemp=""; /* indonesian time format dd/MM/yyyy. Added 2003-11-20.  */

   /* check format */
   if ( sFormat == "dd.MM.yyyy" )  /* german */
   { sLang = "DE"; }
   else if ( sFormat == "yyyy-MM-dd" ) /* german ISO8601 */
   { sLang = "DE8601"; }
   else if ( sFormat == "MM/dd/yyyy" ) /* english */
   { sLang = "EN"; }
   else if (sFormat == "dd/MM/yyyy") /* Indonesian */
   { sLang = "ID";}
   else
   {// if (bDebug)
     { //alert("wrong sFormat");
	   sErrorMsg+= errDateFormat + "\n"; /* EL140802 */
     }
     bOk = false;
   }

   /* ============== */
   /* I. check sDate */
   /* ============== */
   nSize = sDate.length;

   /* ================================================ */
   /* I.1 think about some leading zero    15.08.2002  */
   /* ================================================ */
   /* DE dmmyy, dmmyyyy, d.mm.yyyy       */
   /* DE8601 ymmdd, yyymmdd, yyy-mm-dd   */
   /* EN mddyy, mddyyyy, m/dd/yyyy       */
   if(nSize<5) 
   {
   	bOk = false;
   }else{

	if ((nSize == 5) || (nSize == 7) || (nSize == 9))
	{
		sDate = "0" + sDate;
		nSize = sDate.length;
	}
	 /* check DE ddmmyyyy or dd.mm.yy */
     
	if ((nSize == 8) && ( sLang == "DE"))
	{
		if (sDate.substr(2,1) == ".")
		{ nSize = nSize +1; }
	}

	/* check DE8601 yyyymmdd or yy-mm-dd */
	if ((nSize == 8) && ( sLang == "DE8601"))
	{
		if (sDate.substr(2,1) == "-")
		{ nSize = nSize +1; }
	}

   /* check EN mmddyyyy or mm/dd/yy */
   if ((nSize == 8) && (( sLang == "EN")||( sLang == "ID")))
   {
     if (sDate.substr(2,1) == "/")
       { nSize = nSize +1; }
   }

   /*
   If the sLang == ID, we save it temporarily and simulate to be sLang ==  DE
   Addition to accomodate the indonesian time format. Added 2003-11-20.
   */
   if (sLang=="ID") {
     sLangTemp="ID";
	    sLang="DE";
   }else{
     sLangTemp="";
   }
   
   /* =============== */
   /* II. check sDate */
   /* =============== */
   switch (nSize)
   {
     case 0: break;

     case 6 : /* ddMMyy, yyMMdd, MMddyy */
     { if (isNaN(sDate) == true)
       { //alert("no numeric sDate");
		 sErrorMsg+= errNotNumeric + "\n"; /* EL140802 */
       }
       else
       {
         switch (sLang)
         {
           case "DE" :
           {
             nDay = parseInt(sDate.substr(0,2),10);
             nMonth = parseInt(sDate.substr(2,2),10);
             nYear = parseInt(sDate.substr(4,2),10);

             /* check Y2K */
             if (nYear < 70)
             {
               nYear = nYear + 2000;
             }
             else
             {
               nYear = nYear + 1900;
             }

             /* alert(nDay + " " + nMonth + " " + nYear); */
             break;
           }
           case "DE8601" :
           {
             nYear = parseInt(sDate.substr(0,2),10);
             nMonth = parseInt(sDate.substr(2,2),10);
             nDay = parseInt(sDate.substr(4,2),10);


             /* check Y2K */
             if (nYear < 70)
             {
               nYear = nYear + 2000;
             }
             else
             {
               nYear = nYear + 1900;
             }

             /* alert(nDay + " " + nMonth + " " + nYear); */
             break;
           }

           case "EN" :
           {
             nMonth = parseInt(sDate.substr(0,2),10);
             nDay = parseInt(sDate.substr(2,2),10);
             nYear = parseInt(sDate.substr(4,2),10);

             /* check Y2K */
             if (nYear < 70)
             {
               nYear = nYear + 2000;
             }
             else
             {
               nYear = nYear + 1900;
             }
             break;
           }
           default:
           break;
         } /* end switch(sLang) */
       }
      break;
     }

     case 8 : /* ddMMyyyy */
     { if (isNaN(sDate) == true)
       {
         if (bDebug)
                 {
                    //alert("not numeric sDate or dd.MM.yy");
		            sErrorMsg+= errNotNumeric + "\n"; /* EL140802 */
                 }
         bOk = false;
       }
       else
       {
         switch (sLang)
         {
           case "DE" :
           {
             nDay = parseInt(sDate.substr(0,2),10);
             nMonth = parseInt(sDate.substr(2,2),10);
             nYear = parseInt(sDate.substr(4,4),10);
             break;
           }
           case "DE8601" :
           {
             nYear = parseInt(sDate.substr(0,4),10);
             nMonth = parseInt(sDate.substr(4,2),10);
             nDay = parseInt(sDate.substr(6,2),10);
             break;
           }
           case "EN" :
           {
             nMonth = parseInt(sDate.substr(0,2),10);
             nDay = parseInt(sDate.substr(2,2),10);
             nYear = parseInt(sDate.substr(4,4),10);
             break;
           }
           default:
           break;
         } /* end switch(sLang) */
       }
       break;
     }
     case 9 : /* dd.MM.yy  8+1  */
     {
         switch (sLang)
         {
           case "DE" :
           {
             nDay = parseInt(sDate.substr(0,2),10);
             nMonth = parseInt(sDate.substr(3,2),10);
             nYear = parseInt(sDate.substr(6,2),10);

             /* check Y2K */
             if (nYear < 70)
             {
               nYear = nYear + 2000;
             }
             else
             {
               nYear = nYear + 1900;
             }


             break;
           }
           case "DE8601" :
           {
             nYear = parseInt(sDate.substr(0,2),10);
             nMonth = parseInt(sDate.substr(3,2),10);
             nDay = parseInt(sDate.substr(6,2),10);

             /* check Y2K */
             if (nYear < 70)
             {
               nYear = nYear + 2000;
             }
             else
             {
               nYear = nYear + 1900;
             }
             break;
           }

           case "EN" :
           {
             nMonth = parseInt(sDate.substr(0,2),10);
             nDay = parseInt(sDate.substr(3,2),10);
             nYear = parseInt(sDate.substr(6,2),10);

             /* check Y2K */
             if (nYear < 70)
             {
               nYear = nYear + 2000;
             }
             else
             {
               nYear = nYear + 1900;
             }
             break;
           }
           default:
           break;
         } /* end switch(sLang) */
       break;
     }
     case 10 : /* dd.MM.yyyy   */
     {
         switch (sLang)
         {
           case "DE" :
           {
             nDay = parseInt(sDate.substr(0,2),10);
             nMonth = parseInt(sDate.substr(3,2),10);
             nYear = parseInt(sDate.substr(6,4),10);
             break;
           }
           case "DE8601" :    /* yyyy-MM-dd */
           {
             nYear = parseInt(sDate.substr(0,4),10);
             nMonth = parseInt(sDate.substr(5,2),10);
             nDay = parseInt(sDate.substr(8,2),10);
             break;
           }
           case "EN" :
           {
             nMonth = parseInt(sDate.substr(0,2),10);
             nDay = parseInt(sDate.substr(3,2),10);
             nYear = parseInt(sDate.substr(6,4),10);
             break;
           }
           default:
           break;
         } /* end switch(sLang) */
       break;
     }
     default :
     { if (bDebug)
           { //alert("wrong sDate size");
		     sErrorMsg+= errDateLen + "\n"; /* EL140802 */
           }
       bOk = false;
     }
     break;
   }  /* switch (nSize) */


   /* check LeapYear */
   if (nYear % 400 == 0)
   { bLeapYear = true; }
   else if (nYear % 100 == 0)
   { bLeapYear = false; }
   else if (nYear % 4 == 0)
   { bLeapYear = true; }
   else
   { bLeapYear = false;
   }

   /* check nYear must between 1800 and 9999 */
   /* EL140802 */
   if ((nYear < 1800) || (nYear > 9999))
   { if (bDebug)
     { //alert ("wrong year");
       sErrorMsg+= errYear + "\n"; /* EL140802 */
     }
     bOk = false;
   }

   /* check nMonth */
   /* EL140802 */
   if ((nMonth < 1) || (nMonth > 12))
   { if (bDebug)
     { //alert ("wrong month");
       sErrorMsg+= errMonth + "\n"; /* EL140802 */
     }
     bOk = false;
   }
   /* check nDay */
   if ((nDay >= 1) && (nDay <= 31))
   {
     switch(nMonth)
     {
       case 1,3,5,7,8,10,12:
        { break; }
       case 2:
        { if ((bLeapYear == true) && (nDay <= 29))
          {}
          else
          {
            if (nDay <= 28)
            {}
            else
            { if (bDebug)
              { //alert("wrong day");
                sErrorMsg+= errDay + "\n"; /* EL140802 */
              }
              bOk = false;
            }
          }
         break;
        }
       case 4,6,9,11:
        { if (nDay <= 30)
          {}
          else
          { if (bDebug)
            { //alert("wrong day");
              sErrorMsg+= errDay + "\n"; /* EL140802 */
            }
           bOk = false;
          }
          break;
        }
       default:
       { }
     }
   }
   else
   { if (bDebug)
     { //alert ("wrong day");
       sErrorMsg+= errDay + "\n"; /* EL140802 */
     }
     bOk = false;
   }
}
   /* -- Result of check */
   if (bOk)
   {
     /* formatting back to string to get some leading zero */
     sDay = "";
     if (nDay < 10)
     { sDay = '0' + nDay.toString(10);
     }
     else
     { sDay = nDay.toString(10);
     }

     sMonth = "";
     if (nMonth < 10)
     { sMonth = '0' + nMonth.toString(10);
     }
     else
     { sMonth = nMonth.toString(10);
     }

     sYear = nYear.toString(10);
	 
     /* Check if the real sLang format was ID 
        Addition to accomodate the indonesian time format. Added 2003-11-20.
       */
     if(sLangTemp == "ID") sLang="ID";
   
        /* Date result */
      if (sLang == "DE") { 
         objDate.value=sDay + "." + sMonth + "." + sYear ;
      } else if (sLang == "DE8601") {
         objDate.value=sYear + "-" + sMonth + "-" + sDay ;
      } else if (sLang == "EN") { 
         objDate.value=sMonth + "/" + sDay + "/" + sYear ;
      } else if (sLang == "ID") { 
         objDate.value=sDay + "/" + sMonth + "/" + sYear ;
      } else {
         objDate.value = "";
      }
      return true;
   } else {
     /* found some error */

      alert(sErrorMsg);  /* EL140802 */
      objDate.value = '';
      
      objDate.select();
      objDate.Focus();

      return false;

     /**
     * Die focus() & select() funktionen tun offensichtlich nicht richtig bei Mozilla.
     * Wir brauchen hier cross-programming.
     */
   }
}