<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
{{$HTMLtag}}
<HEAD>
 <TITLE>{{$sWindowTitle}} - {{$Name}}</TITLE>
 {{include file="common/metaheaders.tpl"}}
 {{$setCharSet}}

 {{foreach from=$JavaScript item=currentJS}}
 	{{$currentJS}}
 {{/foreach}}

</HEAD>
<BODY  {{$bgcolor}} {{$sLinkColors}} {{$sOnLoadJs}} {{$sOnUnloadJs}}>
