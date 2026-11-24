<?php
// Vercel entrypoint: delegate to the CakePHP front controller.
$_SERVER['SCRIPT_NAME'] = '/index.php';
require __DIR__ . '/../webroot/index.php';
