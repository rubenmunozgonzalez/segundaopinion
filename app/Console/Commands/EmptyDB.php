<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Foundation\Inspiring;

Use DB;

class EmptyDB extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'empty';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Empty patients and tickets';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {               
        DB::table('users')->where('role', 'patient')->delete();
        $this->info('Se eliminaron tod@s los pacientes de users');                
        
        DB::table('ticketit')->truncate();
        $this->info('Se eliminaron todos los tickets de ticketit');   
        
        DB::table('ticketit_comments')->truncate();
        $this->info('Se eliminaron todos los tickets de ticketit');      
                
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');        
    }
}
