isa<?php

define( 'ROOT', '' );
require_once ROOT . 'isa/includes/Page.inc.php';

PageStartup( array( 'authenticated', 'phpids' ) );

phpinfo();

?>
