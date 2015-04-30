<?php
ini_set('auto_detect_line_endings',true);

$filename = ('data.dat');

$lines = explode(PHP_EOL, file_get_contents('datos/'.$filename));
$spread = array();

for($i = 0; $i < count($lines); $i++){
    //echo $lines[$i].'<br>';
    $data = preg_split("/[\t]/", $lines[$i]);
    print_r($data);
    echo '<br>';
}