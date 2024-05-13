<?php
class Set {
    private $elements = [];

    public function __construct(?array $array) {
        if (is_array($array)) { 
            $this->elements = $array;
        }
    }
    public function addPositionAndQueue($position, $queue) {
        if (!isset($this->elements[$position])) {
            $this->elements[$position] = array();
        }
        $this->elements[$position][] = $queue;
    }

    // public function remove($array) {
    //     $key = array_search($array, $this->elements);
    //     if ($key !== false) {
    //         unset($this->elements[$key]);
    //     }
    // }

    // public function getElements() {
    //     return $this->elements;
    // }
    public function isElementInSet($position, $queue) {
        if(!isset($this->elements[$position])) return false;
        foreach ($this->elements[$position] as $element) { 
            if($queue == $element) return true;
        }
        return false;
    }
}