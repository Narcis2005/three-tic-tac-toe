<?php
require_once("x-0.php");
class X0Controller extends X0{
    protected $isGameWon;
   
   
    public function __construct( ?string $gameState, ?array $queue = []) {
        parent::__construct($gameState, $queue);
        $this->checkWinningConditions();
    }

    protected function isCellOccupied ($cell):bool {
        if($this->chunks[$cell] == X0::EMPTY_CELL)  return false;
        return true;
    }
   
    private function addCellToChunks($cell):void {
        $this->chunks[$cell] = $this->turn;
    }
    private function changeTurn():void {
        if( $this->isGameWon ) return;
        if($this->turn == X0::X_MARK) {
            $this->turn = X0::O_MARK;
        }
        else{
            $this->turn = X0::X_MARK;
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
            if ($this->chunks[$a] !== X0::EMPTY_CELL && $this->chunks[$a] === $this->chunks[$b] && $this->chunks[$b] === $this->chunks[$c]) {
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
    

    public function getIsGameWon(): ?string {
        return $this->isGameWon;
    }
}