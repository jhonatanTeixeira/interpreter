<?php

namespace Lexer\Symbol;

use Lexer\Symbol;

class QualifiedName  implements Symbol
{
    public function getName()
    {
        return 'qualified-name';
    }

    public function getRegexp()
    {
        return '/^[a-z0-9]+\.[a-z0-9]+/i';
    }
}
