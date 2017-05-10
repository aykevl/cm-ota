<?php

require_once 'common.php';
$changes = array_reverse(loadChanges());

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Unofficial S5 Mini ROMS</title>

  <link rel="stylesheet" href="https://code.getmdl.io/1.3.0/material.blue-pink.min.css" />
  <link rel="stylesheet" href="common.css" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

</head>
<body>

  <div class="mdl-layout mdl-js-layout mdl-layout--fixed-header">
    <header class="mdl-layout__header mdl-layout__header--waterfall">
      <div class="mdl-layout__header-row">
        <span class="mdl-layout-title">Downloads for S5 mini</span>
      </div>
    </header>

    <main class="mdl-layout__content">
      <div class="page-content">
        <div class="heading">
          <h3>Unofficial LineageOS ROMs for the Samsung Galaxy S5 Mini <small>(G800F)</small></h3>
          <p>
            See the forum discussion at <a href="https://forum.xda-developers.com/galaxy-s5-mini/development/g800f-m-y-lineageos-14-1-g800f-m-y-t3549055">XDA Developers</a> for the sources of this ROM.
          </p>
          <a href="<?= esc($changes[0]['url']) ?>" class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored mdl-js-ripple-effect">Download <?= esc($changes[0]['rom-name'] . ' ' . $changes[0]['rom-version']) ?></a>
          <a href="<?= esc($changes[0]['twrp-url']) ?>" class="mdl-button mdl-js-button mdl-button--raised mdl-button--accent mdl-js-ripple-effect">Download TWRP</a>
        </div>
        <h4>Older releases</h4>
        <p>These files are sorted from newest to oldest.</p>
        <table class="mdl-data-table mdl-js-data-table">
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
            	<td>
                <a href="<?= esc($change['url']) ?>" title="<?= esc($change['filename']) ?>"><?= esc($change['rom-name'] . ' ' . $change['rom-version']) ?></a>
              </td>
            	<td>
                <?php if (isset($change['twrp-url'])) { ?>
            		<a href="<?= esc($change['twrp-url']) ?>" title="<?= esc($change['twrp-filename']) ?>">TWRP</a>
                <?php } ?>
            	</td>
            </tr>
            <?php } ?>
          </tbody>
        </table>
        <br />
        <p>
          <b>NOTE:</b> These ROMs can be downloaded and used at your own risk. I'm not responsible (as much as possible under applicable law) when these don't work, your phone is bricked, your kittens are killed or your house is set to fire.
        </p>
        <p>
          I have used <a href="https://blog.julianxhokaxhiu.com/how-the-cm-ota-server-works-and-how-to-implement-and-use-ours/">this guide</a> to get OTA to work. The source code is located at <a href="https://github.com/aykevl/cm-ota">GitHub.com</a>.
        </p>
      </div>

      <footer class="mdl-mini-footer">
        <div class="mdl-mini-footer__left-section">
          <div class="mdl-logo">&copy; 2017. All rights reserved.</div>
        </div>
      </footer>
    </main>
  </div>

  <script defer src="https://code.getmdl.io/1.3.0/material.min.js"></script>

</body>
</html>
