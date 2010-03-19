<tr><td>&nbsp;</td></tr>
<table align="center">
{if $loop < 2}
<tr><td align="center">The database file is being installed.</td></tr>
<tr><td align="center"><img src="images/animated_progress.gif"/></td></tr>
{elseif $loop == 3}
<tr><td align="center">Database installation complete.</td></tr>
{/if}
</table>