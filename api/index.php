<?php
// Vercel entrypoint: delegate to the CakePHP front controller.
if (isset($_GET['__dbg'])) { header('Content-Type: text/plain'); print_r(array_intersect_key($_SERVER, array_flip(['REQUEST_URI','SCRIPT_NAME','SCRIPT_FILENAME','PHP_SELF','PATH_INFO','DOCUMENT_ROOT','QUERY_STRING','ORIG_PATH_INFO','PATH_TRANSLATED']))); exit; }
$_SERVER['SCRIPT_NAME'] = '/index.php';
require __DIR__ . '/../webroot/index.php';
