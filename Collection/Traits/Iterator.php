<?php

namespace Collection\Traits;

trait Iterator
{
    private $data;
        
    public function current()
    {
        return $this->data->current();
    }

    public function key()
    {
        return $this->data->key();
    }

    public function next()
    {
        $this->data->next();
    }

    public function rewind()
    {
        $this->data->rewind();
    }

    public function valid()
    {
        return $this->data->valid();
    }

    public function append($item)
    {
        $this->data[] = $item;
    }
}
