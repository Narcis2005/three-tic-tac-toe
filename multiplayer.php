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
        $X0 = new X0($_SESSION["pos"] ?? null, $_SESSION["queue"] ?? null );
        
    ?>

    <body class="board-page">
        <section class="player-section">
            <?php   if(isset($_SESSION["win"])){
            if($_SESSION["win"] == 10) 
               echo ("<p class='color-X'>X won</p>");
            else echo ("<p class='color-0'>0 won</p>");
            
        }
        else {?>
            <p><?php echo $X0->getCharacterTurn()  ?> to play</p>
            <?php  }?>

        </section>
        <section class="section-table">
            <form action="php/x-0.inc.php" method="post" class="form-table">
                <div>
                    <?php for($i = 1; $i<=3; $i++) {
                        echo ("<input type='submit' class='".$X0->getClassForCellAge($i)."' value='".$X0->getCellValue($i)."' name='cell-".$i. "'/>");
                    } ?>
                </div>
                <div>
                    <?php for($i = 4; $i<=6; $i++) {
                        echo ("<input type='submit' class='".$X0->getClassForCellAge($i)."' value='".$X0->getCellValue($i)."' name='cell-".$i. "'/>");
                    } ?>
                </div>
                <div>
                    <?php for($i = 7; $i<=9; $i++) {
                        echo ("<input type='submit' class='".$X0->getClassForCellAge($i)."' value='".$X0->getCellValue($i)."' name='cell-".$i. "'/>");
                    } ?>
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