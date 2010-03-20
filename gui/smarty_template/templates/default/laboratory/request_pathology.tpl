{{* Smarty 2.6.0 Template - NURSING.TPL 19.12.2003 Thomas Wiedmann *}}
{{* Definition :  "pb.."  alias for a GUI pushbutton-element *}}
{{*            :  "gif.." alias for a GIF element like "src=xxx.gif" *}}
{{*            :  "tbl.." alias for a <TABLE> .. </TABLE> element *}}
{{*            :  "input.." alias for a <INPUT> .. </INPUT> element *}}
{{*            :  "val.." alias for a value attribute of an <INPUT> .. </INPUT> element *}}


<!-- This is a temporary local css, will be discarded once a global template is implemented -->
<style type="text/css">
div.fva2_ml10 {font-family: verdana,arial; font-size: 12; margin-left: 10;}
div.fa2_ml10 {font-family: arial; font-size: 12; margin-left: 10;}
div.fva2_ml3 {font-family: verdana; font-size: 12; margin-left: 3; }
div.fa2_ml3 {font-family: arial; font-size: 12; margin-left: 3; }
.fva2_ml10 {font-family: verdana,arial; font-size: 12; margin-left: 10; color:#000099;}
.fva2b_ml10 {font-family: verdana,arial; font-size: 12; margin-left: 10; color:#000000;}
.fva0_ml10 {font-family: verdana,arial; font-size: 10; margin-left: 10; color:#000099;}
.fvag_ml10 {font-family: verdana,arial; font-size: 10; margin-left: 10; color:#969696;}
.lmargin {margin-left: 5;}
{{$css_lab}}
</style>

{{* Do not move the ff: one line *}}
{{$js_noresize}}

<ul>

{{if $edit}}
	{{$form_headers}}
{{else}}
	{{if $show_selectprompt}}

<table border=0>
  <tr>
    <td valign="bottom">{{$imgAngledown}}</td>
    <td><font color="#000099" SIZE=3  FACE="verdana,Arial"> <b>{{$LDPlsSelectPatientFirst}}</b></font></td>
    <td>{{$imgMascot}}</td>
  </tr>
</table>
	{{/if}}
{{/if}}

{{include file="forms/pathology.tpl"}}

<p>

{{$form_footers}}

</ul>
