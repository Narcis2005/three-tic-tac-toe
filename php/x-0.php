<?php
session_start();
// currentPos 00 which is the current player, 00 is 0 and 01 is x, 00 00 00 00 00 00 00 00 00 the cells where 00 is empty, 01 is 0 and 10 is x
   
    function handleClick($pos, $cell) {
        if(isset($_SESSION["win"])) {
            header("Location: ../index.php");
            return;
        }
        if(!isset($_SESSION["queue-0"]))
            $_SESSION["queue-0"] = [];
        if(!isset($_SESSION["queue-x"]))
            $_SESSION["queue-x"] = [];
        $chunks = [];

        $length = strlen($pos);
        $j = 0;
        // Loop through the string and extract each 2-character chunk
        for ($i = 0; $i < $length; $i += 2) {
            // Extract a substring of 2 characters starting at position $i
            $chunk = substr($pos, $i, 2);
            $chunks[$j] = $chunk;
            $j++;
        }
        if($chunks[0] == 00)
            $_SESSION["queue-0"][] = $cell;
        else  $_SESSION["queue-x"][] = $cell;
        if($chunks[$cell] == "00") {
            if($chunks[0] == "00") {
                $chunks[$cell] = "01";
                $chunks[0] = "01";
            }
            else{
                $chunks[$cell] = "10";
                $chunks[0] = "00";
            }
        }
        if(count($_SESSION["queue-0"]) > 3) { 
            $cellToRemove = array_shift($_SESSION["queue-0"]);
            $chunks[$cellToRemove] = "00";
        }
        if(count($_SESSION["queue-x"]) > 3) { 
            $cellToRemove = array_shift($_SESSION["queue-x"]);
            $chunks[$cellToRemove] = "00";
        }
        if(($chunks[1] == $chunks[2] && $chunks[1] == $chunks[3] && $chunks[1] != "00") || 
        ($chunks[4] == $chunks[5] && $chunks[4] == $chunks[6] && $chunks[4] != "00") || 
        ($chunks[7] == $chunks[8] && $chunks[7] == $chunks[9] && $chunks[7] != "00") || 
        ($chunks[1] == $chunks[4] && $chunks[1] == $chunks[7] && $chunks[1] != "00") ||
        ($chunks[2] == $chunks[5] && $chunks[2] == $chunks[8] && $chunks[2] != "00") ||
        ($chunks[3] == $chunks[6] && $chunks[3] == $chunks[9] && $chunks[3] != "00") ||
        ($chunks[3] == $chunks[6] && $chunks[3] == $chunks[9] && $chunks[3] != "00") ||
        ($chunks[1] == $chunks[5] && $chunks[1] == $chunks[9] && $chunks[1] != "00") ||
        ($chunks[3] == $chunks[5] && $chunks[3] == $chunks[7] && $chunks[3] != "00") 
        ) {
            if($chunks[0] == "00")
            $_SESSION["win"] = 01;
        else $_SESSION["win"] = 00;
        }
        $newPos = implode("", $chunks);
        $_SESSION["pos"] = $newPos;
        
        header("Location: ../index.php");
    }
    if(isset($_POST['cell-1'])) {
        $pos = $_POST['pos'];
        handleClick($pos, 1);
    }
    else if(isset($_POST['cell-2'])) {
        $pos = $_POST['pos'];
        handleClick($pos, 2);
    }
    else if(isset($_POST['cell-3'])) {
        $pos = $_POST['pos'];
        handleClick($pos, 3);
    }  else if(isset($_POST['cell-4'])) {
        $pos = $_POST['pos'];
        handleClick($pos, 4);
    }  else if(isset($_POST['cell-5'])) {
        $pos = $_POST['pos'];
        handleClick($pos, 5);
    }  else if(isset($_POST['cell-6'])) {
        $pos = $_POST['pos'];
        handleClick($pos, 6);
    }  else if(isset($_POST['cell-7'])) {
        $pos = $_POST['pos'];
        handleClick($pos, 7);
    }  else if(isset($_POST['cell-8'])) {
        $pos = $_POST['pos'];
        handleClick($pos, 8);
    }  else if(isset($_POST['cell-9'])) {
        $pos = $_POST['pos'];
        handleClick($pos, 9);
    }