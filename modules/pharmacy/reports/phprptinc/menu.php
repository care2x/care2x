<?php $nMenuItems = 0; ?>
<script type="text/javascript" src="phprptjs/menu.js"></script>
<table border="0" cellspacing="0" cellpadding="0"><tr><td>
<script type="text/javascript">
var oMenu_base = new Menu();
var oMenu_phpReport = oMenu_base.CreateMenu();
oMenu_phpReport.displayHtml = "Raportet";
oMenu_base.AddItem(oMenu_phpReport);
var oMenu_1 = oMenu_base.CreateMenu();
oMenu_1.displayHtml = "Gjendja";
oMenu_1.href = "gjendjarpt.php";
oMenu_phpReport.AddItem(oMenu_1);
oMenu_phpReport.SetOrientation("v");
<?php $nMenuItems++; ?>
var oMenu_2 = oMenu_base.CreateMenu();
oMenu_2.displayHtml = "Skadenca";
oMenu_2.href = "skadencarpt.php";
oMenu_phpReport.AddItem(oMenu_2);
oMenu_phpReport.SetOrientation("v");
<?php $nMenuItems++; ?>
var oMenu_3 = oMenu_base.CreateMenu();
oMenu_3.displayHtml = "Terheqja e Medikamenteve Report";
oMenu_3.href = "terheqja_e_medikamenteve_reportsmry.php";
oMenu_phpReport.AddItem(oMenu_3);
oMenu_phpReport.SetOrientation("v");
<?php $nMenuItems++; ?>
var oMenu_4 = oMenu_base.CreateMenu();
oMenu_4.displayHtml = "Farmaci Depo";
oMenu_4.href = "farmaci_deposmry.php";
oMenu_phpReport.AddItem(oMenu_4);
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
