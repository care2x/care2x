<!--
Do not attempt to edit the javascript code block unless you are 100% sure you know what you are doing !!
-->
<script language="javascript">
<!--
var urlholder;

 function gotostat(station){
    winw=screen.width ;
    winw=(winw / 2) - 400;
    winh=screen.height ;
    winh=(winh / 2) - 300;
    winspecs="width=800,height=600,screenX=" + winw + ",screenY=" + winh + ",menubar=no,resizable=yes,scrollbars=yes";

     urlholder="nursing-station.php?route=validroute&user={$aufnahme_user}&station=" + station;
     stationwin=window.open(urlholder,station,winspecs);
 }

 function statbel(e,ward_nr,st){

  {{if $dhtml}}
     w=window.parent.screen.width;
     h=window.parent.screen.height;
  {{else}}
     w=800;
     h=600;
  {{/if}}

  winspecs="menubar=no,resizable=yes,scrollbars=yes,width=" + (w-15) + ", height=" + (h-60);

  if (e==1) urlholder="nursing-station-pass.php?rt=pflege&sid={{$SID_Parameter}}&edit=1&retpath=quick&ward_nr="+ward_nr+"&station="+st;
  else urlholder="nursing-station.php?rt=pflege&sid={{$SID_Parameter}}&edit=0&retpath=quick&ward_nr="+ward_nr+"&station="+st;
  //stationwin=window.open(urlholder,station,winspecs);
  window.location.href=urlholder;
 }
 -->
</script>

{{$tblCalendar}}
<div class="warnprompt">
	<img {{$gifVarrow}} alt="">{{if $is_today}} {{$LDTodays}} {{else}} {{$LDOld}} {{/if}} {{$LDOccupancy}}
	&nbsp;&nbsp;
	({{$formatDate2Local}})
</div>

<table  cellpadding="0" cellspacing=0 border="0"  width="100%">

	<tr class="wardlisttitlerow" align=center><td><b>&nbsp;{{$LDStation}}&nbsp;</b></td>
		<td><img  {{$gifImg_mangr}} alt="{{$LDNrUnocc}}"> <font face="verdana,arial" size="2" ><b>{{$LDFreeBed}}</b></td>
		<td><font  color="{{$PIE_CHART_USED_COLOR}}">&nbsp;<b>{{$LDOccupied}}</b></font></td>
		<td>&nbsp;<b>{{$LDOccupancy}} (%)</b></td>
		<td>&nbsp;<b>{{$LDBedNr}}</b></td>
		<td><b>&nbsp;{{$LDOptions}}&nbsp;</b></td>
	</tr>

    {{$WardRows}}

</table>

	<br>

{{if !$iWardCount}}
	<p class="warnprompt">
	<img {{$gifMascot1_r}} alt="">
    <b>{{$LDNoOcc}}</b>
	</p>
	
	<p>
	<a href="{{$LINKArchiv}}">{{$LDClk2Archive}} <img {{$gifBul_arrowgrnlrg}} alt=""></a>
	</p>
	<br>&nbsp;
{{/if}}

{{if $from == "arch"}}
	<a href="{{$LINKArchiv}}"><img {{$pbBack2}} alt="" width=110 height=24></a>
{{else}}
	<a href="{{$breakfile}}"><img {{$gifClose2}} alt="{{$LDCloseAlt}}" {{$dhtml}}></a>
{{/if}}
