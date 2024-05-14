<?php
require_once("queue.php");

class X0 {
    const X_MARK = "10";
    const O_MARK = "01";
    const EMPTY_CELL = "00";

    protected $chunks;
    protected $gameState;
    protected $turn;
    protected $queue;


    public function __construct($gameState = null, $queue = null) {
        $this->gameState = $gameState ?? self::X_MARK //the first turn is x
         . str_repeat(self::EMPTY_CELL, 9); //the board, that initially is empty
        $this->initiateChunksFromGameState($this->gameState);
        $this->turn = $this->chunks[0];
        $this->queue = new Queue(6, $queue);

    }
    protected function addCellToQueue ($cell):void {
        $cellToRemove = $this->queue->addCellToQueue( $cell);
        if( $cellToRemove ) $this->chunks[$cellToRemove] = X0::EMPTY_CELL;
    }
    private function initiateChunksFromGameState($pos) {
        $length = strlen($pos);
        $j = 0;
        for ($i = 0; $i < $length; $i += 2) {
            $chunk = substr($pos, $i, 2);
            $this->chunks[$j] = $chunk;
            $j++;
        }
    }

    public function getCellValue($cell) {
        switch ($this->chunks[$cell]) {
            case self::O_MARK:
                return "0";
            case self::X_MARK:
                return "X";
            default:
                return "";
        }
    }

    public function getTurn() {
        return $this->turn;
    }

    public function getCharacterTurn() {
        return ($this->turn == self::X_MARK) ? "X" : "0";
    }
    public function getQueue(): array {
        return $this->queue->getElements();
    }
    public function getClassForCellAge($cell) {
        if (!isset($this->queue)) {
            return null;
        }

        $cellValue = $this->getCellValue($cell);
        if ($cellValue === null) {
            return null;
        }

        $elements = $this->queue->getElements();
        $elementsCount = count($elements);
    
        for ($i = 0; $i < $elementsCount; $i++) {
            if ($cell == $elements[$i]) {
                $ageIndex = floor(($elementsCount - $i - 1) / 2);
    
                switch ($ageIndex) {
                    case 0:
                        return "blue";
                    case 1:
                        return "yellow";
                    case 2:
                        return "red";
                    default:
                        return null; 
                }
            }
        }
        
        return null;
    }
}