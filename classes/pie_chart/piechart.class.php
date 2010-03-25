<?php
//include $root_path."classes/pie_chart/chart.class.php"; // modified by ELpidio Latorilla
//***********************************************************************
//***************Written by Rahman Haqparast February 2003***************
//*******************the class for creating pie charts*******************
//***********************************************************************

//class piechart extends chart
class piechart // modified by ELpidio Latorilla
{
	// Modified by Elpidio latorilla 2003-04-23 
	// Moved the elements of class chart.class.php inside the this class 
	// to avoid loading the chart.class.php
	var $elements; //the input values
	var $elemetnames; //the name of the input values
	var $fractions; //the fractions of the elements
	var $colors; //the input color names
    var $colornames = array(
        'aliceblue'     => array(240, 248, 255),
        'antiquewhite'  => array(250, 235, 215),
        'aqua'          => array(0, 255, 255),
        'aquamarine'    => array(127, 255, 212),
        'azure'         => array(240, 255,  255),
        'beige'         => array(245, 245, 220),
        'bisque'        => array(255, 228, 196),
        'black'         => array(0, 0, 0),
        'blanchedalmond'=> array(255, 235, 205),
        'blue'          => array(0, 0, 255),
        'blueviolet'    => array(138, 43, 226),
        'brown'         => array(165, 42, 42),
        'burlywood'     => array(222, 184, 135),
        'cadetblue'     => array(95, 158, 160),
        'chartreuse'    => array(127, 255, 0),
        'chocolate'     => array(210, 105, 30),
        'coral'         => array(255, 127, 80),
        'cornflowerblue'=> array(100, 149,  237),
        'cornsilk'      => array(255, 248, 220),
        'crimson'       => array(220, 20, 60),
        'cyan'          => array(0, 255, 255),
        'darkblue'      => array(0, 0, 13), 
        'darkcyan'      => array(0, 139, 139),
        'darkgoldenrod' => array(184, 134, 11),
        'darkgray'      => array(169, 169, 169),
        'darkgreen'     => array(0, 100, 0),
        'darkkhaki'     => array(189, 183, 107),
        'darkmagenta'   => array(139, 0, 139),
        'darkolivegreen'=> array(85, 107, 47),
        'darkorange'    => array(255, 140, 0),
        'darkorchid'    => array(153, 50, 204),
        'darkred'       => array(139, 0, 0),
        'darksalmon'    => array(233, 150, 122),
        'darkseagreen'  => array(143, 188, 143),
        'darkslateblue' => array(72, 61, 139),
        'darkslategray' => array(47, 79, 79),
        'darkturquoise' => array(0, 206, 209),
        'darkviolet'    => array(148, 0, 211),
        'deeppink'      => array(255, 20, 147),
        'deepskyblue'   => array(0, 191, 255),
        'dimgray'       => array(105, 105, 105),
        'dodgerblue'    => array(30, 144, 255),
        'firebrick'     => array(178, 34, 34),
        'floralwhite'   => array(255, 250, 240),
        'forestgreen'   => array(34, 139, 34),
        'fuchsia'       => array(255, 0, 255),
        'gainsboro'     => array(220, 220, 220),
        'ghostwhite'    => array(248, 248, 255),
        'gold'          => array(255, 215, 0),
        'goldenrod'     => array(218, 165, 32),
        'gray'          => array(128, 128, 128),
        'green'         => array(0, 128, 0),
        'greenyellow'   => array(173, 255, 47),
        'honeydew'      => array(240, 255, 240),
        'hotpink'       => array(255, 105, 180),
        'indianred'     => array(205, 92, 92),
        'indigo'        => array(75, 0, 130),
        'ivory'         => array(255, 255, 240),
        'khaki'         => array(240, 230, 140),
        'lavender'      => array(230, 230, 250),
        'lavenderblush' => array(255, 240, 245),
        'lawngreen'     => array(124, 252,  0),
        'lemonchiffon'  => array(255, 250, 205),
        'lightblue'     => array(173, 216, 230),
        'lightcoral'    => array(240, 128, 128),
        'lightcyan'     => array(224, 255, 255),
        'lightgoldenrodyellow' => array(250, 250, 210),
        'lightgreen'    => array(144, 238, 144),
        'lightgrey'     => array(211, 211, 211),
        'lightpink'     => array(255, 182, 193),
        'lightsalmon'   => array(255, 160, 122),
        'lightseagreen' => array(32, 178, 170),
        'lightskyblue'  => array(135, 206, 250),
        'lightslategray'=> array(119, 136, 153),
        'lightsteelblue'=> array(176, 196, 222),
        'lightyellow'   => array(255, 255, 224),
        'lime'          => array(0, 255, 0),
        'limegreen'     => array(50, 205, 50),
        'linen'         => array(250, 240, 230),
        'magenta'       => array(255, 0, 255),
        'maroon'        => array(128, 0, 0),
        'mediumaquamarine' => array(102, 205, 170),
        'mediumblue'    => array(0, 0, 205),
        'mediumorchid'  => array(186, 85, 211),
        'mediumpurple'  => array(147, 112, 219),
        'mediumseagreen'=> array(60, 179, 113),
        'mediumslateblue'   => array(123, 104, 238),
        'mediumspringgreen' => array(0, 250, 154),
        'mediumturquoise'   => array(72, 209, 204),
        'mediumvioletred'   => array(199, 21, 133),
        'midnightblue'  => array(25, 25, 112),
        'mintcream'     => array(245, 255, 250),
        'mistyrose'     => array(255, 228, 225),
        'moccasin'      => array(255, 228, 181),
        'navajowhite'   => array(255, 222, 173),
        'navy'          => array(0, 0, 128),
        'oldlace'       => array(253, 245, 230),
        'olive'         => array(128, 128, 0),
        'olivedrab'     => array(107, 142, 35),
        'orange'        => array(255, 165, 0),
        'orangered'     => array(255,69,0),
        'orchid'        => array(218,112,214),
        'palegoldenrod' => array(238,232,170),
        'palegreen'     => array(152,251,152),
        'paleturquoise' => array(175,238,238),
        'palevioletred' => array(219,112,147),
        'papayawhip'    => array(255,239,213),
        'peachpuff'     => array(255,218,185),
        'peru' => array(205,133,63),
        'pink' => array(255,192,203),
        'plum' => array(221,160,221),
        'powderblue' => array(176,224,230),
        'purple' => array(128,0,128),
        'red' => array(255,0,0),
        'rosybrown' => array(188,143,143),
        'royalblue' => array(65,105,225),
        'saddlebrown' => array(139,69,19),
        'salmon' => array(250,128,114),
        'sandybrown' => array(244,164,96),
        'seagreen' => array(46,139,87),
        'seashell' => array(255,245,238),
        'sienna' => array(160,82,45),
        'silver' => array(192,192,192),
        'skyblue' => array(135,206,235),
        'slateblue' => array(106,90,205),
        'slategray' => array(112,128,144),
        'snow' => array(255,250,250),
        'springgreen' => array(0,255,127),
        'steelblue' => array(70,130,180),
        'tan' => array(210,180,140),
        'teal' => array(0,128,128),
        'thistle' => array(216,191,216),
        'tomato' => array(255,99,71),
        'turquoise' => array(64,224,208),
        'violet' => array(238,130,238),
        'wheat' => array(245,222,179),
        'white' => array(255,255,255),
        'whitesmoke' => array(245,245,245),
        'yellow' => array(255,255,0),
        'yellowgreen' => array(154,205,50)
    );

	function calculate()
	{
		$sum=array_sum($this->elements);
		foreach ($this->elements as $value) 
		{
			$i++;
			$this->fractions[$i]=$value/$sum;
		}
	}

	// Beginn of the original class prior to modifications by elpidio latorilla
	var $radius;
	var $final;
	var $bgcolor=array();
	
	
	function piechart($r,$na,$el,$co)
	{
		$this->radius=$r;
		$this->elementnames=$na;
		$this->elements=$el;
		$this->colors=$co;
		$this->createimage();
	}
	function createimage()
	{
		$this->calculate();
		$r=$this->radius;
		//$image=imagecreate($r*3,$r*2); // Modified by Elpidio Latorilla 2003-04-23 
		$image=imagecreate($r*2,$r*2);
		$white=imagecolorallocate($image,255,255,255);
		$black=imagecolorallocate($image,0,0,0);
		imagecolorTransparent($image,$white);
		for ($k=0;$k<count($this->colors);$k++)
		{
			$fillcolor[$k]=imagecolorallocate($image,$this->colornames[$this->colors[$k]][0],$this->colornames[$this->colors[$k]][1],$this->colornames[$this->colors[$k]][2]);
		}
		imagearc($image,$r,$r,$r*2-1,$r*2-1,0,360,$black);
		imagefill($image,$r,$r,$fillcolor[0]);
		for ($j=0;$j<count($this->elements);$j++)
		//for ($j=0;$j<1;$j++)
		{
			$degree+=360*$this->fractions[$j];
			if($this->elements[$j]){
				imageline($image,$r,$r,$r+$r*cos($degree*pi()/180),$r+$r*sin($degree*pi()/180),$black);
				imagefill($image,$r+15*cos(($degree+5)*pi()/180),$r+15*sin(($degree+5)*pi()/180),$fillcolor[$j]);
			}
			
			// Modified by Elpidio Latorilla 2003-04-23 
			//imagefilledrectangle($image,2.1*$r,.7*$r+($r/15)*$j,2.12*$r+($r/25),.7*$r+5+($r/15)*$j,$fillcolor[$j]);
			//imagestring($image,0,2.13*$r+$r/20,.71*$r+($r/15)*$j-2,$this->elements[$j]."-".$this->elementnames[$j],$black);
		}	
			$this->final=$image;
	}
	function draw()
	{		// Modified by Elpidio Latorilla 2003-04-23 
			//imagejpeg($this->final);
			imagepng($this->final);
	}
	function out($filename,$quality)
	{		// Modified by Elpidio Latorilla 2003-04-23 
			//imagejpeg($this->final,$filename,$quality);
			imagepng($this->final,$filename,$quality);
	}
}
?>
