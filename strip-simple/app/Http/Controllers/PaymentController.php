<?php

namespace App\Http\Controllers;

use Stripe;
use Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PaymentController extends Controller
{
    public function submitPay(Request $request)
    {
        dd($request->all());
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        Stripe\Charge::create ([
                "amount" => 5 * 100,
                "currency" => "usd",
                "source" => $request->stripeToken,
                "description" => "Making test payment." 
        ]);
  
        Session::flash('success', 'Payment has been successfully processed.');
          
        return back();
    }

    public function store(Request $request)
    {

        DB::table("account")->insert([
            'title'             => $request->title,
            'fname'             => $request->fname,
            'lname'             => $request->lname,
            'email'             => $request->email,
            'contact'           => $request->contact,
            'card_holder'       => $request->card_holder,
            'card_number'       => $request->card_number,
            'csv'               => $request->csv,
            'expiration_month'  => $request->expiration_month,
            'expiration_year'   => $request->expiration_year,

            'amount'            => $request->amount,
            'nights'            => $request->nights,
            'we'                => $request->we,
            'fdate'             => $request->fdate,
            'water'             => $request->water,
            'education'         => $request->education,
            'medical'           => $request->medical,
            'food'              => $request->food,
        ]);

        

        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        Stripe\Charge::create ([
                "amount" => $request->amount * 100,
                "currency" => "USD",
                "source" => $request->stripeToken,
                "description" => "Making test payment for sadqah." 
        ]);
        // $stripe = Stripe\StripeClient(env('STRIPE_SECRET'));
        //   $stripe->subscriptions->create([
        //     'customer' => 'cus_Ivqesx7Vj2sv1t',
        //     'items' => [
        //       ['price' => 'price_1IH0ySLyUi13lSDLknp2NPQu'],
        //     ],
        //   ]);
  
        Session::flash('success', 'Payment has been successfully processed.');
          
        return back();
    }
    public function indexAll(){
        $data = DB::table("account")->get();
        return view('account',compact('data'));
    }

}
