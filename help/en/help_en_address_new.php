<font face="Verdana, Arial" size=3 color="#0000cc">
<b>Address manager - New address data</b></font>
<p>
<font size=2 face="verdana,arial" >


<a name="sel"><img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b></a>
What to fill in the form?</b></font>
<ul>
	<b>Step 1:</b> Enter at least the compulsory city or town's name.<p>
	<b>Step 2:</b> If available, enter additional information in the appropriate fields.<p>
	<b>Step 3:</b> Click the <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> button to save the data.
</ul>


<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
I keep getting a "Save attempt to DB failed!" error message and the data do not get saved in the database. What is wrong?</b></font>
<ul>
This usually happens when you are using a PostgreSQL database. The most probable cause is that you left the "ISO Country Code" input empty.
	<p>
	<b>Step 1:</b> Enter the correct ISO country code of the address<p>
	<b>Step 2:</b> If you do not know the ISO country code, just enter a question mark, or "-na-"  or a space.<p>
	<b>Step 3:</b> Never leave the "ISO Country Code" input empty.<p>
</ul>
