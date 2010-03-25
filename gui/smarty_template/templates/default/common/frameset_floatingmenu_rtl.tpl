{{* Frameset for floating menu window design *}}

<frameset rows="25,*" border=0>
  <frameset cols="*,9%" border=0>
    <frame name="MENUBAR" {{$sMenuFrameSource}} scrolling=no>
    <frame name="STARTPAGE" {{$sStartFrameSource}}>
  </frameset>
  <FRAME NAME = "CONTENTS" {{$sContentsFrameSource}}>
</frameset>
