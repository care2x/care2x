<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<font face="Verdana, Arial" size=3 color="#0000cc">
<b>
Intranet Email - 
<?php
	switch($src)
	{
	case "pass": switch($x1)
						{
							case "": print "Log in";
												break;
							case "1": print "Registering a new user";
												break;
						}
						break;
	case "mail": switch($x1)
						{
							case "compose": print "Compose a new mail";
												break;
							case "listmail": print "Mail listing";
												break;
							case "sendmail": print "Mail sent";
												break;
						}
						break;
	case "read": print "Reading mail";
						break;
	case "address": print "Address book";
						break;

	}


 ?></b></font>
<p><font size=2 face="verana,arial" >
<form action="#" >

	

<?php if($src=="pass") : ?>
<?php if($x1=="") : ?>
		<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
How to log in?</b>
</font>
<ul>       	
 	<b>Step 1: </b>Enter your intranet email address (without the @xxxxxx part) in the <nobr>"<span style="background-color:yellow" > Your email address: </span>"</nobr> field.<br>
 	<b>Step 2: </b>Select the domain part  in the <nobr>"<span style="background-color:yellow" > @<select name="d">
                                                                                          	<option value="Test Domain 1"> Test Domain 1</option>
                                                                                          	<option value="Test Domain 2"> Test Domain 2</option>
                                                                                          </select>
                                                                                           </span>"</nobr> field.<br>
 	<b>Step 3: </b>Click the <input type="button" value="Login"> button to log in.<br>
</ul>

	<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
I have no address yet. How to get an address?</b>
</font>
<ul>       	
 	<b>Step 1: </b>Click the link "<span style="background-color:yellow" > New user can register here. <img <?php echo createComIcon('../','bul_arrowgrnsm.gif','0') ?>> </span>" to open the
	registration form.<br>
 	<b>Step 2: </b>For further instructions, click the "Help" button once the register form is displayed.<br>
</ul>
	<?php endif; ?>		
	<?php if($x1=="1") : ?>
		<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
How to register?</b>
</font>
<ul>       	
 	<b>Step 1: </b>Enter the family and given name in the "<span style="background-color:yellow" > Name, Given name: </span>" field.<br>
 	<b>Step 2: </b>Enter the email address of your choice  in the "<span style="background-color:yellow" > Choice email address: </span>" field.<p>
 	<b>Step 3: </b>Select the domain part  in the <nobr>"<span style="background-color:yellow" > @<select name="d">
                                                                                          	<option value="Test Domain 1"> Test Domain 1</option>
                                                                                          	<option value="Test Domain 2"> Test Domain 2</option>
                                                                                          </select>
                                                                                           </span>"</nobr> field.<br>
 	<b>Step 4: </b>Enter the alias of your choice  in the "<span style="background-color:yellow" > Alias: </span>" field.<p>
 	<b>Step 5: </b>Enter the password of your choice in the "<span style="background-color:yellow" > Choice password: </span>" field.<br>
 	<b>Step 6: </b>Reenter the password in the "<span style="background-color:yellow" > Reenter the password: </span>" field.<br>
 	<b>Step 3: </b>Click the <input type="button" value="Register"> button to register.<br>
</ul>

	<?php endif; ?>		
<?php endif; ?>	

<?php if($src=="mail") : ?>
<?php if($x1=="listmail") : ?>
		<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
How to open a mail?</b>
</font>
<ul>       	
 	<b>Step 1: </b>Click either the mail's recipient or sender, or subject, or date, or the icons <img <?php echo createComIcon('../','c-mail.gif','0') ?>> or <img <?php echo createComIcon('../','o-mail.gif','0') ?>>.<br>
</ul>

	<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
What do the icons <img <?php echo createComIcon('../','c-mail.gif','0') ?>> and <img <?php echo createComIcon('../','o-mail.gif','0') ?>> mean?</b>
</font>
<ul>       	
 	<img <?php echo createComIcon('../','c-mail.gif','0') ?>> = Mail is not yet read or opened. <br>
 	<img <?php echo createComIcon('../','o-mail.gif','0') ?>> = Mail was already  read or opened. <br>
</ul>
	<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
How to delete a mail?</b>
</font>
<ul>       	
 	<b>Step 1: </b>Check  the mail's <input type="checkbox" name="a" value="s" checked> checkbox to select it.<br>
 	<b>Step 2: </b>Click the <input type="button" value="Delete"> button.<br>
</ul>
	<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
How to go from one folder to another?</b>
</font>
<ul>       	
 	<b>Step 1: </b>Just click the folder's name.<br>
</ul>
	<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
How to compose or write a new mail?</b>
</font>
<ul>       	
 	<b>Step 1: </b>Click the link "<span style="background-color:yellow" > New Email </span>".<br>
</ul>
	<?php endif; ?>		
	<?php if($x1=="compose") : ?>
		<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
How to write a new mail?</b>
</font>
<ul>       	
 	<b>Step 1: </b>Enter the email address of the recipient in the "<span style="background-color:yellow" > Recipient: </span>" field.<br>
 	<b>Step 2: </b>If you want to send a copy to somebody enter his email address in the "<span style="background-color:yellow" > (CC) </span>" field.<br>
 	<b>Step 3: </b>If you want to send a copy to somebody (without showing the address) enter his email address in the "<span style="background-color:yellow" > (BCC) </span>" field.<br>
 	<b>Step 4: </b>Enter the subject of your message  in the "<span style="background-color:yellow" > Subject: </span>" field.<br>
 	<b>Step 5: </b>Now type your message in the text input field.<br>
 	<b>Step 6: </b>Click the <input type="button" value="Send"> button to send the mail.<br>
</ul>
		<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
I plan to save the mail as a draft. How to do it?</b>
</font>
<ul>       	
 	<b>Step 1: </b>Type your message in the text input field.<br>
 	<b>Step 2: </b>After typing your message, click the <input type="button" value="Save as draft"> button.<br>
</ul>
		<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
How to use email addresses from my address book directly?</b>
</font>
<ul>       	
 	<b>Step 1: </b>Click the <input type="button" value="Show all"> button under the "Quick address".<br>
 	<b>Step 2: </b>A small window will pop up showing your address book.<br>
 	<b>Step 3: </b>Click the radio button of an address corresponding to the field where it should be copied.<p>
<ul>   
		Click "To<input type="radio" name="t" value="a">" to copy the address to the "Recipient" field.<br>
		Click "CC<input type="radio" name="t" value="a">" to copy the address to the "CC" field.<br>
		Click "BCC<input type="radio" name="t" value="a">" to copy the address to the "BCC" field.<p>
</ul>
        <img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> <b>Note:</b>  If you want to
		reset a radiobutton, click the corresponding <img <?php echo createComIcon('../','redpfeil.gif','0') ?>> icon.<br> 	
        <img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> <b>Note:</b> You can select several addresses
		at the same time. 	<p>
 	<b>Step 4: </b>Click the <input type="button" value="Take over"> button to copy the selected addresses to the mail being composed.<br>
 	<b>Step 5: </b>Click the "<span style="background-color:yellow" > <img <?php echo createComIcon('../','l_arrowgrnsm.gif','0') ?>> Close </span>"
	 link to close the pop-up window.<br>
</ul>
		<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
What is this "Quick address" thing?</b>
</font>
<ul>       	
 	<b>Note: </b>If you have email addresses stored in the "Quick address" cache, the first five will be listed in the "quick address".<p>
 	<b>Step 1: </b>Click first in the entry field where you want to put the address (eg. "Recipient" or "CC" or "BCC") to focus it.<br>
 	<b>Step 2: </b>Click the address in the "Quick address" list. This address will be copied to the entry field where you have previously clicked.<br>
</ul>

	<?php endif; ?>		
<?php if(($x1=="sendmail")&&($x3=="1")) : ?>
	<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
How to compose or write a new mail?</b>
</font>
<ul>       	
 	<b>Step 1: </b>Click the link "<span style="background-color:yellow" > New Email </span>".<br>
</ul>
	<?php endif; ?>		
<?php endif; ?>	


<?php if($src=="read") : ?>
	<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
How to print the mail?</b>
</font>
<ul>       	
 	<b>Step 1: </b>Click the link "<span style="background-color:yellow" > Printer version <img <?php echo createComIcon('../','bul_arrowgrnsm.gif','0') ?>></span>".<br>
 	<b>Step 2: </b>A window will pop up displaying a printer friendly version of the mail.<br>
 	<b>Step 3: </b>Click the option "<span style="background-color:yellow" > < Print > </span>" to print.<br>
 	<b>Step 4: </b>The Windows© printer menu will pop up. Click the button "OK".<br>
 	<b>Step 5: </b>To close the printer version window, click the option "<span style="background-color:yellow" > < Close > </span>".<br>
</ul>
	<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
How to resend the mail?</b>
</font>
<ul>       	
 	<b>Step 1: </b>Click the <input type="button" value="Resend"> button.<br>
 	<b>Step 2: </b>Edit the email addresses if necessary.<br>
 	<b>Step 3: </b>Click the <input type="button" value="Send"> button to finally resend the email.
</ul>
	<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
How to forward the mail?</b>
</font>
<ul>       	
 	<b>Step 1: </b>Click the <input type="button" value="Forward"> button.<br>
 	<b>Step 2: </b>Enter the recipient's address.<br>
 	<b>Step 3: </b>Click the <input type="button" value="Send"> button to finally forward the email.
</ul>
	<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
How to delete the mail?</b>
</font>
<ul>       	
 	<b>Step 1: </b>Click the <input type="button" value="Delete"> button.<br>
 	<b>Step 2: </b>You will be asked if you really want to delete the mail.<br>
 	<b>Step 3: </b>Click the <input type="button" value="OK"> button to finally delete the email.<p>
	<b>Note:</b> Mails that are deleted from the "Inbox" folder are temporarily stored in the "Recycle" folder.
</ul>
	<?php endif; ?>		
	
<?php if($src=="address") : ?>
	<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
How to add an email address to the address book?</b>
</font>
<ul>       	
 	<b>Step 1: </b>Click the <input type="button" value="Add new email address"> button.<br>
 	<b>Step 2: </b>An entry form will appear. Enter the name  in the "<span style="background-color:yellow" > Name, Given name: </span>" field.<br>
 	<b>Step 3: </b>Enter the alias or nickname  in the "<span style="background-color:yellow" > Alias/Nickname: </span>" field.<br>
 	<b>Step 4: </b>Enter the email address in the "<span style="background-color:yellow" > Email address: </span>" field.<br>
 	<b>Step 5: </b>Select the domain part  in the <nobr>"<span style="background-color:yellow" > @<select name="d">
                                                                                          	<option value="Test Domain 1"> Test Domain 1</option>
                                                                                          	<option value="Test Domain 2"> Test Domain 2</option>
                                                                                          </select>
                                                                                           </span>"</nobr> field.<br>
 	<b>Step 6: </b>Click the <input type="button" value="Save"> button.<br>
</ul>
	<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
How to remove an email address from the address book?</b>
</font>
<ul>       	
 	<b>Step 1: </b>Click the checkbox <input type="checkbox" name="d" value="s" checked> of the address to be removed to select it.<br>
 	<b>Step 2: </b>Click the <input type="button" value="Delete"> button.<br>
 	<b>Step 3: </b>You will be asked if you really want to delete the mail.<br>
 	<b>Step 4: </b>Click the <input type="button" value="OK"> button to finally remove the address.<p>
</ul>
	<?php endif; ?>		

	<img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> <font color="#990000"><b>
Note:</b>
</font>
<ul>       	
 	Intranet emails and addresses function ONLY WITHIN the intranet system and are not usable for the internet.<br>
</ul>
	</form>

