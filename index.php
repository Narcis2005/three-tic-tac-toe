<?php 
    session_start();
    if(!isset($_SESSION["pos"])){
    $_SESSION["pos"] = "00000000000000000000";
    }
?>
<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
        <link rel="stylesheet" href="styles.css">
    </head>

    <body>
        <?php function getCellValue($cell, $pos) {
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
            if($chunks[$cell] == "01") return "0";
            else if($chunks[$cell] == "10") return "X";
            else return "";
        }
        if(isset($_SESSION["win"])){
            if($_SESSION["win"] == 00) 
               echo "0 won";
            else echo "x won";
        }
?>

        <section class="section-table">
            <form action="php/x-0.php" method="post" class="form-table">
                <input type="submit" value="<?php echo( getCellValue(1,$_SESSION['pos'] )); ?>" name="cell-1" />
                <input type="submit" value="<?php echo( getCellValue(2,$_SESSION['pos'] )); ?>" name="cell-2" />
                <input type="submit" value="<?php echo( getCellValue(3,$_SESSION['pos'] )); ?>" name="cell-3" />
                <input type="submit" value="<?php echo( getCellValue(4,$_SESSION['pos'] )); ?>" name="cell-4" />
                <input type="submit" value="<?php echo( getCellValue(5,$_SESSION['pos'] )); ?>" name="cell-5" />
                <input type="submit" value="<?php echo( getCellValue(6,$_SESSION['pos'] )); ?>" name="cell-6" />
                <input type="submit" value="<?php echo( getCellValue(7,$_SESSION['pos'] )); ?>" name="cell-7" />
                <input type="submit" value="<?php echo( getCellValue(8,$_SESSION['pos'] )); ?>" name="cell-8" />
                <input type="submit" value="<?php echo( getCellValue(9,$_SESSION['pos'] )); ?>" name="cell-9" />
                <input type="hidden" value="<?php echo($_SESSION['pos']);?>" name="pos" />
            </form>
        </section>
        <div>

            <form action="php/clear-session.php" method="post">
                <input type="submit" value="Clear session" />
            </form>
        </div>
    </body>

</html>