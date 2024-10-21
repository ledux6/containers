<?php

namespace App\Models;

class Box 
{
    public function __construct(
        private int $quantity,
        private float $length,
        private float $width,
        private float $height
    ) {
    }

    public function getQuantity(): int
    {
        return $this->quantity;
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
        return $this->width * $this->height * $this->length * $this->quantity;
    }
}
