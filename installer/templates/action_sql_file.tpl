<div>
	{if $loop < 2}
		The database file is being installed.<br />
		<img src="static/images/loader.gif"/>
	{elseif $loop == 3}
		<h3>Database installation complete.</h3>
	{/if}
</div>