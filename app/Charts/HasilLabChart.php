<?php

namespace App\Charts;

use ArielMejiaDev\LarapexCharts\LarapexChart;

class HasilLabChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\AreaChart
    {
        $hasil = HAsilLaboratorium::get();

        $data = [
            $hasil->where('bulan', 'Februari')->count(),
            $hasil->where('bulan', 'Juni')->count(),
            $hasil->where('bulan', 'Oktober')->count(),


        ];
      
        return $this->chart->areaChart()
            ->setTitle('Hasil Laboratorium.')
            ->setSubtitle('Physical sales vs Digital sales.')
            ->addData('Physical sales', [40, 93, 35, 42, 18, 82])
            ->addData('Digital sales', [70, 29, 77, 28, 55, 45])
            ->setXAxis(['January', 'February', 'March', 'April', 'May', 'June']);
    }
}
