<?php

namespace App\Http\Controllers;

use Auth;
use App\Order;
use App\Shipping;
use App\OrderItem;
use Cartalyst\Stripe\Stripe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Gloudemans\Shoppingcart\Facades\Cart;

class OrderController extends Controller
{

    public function shippinginfoStore(Request $request)
    {
        $request->validate([
            "firstname"   => "required|min:3",
            "lastname"    => "required|min:3",
            "email"       => "required|min:3|email",
            "phone"       => "required",
            "address"     => "required",
            "address2"    => "nullable",
            "country"     => "required",
            "state"       => "required",
            "zip"         => "required"
        ]);


        $shippinginfo = Shipping::create([
            "firstname"   => $request->firstname,
            "lastname"    => $request->lastname,
            "email"       => $request->email,
            "phone"       => $request->phone,
            "address"     => $request->address,
            "address2"    => $request->address2,
            "country"     => $request->country,
            "state"       => $request->state,
            "zip"         => $request->zip
        ]);

        if ($shippinginfo) {

            $request->session()->put('shipping_id', $shippinginfo->id);

            return redirect()->route('payment.process');

        } else {
            return back();
        }

    }

    public function paymentProcess()
    {
        if(request()->session()->get('shipping_id')){

            return view('payment');

        } else {

            return back();
        }

    }


    public function checkout()
    {
        if(Cart::count()) {

            return view('checkout');

        } else {

            return redirect('/');
        }
    }


    public function store(Request $request)
    {
        $request->validate([
            "payment_type" => "required"
        ]);

        $payment_type = $request->payment_type;
        $payment_key  = NULL;

        $succeeded = $this->orderComplete($payment_type, $payment_key);

        if ($succeeded) {

            $request->session()->forget('shipping_id');

            Cart::destroy();

            return redirect()->route('home');

        } else {
            Session::flash('paymenterror','Order not completed!!');
            return redirect()->route('payment.process');
        }
    }


    // STRIPE STORE
    public function postPaymentWithStripe(Request $request)
    {
        $validator = $request->validate([
            'card_no'       => 'required',
            'ccExpiryMonth' => 'required',
            'ccExpiryYear'  => 'required',
            'cvvNumber'     => 'required',
        ]);

        $stripe = Stripe::make('sk_test_0ZiFzBlnI9iWkOjx4vDS4Nkw');

        try {
            $token = $stripe->tokens()->create([
                'card' => [
                    'number'    => $request->get('card_no'),
                    'exp_month' => $request->get('ccExpiryMonth'),
                    'exp_year'  => $request->get('ccExpiryYear'),
                    'cvc'       => $request->get('cvvNumber'),
                ],
            ]);

            if (!isset($token['id'])) {
                return redirect()->route('payment.process');
            }
            $charge = $stripe->charges()->create([
                'card'      => $token['id'],
                'currency'  => 'USD',
                'amount'    => Cart::total()
            ]);
            
            if($charge['status'] == 'succeeded') {

                $payment_type = 'pay-with-stripe';
                $payment_key  = $charge['id'];

                $succeeded = $this->orderComplete($payment_type, $payment_key);

                if ($succeeded) {

                    $request->session()->forget('shipping_id');

                    Cart::destroy();

                    return redirect()->route('home');

                } else {
                    Session::flash('paymenterror','Order not completed!!');
                    return redirect()->route('payment.process');
                }
                
            } else {
                Session::flash('paymenterror','Money not add in wallet!!');
                return redirect()->route('payment.process');
            }
            
        } catch (Exception $e) {
            Session::flash('paymenterror',$e->getMessage());
            return redirect()->route('payment.process');
        } catch(\Cartalyst\Stripe\Exception\CardErrorException $e) {
            Session::flash('paymenterror',$e->getMessage());
            return redirect()->route('payment.process');
        } catch(\Cartalyst\Stripe\Exception\MissingParameterException $e) {
            Session::flash('paymenterror',$e->getMessage());
            return redirect()->route('payment.process');
        }

    }


    protected function orderComplete($payment_type,$payment_key)
    {
        if (session()->get('shipping_id')) {

            $shipping_id    = session()->get('shipping_id');
            $order_id       = rand(100,1000) .''. $shipping_id;
            $order_id       = (int)$order_id;
            $order_details  =  'Items:'. Cart::count() . '|Tax:'. Cart::tax() . '|Total:'. Cart::total();

            $orderpayment = Order::create([
                "order_id"          => $order_id,
                "shipping_id"       => $shipping_id,
                "payment_type"      => $payment_type,
                "payment_key"       => $payment_key,
                "order_details"     => $order_details,
                "customer_id"       => Auth::id()
            ]);

            if ($orderpayment) {

                foreach (Cart::content() as $key => $product) {

                    OrderItem::create([
                        "order_id"      => $order_id,
                        "product_id"    => $product->id,
                        "qty"           => $product->qty, 
                        "price"         => $product->price,
                        "subtotal"      => $product->subtotal
                    ]);
                }

                Shipping::where('id', $shipping_id)->update([ 'order_id' => (int)$order_id]);

                return true;
            }
        } 

        return false;
    }
}
