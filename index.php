<?php

require_once 'common.php';
$changes = array_reverse(loadChanges());

?>
<!DOCTYPE html>
<html>
	<head>
		<title>Unofficial S5 Mini ROMS</title>
		<meta name="viewport" content="width=device-width, initial-scale=1"/>
		<link rel="stylesheet" href="/android/common.css"/>
	</head>
	<body>

<h1>Unofficial LineageOS ROMs for the Samsung Galaxy S5 Mini (G800F)</h1>

<p>See the forum discussion at <a href="https://forum.xda-developers.com/galaxy-s5-mini/development/g800f-m-y-lineageos-14-1-g800f-m-y-t3549055">XDA Developers</a> for the sources of this ROM.

<p>
	<a href="<?= esc($changes[0]['url']) ?>" class="download">Download <?= esc($changes[0]['rom-name'] . ' ' . $changes[0]['rom-version']) ?></a>
	<!--<a href="<?= esc($changes[0]['twrp-url']) ?>" class="download">Download recovery</a>-->
</p>

<h2>Older releases</h2>

<p>These files are sorted from newest to oldest.</p>

<table>
	<thead>
		<tr>
			<th>Build date</th>
			<th>OS</th>
			<th>Recovery</th>
		</tr>
	</thead>
	<tbody>
<?php foreach ($changes as $change) { ?>
		<tr>
			<td><?= date('Y-m-d H:i', (int)$change['timestamp']) ?></td>
			<td><a href="<?= esc($change['url']) ?>" title="<?= esc($change['filename']) ?>"><?= esc($change['rom-name'] . ' ' . $change['rom-version']) ?></a></td>
			<td>
<?php if (isset($change['twrp-url'])) { ?>
				<a href="<?= esc($change['twrp-url']) ?>" title="<?= esc($change['twrp-filename']) ?>">TWRP</a>
<?php } ?>
			</td>
		</tr>
	</tbody>
<?php } ?>
</table>

<p><strong>NOTE:</strong> These ROMs can be downloaded and used at your own risk. I'm not responsible (as much as possible under applicable law) when these don't work, your phone is bricked, your kittens are killed or your house is set to fire.</p>

<p>I have used <a href="https://blog.julianxhokaxhiu.com/how-the-cm-ota-server-works-and-how-to-implement-and-use-ours/">this guide</a> to get OTA to work. The source code is located at <a href="https://github.com/aykevl/cm-ota">GitHub.com</a>.</p>

</body>
</html>
