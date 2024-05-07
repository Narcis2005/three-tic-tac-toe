<?php
class Set {
    private $elements;

    public function __construct($elements = []) {
        if(is_array($elements))
            $this->elements = $elements;
          else  $this->elements = [];
    }

    public function add($element) {
        if (!$this->contains($element)) {
            $this->elements[] = $element;
        }
    }

    public function remove($element) {
        $index = array_search($element, $this->elements);
        if ($index !== false) {
            array_splice($this->elements, $index, 1);
        }
    }

    public function contains($element) {
        return in_array($element, $this->elements);
    }

    public function size() {
        return count($this->elements);
    }

    public function toArray() {
        return $this->elements;
    }

    public function clear() {
        $this->elements = [];
    }
}