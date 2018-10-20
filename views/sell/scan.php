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
    <h1>Testdrive</h1>
    <button id="play-pause-btn">Play</button>
    <input id="threshold" placeholder="threshold" />
  </header>

  <div id="predictions-cont">
    <div id="empty">

    </div>
    <ol id="predictions">

    </ol>
  </div>
</div>
