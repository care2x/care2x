<?php
	// if accept language is german goto german version
		require("chklang.php");
		header("location:main/indexframe.php?boot=1");
		exit;
?>
