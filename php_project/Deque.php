<?php

class Deque {
    private $maxSize;
    private $deque;
    private $front;
    private $back;
    private $size;

    public function __construct($maxSize) {
        $this->maxSize = $maxSize;
        $this->deque = [];
        $this->front = 0;
        $this->back = -1;
        $this->size = 0;
    }

    public function pushBack($value) {
        if ($this->size == $this->maxSize) {
            return false;
        }
        $this->back = ($this->back + 1) % $this->maxSize;
        $this->deque[$this->back] = $value;
        $this->size++;
        return true;
    }

    public function pushFront($value) {
        if ($this->size == $this->maxSize) {
            return false;
        }
        $this->front = ($this->front - 1 + $this->maxSize) % $this->maxSize;
        $this->deque[$this->front] = $value;
        $this->size++;
        return true;
    }

    public function popBack() {
        if ($this->size == 0) {
            return false;
        }
        $value = $this->deque[$this->back];
        unset($this->deque[$this->back]);
        $this->back = ($this->back - 1 + $this->maxSize) % $this->maxSize;
        $this->size--;
        return $value;
    }

    public function popFront() {
        if ($this->size == 0) {
            return false;
        }
        $value = $this->deque[$this->front];
        unset($this->deque[$this->front]);
        $this->front = ($this->front + 1) % $this->maxSize;
        $this->size--;
        return $value;
    }

    public function getSize() {
        return $this->size;
    }

    public function isEmpty() {
        return $this->size == 0;
    }

    public function peekFront() {
        if ($this->isEmpty()) {
            return false;
        }
        return $this->deque[$this->front];
    }

    public function peekBack() {
        if ($this->isEmpty()) {
            return false;
        }
        return $this->deque[$this->back];
    }

    public function clear() {
        $this->deque = [];
        $this->front = 0;
        $this->back = -1;
        $this->size = 0;
    }
}

$maxSize = 5;
$deque = new Deque($maxSize);
$deque->pushBack(1);
$deque->pushFront(2);
$deque->pushBack(3);
$deque->pushFront(4);
$deque->pushBack(5);

echo $deque->popFront() . "\n";
echo $deque->popBack() . "\n";
echo $deque->popFront() . "\n";
echo $deque->popBack() . "\n";
echo $deque->popFront() . "\n";
echo $deque->popBack() . "\n";
