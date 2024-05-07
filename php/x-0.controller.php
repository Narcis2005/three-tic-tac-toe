<?php
require_once("x-0.php");
require_once("queue.php");
require_once("set.php");
class X0Controller extends X0{


    protected $queue;
    protected $isGameWon;
    protected $set;
    public function __construct( $gameState, $queue=[], $set = []) {
        parent::__construct($gameState);
        $this->queue = new Queue(6, $queue);
        $this->modifyGameState();
        $this->set = new Set($set);
    }

    protected function isCellOccupied ($cell) {
        if($this->chunks[$cell] == "00")  return false;
        return true;
    }
    private function addCellToQueue ($cell) {
        $cellToRemove = $this->queue->addCellToQueue( $cell);
        if( $cellToRemove ) $this->chunks[$cellToRemove] = "00";
    }
    private function addCellToChunks($cell) {
        $this->chunks[$cell] = $this->turn;
    }
    private function changeTurn() {
        if( $this->isGameWon ) return;
        if($this->turn == "10") {
            $this->turn = "01";
        }
        else{
            $this->turn = "10";
        }
    }
    private function modifyGameState() {
        if(($this->chunks[1] == $this->chunks[2] && $this->chunks[1] == $this->chunks[3] && $this->chunks[1] != "00") || 
        ($this->chunks[4] == $this->chunks[5] && $this->chunks[4] == $this->chunks[6] && $this->chunks[4] != "00") || 
        ($this->chunks[7] == $this->chunks[8] && $this->chunks[7] == $this->chunks[9] && $this->chunks[7] != "00") || 
        ($this->chunks[1] == $this->chunks[4] && $this->chunks[1] == $this->chunks[7] && $this->chunks[1] != "00") ||
        ($this->chunks[2] == $this->chunks[5] && $this->chunks[2] == $this->chunks[8] && $this->chunks[2] != "00") ||
        ($this->chunks[3] == $this->chunks[6] && $this->chunks[3] == $this->chunks[9] && $this->chunks[3] != "00") ||
        ($this->chunks[3] == $this->chunks[6] && $this->chunks[3] == $this->chunks[9] && $this->chunks[3] != "00") ||
        ($this->chunks[1] == $this->chunks[5] && $this->chunks[1] == $this->chunks[9] && $this->chunks[1] != "00") ||
        ($this->chunks[3] == $this->chunks[5] && $this->chunks[3] == $this->chunks[7] && $this->chunks[3] != "00") 
        ) {
                $this->isGameWon = $this->turn;
        }
    }
    public function makeTurn($cell) {
        if($this->isCellOccupied($cell)) return $this->gameState;
        if($this->isGameWon) return $this->gameState;
        $this->addCellToQueue($cell);
        $this->addCellToChunks($cell);
        $this->modifyGameState();
        $this->changeTurn();
        $this->chunks[0] = $this->turn;
        $this->gameState = implode("", $this->chunks);
        return $this->gameState;
    }
    public function getQueue () {
        return $this->queue->getElements();
    }
    public function getIsGameWon() {
        return $this->isGameWon;
    }

   
   
 

   
}