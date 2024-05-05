<?php

class Queue {
    private $queue;
    private $maxSize;

    public function __construct($maxSize = 3) {
        $this->queue = [];
        $this->maxSize = $maxSize;
    }

    public function enqueue($element) {
        if (count($this->queue) >= $this->maxSize) {
            array_shift($this->queue); // Remove oldest element
        }
        $this->queue[] = $element;
    }

    public function dequeue() {
        if ($this->isEmpty()) {
            return null;
        }
        return array_shift($this->queue);
    }

    public function isEmpty() {
        return empty($this->queue);
    }

    public function peek() {
        return reset($this->queue);
    }

    public function size() {
        return count($this->queue);
    }

    public function clear() {
        $this->queue = [];
    }
}

// Example usage
$queue = new Queue();

$queue->enqueue(1);
$queue->enqueue(2);
$queue->enqueue(3);
$queue->enqueue(4); // This will remove the oldest element (1)

echo "Queue size: " . $queue->size() . "\n"; // Output: Queue size: 3

while (!$queue->isEmpty()) {
    echo $queue->dequeue() . "\n"; // Output: 2 3 4
}