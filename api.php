<?php

require_once 'common.php';


if (substr($_SERVER['REQUEST_URI'], 0, strlen($PATH_PREFIX)) !== $PATH_PREFIX) {
	header('Status: 404');
	exit('Not a valid prefix URL');
}

$api_url = substr($_SERVER['DOCUMENT_URI'], strlen($PATH_PREFIX));

if ($api_url === '/api') {
	// Backwards compatibility with CyanogenMOD updater
	$result = [];
	foreach (loadChanges() as $r) {
		if ($r['api_level'] !== 23) {
			continue;
		}
		$result[] = $r;
	}
	$data = [
		'id'     => null,
		'result' => $result,
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
	$parts = explode('/', trim($api_url, '/'));
	if (count($parts) < 3) {
		header('Status: 404');
		exit('Not a valid API URL');
	}
	if ($parts[0] !== 'api' || $parts[1] !== 'v1') {
		header('Status: 404');
		exit('Not a valid API URL');
	}
	$result = [];
	foreach (loadChanges() as $r) {
		if ($r['api_level'] < 25) {
			continue;
		}
		if ($r['device'] !== $parts[2]) {
			continue;
		}
		$result[] = $r;
	}
	$data = [
		'id'       => null,    // unnecessary
		'response' => $result,
		'error'    => null,    // unnecessary
	];
	send_json($data);
}
