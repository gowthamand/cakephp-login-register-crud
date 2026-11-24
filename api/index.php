<?php
// Vercel entrypoint: delegate to the CakePHP front controller.
// PHP_SELF includes the request path on Vercel, which breaks CakePHP's base-path detection.
$_SERVER['SCRIPT_NAME'] = '/index.php';
$_SERVER['PHP_SELF'] = '/index.php';
require __DIR__ . '/../webroot/index.php';
