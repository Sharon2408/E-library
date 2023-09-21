<?php

namespace App\Console\Commands;

use App\Mail\OneDayBeforeEmail;
use Illuminate\Console\Command;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class one_day_before_subscription extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mail:one_day_before_subscription';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        
        $currentDate = Carbon::now()->toDateString();
        $one_day_before_subscription = DB::table('users')
        ->join('subscriptions', 'subscriptions.user_id', '=', 'users.id')
        ->whereRaw('DATEDIFF(subscriptions.plan_end_date, CURDATE()) = ?', [1])
        ->get();
         //   dd($subscription_ended);
        foreach ($one_day_before_subscription as $sub) {
         Mail::to($sub->email)->send(new OneDayBeforeEmail($one_day_before_subscription));

            //$this->info('Mail Sent'.$users->name);
        }
        return Command::SUCCESS;
    }
}
