<?php
    class X0 {
        protected $chunks;
        protected $gameState;
        protected $turn;
        public function __construct($gameState) {
            $this->gameState = $gameState;
            if($this->gameState == null){
                $this->gameState = "10" // 10 means that it's X's turn and 01 means it's 0's turn
                . "00" // the board itself
                . "00" // there will be 9 portions of 2 bits parts
                . "00" // 00 means that the square is empty
                . "00" // 01 means that 0 is in that square
                . "00" // 10 means that X is in that square
                . "00"
                . "00"
                . "00"
                . "00";
                }
            $this->initiateChunksFromGameState($this->gameState);
            $this->turn = $this->chunks[0];
        }
        private function initiateChunksFromGameState($pos) {
            $length = strlen($pos);
            $j = 0;
            // Loop through the string and extract each 2-character chunk
            for ($i = 0; $i < $length; $i += 2) {
                // Extract a substring of 2 characters starting at position $i
                $chunk = substr($pos, $i, 2);
                $this->chunks[$j] = $chunk;
                $j++;
            }
        }
        public function getCellValue($cell) {
            if($this->chunks[$cell] == "01") return "0";
            else if($this->chunks[$cell] == "10") return "X";
            else return "";
        }
        public function getTurn() {return $this->turn;}
        public function getCharacterTurn() {
            if($this->turn == "10") return "X";
            else return "0";
        }
    }