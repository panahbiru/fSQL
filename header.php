<?php	
	$full_script_name = $_SERVER['SCRIPT_NAME'];
	$dirname = dirname($full_script_name);
	$script_name = basename($full_script_name);
	$conn = pg_connect("host=localhost port=5432 dbname=fsqlorg_site user=fsqlorg_guest password=shamwow");
	if($script_name !== 'index.php')
		$page_result = pg_query($conn, "SELECT title, menu_title FROM pages WHERE path='$full_script_name'");
	else
		$page_result = pg_query($conn, "SELECT title, menu_title FROM pages WHERE path='$dirname'");
	list($title, $menu_title) = pg_fetch_row($page_result);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en"><head>
  
  <title><?php echo $title; ?></title>
  <meta name="Author" content="Kaja Fumei, kaja.fumei@gmail.com" />
  <meta name="Description" content="Home of Flat-File SQL" />
  <meta name="Copyright" content="Copyright (C) 2006-2010, Kaja Fumei" />
  <meta name="Language" content="en" />
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <meta http-equiv="Content-Language" content="en" />
  <link rev="made" href="mailto:kaja.fumei@gmail.com" />
  <link rel="StyleSheet" href="/screen.css" type="text/css" media="screen" />
  <link rel="StyleSheet" href="/print.css" type="text/css" media="print" />
  <script type="text/javascript" src="/external.js"></script></head>

<body>

<!-- For non-visual or non-stylesheet-capable user agents -->
<div id="mainlink"><a href="#main">Skip to main content.</a></div>


<!-- ======== Header ======== -->

<div id="header">
  <div class="left">
    <a href="/index.php"><img src="/fSQL.png" alt="Flat-File SQL" height="60" width="375" /></a>
  </div>

  <div class="subheader">
    <span class="hidden">Navigation:</span>
<?php
	$topMenu = array(
		"Home" => "/index.php",
		"Documentation" => "/docs/index.php",
		"Downloads" => "/download.php",
		"Support" => "/support.php"
	);
	
	$menuCode = array();
	foreach($topMenu as $linkName => $linkAddress)
	{
		$class = ($linkAddress === $_SERVER['SCRIPT_NAME']) ? "class=\"highlight\"" : "";
		$menuCode[] =  "    <a $class href=\"$linkAddress\">$linkName</a>";
	}
	
	echo implode(" | \n", $menuCode);

?>

  </div>
</div>

<div id="sidebar">
  <div>

<?php
	if($dirname !== '/')
	{
		$result = pg_query($conn, "SELECT id, menu_title FROM pages WHERE path='$dirname'");
		$row = pg_fetch_row($result);
		echo "    <p class=\"title\"><a href=\"$dirname\">{$row[1]}</a></p>\n    <ul>\n";
		$side_menu_result = pg_query($conn, "SELECT path, menu_title FROM pages WHERE parent='{$row[0]}'");
		while ($side_menu_item = pg_fetch_row($side_menu_result)) {
			echo "      <li><a href=\"{$side_menu_item[0]}\">{$side_menu_item[1]}</a>\n";
		}
		
		$pieces = explode('/', $full_script_name);
		if(empty($pieces[0]))
			array_shift($pieces);
		array_pop($pieces); // script name
		if($script_name === 'index.php')
			array_pop($pieces);
	}
	else
		require "./sidebar.php";
?>

    </ul> 
  </div>
</div>


<!-- ======== Main Content ======== -->

<div id="main">

<div id="navhead">
  <hr />
  <span class="hidden">Path to this page:</span>
<?php
	if($dirname !== '/' && count($pieces) > 0)
	{
		$fullpath = "";
		foreach($pieces as $piece)
		{
			$fullpath .= "/$piece";
			$top_menu_result = pg_query($conn, "SELECT menu_title FROM pages WHERE path='$fullpath'");
			$top_menu_row = pg_fetch_row($top_menu_result);
			echo "  <a href=\"$fullpath\">{$top_menu_row[0]}</a> &raquo;\n";
		}
		echo "  $menu_title\n";
	}
?>

</div>