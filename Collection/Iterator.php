<?php

namespace Collection;

//use Collection\Traits;

class Iterator implements \Iterator
{
    use Traits\Iterator;
    
    public function __construct($data = array())
    {
        if (is_array($data)) {
            $data = new \ArrayIterator($data);
        }
        
        if (!$data instanceof \Traversable) {
            throw new \Exception('data must be array or traversable');
        }
        
        $this->data = $data;
    }
}
