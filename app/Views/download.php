<?php
header('Content-Type: application/octet-stream');
header('Content-Disposition: attachment; filename="' . basename("stat.csv") . '"');
header('Content-Length: ' . filesize("stat.csv"));
readfile("stat.csv");
?>
