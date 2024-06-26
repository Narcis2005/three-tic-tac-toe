<?php
require_once("x-0.controller.php");
require_once("set.php");

class X0Bot extends X0Controller {
    private $player;
    static $set;
    public function __construct( $gameState, $queue=[], $player) {
        parent::__construct($gameState, $queue);
        if($player == "x") {
            $this->player = X0::X_MARK;
        }
        else $this->player = X0::O_MARK;
    }
     private function getChunks():array {
        return $this->chunks;
    }
     private function getGameState() {
        return $this->gameState;
    }

   
    public function bestMove($turn) {
        if ($this->isGameWon) {
            return null;
        }
                
        $winningMove = $this->findWinningMove($turn,$turn)[0];
        $winningDepth = $this->findWinningMove($turn,$turn)[1];
    
        $blockingMove = $this->findBlockingMove($turn)[0];
        $blockingDepth = $this->findBlockingMove($turn)[1];

        if($winningMove != null && $blockingMove == null) return $winningMove;
        else if($blockingMove != null && $winningMove == null) return $blockingMove;

        //If there is both a winning move and a blocking move, play the one with the highest depth (the one that would happen first)
        if($blockingMove != null && $winningMove != null) {
            if($winningDepth >= $blockingDepth ) return $winningMove;
            else if($blockingDepth > $winningDepth) return $blockingMove;
        }

        // If none of the above, play randomly
        return $this->getRandomMove();
    }
    
    private function findWinningMove($turn, $currentTurn ,$originalCell=0, $maxDepth=6) {
        if ($this->isGameWon || $maxDepth == 0) {
            return array(null, null);
        }

        $chunks = $this->getChunks();

        // Check each cell to find the best move
        for ($cell = 1; $cell <= 9; $cell++) {
            if (!$this->isCellOccupied($cell)) {
                $tempChunks = $chunks;
                //This line is for blocking move, where it's needed to simulate the game from the other player perspective
                $tempChunks[0] = $currentTurn;
                $tempGameState = implode("", $tempChunks);

                // Create a temporary class with the simulated game state
                $newClass = new X0Bot($tempGameState, $this->queue->getElements(), $this->player);
                $newClass->makeTurn($cell);

                //Check if this position is aleardy in the set. If it's not add it
                if(X0Bot::$set->isElementInSet($newClass->gameState, $newClass->queue->getElements())) return;
                X0Bot::$set->addPositionAndQueue( $newClass->getGameState(), $newClass->queue->getElements()); //for value,not reference
            
                // If this move leads to winning the game, return the cell
                if ($newClass->getIsGameWon() == $turn) {
                    if($originalCell != 0)
                        return array($originalCell, $maxDepth);
                    return array($cell, $maxDepth);
                }
                else  {
                    $otherTurn = $currentTurn == X0::X_MARK ? X0::O_MARK : X0::X_MARK;
                    if($originalCell != 0)
                        $newClass->findWinningMove($turn, $otherTurn,$originalCell, $maxDepth-1 );
                    else $newClass->findWinningMove($turn,$otherTurn, $cell, $maxDepth-1 );}
            }
        }
    }
    
    private function findBlockingMove($turn) {
        $opponentTurn = ($turn == '10') ? '01' : '10';
        return $this->findWinningMove($opponentTurn,$opponentTurn);
    }
    
    
    private function getRandomMove() {
         // If center is free, play it
        if($this->chunks[5] == X0::EMPTY_CELL) return 5;
        //If not, play a random move
        $validIndices = [];

        foreach ($this->chunks as $key => $value) {
            if ($value === X0::EMPTY_CELL) {
                $validIndices[] = $key;
            }
        }
        // If no elements meet the condition, return null
        if (empty($validIndices)) {
            return null;
        }
        $randomIndex = array_rand($validIndices);
        return $validIndices[$randomIndex];
    }
    
    
    public function makeBotMove() {
        if($this->turn != $this->player && $this->isGameWon == "") {
            $this->makeTurn($this->bestMove($this->turn));
        }
        return $this->gameState;
    }
}
X0Bot::$set = new Set([]);