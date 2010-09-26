<div>
{if $loop != 3}
	<h3>Choose optional database tables for installation:</h3>
	{foreach name=sqloptions from=$files key=name item=file}
		<div>
			<input id="radio" type="radio" name="optfile" value="{$file}"{if $smarty.foreach.sqloptions.first} checked{/if}>
			<label class="form-radios">{$name|upper}</label>
		</div>
		<br />
	{/foreach}
	<input id="button" type="submit" class="form-submit" style="float:left" name="install_sql" value="Install">
	&nbsp;&nbsp;&nbsp;
	<input id="button" type="submit" class="form-submit" style="float:right" name="install_sql_done" value="Done">
{else if $loop == 3}
	<h3>The database table is being installed.</h3><br />
	<img src="static/images/loader.gif"/>
{/if}
</div>