<?php
require_once("x-0.php");
require_once("queue.php");
require_once("set.php");
class X0Controller extends X0{
    protected $queue;
    protected $isGameWon;
    protected $set;
    public function __construct( ?string $gameState, ?array $queue = [], ?array $set = []) {
        parent::__construct($gameState);
        $this->queue = new Queue(6, $queue);
        $this->checkWinningConditions();
        $this->set = new Set($set);
    }

    protected function isCellOccupied ($cell):bool {
        if($this->chunks[$cell] == "00")  return false;
        return true;
    }
    private function addCellToQueue ($cell):void {
        $cellToRemove = $this->queue->addCellToQueue( $cell);
        if( $cellToRemove ) $this->chunks[$cellToRemove] = "00";
    }
    private function addCellToChunks($cell):void {
        $this->chunks[$cell] = $this->turn;
    }
    private function changeTurn():void {
        if( $this->isGameWon ) return;
        if($this->turn == "10") {
            $this->turn = "01";
        }
        else{
            $this->turn = "10";
        }
    }
    private function checkWinningConditions(): void {
        $winningConditions = [
            [1, 2, 3], [4, 5, 6], [7, 8, 9], // Rows
            [1, 4, 7], [2, 5, 8], [3, 6, 9], // Columns
            [1, 5, 9], [3, 5, 7]             // Diagonals
        ];

        foreach ($winningConditions as $condition) {
            [$a, $b, $c] = $condition;
            if ($this->chunks[$a] !== "00" && $this->chunks[$a] === $this->chunks[$b] && $this->chunks[$b] === $this->chunks[$c]) {
                $this->isGameWon = $this->turn;
                return;
            }
        }
    }
    public function makeTurn($cell):string {
        if($this->isCellOccupied($cell)) return $this->gameState;
        if($this->isGameWon) return $this->gameState;
        $this->addCellToQueue($cell);
        $this->addCellToChunks($cell);
        $this->checkWinningConditions();
        $this->changeTurn();
        $this->chunks[0] = $this->turn;
        $this->gameState = implode("", $this->chunks);
        return $this->gameState;
    }
    public function getQueue(): array {
        return $this->queue->getElements();
    }

    public function getIsGameWon(): ?string {
        return $this->isGameWon;
    }
}