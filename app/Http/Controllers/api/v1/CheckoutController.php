<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use FFI\Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Stripe\Checkout\Session;
use Stripe\Stripe;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class CheckoutController extends Controller
{
    public function checkout(Request $request)
    {
        $cartItems = $request->cartItems;
        $lineItems = [];
        $total_price = 0;
        foreach ($cartItems as $item) {

            $product = Product::find(($item['id']));
            $total_price += $item['quantity'] * $product->price;
            $cartitem  = [
                'price_data' => [
                    'currency' => 'usd',
                    'unit_amount' => $product->price, // Replace with the actual price in cents
                    'product_data' => [
                        'name' => $product->name, // Replace with the actual product name
                        'images' => [$product->image]
                    ],
                ],
                'quantity' => $item['quantity'],
            ];
            $lineItems[] = $cartitem;
        }


        Stripe::setApiKey('sk_test_51FnOqvCRrnl9LwKjagwBq9nLP0aRu4qNGycLK5U0vZZW9uOTqEOuBBidgxRES8vmINdCwswEZXbCce2cvs13sIT500yGqfMhES');


        $session = Session::create([
            'payment_method_types' => ['card'],
            'line_items' => $lineItems,
            'mode' => 'payment',
            'success_url' => route('checkout.success') . '?session_id={CHECKOUT_SESSION_ID}',
            'cancel_url' => route('checkout.cancel'),
        ]);
        if ($session->id) {
            $order = new Order();
            $order->session_id = $session->id;
            $order->total_price = $total_price;
            $order->save();
            foreach ($cartItems as $item) {
                $order->products()->attach(Product::find(($item['id'])), ['quantity' => $item['quantity']]);
            }
        }


        return response()->json([
            'sessionId' => $session->id,

        ]);
    }
    public function webhook()
    {



        // This is your Stripe CLI webhook secret for testing your endpoint locally.
        $endpoint_secret = 'whsec_bbf4fe44598a6ea2b1611fd5cad4feb0d92dde9779c09abde53e75a409663bf1';

        $payload = @file_get_contents('php://input');
        $sig_header = $_SERVER['HTTP_STRIPE_SIGNATURE'];
        $event = null;

        try {
            $event = \Stripe\Webhook::constructEvent(
                $payload,
                $sig_header,
                $endpoint_secret
            );
        } catch (\UnexpectedValueException $e) {
            // Invalid payload
            http_response_code(400);
            exit();
        } catch (\Stripe\Exception\SignatureVerificationException $e) {
            // Invalid signature
            http_response_code(400);
            exit();
        }

        // Handle the event
        switch ($event->type) {
            case 'checkout.session.completed':
                $session = $event->data->object;
                $order = Order::where('session_id', $session->id);

                if ($order->status == 'unpaid') {
                    $order->status = 'paid';
                    $order->save();
                }

            default:
                echo 'Received unknown event type ' . $event->type;
        }

        http_response_code(200);
    }

    public function success(Request $request)
    {
        $sessionId = $request->get('session_id');
        Stripe::setApiKey('sk_test_51FnOqvCRrnl9LwKjagwBq9nLP0aRu4qNGycLK5U0vZZW9uOTqEOuBBidgxRES8vmINdCwswEZXbCce2cvs13sIT500yGqfMhES');

        try {

            $session = \Stripe\checkout\Session::retrieve($sessionId);


            if (!$sessionId) {
                throw new NotFoundHttpException;
            }
            $customer = \Stripe\Customer::retrieve($session->customer);
            $order = Order::where('session_id', $sessionId)->first();
            if (!$order) {
                throw new NotFoundHttpException;
            }
            if ($order->status == 'unpaid') {
                $order->status = 'paid';
                $order->save();
            }
            return view('checkoutsuccsess', compact('customer', 'order'));
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode(['error' => $e->getMessage()]);
        }
    }

    public function cancel()
    {
    }
}
