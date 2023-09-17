<?php

namespace App\Http\Controllers;

use App\Mail\SubscriptionMail;
use App\Models\Plan;
use App\Models\Subscription;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Mail;

class PlanController extends Controller
{
    public function index()
    {
        $plans = Plan::all();
        return view('library/subscribe', compact('plans'));
    }

    public function store($plan_id)
    {

        $user_id = auth()->user()->id;
        $user_email = auth()->user()->email;
        $user_name = auth()->user()->name;
        if ($plan_id == 1) {

            Subscription::create([

                "user_id" => $user_id,
                "plan_id" => $plan_id,
                "plan_start_date" => Carbon::now()->toDateString(),
                "plan_end_date" => Carbon::now()->addWeek()->toDateString(),
                "ispaid" => 1,
            ]);

            User::where('id', $user_id)->update([
                'subscription' => 1,
            ]);
            Mail::to($user_email)->send(new SubscriptionMail($user_name));
            return redirect('/');
        }
        elseif($plan_id == 2){
            Subscription::create([

                "user_id" => $user_id,
                "plan_id" => $plan_id,
                "plan_start_date" => Carbon::now()->toDateString(),
                "plan_end_date" => Carbon::now()->addMonths(3)->toDateString(),
                "ispaid" => 1,
            ]);

           User::where('id', $user_id)->update([
                'subscription' => 1,
            ]);
            Mail::to($user_email)->send(new SubscriptionMail($user_name));
            return redirect('/');
        }
        else{
            Subscription::create([

                "user_id" => $user_id,
                "plan_id" => $plan_id,
                "plan_start_date" => Carbon::now()->toDateString(),
                "plan_end_date" => Carbon::now()->addMonths(6)->toDateString(),
                "ispaid" => 1,
            ]);

            User::where('id', $user_id)->update([
                'subscription' => 1,
            ]);
            Mail::to($user_email)->send(new SubscriptionMail($user_name));
            return redirect('/');
        }
        
    }
}