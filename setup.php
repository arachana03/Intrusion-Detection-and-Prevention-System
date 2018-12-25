isa<?php

define( 'ROOT', '' );
require_once ROOT . 'isa/includes/Page.inc.php';

PageStartup( array( 'phpids' ) );

$page = PageNewGrab();
$page[ 'title' ]   = 'Setup' . $page[ 'title_separator' ].$page[ 'title' ];
$page[ 'page_id' ] = 'setup';

if( isset( $_POST[ 'create_db' ] ) ) {
	// Anti-CSRF
	checkToken( $_REQUEST[ 'user_token' ], $_SESSION[ 'session_token' ], 'setup.php' );

	if( $DBMS == 'MySQL' ) {
		include_once ROOT . 'isa/includes/DBMS/MySQL.php';
	}
	elseif($DBMS == 'PGSQL') {
		// include_once ROOT . 'isa/includes/DBMS/PGSQL.php';
		MessagePush( 'PostgreSQL is not yet fully supported.' );
		PageReload();
	}
	else {
		MessagePush( 'ERROR: Invalid database selected. Please review the config file syntax.' );
		PageReload();
	}
}

// Anti-CSRF
generateSessionToken();

$page[ 'body' ] .= "
<div class=\"body_padded\">
	<h1>Database Setup <img src=\"" . ROOT . "isa/images/spanner.png\" /></h1>

	<p>Click on the 'Create / Reset Database' button below to create or reset your database.<br />
	If you get an error make sure you have the correct user credentials in: <em>" . realpath(  getcwd() . DIRECTORY_SEPARATOR . "config" . DIRECTORY_SEPARATOR . "config.inc.php" ) . "</em></p>

	<p>If the database already exists, <em>it will be cleared and the data will be reset</em>.<br />
	You can also use this to reset the administrator credentials (\"<em>admin</em> // <em>password</em>\") at any stage.</p>
	<hr />
	<br />

	<h2>Setup Check</h2>

	{$ISAOS}<br />
	Backend database: <em>{$DBMS}</em><br />
	PHP version: <em>" . phpversion() . "</em><br />
	<br />
	{$SERVER_NAME}<br />
	<br />
	{$phpDisplayErrors}<br />
	{$phpSafeMode}<br/ >
	{$phpURLInclude}<br/ >
	{$phpURLFopen}<br />
	{$phpMagicQuotes}<br />
	{$phpGD}<br />
	{$phpMySQL}<br />
	{$phpPDO}<br />
	<br />
	{$MYSQL_USER}<br />
	{$MYSQL_PASS}<br />
	{$MYSQL_DB}<br />
	{$MYSQL_SERVER}<br />
	<br />
	{$Recaptcha}<br />
	<br />
	{$UploadsWrite}<br />
	{$PHPWrite}<br />
	<br />
	<br />
	{$bakWritable}
	<br />
	<i><span class=\"failure\">Status in red</span>, indicate there will be an issue when trying to complete some modules.</i><br />
	<br />
	If you see disabled on either <i>allow_url_fopen</i> or <i>allow_url_include</i>, set the following in your php.ini file and restart Apache.<br />
	<pre><code>allow_url_fopen = On
allow_url_include = On</code></pre>
	These are only required for the file inclusion labs so unless you want to play with those, you can ignore them.

	<br /><br /><br />

	<!-- Create db button -->
	<form action=\"#\" method=\"post\">
		<input name=\"create_db\" type=\"submit\" value=\"Create / Reset Database\">
		" . tokenField() . "
	</form>
	<br />
	<hr />
</div>";

HtmlEcho( $page );

?>
