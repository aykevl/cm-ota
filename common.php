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

		$matches = [];
		if (preg_match('{^.*-(20[0-9]{6})-(UNOFFICIAL|NIGHTLY)-([a-z]+)\.zip$}', $fn, $matches) === false) {
			continue;
		}
		$twrpFile = "twrp-{$matches[1]}-{$matches[2]}-{$matches[3]}.img";
		$twrpURL = null;
		if (file_exists($ROM_PATH . $twrpFile)) {
			$twrpURL = $ROM_URL . rawurlencode($twrpFile);
		}

		$changesFile = substr($fn, 0, -4) . '.txt';
		if (!file_exists($ROM_PATH . $changesFile))
			continue;
		$changesURL = $ROM_URL . $changesFile;

		$path = $ROM_PATH . $fn;

		$path_md5 = $path . '.md5sum';
		if (!file_exists($path_md5))
			continue;
		$md5sum = substr(trim(file_get_contents($path_md5)), 0, 32);

		$buildPropLines = explode("\n", file_get_contents('zip://' . $ROM_PATH . $fn . '#system/build.prop'));
		$buildProp = [];
		foreach ($buildPropLines as $line) {
			if (strlen($line) == 0)
				continue;
			if ($line[0] === '#')
				continue;
			$pos = strpos($line, '=');
			if ($pos === false)
				continue;
			$key = substr($line, 0, $pos);
			$value = substr($line, $pos+1);
			$buildProp[$key] = $value;
		}

		$incremental = $buildProp['ro.build.version.incremental'];
		$api_level = (int)$buildProp['ro.build.version.sdk'];

		$rom_version = explode('-', $fn)[1];
		$rom_name = explode('-', $fn)[0];
		if ($rom_name === 'cm') {
			$rom_name = 'CyanogenMOD';
		} elseif ($rom_name == 'lineage') {
			$rom_name = 'LineageOS';
		}

		$result[] = [
			// Web frontend
			'twrp-filename' => $twrpFile,
			'twrp-url'      => $twrpURL,
			'device'        => $buildProp['ro.cm.device'],
			'rom-name'      => $rom_name,
			'rom-version'   => $rom_version,
			// Both ROMs
			'filename'      => $fn,
			'url'           => $ROM_URL . rawurlencode($fn),
			// LineageOS
			'datetime'      => $buildProp['ro.build.date.utc'],
			'romtype'       => 'nightly',
			// CyanogenMOD (deprecated)
			'incremental'   => null,
			'api_level'     => $api_level,
			'timestamp'     => $buildProp['ro.build.date.utc'],
			'md5sum'        => $md5sum,
			'changes'       => $changesURL,
			'channel'       => 'nightly',
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
