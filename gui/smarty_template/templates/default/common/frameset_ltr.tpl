{{* Frameset for default design and normal left-to-right direction *}}

<frameset cols="{{$gui_frame_left_nav_width}},*" border="{{$gui_frame_left_nav_border}}">
	<FRAME  NAME = "STARTPAGE" {{$sStartFrameSource}} MARGINHEIGHT="5"	MARGINWIDTH  ="5" SCROLLING="auto" >
	<FRAME NAME = "CONTENTS" {{$sContentsFrameSource}}>
</frameset>