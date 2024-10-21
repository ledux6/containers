<?php

namespace App\Models;

class Container 
{
    public function __construct(
        private float $length,
        private float $width,
        private float $height
    ) {
    }

    public function getLength(): float 
    {
        return $this->length;
    }

    public function getWidth(): float
    {
        return $this->width;
    }

    public function getHeight(): float
    {
        return $this->height;
    }

    public function getVolume(): float
    {
        return $this->width * $this->height * $this->length;
    }
}
