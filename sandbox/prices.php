<?php

$urls = isset($_POST['urls']) ? $_POST['urls'] : null;

if (!is_array($urls)) {
    throw new Exception('Expecting urls array in post request.');
}

$response = array();
foreach ($urls as $url) {
    $response[$url] = rand(1, 100);
}

echo json_encode($response);