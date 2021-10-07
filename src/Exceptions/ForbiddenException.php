<?php

namespace Rickkuilman\DigitalHumaniPhpSdk\Exceptions;

use Exception;

class ForbiddenException extends Exception
{
    /**
     * Create a new exception instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct('Forbidden. Do you have access to the supplied Enterprise?');
    }
}
