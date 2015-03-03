<?php
class PriorityQueue implements Iterator, Countable {
    /**
     * Extract the data.
     */
    const EXTR_DATA = 1;
    /**
     * Extract the priority.
     */
    const EXTR_PRIORITY = 2;
    /**
     * Extract an array containing both priority and data.
     */
    const EXTR_BOTH = 3;
    private $flags;
    private $items;

    public function __construct() {
        $this->flags = self::EXTR_DATA;
        $this->items = array();
    }

    function compare($priority1, $priority2) {}

    function count() {
        return count($this->items);
    }

    function extract() {
        $result = $this->current();
        $this->next();
        return $result;
    }

    function current() {
        switch ($this->flags) {
            case self::EXTR_BOTH:
                $result = $this->key() . ' - ' . current($this->items);
                break;
            case self::EXTR_DATA:
                $result = $this->key();
                break;
            case self::EXTR_PRIORITY:
                $result = current($this->items);
                break;
            default:
                $result = '';
        }
        return $result;
    }

    function key() {
        return key($this->items);
    }

    function next() {
        return next($this->items);
    }

    function insert($name, $priority) {
        $this->items[$name] = $priority;
        asort($this->items);
        return $this;
    }

    function isEmpty() {
        return empty($this->items);
    }

    function recoverFromCorruption() {}

    function rewind() {}

    function setExtractFlags($flags) {
        switch ($flags) {
            case self::EXTR_BOTH:
            case self::EXTR_DATA:
            case self::EXTR_PRIORITY:
                $this->flags = $flags;
                break;
        };
    }

    function valid() {
        return (null === key($this->items)) ? false : true;
    }
}?>