<?php

namespace App\Http\Controllers;

use App\Events\SubscriptionEvent;
use App\Mail\SubscriptionMail;
use App\Models\Plan;
use App\Models\Subscription;
use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Razorpay\Api\Api;

class PlanController extends Controller
{
    public function index()
    {
        $plans = Plan::all();
        return view('library/subscribe', compact('plans'));
    }

    public function store(Request $request, $plan_id)
    {
        // dd($request);
        $user_id = auth()->user()->id;
        $user_email = auth()->user()->email;
        $user_name = auth()->user()->name;
        $plan_name = Plan::select('plan_name')->where('id', $plan_id)->get();
        $data = [
            'email' => $user_email,
            'name' => $user_name,
            'plan_name' => $plan_name,
        ];
        // dd($data);
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
            event(new SubscriptionEvent($data));
            return $this->receipt($request);
        } elseif ($plan_id == 2) {
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
            event(new SubscriptionEvent($data));
            return $this->receipt($request);
        } else {
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

            event(new SubscriptionEvent($data));
            return $this->receipt($request);
        }

    }

    public function showPlans()
    {
        if (auth()->user()->email !== 'admin@gmail.com') {
            return abort(403);
        }
        $plans = Plan::all();
        return view('/admin/viewplans', compact('plans'));
    }


    public function createPlan()
    {
        try {
            $plan = new Plan();
        } catch (QueryException $q) {
            //dd($q->getMessage());
            return view('library/error');
        }
        return view('admin/createplan', compact('plan'));
    }

    public function storePlan(Request $request)
    {
        try {
            $data = request()->validate([
                'plan_name' => 'required|string',
                'price' => 'required',
                'plan_duration' => 'required',
            ]);

            $plan = Plan::create($data);
        } catch (QueryException $q) {
            //dd($q->getMessage());
            return view('library/error');
        }
        return redirect('admin/viewplans')->with('plan-created', 'New Plan Added Successfuly');
    }


    public function show(Plan $plan)
    {
        try {
            $plans = Plan::all();
        } catch (QueryException $q) {
            //dd($q->getMessage());
            return view('library/error');
        }
        return view('admin/editplan', compact('plan', 'plans'));
    }


    public function updatePlan(Plan $plan, Request $request)
    {
        try {
            $data = request()->validate([
                'plan_name' => 'required|string',
                'price' => 'required',
                'plan_duration' => 'required',
            ]);

            $plan->update($data);
        } catch (QueryException $q) {
            return view('library/error');
        }
        return redirect('admin/viewplans')->with('plan-updated', 'Plan Updated Successfully');
    }

    public function destroy($id)
    {
        try {
            $plan = Plan::where('id', $id);
            $plan->delete();
        } catch (QueryException $q) {
            return view('library/error');
        }
        return redirect('admin/viewplans')->with('plan-deleted', 'Plan Deleted Successfully');
    }

    private $api_id = "rzp_test_gB76NgJTAbbEVE";
    private $api_key = "L35iY1Kb0S2TUjiPZNATvQcE";

    public function payment(Request $request, $id)
    {
        $name = auth()->user()->name;
        $email = auth()->user()->email;
        // $amount = Plan::select('price')->where('id',$id)->get();
        $receiptId = Str::random(10);
        $api = new Api($this->api_id, $this->api_key);
        $order = $api->order->create(
            array(
                'receipt' => $receiptId,
                'amount' => $request->all()['price'] * 100,
                'currency' => 'INR',
                // 'name' => $name,
                // 'planid' => $id
            )
        );
        $response = [
            'orderId' => $order['id'],
            'razorpayId' => $receiptId,
            'amount' => $request->all()['price'] * 100,
            'currency' => 'INR',
            'description' => 'testing description',
            'email' => $email,
            'name' => $name,
        ];

        $plan = [
            'id' => $id
        ];
        return view('/payment/payment', ['response' => $response, 'plan' => ['id' => $id]]);

    }

    public function receipt(Request $request)
    {    
        return view('/payment/receipt');
    }

}