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
        $X0 = new X0($_SESSION["pos"] ?? null);
        if(isset($_SESSION["bestMove"])){
               echo $_SESSION["bestMove"];

        }
?>

    <body class="board-page">
        <section class="player-section">
            <?php   if(isset($_SESSION["win"])){
            if($_SESSION["win"] == 10) 
               echo "<p>X won</p>";
            else echo "<p>0 won</p>";
            
        }
        else {?>
            <p><?php echo $X0->getCharacterTurn()  ?> to play</p>
            <?php  }?>

        </section>
        <section class="section-table">
            <form action="php/x-0.inc.php" method="post" class="form-table">
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