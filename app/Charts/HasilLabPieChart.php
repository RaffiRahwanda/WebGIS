<?php

namespace App\Charts;

use ArielMejiaDev\LarapexCharts\LarapexChart;
use App\Models\HasilLaboratorium;
use DB;

class HasilLabPieChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\AreaChart
    {

        $hasil = HasilLaboratorium::get();

        $data = [
            $hasil->where('bulan','Februari')->sum('tss'),
            $hasil->where('bulan','Februari')->sum('do'),
            $hasil->where('bulan','Februari')->sum('bod'),

            // $hasil->where('bulan','Februari')->sum('fecal_coli'),
            // $hasil->where('bulan','Februari')->sum('total_coliform'),
            //   $hasil->where('bulan','Februari')->whereBetween('tss', [1, 100])->count(),
            //   $hasil->where('bulan','Februari')->whereBetween('do', [1, 100])->count(),
            //   $hasil->where('bulan','Februari')->whereBetween('bod', [0, 100])->count(),
            //   $hasil->where('bulan','Februari')->whereBetween('cod', [1, 100])->count(),
            //   $hasil->where('bulan','Februari')->whereBetween('fosfat', [0, 100])->count(),
            //   $hasil->where('bulan','Februari')->whereBetween('fecal_coli', [0,192000])->count(),

            // $hasil->where(['bulan','Februari'], ['sungai_id', 1]),
            // $hasil->where(['bulan','Februari'], ['sungai_id', 1]),
            // $hasil->where(['bulan','Februari'], ['sungai_id', 1]),
            //      $hasil->where(['bulan','Februari'], ['sungai_id', 2]),
            // $hasil->where(['bulan','Februari'], ['sungai_id', 2]),
            // $hasil->where(['bulan','Februari'], ['sungai_id', 2]),
            //      $hasil->where(['bulan','Februari'], ['sungai_id', 3]),
            // $hasil->where(['bulan','Februari'], ['sungai_id', 3]),
            // $hasil->where(['bulan','Februari'], ['sungai_id', 3]),
            
            
        ];
        $datas = [

            // $hasil->where(['bulan','Juni'], ['sungai_id', 1]),
            // $hasil->where(['bulan','Juni'], ['sungai_id', 1]),
            // $hasil->where(['bulan','Juni'], ['sungai_id', 1]),
            //      $hasil->where(['bulan','Juni'], ['sungai_id', 2]),
            // $hasil->where(['bulan','Juni'], ['sungai_id', 2]),
            // $hasil->where(['bulan','Juni'], ['sungai_id', 2]),
            //      $hasil->where(['bulan','Juni'], ['sungai_id', 3]),
            // $hasil->where(['bulan','Juni'], ['sungai_id', 3]),
            // $hasil->where(['bulan','Juni'], ['sungai_id', 3]),


            //   $hasil->where('bulan','Juni')->whereBetween('tss', [1, 100])->count(),
            //   $hasil->where('bulan','Juni')->whereBetween('do', [1, 100])->count(),
            //   $hasil->where('bulan','Juni')->whereBetween('bod', [0, 100])->count(),
            //   $hasil->where('bulan','Juni')->whereBetween('cod', [1, 100])->count(),
            //   $hasil->where('bulan','Juni')->whereBetween('fosfat', [0, 100])->count(),
            //   $hasil->where('bulan','Juni')->whereBetween('fecal_coli', [0,192000])->count(),

             $hasil->where('bulan','Juni')->sum('tss'),
            $hasil->where('bulan','Juni')->sum('do'),
            $hasil->where('bulan','Juni')->sum('bod'),
            // $hasil->where('bulan','Juni')->sum('cod'),
            // $hasil->where('bulan','Juni')->sum('fosfat'),
            // $hasil->where('bulan','Juni')->sum('fecal_coli'),
            // $hasil->where('bulan','Juni')->sum('total_coliform'),
        ];
           $datas2 = [
              $hasil->where('bulan','Oktober')->sum('tss'),
            $hasil->where('bulan','Oktober')->sum('do'),
            $hasil->where('bulan','Oktober')->sum('bod'),
            // $hasil->where('bulan','Oktober')->sum('cod'),
            // $hasil->where('bulan','Oktober')->sum('fosfat'),
            // $hasil->where('bulan','Oktober')->sum('fecal_coli'),
            // $hasil->where('bulan','Oktober')->sum('total_coliform'),
            //             $hasil->where(['bulan','=','Oktober'], ['sungai_id','=', 1])->count(),
            // $hasil->where(['bulan','=','Oktober'], ['sungai_id','=', 1])->count(),
            // $hasil->where(['bulan','=','Oktober'], ['sungai_id','=', 1])->count(),
            //      $hasil->where(['bulan','=','Oktober'], ['sungai_id','=', 2])->count(),
            // $hasil->where(['bulan','=','Oktober'], ['sungai_id','=', 2])->count(),
            // $hasil->where(['bulan','=','Oktober'], ['sungai_id','=', 2])->count(),
            //      $hasil->where(['bulan','=','Oktober'], ['sungai_id','=', 3]),
            // $hasil->where(['bulan','=','Oktober'], ['sungai_id','=', 3]),
            // $hasil->where(['bulan','=','Oktober'], ['sungai_id','=', 3]),

            //  $hasil->where('bulan','Oktober')->whereBetween('tss', [1, 100])->count(),
            //   $hasil->where('bulan','Oktober')->whereBetween('do', [1, 100])->count(),
            //   $hasil->where('bulan','Oktober')->whereBetween('bod', [0, 100])->count(),
            //   $hasil->where('bulan','Oktober')->whereBetween('cod', [1, 100])->count(),
            //   $hasil->where('bulan','Oktober')->whereBetween('fosfat', [0, 100])->count(),
            //   $hasil->where('bulan','Oktober')->whereBetween('fecal_coli', [0,192000])->count(),
          

        ];
         $datas3 = [
            //   $hasil->where('bulan','Oktober')->whereBetween('tss', [1, 100])->count(),
            //   $hasil->where('bulan','Oktober')->whereBetween('do', [1, 100])->count(),
            //   $hasil->where('bulan','Oktober')->whereBetween('bod', [0, 100])->count(),
            //   $hasil->where('bulan','Oktober')->whereBetween('cod', [1, 100])->count(),
            //   $hasil->where('bulan','Oktober')->whereBetween('fosfat', [0, 100])->count(),
            //   $hasil->where('bulan','Oktober')->whereBetween('fecal_coli', [0,192000])->count(),





            // $hasil->where('bulan','Oktober'),
            // $hasil->where('bulan','Oktober'),
            // $hasil->where('bulan','Oktober'),
            // $hasil->where('bulan','Oktober'),
            // $hasil->where('bulan','Oktober'),
            // $hasil->where('bulan','Oktober'),
        ];


        $label = [
            'Februari',
            'Juni',
            'Oktober',
           
        ];
      
        // $tes = HasilLaboratorium::select(DB::raw("SELECT tss,do,bod FROM hasil_lab WHERE bulan = 'Oktober'"))->get();
        // $tes = $hasil->where("tss,do,bod")->get();
        return $this->chart->areaChart()
            ->setTitle('TSS DO BOD')
            ->setSubtitle('2022 ')
              ->setHeight(400)
            ->setWidth(300)
            ->addData('TSS',$data)
            ->addData('DO',$datas)
            ->addData('BOD',$datas2)


            ->setXAxis($label);
    }

     public function build1()
    {

         $hasil1 = HasilLaboratorium::get();
        $data = [
            $hasil1->where('bulan','Februari')->sum('cod'),
            $hasil1->where('bulan','Juni')->sum('cod'),
            $hasil1->where('bulan','Oktober')->sum('cod'),
        ];
        
        $data1 = [
            $hasil1->where('bulan','Juni')->sum('fosfat'),
            $hasil1->where('bulan','Februari')->sum('fosfat'),
            $hasil1->where('bulan','Oktober')->sum('fosfat'),
        ];

         $data2 = [
        ];

        $title =[
            'COD',
            'FOSFAT'
        ];

        // return $this->chart->pieChart()
        //     ->setTitle('Data', $title)
        //     ->setSubtitle(date('Y'))
        //     ->setWidth(500)
        //     ->setHeight(500)
        //     ->addData($data)
        //     ->setLabels($title);
        // return $this->chart->lineChart()
        //     ->setTitle('Sales during 2021.')
        // ->setSubtitle('Physical sales vs Digital sales.')
        // ->addData('Physical sales', [$hasil1->where('bulan','Oktober')->count()])
        // ->addData('Physical sales', [40, 93, 35, 42, 18, 82])

        // ->addData('Digital sales', [70, 29, 77, 28, 55, 45])
        // ->setXAxis(['January', 'February', 'March', 'April', 'May', 'June']);


                //     return $this->chart->horizontalBarChart()
                // ->setTitle('Los Angeles vs Miami.')
                // ->setSubtitle('Wins during season 2021.')
                // ->setColors(['#FFC107', '#D32F2F'])
                // ->addData('San Francisco', [6, 9, 3, 4, 10, 8])
                // ->addData('Boston', [7, 3, 8, 2, 6, 4])
                // ->setXAxis(['January', 'February', 'March', 'April', 'May', 'June']);

                // return $this->chart->heatMapChart()
                // ->setTitle('Basic radar chart')
                // ->addData('Sales', [80, 50, 30, 40, 100, 20])
                // ->addHeat('Income', [70, 10, 80, 20, 60, 40])
                // ->setMarkers(['#FFA41B', '#4F46E5'], 7, 10)
                // ->setXAxis(['January', 'February', 'March', 'April', 'May', 'June']);

                // return $this->chart->radarChart()
                // ->setTitle('Individual Player Stats.')
                // ->setSubtitle('Season 2021.')
                // ->addData('Stats', [70, 93, 78, 97, 50, 90])
                // ->setXAxis(['Pass', 'Dribble', 'Shot', 'Stamina', 'Long shots', 'Tactical'])
                // ->setMarkers(['#303F9F'], 7, 10);

                return $this->chart->barChart()
            ->setTitle('COD & FOSFAT.')
            ->setSubtitle('2022.')
            ->setHeight(400)
            ->setWidth(300)
            ->addData('Cod',$data)
            ->addData('Fosfat', $data1)
            ->setXAxis(['January', 'Juni', 'Oktober']);
    }
    public function build2(){

         $hasil2 = HasilLaboratorium::get();

            //     return $this->chart->polarAreaChart()
            // ->setTitle('Top 3 scorers of the team.')
            // ->setSubtitle('Season 2021.')
            // ->addData([20, 24, 30])
            // ->setLabels(['Player 7', 'Player 10', 'Player 9']);
    //         return $this->chart->radialChart()
    // ->setTitle('Passing effectiveness.')
    // ->setSubtitle('Barcelona city vs Madrid sports.')
    // ->addData([75, 60])
    // ->setLabels(['Barcelona city', 'Madrid sports'])
    // ->setColors(['#D32F2F', '#03A9F4']);

    $data = [
          $hasil2->where('bulan','Februari')->sum('fecal_coli'),
          $hasil2->where('bulan','Juni')->sum('fecal_coli'),
          $hasil2->where('bulan','Oktober')->sum('fecal_coli'),
        ];
        $data1 = [
        $hasil2->where('bulan','Februari')->sum('total_coliform'),
            $hasil2->where('bulan','Juni')->sum('total_coliform'),
            $hasil2->where('bulan','Oktober')->sum('total_coliform'),     
    ];
    $data2 = [
    ];

         return $this->chart->lineChart()
            ->setTitle('Fecal Coli & Total ColiForm.')
        ->setSubtitle('2022.')
        ->addData('Fecal Coli', $data)
   ->setHeight(400)
            ->setWidth(300)
        ->addData('Total Coliform',$data1)
        ->setXAxis(['Februari', 'Juni', 'Oktober']);

    //  return $this->chart->heatMapChart()
    //             ->setTitle('Basic radar chart')
    //             ->addData('Sales', [80, 50, 30, 40, 100, 20])
    //             ->addHeat('Income', [70, 10, 80, 20, 60, 40])
    //             ->setMarkers(['#FFA41B', '#4F46E5'], 7, 10)
    //             ->setXAxis(['January', 'February', 'March', 'April', 'May', 'June']);

    }
      public function build3()
    {

         $hasil1 =  HasilLaboratorium::get();
            
         
         $datas=[

             $hasil1->where('bulan','Februari')->sum('fecal_coli'),
          $hasil1->where('bulan','Juni')->sum('fecal_coli'),
          $hasil1->where('bulan','Oktober')->sum('fecal_coli'),
         ];
        $data = [
            
            $hasil1->where('bulan','Februari')->sum('cod'),
            $hasil1->where('bulan','Juni')->sum('cod'),
            $hasil1->where('bulan','Oktober')->sum('cod'),
        ];
        
        $data1 = [
            //  $hasil1->where('bulan','Februari')->sum('total_coliform'),
            // $hasil1->where('bulan','Juni')->sum('total_coliform'),
            // $hasil1->where('bulan','Oktober')->sum('total_coliform'),  
            $hasil1->where('bulan','Juni')->sum('fosfat'),
            $hasil1->where('bulan','Februari')->sum('fosfat'),
            $hasil1->where('bulan','Oktober')->sum('fosfat'),
        ];

         $data2 = [
        ];

        $title =[
            'COD',
            'FOSFAT'
        ];

       
                return $this->chart->barChart()
            ->setTitle('COD & FOSFAT.')
            ->setSubtitle('2022.')
            ->setHeight(400)
            ->setWidth(300)
            ->addData('Cod',$data)
            ->addData('Fosfat', $data1)
          
            ->setXAxis(['January', 'Juni', 'Oktober','Maret']);
    }
}
