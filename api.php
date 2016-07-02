<?php

require_once 'common.php';


if (substr($_SERVER['REQUEST_URI'], 0, strlen($PATH_PREFIX)) !== $PATH_PREFIX) {
	header('Status: 404');
	exit('Not a valid prefix URL');
}

$api_url = substr($_SERVER['REQUEST_URI'], strlen($PATH_PREFIX));

if ($api_url === '/api') {
	$data = [
		'id'     => null,
		'result' => loadChanges(),
		'error'  => null,
	];
	send_json($data);
} else if ($api_url === '/api/v1/build/get_delta') {
	$data = [
		'errors' => [
			'message' => 'Delta not implemented',
		],
	];
	send_json($data);
} else {
	header('Status: 404');
	exit('Not a valid API URL');
}
