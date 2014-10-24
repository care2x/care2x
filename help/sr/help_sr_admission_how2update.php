
<p><font size=2 face="verana,arial" >
<form action="#" >
<b>To update or change data</b>
<ul> If you want to make changes in the information click the button <input type="button" value="Update data">.
</ul>
<?php if($src=="search") : ?>
<b>New search</b>
<ul> If you want to start a new search click the button <input type="button" value="Back to search">.
</ul>
<?php else : ?>
<b>To start a new admission of a new patient</b>
<ul> If you want to start new admission click the button <input type="button" value="Back to admission">.
</ul>
<?php endif;?>
<b>Note</b>
<ul> If you are finished  click the button <img <?php echo createLDImgSrc('../','cancel.gif','0') ?>>.
		
</ul>


</form>

