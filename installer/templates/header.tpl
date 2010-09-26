<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	{$HEADER_EXTRAS}
	<title>{$APP_NAME} Installation</title>
	<link href="static/css/reset.css" rel="stylesheet" type="text/css" />
	<link href="static/css/base.css" rel="stylesheet" type="text/css" />
	<link href="static/css/colors.css" rel="stylesheet" type="text/css" />
	<link href="static/css/layout.css" rel="stylesheet" type="text/css" />
	<link href="static/css/style.css" rel="stylesheet" type="text/css" />
</head>

<body class="front page-node one-sidebar">
<div id="header-wrapper">
  <div class="clear-block with-blocks" id="header">
	<div class="region region-header">
		<div class="inner">
		  <div class="content">
			<div class="clear-block" id="branding-wrapper">
			  <div id="branding">
				<div id="logo"> <a title="Home" rel="home" href="/"> <img src="static/images/logo-web.png" alt="Home"> </a></div>
				<div id="name-and-slogan">
				  <div id="site-name"> <a title="Home" rel="home" href="/">care2x</a></div>
				  <div id="site-slogan"> the open source hospital information system</div>
				</div>
			  </div>
			</div>
		  </div>
		</div>
	</div>
  </div>
</div>
<div id="main-columns-wrapper">
  <div id="main-columns">
    <div id="sidebar-first" class="clear-block first">
      <div class="region region-sidebar-first">
        <div id="block-menu-secondary-links" class="block block-menu">
          <div class="inner">
			<br /><br />
            <h2>Installation Steps</h2>
            <div class="content">
              <ul class="menu">
				{foreach from=$PHASE_LIST key=nr item=phase}
					 <li{if $PHASE_NUMBER eq $nr} class="current"{/if}>{$phase}</li>
				{/foreach}
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- /#sidebar-first -->
    <div id="main-wrapper" class="">
      <div id="main">
        <div id="page" class="clear-block"> <a id="main-content"></a>
          <div class="region region-content">
            <div class="content">
				<h2>{$INSTALLER_PHASE}</h2>