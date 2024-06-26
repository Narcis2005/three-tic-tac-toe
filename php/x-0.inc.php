<?php
    session_start();
    require_once ("./x-0.controller.php");
    for ($i = 1; $i <= 9; $i++) {
        $cellName = 'cell-' . $i;
        if (isset($_POST[$cellName])) {
            
            $pos = $_SESSION["pos"] ?? null;
            $queue = $_SESSION["queue"] ?? null;
            $x0Controller = new X0Controller($pos, $queue);
            $_SESSION["pos"] =  $x0Controller->makeTurn($i);
            $_SESSION["queue"] =  $x0Controller->getQueue();

            $_SESSION["win"] =  $x0Controller->getIsGameWon();
            header("Location: ../multiplayer.php");
            break;
        }
    }