<?php

/** @var yii\web\View $this */

use yii\helpers\Html;

$this->title = 'About';
$this->params['breadcrumbs'][] = $this->title;
?>
<div id="counter">-</div>
  <script src="https://unpkg.com/centrifuge@5.2.2/dist/centrifuge.js"></script>
  <script type="text/javascript">
    console.log('Test message')
    const container = document.getElementById('counter');

    // eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJzdWIiOiIxMjM3MjIiLCJleHAiOjE3NTUzNDY3MDcsImlhdCI6MTc1NDc0MTkwN30.yIofRZEpHxYc1PE7gRsCa9BFjtluGKo7aNgiLsL77L0
    // id=1 eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOiIxIn0.iGjP4pTz7khXDL3M65_phr9IvB_9lTiNsdbVCuRYhV8
    // id=22 eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOiIyMiJ9.JI0ZoAUi5LTQkzCO9X6fQvjE7WNHeMYLpOoc-9oaeQo
    const centrifuge = new Centrifuge("ws://localhost:9000/connection/websocket", {
      token: "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOiIxMDAifQ.-HZT7caj6DGUgUPdqShgAzqWMbXYA5AIVm8Dw7M5-as"
    });

    centrifuge.on('connecting', function (ctx) {
      console.log(`connecting: ${ctx.code}, ${ctx.reason}`);
    }).on('connected', function (ctx) {
      console.log(`connected over ${ctx.transport}`);
    }).on('disconnected', function (ctx) {
      console.log(`disconnected: ${ctx.code}, ${ctx.reason}`);
    }).connect();

    const sub = centrifuge.newSubscription("test_channel");

    sub.on('publication', function (ctx) {
      container.innerHTML = ctx.data.value;
      document.title = ctx.data.value;
    }).on('subscribing', function (ctx) {
      console.log(`subscribing: ${ctx.code}, ${ctx.reason}`);
    }).on('subscribed', function (ctx) {
      console.log('subscribed', ctx);
    }).on('unsubscribed', function (ctx) {
      console.log(`unsubscribed: ${ctx.code}, ${ctx.reason}`);
    }).subscribe();
  </script>