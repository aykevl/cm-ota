<?php

require_once 'common.php';
$changes = loadChanges();

?>
<!DOCTYPE html>
<html>
	<head>
		<title>Unofficial S5 Mini ROMS</title>
		<meta name="viewport" content="width=device-width, initial-scale=1"/>
		<link rel="stylesheet" href="/android/common.css"/>
	</head>
	<body>

<h1>Unofficial CyanogenMod ROMs for the Samsung Galaxy S5 Mini</h1>

<p>See the forum discussion at <a href="http://forum.xda-developers.com/galaxy-s5-mini/development/g800f-m-y-cyanogenmod-13-0-g800f-m-y-t3234909">XDA Developers</a> for the sources of this ROM.

<table>
	<tr>
		<th>Filename:</th>
		<th>TWRP recovery:</th>
		<th>Build date:</th>
	</tr>
<?php foreach ($changes as $change) { ?>
	<tr>
		<td><a href="<?= esc($change['url']) ?>"><?= esc($change['filename']) ?></a></td>
		<td>
<?php if (isset($change['twrp-url'])) { ?>
			<a href="<?= esc($change['twrp-url']) ?>"><?= esc($change['twrp-filename']) ?></a>
<?php } ?>
		</td>
		<td><?= date('Y-m-d H:i', (int)$change['timestamp']) ?></td>
	</tr>
<?php } ?>
</table>

<p><strong>NOTE:</strong> These ROMs can be downloaded and used at your own risk. I'm not responsible (as much as possible under applicable law) when these don't work, your phone is bricked, your kittens are killed or your house is set to fire.</p>

<p>I have used <a href="https://blog.julianxhokaxhiu.com/how-the-cm-ota-server-works-and-how-to-implement-and-use-ours/">this guide</a> to get OTA to work. The source code is located at <a href="https://github.com/aykevl/cm-ota">GitHub.com</a>.</p>

</body>
</html>
