<?php $nMenuItems = 0; ?>
<script type="text/javascript" src="phprptjs/menu.js"></script>
<table border="0" cellspacing="0" cellpadding="0"><tr><td>
<script type="text/javascript">
var oMenu_base = new Menu();
var oMenu_phpReport = oMenu_base.CreateMenu();
oMenu_phpReport.displayHtml = "Raportet";
oMenu_base.AddItem(oMenu_phpReport);
var oMenu_1 = oMenu_base.CreateMenu();
oMenu_1.displayHtml = "Gjenja e medikamenteve ne depo";
oMenu_1.href = "Gjendja_e_medikamenteve_ne_deposmry.php";
oMenu_phpReport.AddItem(oMenu_1);
oMenu_phpReport.SetOrientation("v");
<?php $nMenuItems++; ?>
var oMenu_2 = oMenu_base.CreateMenu();
oMenu_2.displayHtml = "Furnizimet";
oMenu_2.href = "Supplyetsmry.php";
oMenu_phpReport.AddItem(oMenu_2);
oMenu_phpReport.SetOrientation("v");
<?php $nMenuItems++; ?>
oMenu_base.SetOrientation("h");
oMenu_base.SetSize(150, 20);
<?php if ($nMenuItems > 0) { ?>
oMenu_base.Render();
<?php } ?>
</script>
</td>
</tr></table>
