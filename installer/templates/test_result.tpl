<h5>
	{if $test->getResult() == $smarty.const.INSTALLER_TEST_SUCCESS }
		<img src='static/images/tick.png'>
	{elseif $test->getResult() == $smarty.const.INSTALLER_TEST_WARNING }
		<img src='static/images/error.png'>
	{else}
		<img src='static/images/red.png'>
	{/if}
	{$test->getResultMessage()}
</h5>