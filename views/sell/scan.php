<?php

/* @var $this yii\web\View */

app\assets\ScanAsset::register($this);

?>
<div id="video-container">
  <video id="video" playsinline></video>
  <div id="rect-container">

  </div>
</div>
<div id="ui">
  <header>
    <button id="play-pause-btn">Play</button>
    <button id="submit-btn">Sell</button>
  </header>

  <div id="predictions-cont">
    <div id="empty">

    </div>
    <div id="snapshots">

    </div>
  </div>
</div>
