<?php

namespace Parser\Syntax\Traits;

trait AlphaRegexp
{
    public function getRegexp()
    {
        return '/^[a-zA-Z0-9]+$/';
    }
}
