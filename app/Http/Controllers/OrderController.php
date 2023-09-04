<?php

namespace App\Http\Controllers;

use App\Models\Basket;
use App\Models\Order;
use App\Models\Payment;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function generateUniqueID()
    {
        $today = date('YmdHi');
        $startDate = date('YmdHi', strtotime('-10 days'));
        $range = $today - $startDate;
        $rand = rand(0, $range);
        $uniqueID = $startDate + $rand;
        $length = 20;
        $pool = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $sid = substr(str_shuffle(str_repeat($pool, $length)), 0, $length);
        $sid = $sid . $uniqueID;

        return $sid;
    }
    /**
     * Store a newly created resource in storage.
     */
    public function orderedService(Request $request)
    {
        try {


            // transaction code
            $transactionCode = $this->generateUniqueID();
            $totalAmount = 0;

            $currentTime = Carbon::now();
            $formattedTime = $currentTime->format('H:i:s');
            $formattedDate = $currentTime->format('Y-m-d');

            // store orders
            $data = $request->cartData; // Get the array of orders from the request
            $basketIds = $request->basketIds; // Get the array of orders from the request
            $orders = []; // Initialize an empty array to store the created orders
            $service_names = []; // Initialize an empty array to store the service names
            $totalAmount = 0; // Initialize the total amount

            /**
             * Adding mutiple data to     order table database
             */



            foreach ($data as $item) {
                $order_data = DB::table('services')
                    ->where('id', $item['service_id'])
                    ->select('service_price', 'service_name')
                    ->get();

                $total_Order_Amount = ($item['quantity'] * $order_data[0]->service_price);

                $order = new Order();
                $order->service_id = $item['service_id'];
                $order->order_quantity = $item['quantity'];
                $order->order_amount = $total_Order_Amount;
                $order->remarks = 'test';
                $order->t_code = $transactionCode;
                $order->save();

                $totalAmount += $total_Order_Amount; // Add the total amount of the order to the total amount
                $service_names[] = $order_data[0]->service_name; // Add the service name to the array
                $orders[] = $order; // Add the created order to the array
            }

            // online transaction code
            $online_T_code = $request->online_Transaction_code; // storing online transaction code in a variable  

            $user_id = $request->user_id; // storing user id in a variable 


            /**
             * Add payment data to the database
             */
            $paymentData = new Payment();
            $paymentData->user_id = $user_id;
            $paymentData->payment_type = $request->payment_type;
            $paymentData->total_amount = $totalAmount;
            $paymentData->payment_date = $formattedDate;
            $paymentData->payment_time = $formattedTime;
            $paymentData->t_code = $transactionCode;

            if ($online_T_code == null) {
                $paymentData->payment_status = 2;
                $paymentData->online_Transaction_code = 'pending';
            } else {
                $paymentData->payment_status = 'paid';
                $paymentData->online_Transaction_code = $online_T_code;
            }

            if ($basketIds != null) {
                foreach ($basketIds as $basket) {
                    $basketId = $basket['basket_id'];
                    $order = Basket::find($basketId);

                    if ($order) {
                        $order->delete();
                    }
                }
            }

            $paymentData->save();
            return response()->json([
                'success' => true,
                'message' => 'Orders Added Successfully',
                // 'order' => $orders,
                // 'payment' => $paymentData,
                'service_names' => $service_names,

            ], 200);
        } catch (\Exception $e) {
            dd($e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Order not Added',
                'error' => $e->getMessage(),
            ]);
            // return redirect()->back()->with('fail','Order not Added');
        }
    }

    
}
