<font face="Verdana, Arial" size=3 color="#0000cc">
<b><?php echo "$x3 - $x2" ?></b></font>
<form action="#" >
<p><font size=2 face="verdana,arial" >
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
How to admit a patient from the waiting list?</b></font>
<ul> <b>Step 1: </b>Click the patient's name on the waiting list.<p>
<img src="../help/en/img/en_ambulatory_waitlist.png" border=0 width=301 height=156>
                                                                     <p>
		<b>Step 2: </b>A pop-up window showing the ward's occupancy will appear.<br>
		<b>Step 3: </b>Click the <img <?php echo createLDImgSrc('../','assign_here.gif','0') ?>> button  of the bed to be assigned to the patient.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
How to assign a bed to a patient?</b> (Old method)</font>
<ul> 
<b>Note: </b> This is the old method of admitting an inpatient to a ward. The current preferred method is to use the waiting list. See above steps.<p>
<b>Step 1: </b>Click on the <img <?php echo createComIcon('../','plus2.gif','0') ?>> button corresponding to the room number and bed. 
                                                                     <br>
		<b>Step 2: </b>A pop-up window for searching the patient will appear.<br>
		<b>Step 3: </b>Find first the patient by entering a search keyword into one of several entry fields.<br>
		If you  want to find the patient...<ul type="disc">
		<li>by its patient number, enter the number into the <br>"<span style="background-color:yellow" >Patient nr.:</span><input type="text" name="t" size=19 maxlength=10 value="22000109">" field.
		<li>by its Family name, enter its Family name or the first few letters into the <br>"<span style="background-color:yellow" >Family name:</span><input type="text" name="t" size=19 maxlength=10 value="Schmitt">" field.
		<li>by its Given name, enter its Given name or the first few letters into the <br>"<span style="background-color:yellow" >Given name:</span><input type="text" name="t" size=19 maxlength=10 value="Peter">" field.
		<li>by its birthdate, enter its birthdate or the first few numbers into the <br>"<span style="background-color:yellow" >Birthdate:</span><input type="text" name="t" size=19 maxlength=10 value="10.10.1966">" field.
		</ul>
		<b>Step 4: </b>Click the button <img <?php echo createLDImgSrc('../','searchlamp.gif','0') ?>> to start searching for the patient.<br>
		<b>Step 5: </b>If the search finds the patient or several patients, a list of patients will be displayed.<br>
		<b>Step 6: </b>To select the right patient, click on the button&nbsp;<button><img <?php echo createComIcon('../','post_discussion.gif','0') ?>></button> corresponding to it.<br>
</ul>

<?php if((($src=="")&&($x1=="ja"))||(($src=="fresh")&&($x1=="template"))) : ?>


<font face="Verdana, Arial" size=2>
<a name="open"></a>
<b>
<p><img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000">How to open the patient's charts?</font></b><p>
<font face="Verdana, Arial" size=2>
<ul>
<b>Step:</b> Click the colored bars to open the charts folder...<p>
<img src="../help/en/img/en_ambulatory_sbars.png" border=0 width=434 height=84><p>
<b>OR:</b> Click the <img <?php echo createComIcon($root_path,'open.gif','0'); ?>> icon to open the charts folder...<p>
<img src="../help/en/img/en_admission_folder.png" border=0 width=456 height=92>
</ul>
<a name="adata"></a>
<font face="Verdana, Arial" size=2>
<b>
<p><img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000">How to display the admission data of a patient?</font></b><p>
<font face="Verdana, Arial" size=2>
<ul>
<b>Step:</b> Click the <img <?php echo createComIcon($root_path,'pdata.gif','0'); ?>> icon to display the admission data...<p>
<img src="../help/en/img/en_admission_listlink.png" border=0 width=456 height=92><p>
<b>OR:</b> Click the patient's family name to display the admission data.<p>
<img src="../help/en/img/en_ambulatory_name.png" border=0 width=434 height=84>
</ul>

<a name="transfer"></a>
<font face="Verdana, Arial" size=2>
<b>
<p><img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000">How to transfer a patient?</font></b><p>
<font face="Verdana, Arial" size=2>
<ul>
<b>Step:</b> Click the <img <?php echo createComIcon($root_path,'xchange.gif','0'); ?>> icon to open the transfer window.<p>
<img src="../help/en/img/en_admission_transfer.png" border=0 width=456 height=92>
</ul>


<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
How to discharge a patient from the ward?</b></font>
<ul> <b>Step 1: </b>Click on the <img <?php echo createComIcon('../','bestell.gif','0') ?>> button corresponding to the patient.
                                                                     <p>
<img src="../help/en/img/en_admission_discharge.png" border=0 width=456 height=92><p>
		<b>Step 2: </b>The patient discharge form will appear.<br>
		<b>Step 3: </b>If you are sure to discharge the patient, <br>click the checkbox 
		"<input type="checkbox" name="g" ><span style="background-color:yellow" > Yes, I am sure. discharge the patient.</span>" field to
		activate it.<br>
       	<b>Step 4: </b>Click the button <input type="button" value="discharge"> to discharge the patient.<p>
       	<b>Note: </b>If you want to cancel, click the button <img <?php echo createLDImgSrc('../','cancel.gif','0') ?>> and the patient will not be discharged.<br>
</ul>




<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
How to lock a bed?</b></font>
<ul> <b>Step 1: </b>Click on the <img <?php echo createComIcon('../','plus2.gif','0') ?>> button corresponding to the room number and bed.
                                                                     <br>
		<b>Step 2: </b>A pop-up window for searching the patient will appear.<br>
		<b>Step 3: </b>Click on the "<span style="background-color:yellow" > <img <?php echo createComIcon('../','delete2.gif','0','absmiddle') ?>> <font color="#0000ff">Lock this bed</font> </span>".<br>
		<b>Step 4: </b>Choose&nbsp;<button>OK</button> when asked for confirmation.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
I want to delete a patient from the list</b></font>
<ul> <b>Note: </b>You CANNOT just simply delete a patient from the list. To remove the patient, you have to discharge him regularly. To do it,
				follow the instructions on how to discharge a patient from the ward described above.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>What do these  <img <?php echo createComIcon('../','s_colorbar.gif','0') ?>> color bars mean? </b></font>
<ul> <b>Note: </b>Each of these color bars when "set visible" signalize the availability of a particular information, an instruction, a change, or a query, etc.<br>
			The meaning of a color can be set for every ward. 
</ul>
<!-- <img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>What does this icon <img <?php echo createComIcon('../','patdata.gif','0') ?>> mean? </b></font>
<ul> <b>Note: </b>This is the patient's data file button. To display the patient's data file folder, click this icon. A pop-up window will appear
			showing the basic information on the patient, its id picture if available, and several other options.<br>
</ul> -->
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>What does this icon <img <?php echo createComIcon('../','bubble2.gif','0') ?>> mean? </b></font>
<ul> <b>Note: </b>This is the Read/Write notice button. Clicking it will open a pop-up window for reading or writing notices regarding the patient.<br>
			The  plain <img <?php echo createComIcon('../','bubble2.gif','0') ?>> icon means that there is no current notes or remarks about the patient. To write a note or remarks click on this icon.
			The icon <img <?php echo createComIcon('../','bubble3.gif','0') ?>> means that there is an stored note or remark about the patient. To read  or append notes or remarks
			click on this icon.
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>What does this icon <img <?php echo createComIcon('../','bestell.gif','0') ?>> mean? </b></font>
<ul> <b>Note: </b>This is the patient discharge button. To discharge a patient, click this to open the patient discharge form.<br>
</ul>
<?php elseif(($src=="")&&($x1=="template")) : ?>

<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
What should I do when <span style="background-color:yellow" >today's list is not yet created</span>?</b></font>
<ul> <b>Step 1: </b>Click on the button <input type="button" value="Show last occupancy list"> to find the last recorded list.
                                                                     <br>
		<b>Step 2: </b>When a recorded list is found within the last 31 days, it will be displayed.<br>
		<b>Step 3: </b>Click on the button <input type="button" value="Copy this list for today anyway."><br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
I don't want to see the last occupancy list. How to create a new list?</b></font>
<ul> <b>Step 1: </b>Click on the <img <?php echo createComIcon('../','plus2.gif','0') ?>> button corresponding to the room number and bed.
                                                                     <br>
		<b>Step 2: </b>A pop-up window for searching the patient will appear.<br>
		<b>Step 3: </b>Find first the patient by entering a search keyword into one of several entry fields.<br>
		If you  want to find the patient...<ul type="disc">
		<li>by its patient number, enter the number into the <br>"<span style="background-color:yellow" >Patient nr.:</span><input type="text" name="t" size=19 maxlength=10 value="22000109">" field.
		<li>by its Family name, enter its Family name or the first few letters into the <br>"<span style="background-color:yellow" >Family name:</span><input type="text" name="t" size=19 maxlength=10 value="Schmitt">" field.
		<li>by its Given name, enter its Given name or the first few letters into the <br>"<span style="background-color:yellow" >Given name:</span><input type="text" name="t" size=19 maxlength=10 value="Peter">" field.
		<li>by its birthdate, enter its birthdate or the first few numbers into the <br>"<span style="background-color:yellow" >Birthdate:</span><input type="text" name="t" size=19 maxlength=10 value="10.10.1966">" field.
		</ul>
		<b>Step 4: </b>Click the button <img <?php echo createLDImgSrc('../','searchlamp.gif','0') ?>> to start searching for the patient.<br>
		<b>Step 5: </b>If the search finds the patient or several patients, a list of patients will be displayed.<br>
		<b>Step 6: </b>To select the right patient, click on the button&nbsp;<button><img <?php echo createComIcon('../','post_discussion.gif','0') ?>></button> corresponding to it.<br>
</ul>
<?php elseif(($src=="getlast")&&($x1=="last")) : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
How to copy the displayed last recorded list for today's occupancy list?</b></font>
<ul> <b>Step 1: </b>Click on the button <input type="button" value="Copy this list for today anyway."> to copy the last recorded list.
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
The last occupancy list is being displayed but I don't want to copy it. How to start a new list? </b></font>
<ul> <b>Step 1: </b>Click on the button <input type="button" value="Do not copy this! Create a new list."> to start creating a new list.
</ul>
<?php elseif($src=="assign") : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
How to assign a bed to a patient?</b></font>
<ul> <b>Step 1: </b>Find first the patient by entering a search keyword into one of several entry fields.<br>
		If you  want to find the patient...<ul type="disc">
		<li>by its patient number, enter the number into the <br>"<span style="background-color:yellow" >Patient nr.:</span><input type="text" name="t" size=19 maxlength=10 value="22000109">" field.
		<li>by its Family name, enter its Family name or the first few letters into the <br>"<span style="background-color:yellow" >Family name:</span><input type="text" name="t" size=19 maxlength=10 value="Schmitt">" field.
		<li>by its Given name, enter its Given name or the first few letters into the <br>"<span style="background-color:yellow" >Given name:</span><input type="text" name="t" size=19 maxlength=10 value="Peter">" field.
		<li>by its birthdate, enter its birthdate or the first few numbers into the <br>"<span style="background-color:yellow" >Birthdate:</span><input type="text" name="t" size=19 maxlength=10 value="10.10.1966">" field.
		</ul>
		<b>Step 2: </b>Click the button <img <?php echo createLDImgSrc('../','searchlamp.gif','0') ?>> to start searching for the patient.<br>
		<b>Step 3: </b>If the search finds the patient or several patients, a list of patients will be displayed.<br>
		<b>Step 4: </b>To select the right patient, click on the button&nbsp;<button><img <?php echo createComIcon('../','post_discussion.gif','0') ?>></button> corresponding to it.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
How to lock a bed?</b></font>
<ul> <b>Step 1: </b>Click on the "<span style="background-color:yellow" > <img <?php echo createComIcon('../','delete2.gif','0','absmiddle') ?>> <font color="#0000ff">Lock this bed</font> </span>".<br>
		<b>Step 2: </b>Choose&nbsp;<button>OK</button> when asked for confirmation.<p>
</ul>
  <b>Note: </b>If you want to cancel, click the button <img <?php echo createLDImgSrc('../','cancel.gif','0') ?> align="absmiddle">.</ul>
  
<?php endif;?>

<?php if(($src!="assign")&&($src!="remarks")&&($src!="discharge")) : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>What does this "<span style="background-color:yellow" > <img <?php echo createComIcon('../','delete2.gif','0','absmiddle') ?>> <font color="#0000ff">Locked</font> </span>" mean? </b></font>
<ul> <b>Note: </b>This means that the bed is locked and cannot be assigned to a patient. To unlock it, click on the "<span style="background-color:yellow" ><font color="#0000ff">Locked</font></span>" and choose&nbsp;<button>OK</button>
			when asked for confirmation.<br>
 <b>Note: </b>Depending on the program's version or setup configurations, undoing a locked bed might require a password.</ul>

<?php endif;?>

<a name="pic"></a>
<font face="Verdana, Arial" size=2>
<b>
<p><img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000">How to show the patient's id photo?</font></b><p>
<font face="Verdana, Arial" size=2>
<ul>
<b>Step:</b> Click the <img <?php echo createComIcon($root_path,'spf.gif','0'); ?>> or  <img <?php echo createComIcon($root_path,'spm.gif','0'); ?>> icon.<p>
<img src="../help/en/img/en_ambulatory_sex.png" border=0 width=434 height=84>
</ul>


</form>

