<?php
include('vendor/rmccue/requests/library/Requests.php');
Requests::register_autoloader();
$headers = array();
$options = array('auth' => array('akhdaniel', 'v1tr41n1ng.com'));
$response = Requests::post('https://api.bukalapak.com/v2/authenticate.json', $headers, $options);
