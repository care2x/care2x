					{if $FINISHED}
						<div id="install_block">
							<input id="button" type="reset" class="form-submit" style="float:right;" value="Start using Care2x" onClick="parent.location='{$APP_URL}'"/>
						</div>
					{else}
						<br />
						<div style="clear: both; margin-right: auto; margin-left: auto;">
							<input id="button" type="reset" class="form-submit" style="float:right;" value="Restart Installation" onClick="parent.location='{$smarty.server.PHP_SELF}?restart_installer=true'"/>
						{if $CAN_CONTINUE}
							<input id="button" type="reset" class="form-submit" style="float:right" value="Continue..." onClick="parent.location='{$smarty.server.PHP_SELF}?next_step=true'"/>
						{/if}
						</div>
					{/if}
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div style="clear: both; margin-right: auto; margin-left: auto; width: 740px;">
	<div id="closure"> &copy; Copyright 2002-2007 Elpidio Latorilla. GPL 2008-{php}echo date('Y');{/php} Mauri Niemi
		<a href="http://www.care2x.org/">Care2x Home</a> :: 
		<a href="http://www.care2x.org/wiki/">Wiki</a> :: 
		<a href="http://sourceforge.net/mailarchive/forum.php?forum_id=11772">Mailing List</a> :: 
		<a href="http://sourceforge.net/projects/care2002/">SF.net Project</a>				
	</div>	  
</div>	
</html>