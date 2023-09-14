<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Category;

class AddCategoryCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'add:category';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Add Category';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
   
        $name=$this->ask('Enter Category:');
        $image=$this->ask('Give Category image:');
        if($this->confirm('Are you sure to insert the record"'.$name.'"? ')){

            $category=Category::create([
                'category_name'=>$name,
                'image'=>$image
            ]);
            $this->info('record added'.$category->category_name);
        }
        else{
            $this->warn('No records added');
      
        }
    }
}
