<?php
require_once __DIR__ . '/vendor/autoload.php';
ini_set('max_execution_time', 300);
ini_set("pcre.backtrack_limit", "1000000000");
ini_set('memory_limit', '-1');
ob_start();
?>
<!DOCTYPE html>
<html>
<head>
  <title>รายงานภาษีขาย</title>
  <style>
  </style>
</head>
<body>
<?php

$data = json_decode($_POST['data_tax'],  true);
print_r($data);
?>
</body>
</html>