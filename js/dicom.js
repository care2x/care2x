function popSelectDicomViewer(s,l){

	urlholder="dicom_viewer_select.php?sid="+s+"&lang="+l;
	DICOMVIEWER=window.open(urlholder,"DICOMVIEWER","menubar=no,width=300,height=300,resizable=yes,scrollbars=yes");
}

function popImgNotes(n,s,l){

	urlholder="view_image_notes.php?sid="+s+"&lang="+l+"&nr="+n;
	IMGNOTES=window.open(urlholder,"IMGNOTES","menubar=no,width=450,height=400,resizable=yes,scrollbars=yes");
}
