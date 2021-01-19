<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Payment;
use App\Models\Subscription;
use App\Models\Service;
use App\Models\Task;
use App\Models\User;
use App\Utils\Globals\UserType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;
use Stripe\Stripe;
use App\Notifications\NewSubscription;


class SubscriptionsController extends FrontendController
{
    private $_service;
    private $_task;

    /**
     * SubscriptionsController constructor.
     * @param Service $service
     * @param Task $task
     */
    function __construct(Service $service, Task $task)
    {
        $this->_service = $service;
        $this->_task = $task;
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function subscribeAService($id){

        $service = $this->_service->find($id);
        return view('frontend.service.subscribe-a-service', compact('service'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function subscriptions(){
        return view('frontend.subscription.subscriptions');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function subscribeService(Request $request){
        $service = $this->_service->find($request->service_id);

        try {
            \Stripe\Stripe::setApiKey (config('app.stripe_key'));
            $charge = \Stripe\Charge::create ( array (
                "amount" => $request->bill,
                "currency" => "usd",
                "source" => 'tok_visa', // obtained with Stripe.js
                "description" => "Test payment."
            ));
            $subscription = new Subscription();
            $subscription->user_id = Auth::user()->id;
            $subscription->service_id = $service->id;
            $subscription->frequency = $request->frequency;
            $subscription->duration = $request->duration;
            $subscription->charges = $request->bill;
            $subscription->expiry  = Carbon::now()->addDays($request->duration+1);
            $subscription->status = "Active";
            $subscription->task_date = Carbon::now()->addDays(1);
            $subscription->save();

            $payment = new Payment();
            $payment->amount = $request->bill;
            $payment->subscription_id = $subscription->id;
            $payment->user_id = $subscription->user_id;
            $payment->status = 'Paid';
            $payment->save();

            Auth::user()->notify(new NewSubscription($subscription->user->profile_photo, 'You have subscribed for service '.$subscription->service->title ,'New Subscription', $subscription->id));

        } catch ( \Exception $e ) {
            dd($e->getMessage());
        }

         return redirect()->route('mySubscription');
    }

    public function renewSubscription($id,$notificationId){
        $subscription = Subscription::find($id);
        $service = Service::find($subscription->service->id);
        $subscription->user->userReadNotification($notificationId);
        return view('frontend.service.renew-subscription', compact('service', 'subscription'));
    }

    public function saveRenewedSubscription(Request $request){

        try {
            \Stripe\Stripe::setApiKey ( config('app.stripe_key'));
            $charge = \Stripe\Charge::create ( array (
                "amount" => $request->bill,
                "currency" => "usd",
                "source" => 'tok_visa', // obtained with Stripe.js
                "description" => "Test payment."
            ));
            $subscription = Subscription::find($request->subscription_id);
            $subscription->duration = $subscription->duration + $request->duration;
            $subscription->charges = $subscription->charges + $request->bill;
            $subscription->expiry = Carbon::parse($subscription->expiry)->addDays($request->duration);
            $subscription->renew_date = Carbon::now()->addDays(5);
            $subscription->status = "Active";
            $subscription->save();

            $payment = new Payment();
            $payment->amount = $request->bill;
            $payment->subscription_id = $subscription->id;
            $payment->user_id = $subscription->user_id;
            $payment->status = 'Paid';
            $payment->save();



        } catch ( \Exception $e ) {
            dd($e->getMessage());
        }
    }
}
