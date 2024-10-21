<?php

namespace App\Console\Commands;

use App\Models\Box;
use App\Services\CalculationService;
use Illuminate\Console\Command;

class CalculateContainersCommand extends Command
{

    public function __construct(private CalculationService $calculationService)
    {
        parent::__construct();
    }

    protected $signature = 'app:calculate-containers {--quantity=*} {--length=*} {--width=*} {--height=*}';

    protected $description = 'Calculates container count';
    public $exampleRun1 = 'php artisan app:calculate-containers --quantity=27 --width=78 --height=79 --length=93';
    public $exampleRun2 = 'php artisan app:calculate-containers --quantity=24 --width=30 --height=60 --length=90 --quantity=33 --width=75 --height=100 --length=200';
    public $exampleRun3 = 'php artisan app:calculate-containers --quantity=10 --width=80 --height=100 --length=200 --quantity=25 --width=60 --height=80 --length=150';

    public function handle()
    {
        $quantities = $this->option('quantity');
        $lengths = $this->option('length');
        $widths = $this->option('width');
        $heights = $this->option('height');

        $boxes = [];
        try {
            foreach ($quantities as $key => $quantity) {
                $boxes[] = new Box(
                    $quantities[$key],
                    $lengths[$key],
                    $heights[$key],
                    $widths[$key]
                );
            }
        } catch (\Exception $e) {
            $this->error('Check if you have provided all the arguments.');
            return;
        }
        
        $result = $this->calculationService->calculate($boxes);
        $this->info(sprintf(
            'The shipment requires %s big containers and %s small containers.', 
            $result['bigContainers'],
            $result['smallContainers']
        ));
    }
}
