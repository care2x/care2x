<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<font face="Verdana, Arial" size=3 color="#0000cc">
<b>
<?php
if($x2=="pharma") print "Pharmacy - "; else print "Medical depot - ";
	switch($src)
	{
	case "input": if($x1=="update") print "Editing a product's Information";
                          else print "Entering new product into the databank";
					break;
	case "search": print "Search a product";
					break;
	case "mng": print "Manage products in the databank";
					break;
	case "delete": print "Removing a product from the databank";
					break;
	}


 ?></b></font>
<p><font size=2 face="verana,arial" >
<form action="#" >

	

<?php if($src=="input") : ?>
	<?php if($x1=="") : ?>
	<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
How to enter a new product into the databank?</b>
</font>
<ul>       	
 	<b>Step 1: </b>Enter first all available information about the product into their corresponding entry fields.<br>
</ul>
	<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
I want to select a picture of the product. How to do it?</b>
</font>
<ul>       	
 	<b>Step 1: </b>Click the button <input type="button" value="Browse..."> on the "<span style="background-color:yellow" > Picture file </span>" field.<br>
 	<b>Step 2: </b>A small window for selecting a file will appear. Select the picture file of your choice and click "OK".<br>
</ul>
	<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
I am finished entering all available product information. How to save it?</b>
</font>
<ul>       	
 	<b>Step 1: </b>Click the button <input type="button" value="Save">.<br>
</ul>
	<?php endif;?>	
	<?php if($x1=="save") : ?>
	<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
How to enter a new product into the databank?</b>
</font>
<ul>       	
 	<b>Step 1: </b>Click the <input type="button" value="New product"> button.<br>
 	<b>Step 2: </b>The entry form will appear.<br>
 	<b>Step 3: </b>Enter the available information about the new product.<br>
 	<b>Step 4: </b>Click the button <input type="button" value="Save"> to save the information.<br>
</ul>
	<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
I want to edit the product that is currently displayed How to do it?</b>
</font>
<ul>       	
 	<b>Step 1: </b>Click the button <input type="button" value="Updte or edit">.<br>
 	<b>Step 2: </b>The product information will be automatically entered into the editing form.<br>
 	<b>Step 3: </b>Edit the information.<br>
 	<b>Step 4: </b>Click the button <input type="button" value="Save"> to save the new information.<br>
</ul>
	
	<?php endif;?>	
	<?php if($x1=="update") : ?>
	<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
I want to edit the product that is currently displayed How to do it?</b>
</font>
<ul>       	
 	<b>Step 1: </b>If necessary delete first the existing data from an entry field.<p>
 	<b>Step 2: </b>Type the new information in the appropriate entry field.<p>
 	<b>Step 3: </b>Click the button <input type="button" value="Save"> to save the new information.<br>
</ul>
	<?php endif;?>	
<?php endif;?>	

<?php if($src=="search") : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
How to search a product?</b>
</font>
<ul>       	
 	<b>Step 1: </b>Enter either a complete information or the first few letters of the articles brand name, or generic name, or order number, etc. in the 
				<nobr><span style="background-color:yellow" >" Search a search keyword...: <input type="text" name="s" size=10 maxlength=10> "</span></nobr> field.<br>
 	<b>Step 2: </b>Click the button <input type="button" value="Search"> to find the article.<br>
 	<b>Step 3: </b>If the search finds the article that exactly matches the search keyword, a detailed information on the article will be displayed.<br>
 	<b>Step 4: </b>If the search finds several articles that approximate the search keyword, a list of the articles will be displayed.<br>
</ul>
	<?php if($x1!="multiple") : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
A list of several articles is listed. How to see the information of a particular article?</b>
</font>
<ul>       	
 	<b>Step 1: </b>Click either the button <img <?php echo createComIcon('../','info3.gif','0') ?>> or the article's name.<br>
</ul>
	<?php endif;?>
	<?php if($x1=="multiple") : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
I want to see the previous list of articles. What should I do?</b>
</font>
<ul>       	
 	<b>Step 1: </b>Click the button <input type="button" value="Go back">.<br>
</ul>
	<?php endif;?>
<img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> <font color="#990000"><b> Note:</b></font> 
<ul>       	
 If you decide to cancel click the button <img <?php echo createLDImgSrc('../','cancel.gif','0') ?>>.
</ul>

<?php endif;?>

<?php if($src=="mng") : ?>
	<?php if(($x3=="1")) : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
How to edit the product information?</b>
</font>
<ul>       	
 	<b>Step 1: </b>Edit the information about the new product.<br>
 	<b>Step 2: </b>Click the button <input type="button" value="Save"> to save the new information.<br>
</ul>
	<?php endif;?>

	<?php if($x1=="multiple") : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
How to edit the information of the product currently displayed?</b>
</font>
<ul>       	
 	<b>Step 1: </b>Click the button <input type="button" value="Update or edit">.<br>
 	<b>Step 2: </b>The product information will be automatically entered into the editing form.<br>
 	<b>Step 3: </b>Edit the information.<br>
 	<b>Step 4: </b>Click the button <input type="button" value="Save"> to save the new information.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
How to remove the product currently displayed?</b>
</font>
<ul>       	
 	<b>Step 1: </b>Click the button <input type="button" value="Remove from the databank">.<br>
 	<b>Step 2: </b>You will be ask if you really want to remove the information from the databank<br>
 	<b>Step 3: </b>If you really want to remove the product's information, click the button <input type="button" value="Yes, I'm dead sure. Remove data."><p>
 	<img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> <font color="#990000"><b> Note:</b></font> Removal or deletion of the data cannot be undone.<br>
</ul>	
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
I do not want to remove the product's information. What should I do?</b>
</font>
<ul>       	
 	<b>Step 1: </b>Click the link "<span style="background-color:yellow" > << No, do not delete. Go back </span>".<br>
</ul>	
<?php endif;?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
How to manage a product in the databank?</b>
</font>
<ul>       	
 	<b>Step 1: </b>Find the product article first. Enter either a complete information or the first few letters of the article's brand name, or generic name, or order number, etc. in the 
				<nobr><span style="background-color:yellow" >" Search keyword: <input type="text" name="s" size=10 maxlength=10> "</span></nobr> field.<br>
 	<b>Step 2: </b>Click the button <input type="button" value="Search"> to find the article.<br>
 	<b>Step 3: </b>If the search finds the article that exactly matches the search keyword, a detailed information on the article will be displayed.<br>
 	<b>Step 4: </b>If the search finds several articles that approximate the search keyword, a list of the articles will be displayed.<br>
</ul>
	<?php if(($x1!="multiple")&&($x3=="")) : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
A list of several articles is listed. How to see the information of a particular article?</b>
</font>
<ul>       	
 	<b>Step 1: </b>Click either the button <img <?php echo createComIcon('../','info3.gif','0') ?>> or the article's name.<br>
</ul>
	<?php endif;?>
	<img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> <font color="#990000"><b> Note:</b></font> 
<ul>       	
 If you decide to cancel click the button <img <?php echo createLDImgSrc('../','cancel.gif','0') ?>>.
</ul>
<?php endif;?>



<?php if($src=="delete") : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
I want to remove the product from the databank. What should I do?</b>
</font>
<ul>       	
 	<img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> <font color="#990000"><b> Note:</b></font> Removal or deletion of the product cannot be undone.<p>
 	<b>Step 1: </b>If you are sure you want to delete the product, click the button <input type="button" value="Yes, I'm dead sure. Delete the data">.<br>
</ul>

<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
I do not want to remove the product's information. What should I do?</b>
</font>
<ul>       	
 	<b>Step 1: </b>Click the link "<span style="background-color:yellow" > << No, do not delete. Go back </span>".<br>
</ul>	

<img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> <font color="#990000"><b> Note:</b></font> 
<ul>       	
 If you decide to cancel click the button <img <?php echo createLDImgSrc('../','cancel.gif','0') ?>>.
</ul>

<?php endif;?>	

<?php if($src=="report") : ?>

<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
How to write a report?</b>
</font>
<ul>       	
 	<b>Schritt 1: </b>Write your report in the
				<nobr><span style="background-color:yellow" >" Report: <input type="text" name="s" size=10 maxlength=10> "</span></nobr> field.<br>
 	<b>Schritt 2: </b>Type your name in the
				<nobr><span style="background-color:yellow" >" Reporter: <input type="text" name="s" size=10 maxlength=10> "</span></nobr> field.<br>
 	<b>Schritt 3: </b>Enter your personell number in teh
				<nobr><span style="background-color:yellow" >" Personell Nr: <input type="text" name="s" size=10 maxlength=10> "</span></nobr> field.<br>
 	<b>Schritt 4: </b>Click the button <input type="button" value="Send"> to send the report.<br>
</ul>
<img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> <font color="#990000"><b> Note:</b><br></font> 
       	
If you decide to cancel or end click the button <img <?php echo createLDImgSrc('../','close2.gif','0') ?>>.
</ul>
<?php endif;?>	

</form>

