<?php 
    include("php/x-0.php");
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
        $playAs = "10";
        $X0 = new X0($_SESSION["pos"] ?? null);
        $playerParam = '';
        if(isset($_GET['player'])) {
            $player = $_GET['player'];
            $playerParam = isset($player) ? '?player=' . urlencode($player) : '';
        }
      
?>

    <body class="board-page">
        <section class="player-section">
            <?php   if(isset($_SESSION["win"])){
            if($_SESSION["win"] == $playAs) 
               echo ("<p class='color-0'>You won</p>");
            else echo ("<p class='color-X'>You lose</p>");
            
        }
        else {?>
            <p>You play as <?php  echo $playAs == "10" ? "X" : "0"?></p>
            <?php  }?>

        </section>
        <?php   if(isset($_SESSION["bestMove"]))
            echo $_SESSION["bestMove"];?>
        <section class="section-table">
            <form action="php/x-0-singleplayer.inc.php<?php echo $playerParam ;?>" method="post" class="form-table">
                <?php for($i = 1; $i<=9; $i++) {
                    echo ("<input type='submit' class='color-".$X0->getCellValue($i)."' value='".$X0->getCellValue($i)."' name='cell-".$i. "'/>");
                } ?>
            </form>
        </section>
        <div class="reset-position">

            <form action="php/clear-session.php" method="post">
                <input type="submit" value="Reset" />
            </form>
        </div>
    </body>

</html>