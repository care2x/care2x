{{* Smarty 2.6.0 Template - request_aftersave.tpl 06.05.2004 Elpidio Latorilla *}}
{{* Definition :  "pb.."  alias for a GUI pushbutton-element *}}
{{*            :  "gif.." alias for a GIF element like "src=xxx.gif" *}}
{{*            :  "tbl.." alias for a <TABLE> .. </TABLE> element *}}
{{*            :  "input.." alias for a <INPUT> .. </INPUT> element *}}
{{*            :  "val.." alias for a value attribute of an <INPUT> .. </INPUT> element *}}

{{config_load file=test.conf section="setup"}}

{{include file="common/header.tpl" title=""}}

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


{{include file="common/header_topblock.tpl"}}

<table border=0>
  <tr valign="top">
    <td>{{$gifMascot}}</td>
    <td><FONT    SIZE=4  FACE="verdana,Arial" color="#990000">
	{{$sAfterSavePrompt}}<br>
	{{$LDWhatToDo}}
	<p>
    <FONT    SIZE=2  FACE="verdana,Arial" color="#990000">
           <a href="{{$pbPrintOut}}"> {{$gifGrnArrow}} {{$LDPrintForm}}</a><br>
           <a href="{{$pbEditForm}}"> {{$gifGrnArrow}} {{$LDEditForm}}</a><br>
	       <a href="{{$pbNewSamePatient}}"> {{$gifGrnArrow}}  {{$LDNewFormSamePatient}}</a><br>
           {{if $user_origin_lab}}
	       <a href="{{$pbNewForm}}"> {{$gifGrnArrow}}  {{$LDNewFormOtherPatient}}</a><br>
           {{/if}}
           <a href="{{$breakfile}}"> {{$gifGrnArrow}} {{$LDEndTestRequest}}</a><p>
        </td>
  </tr>
</table>

<div align="center">

{{if $patho}}
	{{include file="forms/pathology.tpl"}}
{{else}}
	{{$printout_form}}
{{/if}}

</div>

<p>

{{include file="common/copyright.tpl"}}
{{include file="common/footer.tpl"}}
