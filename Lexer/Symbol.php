<?php

namespace Lexer;

interface Symbol
{
    public function getName();

    public function getRegexp();
}
