 {{* Toolbar - Topblock  *}}
<table cellspacing="0"  class="titlebar" border=0>
 <tr valign=top  class="titlebar" >
  <td bgcolor="{{$top_bgcolor}}" >
    &nbsp;{{$sTitleImage}}&nbsp;<font color="{{$top_txtcolor}}">{{$sToolbarTitle}}</font>
     {{if $Subtitle}}
      - {{$Subtitle}}
     {{/if}}
  </td>
  <td bgcolor="{{$top_bgcolor}}" align=right>{{if $pbAux2}}<a
   href="{{$pbAux2}}"><img {{$gifAux2}} alt="" {{$dhtml}} ></a>{{/if}}{{if $pbAux1}}<a
   href="{{$pbAux1}}"><img {{$gifAux1}} alt="" {{$dhtml}} ></a>{{/if}}{{if $pbBack}}<a
   href="{{$pbBack}}"><img {{$gifBack2}} alt="" {{$dhtml}} ></a>{{/if}}{{if $pbHelp}}<a
   href="{{$pbHelp}}"><img {{$gifHilfeR}} alt="" {{$dhtml}}></a>{{/if}}{{if $breakfile}}<a
   href="{{$breakfile}}" {{$sCloseTarget}}><img {{$gifClose2}} alt="{{$LDCloseAlt}}" {{$dhtml}}></a>{{/if}}
  </td>
 </tr>
 </table>