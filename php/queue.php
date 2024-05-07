<?php
class Queue {
    private $length;
    private $elements = [];
    public function __construct($length, $elements = []) { 
        $this->length = $length;
        if (is_array($elements)) {
            $this->elements = $elements;
        }
    }
    public function addCellToQueue ($cell) {
        $this->elements[] = $cell;
        if(count($this->elements) > $this->length) { 
            $cellToRemove = array_shift($this->elements);
            return $cellToRemove;
        }
        return null;
    }
    public function getElements () { 
        return $this->elements;
    }
}