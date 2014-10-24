<?php html_rtl($lang); ?>
<head>
<?php echo setCharSet(); ?>
<title></title>
</head>
<frameset rows="50%,*">
  <frame name="NEWEMAIL" src="intra-email.php?sid=<?php echo "$sid&lang=$lang&mode=$mode&folder=$folder&l2h=$l2h&b2p=1" ?>" marginwidth=0 marginheight=0>
  <frame name="ADDRESS" src="intra-email-showaddr.php?sid=<?php echo "$sid&lang=$lang" ?>" marginwidth=0 marginheight=0>
<noframes>
<body>


</body>
</noframes>
</frameset>
</html>
