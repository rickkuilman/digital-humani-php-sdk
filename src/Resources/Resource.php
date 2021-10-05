<?php

namespace Rickkuilman\DigitalHumaniPhpSdk\Resources;

use Rickkuilman\DigitalHumaniPhpSdk\DigitalHumani;

class Resource
{
    /**
     * The resource attributes.
     *
     * @var array
     */
    public array $attributes;

    /**
     * The Digital Humani SDK instance.
     *
     * @var DigitalHumani|null
     */
    protected ?DigitalHumani $digitalHumani;

    /**
     * Create a new resource instance.
     *
     * @param array $attributes
     * @param DigitalHumani|null $digitalHumani
     * @return void
     */
    public function __construct(array $attributes, DigitalHumani $digitalHumani = null)
    {
        $this->attributes = $attributes;
        $this->digitalHumani = $digitalHumani;

        $this->fill();
    }

    /**
     * Fill the resource with the array of attributes.
     *
     * @return void
     */
    protected function fill()
    {
        foreach ($this->attributes as $key => $value) {
            $key = $this->camelCase($key);

            $this->{$key} = $value;
        }
    }

    /**
     * Convert the key name to camel case.
     *
     * @param string $key
     * @return string
     */
    protected function camelCase(string $key): string
    {
        $parts = explode('_', $key);

        foreach ($parts as $i => $part) {
            if ($i !== 0) {
                $parts[$i] = ucfirst($part);
            }
        }

        return str_replace(' ', '', implode(' ', $parts));
    }

}
