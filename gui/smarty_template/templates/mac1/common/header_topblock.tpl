 {{* Toolbar - Topblock  *}}
<table cellspacing="0"  class="titlebar" border=0>
 <tr valign=top  class="titlebar" >
   <td bgcolor="{{$top_bgcolor}}" width="20%">{{if $pbBack}}<a
   href="{{$pbBack}}"><img {{$gifBack2}} alt="" {{$dhtml}} ></a>{{/if}}{{if $pbHelp}}<a
   href="{{$pbHelp}}"><img {{$gifHilfeR}} alt="" {{$dhtml}}></a>{{/if}}{{if $pbAux2}}<a
   href="{{$pbAux2}}"><img {{$gifAux2}} alt="" {{$dhtml}} ></a>{{/if}}{{if $pbAux1}}<a
   href="{{$pbAux1}}"><img {{$gifAux1}} alt="" {{$dhtml}} ></a>{{/if}}
  </td>
  <td bgcolor="{{$top_bgcolor}}" style="background-image: url({{$root_path}}css/themes/mac2/mac_bg2.gif);"><div align="center">
    &nbsp;{{$sTitleImage}}&nbsp;<font color="{{$top_txtcolor}}">{{$sToolbarTitle}}</font>
     {{if $Subtitle}}
      - {{$Subtitle}}
     {{/if}}
	 </div>
  </td>
  <td bgcolor="{{$top_bgcolor}}" align=right width="20%">{{if $breakfile}}<a
   href="{{$breakfile}}" {{$sCloseTarget}}><img {{$gifClose2}} alt="{{$LDCloseAlt}}" {{$dhtml}}></a>{{/if}}
  </td>
 </tr>
 </table>
