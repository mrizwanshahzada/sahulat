<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Payment;
use App\Models\Service;
use App\Models\Task;
use App\Models\Vendor;
use App\Notifications\NewTask;
use Illuminate\Http\Request;
use Stripe\Stripe;
use Illuminate\Support\Facades\Auth;

class PaymentsController extends FrontendController
{
    private $_payment;
    /**
     * @param Request $request
     * @param Service $service
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */

    public function __construct(Payment $payment){
        $this->_payment = $payment;
    }

    public function taskPayment(Request $request , Service $service){
        $deadline = $request->deadline;
        return view('frontend.payment.task-payment',compact('service','deadline'));
    }

    /**
     *
     */
    public function payment(){
        try {
            \Stripe\Stripe::setApiKey ( config('app.stripe_key'));
            $charge = \Stripe\Charge::create ( array (
                "amount" => 300 * 100,
                "currency" => "usd",
                "source" => 'tok_visa', // obtained with Stripe.js
                "description" => "Test payment."
            ) );
            // return view('home');
            // dd('Payment done successfully !');
            // dd($request);
            //   $task = new Task();
            // $task->user_id = Auth::user()->id;
            // $task->service_id = $service->id;
            // $task->vendor_id = $service->vendor_id;
            // $task->budget = $service->charges;
            // $task->status = "pending";
            // $task->deadline =$deadline;
            // $task->save();
            // $vendor = Vendor::find($service->vendor_id);
            // // $title = Service::find($task->service_id)->title;
            // // dd($service->vendor_id);
            //  $vendor->notify(new NewTask($task->service->title, $task->user->name,$task->user->profile_photo));
            // dd($vendor->notifications);

            // return redirect()->route('/');
        } catch ( \Exception $e ) {
            dd($e->getMessage());
            // Session::flash ( 'fail-message', "Error! Please Try again." );
            // return view('/');

        }
        // return view()
    }

    public function transactionHistory(){
        $payments = $this->_payment->getPaymentsHistory()->where('user_id', Auth::user()->id);
        return view('frontend.user.dashboard.transaction-history', compact('payments'));
    }
}
