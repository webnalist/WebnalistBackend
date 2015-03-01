<?php

$urls = $_POST['urls'];

if (!is_array($urls)) {
    throw new Exception('Expecting urls array in post request.');
}

$response = array();
foreach ($urls as $url) {
    $array[$url] = rand(1, 100);
}

echo json_encode($array);