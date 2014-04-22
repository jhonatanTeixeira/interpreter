<?php

namespace Collection\Traits;

trait RecursiveIterator
{
    use Iterator;
    
    public function hasChildren()
    {
        if ((is_array($this->current()) || $this->current() instanceof \Traversable)
            && (false !== $this->current() && count($this->current()) > 0)) {
            return true;
        }
        
        return false;
    }
    
    public function getChildren()
    {
        return new self($this->current());
    }
}
