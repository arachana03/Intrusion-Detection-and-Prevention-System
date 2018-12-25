isa<?php

define( 'ROOT', '' );
require_once ROOT . 'isa/includes/Page.inc.php';

define( 'ROOT_TO_PHPIDS_LOG', 'external/phpids/' . PhpIdsVersionGet() . '/lib/IDS/tmp/phpids_log.txt' );
define( 'PHPIDS_LOG', ROOT.ROOT_TO_PHPIDS_LOG );

PageStartup( array( 'authenticated', 'phpids' ) );

$page = PageNewGrab();
$page[ 'title' ]   = 'PHPIDS Log' . $page[ 'title_separator' ].$page[ 'title' ];
$page[ 'page_id' ] = 'log';
// $page[ 'clear_log' ]; <- Was showing error.

$page[ 'body' ] .= "
<div class=\"body_padded\">
	<h1>PHPIDS Log</h1>

	<p>" . ReadIdsLog() . "</p>
	<br /><br />

	<form action=\"#\" method=\"GET\">
		<input type=\"submit\" value=\"Clear Log\" name=\"clear_log\">
	</form>

	" . ClearIdsLog() . "
</div>";

HtmlEcho( $page );

?>
