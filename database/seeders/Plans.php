<?php

namespace Database\Seeders;

use App\Models\Plan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class Plans extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       // Plan::truncate();
        $report = fopen(public_path("data/Plans.csv"),"r");
        $datarow = true;
        while (($data = fgetcsv($report, 4000, ",")) !== FALSE){
            if(!$datarow){
                Plan::create([
                    "plan_name" => $data[0],
                    "price" => $data[1],
                    "plan_duration" => $data[2]
                ]);
            }
            $datarow=false;
        } 
        fclose($report);

    }
}
