<?php
$data = file_get_contents("proc.json");
$jsons = json_decode($data, true);
if (empty($jsons)) {
    echo "json is empty\n";
    exit;
}

$header = "";
$content = "";

foreach($jsons["rows"] as $key => $value) {
    // header
    foreach ($value as $key2 => $v) {
        if ($key == 0) {
            $header = $header . $key2 . ",";
        }
        if ($key2 == "html") {
            $html = str_replace('"', "'", $v);
            $html = str_replace("\n",'', $html);
            $html = str_replace("\r\n",'', $html);
            $html = str_replace(",",' ', $html);
            $html = trim($html);
            $v = $html;
        }
        $v = str_replace(",",' ', $v);
        $content = $content . '"' . $v .'",';
    }
    $content = rtrim($content, ",") ."\n";
}
$header = $header . "\n";
$csv = $header . $content;
echo $csv;
?>
