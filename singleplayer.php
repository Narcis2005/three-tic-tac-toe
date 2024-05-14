<?php 
    require_once("php/x-0.php");
    session_start();
    ?>
<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
        <link rel="stylesheet" href="styles.css">
    </head>
    <?php 
        
        $initialGame = "10000000000000000000";
        $playerParam = '';
        if(isset($_GET['player'])) {
            $player = $_GET['player'];
            $playerParam = isset($player) ? '?player=' . urlencode($player) : '';
        }
        function getRandomGeneratedInitialPosition() {
            $pos = "01";
            $randomNumber = mt_rand(1, 9);
            for($j = 1; $j<=9; $j++) {
                if($j == $randomNumber) $pos .= "10";
                else $pos .= "00";
            }
            return[$randomNumber, $pos];
        }
        $queue = [];
        
        if($player == '0') {
            $result = getRandomGeneratedInitialPosition();
            $queueIndex = $result[0];
            $initialGame = $result[1];
            $queue = [$queueIndex];
         }
         if(!isset($_SESSION["pos"])) {
         $_SESSION["pos"] = $initialGame;
        }
        if(!isset($_SESSION["queue"])) {
            $_SESSION["queue"] = $queue;
           }
        $playAs = $player == "x" ? X0::X_MARK : X0::O_MARK;
        $X0 = new X0($_SESSION["pos"] ?? $initialGame, $_SESSION["queue"] ?? $queue);
      
      
?>

    <body class="board-page">
        <section class="player-section">
            <?php   if(isset($_SESSION["win"])){
            if($_SESSION["win"] == $playAs) 
               echo ("<p class='color-0'>You won</p>");
            else echo ("<p class='color-X'>You lose</p>");
            
        }
        else {?>
            <p>You play as <?php  echo $player?></p>
            <?php  }?>

        </section>
        <?php   if(isset($_SESSION["bestMove"]))
            echo $_SESSION["bestMove"];?>
        <section class="section-table">
            <form action="php/x-0-singleplayer.inc.php<?php echo $playerParam ;?>" method="post" class="form-table">
                <div>
                    <?php for($i = 1; $i<=3; $i++) {
                        echo ("<input type='submit' class='".$X0->getClassForCellAge($i)."' value='".$X0->getCellValue($i)."' name='cell-".$i. "'/>");                    } ?>
                </div>
                <div>
                    <?php for($i = 4; $i<=6; $i++) {
                        echo ("<input type='submit' class='".$X0->getClassForCellAge($i)."' value='".$X0->getCellValue($i)."' name='cell-".$i. "'/>");                } ?>
                </div>
                <div>
                    <?php for($i = 7; $i<=9; $i++) {
                        echo ("<input type='submit' class='".$X0->getClassForCellAge($i)."' value='".$X0->getCellValue($i)."' name='cell-".$i. "'/>");                } ?>
                </div>

            </form>
        </section>
        <div class="reset-position">

            <form action="php/clear-session.php" method="post">
                <input type="submit" value="Reset" />
            </form>
        </div>
    </body>

</html>