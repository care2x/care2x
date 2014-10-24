<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
{{$HTMLtag}}
<HEAD>
 <TITLE>{{$sWindowTitle}}</TITLE>
 {{include file="common/metaheaders.tpl"}}
 {{$setCharSet}}

</HEAD>

{{* Load the base frameset *}}

{{include file=$sBaseFramesetTemplate}}

<noframes>
<BODY bgcolor=white>
{{$LDNoFrame}}<BR>
<A HREF="contents.htm"> OK</A>
</BODY>
</noframes>

</HTML>