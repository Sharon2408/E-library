<?php

namespace App\Console\Commands;

use App\Models\Subscription;
use Illuminate\Console\Command;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\SubscriptionEndDateMail;

class enddatemail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mail:subscriptionmail';

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
        $subscription_ended = DB::table('users')
            ->join('subscriptions', 'subscriptions.user_id', '=', 'users.id')
            ->where('plan_end_date', $currentDate)
            ->get();
         //   dd($subscription_ended);
        foreach ($subscription_ended as $sub) {
         Mail::to($sub->email)->send(new SubscriptionEndDateMail($subscription_ended));
break;
            //$this->info('Mail Sent'.$users->name);
        }
    }
}