isa<?php

define( 'ROOT', '' );
require_once ROOT . 'isa/includes/Page.inc.php';

PageStartup( array( 'phpids' ) );

$page = PageNewGrab();
$page[ 'title' ]   = 'About' . $page[ 'title_separator' ].$page[ 'title' ];
$page[ 'page_id' ] = 'about';

$page[ 'body' ] .= "
<div class=\"body_padded\">
	<h2>About</h2>
	<p> Hello welcome to ISA project on SQL Injection. </p>

</div>\n";

HtmlEcho( $page );

exit;

?>
