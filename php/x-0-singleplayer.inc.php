<?php
    session_start();
    require_once ("./x-0-bot.php");
    for ($i = 1; $i <= 9; $i++) {
        $cellName = 'cell-' . $i;
        if (isset($_POST[$cellName] )&& isset($_GET["player"])) {
            
            $pos = $_SESSION["pos"] ?? null;
            $queue = $_SESSION["queue"] ?? null;
            $x0Bot = new X0Bot($pos, $queue, $_GET["player"]);
            $x0Bot->makeTurn($i);
            $_SESSION["pos"] = $x0Bot->makeBotMove();
            $_SESSION["queue"] =  $x0Bot->getQueue();

            $_SESSION["win"] =  $x0Bot->getIsGameWon();
           
            $playerParam = isset($_GET["player"]) ? '?player=' . urlencode($_GET["player"]) : '';
            header("Location: ../singleplayer.php".$playerParam."");
            break;
        }
    }