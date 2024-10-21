<?php

namespace App\Services;

use App\Models\Container;
use App\Models\Box;

class CalculationService
{
    private Container $smallContainer;
    private Container $bigContainer;
    private int $smallContainerCount = 0;
    private int $bigContainerCount = 0;

    public function __construct() {
        $this->smallContainer = new Container(279.4, 234.8, 238.44 );
        $this->bigContainer = new Container(1203.1, 234.8, 238.44);
    }

    /**
     * @param array[Box] $boxes
     */
    public function calculate(array $boxes): array 
    {
        $totalVolume = 0;
        foreach ( $boxes as $box ) {
            $totalVolume += $box->getVolume();
        }

        if ($totalVolume < $this->smallContainer->getVolume()) {
            $this->smallContainerCount++;
        }

        if ($totalVolume < $this->bigContainer->getVolume()) {
            $this->bigContainerCount++;
        }

        if ($totalVolume > $this->bigContainer->getVolume()) {
            $this->countOverflow($totalVolume);
        }

        return ['bigContainers' => $this->bigContainerCount, 'smallContainers' => $this->smallContainerCount];
    }

    private function countOverflow(float $volume): void
    {
        if ($volume > $this->bigContainer->getVolume()) {
            $volume -= $this->bigContainer->getVolume();
            $this->bigContainerCount++;
            $this->countOverflow($volume);
            return;
        }

        if ($volume > $this->smallContainer->getVolume()) {
            $volume -= $this->smallContainer->getVolume();
            $this->smallContainerCount++;
            $this->countOverflow($volume);
            return;
        }

        if ($volume < $this->bigContainer->getVolume() && $volume > $this->smallContainer->getVolume()) {
            $this->bigContainerCount++;
            return;
        }

        if ($volume < $this->smallContainer->getVolume()) {
            $this->smallContainerCount++;
            return;
        }
    }
}