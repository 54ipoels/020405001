<?php
$file = $nama_file.".pdf";
header('Content-type: application/pdf');
header('Content-Disposition: inline; filename="contoh.pdf "');
header('Content-Length: ' . filesize($file));
ob_clean();
flush();
readfile($file);
exit;

?>