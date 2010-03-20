===============================================================================
 [Program Name] DICOM AiViewer (Java Applet) Ver.1.0.0ƒÀ
 [Archive Name] dicomviewer054.zip
 [Author] Takahiro Katoji(katoco@mars.elcom.nitech.ac.jp or katoco@tomo.ne.jp)
 [Edit By] E-mail: ta-naka@mars.elcom.nitech.ac.jp
 [Web site] http://mars.elcom.nitech.ac.jp/dicom/index-e.html
 [Development Language] Sun SDK 1.4.2_06
===============================================================================

 *****************************************************************************

     This DICOM Viewer allows DICOM images to be manipulated and displayed 
         efficiently by using the general-purpose WWW browser such as 
               Internet Explorer, Netscape Navigator, and so on.

     !!! WARNING !!!
     THESE SOFTWARES ARE FREEWARE AND IT IS AVAILABLE TO USE FOR COMMERCIAL OR
     NON-COMMERCIAL.
     IN NO EVENT SHALL US BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL,
     SPECIAL, CONSEQUENTIAL DAMAGES ARISING FROM THE USE OF THESE SOFTWARES.

     LICENSE ISSUES ARE COPYRIGHT.txt.


 *****************************************************************************

[MAIN FUNCTION]
  * Viewing DICOM data. 
  * Multi platform. (Windows, MacOS, Unix, etc...)
  * Support for 8-16 bit gray scale. 
  * Support for 24 bit RGB color. 
  * Multi slices. (more than 1,000 slices) 
  * Real-time WW/WL. 
  * Zooming. 
  * Loupe. 
  * Slices animation. (Cine mode) 
  * Show tag information. 
  * Show tiled. 
  * Inverse, Flip LR, Flip UD, Rotate LR. 
  * New!: Corresponds to DICOM-Part10 Standard
  * New!: Corresponds to JPEG transfer syntax

[HOW TO USE]
  Download Class files, extract them on directory enable web access such as
  following example. Make HTML file as "How to describe HTML". Accessing the
  HTML file by the WWW browser, DICOM AiViewer starts.
  Notice: Even if you access from the machine that has the HTML file, you have
  to access by http necessarily. (such as http://localhost/sample.html)

  Example:

  /public_html/ etc. (directory enable web access.)
       |
       | -- sample.html (maked HTML file as "How to describe HTML".)
       | -- etc.
       |
       | -- /dicomviewer/ (extract download ClassFile here.)
       |        |
       |        | -- Viewer.class
       |        | -- etc.
       |
       | -- /data/ (It would be better to put DICOM file here.)
                |
                | -- sample.dcm
                | -- etc.

[SETTING TO JAVA]
JRE 1.4.2_06 or more is necessary,so install it.
  -->http://java.sun.com/j2se/1.4.2/download.html

if you want to use JPEG transfer syntax,following setting is necessary.
Install Java Advanced Imaging Image I/O Tools.
  -->http://java.sun.com/products/java-media/jai/index.jsp

And add the following to the file of the name of ".java.policy"
and copy it onto an appropriate place.
ex)
   grant codeBase "http://hogehoge.ho.ge/" {                                   //your URL that is set up applet
      permission java.lang.RuntimePermission "loadLibrary.*";                  //You need not change. 
      permission java.util.PropertyPermission "*", "read";                     //You need not change. 
      permission java.io.FilePermission "C:\\Program Files\\java\\-", "read";  //your local folder that is set up JRE
   };

There is ".java.policy" file in "java\jre\lib\security\".
For example,appropriate place is home directory.
windows example,
uC:\Documents and Settings\(account)\v

If you want to check kind of jpeg image that can be read,please see following URL.
  -->http://mars.elcom.nitech.ac.jp/dicom/check-jpeg.html
And add the following to the file of the name of ".java.policy"
ex)
   grant codeBase "http://mars.elcom.nitech.ac.jp/dicom/" {                    //You need not change.
      permission java.lang.RuntimePermission "loadLibrary.*";                  //You need not change. 
      permission java.util.PropertyPermission "*", "read";                     //You need not change. 
      permission java.io.FilePermission "C:\\Program Files\\java\\-", "read";  //your local folder that is set up JRE
   };

If your setting is right , you can see words of [JPEG2000],[JPEG-LOSSLESS],etc...
If you can't see it , your setting is wrong.So,please check your setting while seeing "ReadMe.txt". 

[HOT TO DESCRIBE HTML]
  * <APPLET>
    - CODE: Describe it just like this. "dicomviewer.Viewer.class"
    - NAME: Describe it just like this, too. "Viewer.java"
    - WIDTH: Viewer size.
    - HEIGHT: Viewer size.
  * <PARAM>
    - tmpSize: Number of images which is loaded on memory at once. (default:10)
    - NUM: Number of all images. (default: 1)
    - currentNo: The number of first displayed image. (default: 0)
    - dicURL: URL of DICOM dictionary.
    - imgURL??: URL of images.

  Notice: If you want to learn detail about HTML, read the reference book.

sample.html
-------------------------------------------------------------------------------
<HTML>
<HEAD>
<TITLE>
DICOM Viewer
</TITLE>
</HEAD>
<BODY>
<APPLET
  CODEBASE = "."
  CODE = "dicomviewer.Viewer.class"
  NAME = "Viewer.java"
  WIDTH = 100%
  HEIGHT = 100%
  HSPACE = 0
  VSPACE = 0
  ALIGN = middle >
<PARAM NAME = "tmpSize" VALUE = "10">
<PARAM NAME = "NUM" VALUE = "5">
<PARAM NAME = "currentNo" VALUE = "0">
<PARAM NAME = "dicURL" VALUE = "http://hoge.com/dicom/dicomviewer/Dicom.dic">
<PARAM NAME = "imgURL0" VALUE = "http://hoge.com/dicom/data/CT.531.1.dcm">
<PARAM NAME = "imgURL1" VALUE = "http://hoge.com/dicom/data/CT.531.2.dcm">
<PARAM NAME = "imgURL2" VALUE = "http://hoge.com/dicom/data/CT.531.3.dcm">
<PARAM NAME = "imgURL3" VALUE = "http://hoge.com/dicom/data/CT.531.4.dcm">
<PARAM NAME = "imgURL4" VALUE = "http://hoge.com/dicom/data/CT.531.5.dcm">
</APPLET> 
</BODY>
</HTML> 
-------------------------------------------------------------------------------

[COPYRIGHT]
  Copyright(C) 2000,
  Nagoya Institute of Technology, Iwata laboratory and Takahiro Katoji

  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License as published by
  the Free Software Foundation; either version 2 of the License, or
  (at your option) any later version.

  This program is distributed in the hope that it will be useful,
  but WITHOUT ANY WARRANTY; without even the implied warranty of
  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
  GNU General Public License for more details.

[THANKS]
  I deeply appreciate the guidances and advices by Yutaka Emoto,MD,PhD(1),
  Kouichi Muto,MSc(2) and Hirokazu Nagashima,BS(3) on programing this software.

  And I deeply thank Akira Iwata,PhD(4) and everyone in Iwata Laboratory.
  Because if I haven't received their cooperation, I wouldn't succeed.

    (1)Department of Radiology, School of Medicine, Fujita Health University
    (2)Faculty of Ragiological Technology, School of Health Sciences,
       Fujita Health University
    (3)BioMedical Information Center, Institute for Comprehensive Medical
       Science, Fujita Health University
    (4)Department of Electrical & Computer Engineering,
       Nagoya Institute of Technology
