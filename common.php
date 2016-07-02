<?php


$ORIGIN = 'https://aykevl.nl';
$PATH_PREFIX = '/android';
$BASE_URL = $ORIGIN . $PATH_PREFIX;
$ROM_PATH = 'roms/';
$ROM_URL = $BASE_URL . '/roms/';

function loadChanges() {
	global $BASE_URL, $ROM_PATH, $ROM_URL;
	$result = [];
	foreach (scandir($ROM_PATH) as $fn) {
		// Only include actual zips (roms)
		if ($fn[0] == '.')
			continue;
		if (substr($fn, -4) != '.zip')
			continue;

		$changesFile = substr($fn, 0, -4) . '.txt';
		if (!file_exists($ROM_PATH . $changesFile))
			continue;
		$changesURL = $ROM_URL . $changesFile;

		$path = $ROM_PATH . $fn;

		$path_md5 = $path . '.md5sum';
		if (!file_exists($path_md5))
			continue;
		$md5sum = substr(trim(file_get_contents($path_md5)), 0, 32);

		$result[] = [
			'incremental' => null,
			'api_level'   => 23,
			'url'         => $ROM_URL . rawurlencode($fn),
			'timestamp'   => (string)filemtime($path),
			'md5sum'      => $md5sum,
			'changes'     => $changesURL,
			'channel'     => 'nightly',
			'filename'    => $fn,
		];
	}
	return $result;
}

function esc($text) {
	return htmlspecialchars($text, ENT_QUOTES|ENT_HTML5);
}

function send_json($data) {
	header('Content-Type: application/json');
	print json_encode($data, JSON_PRETTY_PRINT|JSON_UNESCAPED_SLASHES);
	exit();
}
