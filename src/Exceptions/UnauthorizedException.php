<?php

namespace Rickkuilman\DigitalHumaniPhpSdk\Exceptions;

use Exception;
use Rickkuilman\DigitalHumaniPhpSdk\DigitalHumani;

class UnauthorizedException extends Exception
{
    /**
     * Create a new exception instance.
     *
     * @return void
     */
    public function __construct(DigitalHumani $digitalHumani)
    {
        $environment = 'sandbox';

        if ($digitalHumani->usesProductionEnvironment()) {
            $environment = 'production';
        }

        parent::__construct(sprintf('Unauthorized. You are using the %s environment, did you grab the correct API key?', $environment));
    }
}
