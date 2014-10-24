
<p><font size=2 face="verana,arial" >
<form action="#" >
<b>更新或修改数据</b>
<ul> 如果您想修改信息击打以下按钮 <input type="button" value="更改数据">.
</ul>
<?php if($src=="search") : ?>
<b>新检索</b>
<ul> 如果您想重新检索,请击打以下按钮 <input type="button" value="回到检索">.
</ul>
<?php else : ?>
<b>重新开始新病人入院手续</b>
<ul> 如果您想重新开始新入院手续,请击打以下按钮 <input type="button" value="回到入院手续">.
</ul>
<?php endif;?>
<b>注意</b>
<ul> 如果您完成了,请击打以下按钮 <img <?php echo createLDImgSrc('../','cancel.gif','0') ?>>.
		
</ul>


</form>

