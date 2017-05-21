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

  <link rel="stylesheet" href="https://unpkg.com/material-components-web@latest/dist/material-components-web.min.css" />
  <link rel="stylesheet" href="common.css" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons" />

</head>
<body class="mdc-typography">

  <header class="mdc-toolbar mdc-toolbar--fixed mdc-toolbar--waterfall">
    <div class="mdc-toolbar__row">
      <section class="mdc-toolbar__section mdc-toolbar__section--align-start">
        <span class="mdc-toolbar__title">Downloads for S5 mini</span>
      </section>
    </div>
  </header>

  <main class="mdc-toolbar-fixed-adjust">
    <div class="page__content">
      <div class="heading">
        <h1 class="mdc-typography--display1">Unofficial LineageOS ROMs for the Samsung Galaxy S5 Mini <small>(G800F)</small></h1>
        <p class="mdc-typography--body1">
          See the forum discussion at <a href="https://forum.xda-developers.com/galaxy-s5-mini/development/g800f-m-y-lineageos-14-1-g800f-m-y-t3549055">XDA Developers</a> for the sources of this ROM.
        </p>
        <a href="<?= esc($changes[0]['url']) ?>" class="mdc-button mdc-button--raised mdc-button--primary" data-mdc-auto-init="MDCRipple">Download <?= esc($changes[0]['rom-name'] . ' ' . $changes[0]['rom-version']) ?></a>
        <a href="<?= esc($changes[0]['twrp-url']) ?>" class="mdc-button mdc-button--raised mdc-button--accent" data-mdc-auto-init="MDCRipple">Download TWRP</a>
      </div>

      <h2 class="mdc-typography--title">Older releases</h2>
      <p class="mdc-typography--body1">These files are sorted from newest to oldest.</p>

      <ul class="mdc-list">
        <?php foreach ($changes as $change) { ?>
        <li class="mdc-list-item">
          <span class="mdc-list-item__text">
            <?= date('Y-m-d H:i', (int)$change['timestamp']) ?>
            <span class="mdc-list-item__text__secondary"><?= esc($change['rom-name'] . ' ' . $change['rom-version']) ?></span>
          </span>
          <a href="<?= esc($change['url']) ?>" title="<?= esc($change['filename']) ?>" class="mdc-list-item__end-detail mdc-button mdc-button--compact">
            Download
          </a>
        </li>
        <?php } ?>
      </ul>

      <p class="mdc-typography--body1">
        <b>NOTE:</b> These ROMs can be downloaded and used at your own risk. I'm not responsible (as much as possible under applicable law) when these don't work, your phone is bricked, your kittens are killed or your house is set to fire.
      </p>
      <p class="mdc-typography--body1">
        I have used <a href="https://blog.julianxhokaxhiu.com/how-the-cm-ota-server-works-and-how-to-implement-and-use-ours/">this guide</a> to get OTA to work. The source code is located at <a href="https://github.com/aykevl/cm-ota">GitHub.com</a>.
      </p>
    </div>
  </main>
  <footer class="footer">
    <div class="footer__content">
      <p class="mdc-typography--body2">&copy; 2017. All rights reserved.</p>
    </div>
  </footer>
  <script src="https://unpkg.com/material-components-web@latest/dist/material-components-web.min.js"></script>
  <script>
  mdc.autoInit();
  var toolbar = mdc.toolbar.MDCToolbar.attachTo(document.querySelector('.mdc-toolbar'));
  toolbar.fixedAdjustElement = document.querySelector('.mdc-toolbar-fixed-adjust');

  for (var links = document.links, i = 0, a; a = links[i]; i++) {
    if (a.host !== location.host) {
      a.target = '_blank';
    }
  }
  </script>

</body>
</html>
