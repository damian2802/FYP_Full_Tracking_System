<?php
$file = $_GET['file'];

header("content-type: application/pdf");
readfile($file);
?>
