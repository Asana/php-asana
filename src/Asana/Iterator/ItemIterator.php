<?php

namespace Asana\Iterator;

class ItemIterator implements \Iterator
{
    public function __construct($pages)
    {
        $this->pages = $pages;
    }

    public function rewind()
    {
        $this->pages->rewind();
        $this->items = null;

        $this->item = null;
        $this->itemIndex = -1;

        $this->next();
    }

    public function next()
    {
        // if we don't have an items iterator try to get the next one
        while ($this->items == null || !$this->items->valid()) {
            $this->items = null;
            // no more pages
            if (!$this->pages->valid()) {
                break;
            }
            $array = $this->pages->current();
            if ($array) {
                $this->items = new \ArrayIterator($array);
                $this->items->rewind();
            }
            // advance the page iterator
            $this->pages->next();
        }

        if ($this->items) {
            $this->item = $this->items->current();
            $this->itemIndex++;
            // advance the item iterator
            $this->items->next();
        }
    }

    public function valid()
    {
        return $this->items != null;
    }

    public function current()
    {
        return $this->item;
    }

    public function key()
    {
        return $this->itemIndex;
    }
}
