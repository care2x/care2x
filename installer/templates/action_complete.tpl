{if $ACTION->getResult() == $smarty.const.INSTALLER_TEST_SUCCESS}
	<div class="messages status" style="margin: 10px 0pt;">
		{$ACTION->getResultMessage()}
	</div>
{elseif $ACTION->getResult() == $smarty.const.INSTALLER_TEST_WARNING}
	<div class="messages warning" style="margin: 10px 0pt;">
		{$ACTION->getResultMessage()}
	</div>
{else}
	<div class="messages error" style="margin: 10px 0pt;">
		{$ACTION->getResultMessage()}
	</div>
{/if}
