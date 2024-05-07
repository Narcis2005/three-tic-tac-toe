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

    <body class="main-page">
        <section class="title-section">
            <h1>Tic-tac-toe... kind of</h1>
        </section>

        <section class="button-section">
            <nav>
                <a href="multiplayer.php">
                    <button>Multiplayer</button>
                </a>
                <div class="singlepayer-div">
                    <h2>Singleplayer. Play as:</h2>
                    <div class="singleplayer-buttons">

                        <a href="singleplayer.php?player=x"><button>X</button></a>
                        <!-- <a href="singleplayer.php?player=0"><button>0</button></a> -->
                    </div>
                </div>
            </nav>

        </section>
    </body>

</html>