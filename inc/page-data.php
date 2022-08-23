<?php
$dir = "../apply/";
$scanned_files = array_diff(scandir($dir, 1), array('..', '.', 'index.php', 'forms'));
$total = count($scanned_files);

$pages = array();

for ($i = 0; $i < $total; $i++) {
    $str = $scanned_files[(2 + $i)];
    $id = substr($str, 16, 1);
    array_push($pages, array("id" => $id, "name" => ""));
}

print_r($pages);
