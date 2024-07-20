<?php

require_once 'Game.php';

// ゲームスタート
$game = new Game();
$game->BeforeStartGame()
     ->WarOfTrump();
