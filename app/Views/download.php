<?php

$file_path = "stat.csv";

// Set the appropriate headers for file download
header('Content-Type: application/octet-stream');
header('Content-Disposition: attachment; filename="' . basename($file_path) . '"');
header('Content-Length: ' . filesize($file_path));

// Output the file content
readfile($file_path);
//exit;
?>
