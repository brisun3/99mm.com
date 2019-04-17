<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Plan;

class SubscriptionsController extends Controller
{
    public function create(Request $request, Plan $plan)
    {    // dd(1);
        $plan = Plan::findOrFail($request->get('plan'));
        //required by stripe in lara
        //dd(2);
        $request->user()
            ->newSubscription('main', $plan->stripe_plan)
            ->create($request->stripeToken);
            dd(3);
        return redirect()->route('/help')->with('success', 'Your plan subscribed successfully');
    }
}
