<?php
/*
Author: Blaz Grapar, blaz.grapar@email.si
Please don't delete my name in the script. Thanks.

This simple class creates a thumbnail of an image. Size of thumbnail is determined with maximum width and height of an thumbnail.

EXAMPLE:
$myThumb = new Thumbnail; // Start using a class
$myThumb->setMaxSize( 200, 200 ); // Specify maximum size (width, height)
$myThumb->setImgSource(	'image_original.jpg' ); // Specify original image filename
$myThumb->Create( 'image_thumbnail.jpg' ); // Specify destination image filename or leave empty to output directly

You can also get additional info about original image or thumbnail...
$myThumb = new Thumbnail; // Start using a class
$myThumb->setImgSource(	'image_original.jpg' ); // Specify original image filename
$myThumb->getImageData( 'width' ) // This will get you pixel width of original image. getImageData arguments are width|height|type

You can also use getThumbData to see the size of thumbnail that will be created.
$myThumb = new Thumbnail; // Start using a class
$myThumb->setMaxSize( 200, 200 ); // Specify maximum size (width, height)
$myThumb->getThumbData( 'width' ) // This will get you pixel width of thumbnail image. getImageData arguments are width|height|type
*/

# This is required for the gd_version method needed in this class

require_once($root_path.'include/care_api_classes/class_image.php');

class Thumbnail extends Image {
	
	# Added var definitions  by Elpidio Latorilla 2003-07-13 
	var $source;
	var $max_width;
	var $max_height;

	// Set destination filename
	function setImgSource( $source )
		{
		$this->source = $source;
		}

	// Set maximum size of thumbnail
	function setMaxSize ( $max_width = 100, $max_height = 100 )
		{
		$this->max_width = $max_width;
		$this->max_height = $max_height;
		}


	// Get info about original image
	function getImageData( $data )
		{
		$size = GetImageSize( $this->source );
		
		switch ( $data )
			{
			case 'width':
				return $size[0];
				break;
			case 'height':
				return $size[1];
				break;
			case 'type':
				switch ( $size[2] )
					{
					case 1:
						return 'gif';
						break;
					case 2:
						return 'jpg';
						break;
					case 3:
						return 'png';
						break;
					}
				break;
			}		
		}

	// Get info about thumbnail
	function getThumbData( $data )
		{
		$w_ratio = $this->max_width  / $this->GetImageData('width');
		$h_ratio = $this->max_height / $this->GetImageData('height');

		if ( $h_ratio < $w_ratio )
			{
			$height = $this->max_height;
			$width = round( $this->GetImageData('width') * $h_ratio, 0);
			}
		else
			{
			$width = $this->max_width;
			$height = round( $this->GetImageData('height') * $w_ratio, 0);
			}
				
		switch ( $data )
			{
			case 'width':
				return $width;
				break;
			case 'height':
				return $height;
				break;
			}
		}

		
	// Creating a thumbnail
	function Create( $dest )
		{

		# Modified by Elpidio Latorilla 2004-03-27
		# Uses the gd_version method of the Image class from /include/care_api_classes/class_image.ph

		if($this->gd_version>=2) $img_des = @ImageCreateTrueColor ( $this->GetThumbData('width'), $this->GetThumbData('height') );
			else $img_des = ImageCreate( $this->GetThumbData('width'), $this->GetThumbData('height') );

		switch ( $this->GetImageData('type') )
			{
			case 'gif':
				$img_src = ImageCreateFromGIF ( $this->source );
				break;

			case 'jpg':
				$img_src = ImageCreateFromJPEG ( $this->source );
				break;

			case 'png':
				$img_src = ImageCreateFromPNG ( $this->source );
				break;
			}

		ImageCopyResized( $img_des, $img_src, 0, 0, 0, 0, $this->GetThumbData('width'), $this->GetThumbData('height'), $this->GetImageData('width'), $this->GetImageData('height') );

		switch ( $this->GetImageData('type') )
			{
			case 'gif':
				if ( empty( $dest ) )
					{
					header( "Content-type: image/gif" );
					return ImageGIF( $img_des );
					}
				else
					{
					return ImageGIF( $img_des, $dest );
					}
					break;

			case 'jpg':
				if ( empty( $dest ) )
					{
					header ( "Content-type: image/jpeg" );
					return ImageJPEG( $img_des );
					}
				else
					{
					return ImageJPEG( $img_des, $dest );
					}
				break;

			case 'png':
				if ( empty( $dest ) )
					{
					header ( "Content-type: image/png" );
					return ImagePNG( $img_des );
					}
				else
					{
					return ImagePNG( $img_des, $dest );
					}
				break;
			}
		}
	}
?>
