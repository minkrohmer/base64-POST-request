<?php 
// gets data from the body of the received POST request
$data = file_get_contents('php://input');
// base64 encodes the body from the received POST request
$postbody = base64_encode ($data);

$url = 'http://api.mixpanel.com/track/';

// settings for the POST request to mixpanel
$options = array(
    'http' => array(
        'header' => "Content-Type: application/json",
        'method' => 'POST',
        'content' => 'data=' . $postbody,
        ),
    );
$context  = stream_context_create($options);

// sends a POST request to mixpanel with the base64 encoded JSON object as the request body
$fp = fopen($url, 'r', false, $context);
fpassthru($fp);
fclose($fp);
