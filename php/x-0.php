<?php
class X0 {
    const X_MARK = "10";
    const O_MARK = "01";
    const EMPTY_CELL = "00";

    protected $chunks;
    protected $gameState;
    protected $turn;

    public function __construct($gameState = null) {
        $this->gameState = $gameState ?? self::X_MARK . str_repeat(self::EMPTY_CELL, 9);
        $this->initiateChunksFromGameState($this->gameState);
        $this->turn = $this->chunks[0];
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
}