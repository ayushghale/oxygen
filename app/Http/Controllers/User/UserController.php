<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Basket;
use App\Models\Review;
use App\Models\Service;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class UserController extends Controller
{
    /**
     * Display Customer Dashboard.
     */
    public function dashboard()
    {
        // dd('dashboard');
        return view('customer.dashboard');
    }

    /**
     * Display customer ledger.
     */
    public function ledger()
    {
        $id = session()->get('userLogedIn');

        $uerOrderDetails = [];
        $uerPaymetnDetails = DB::table('payments')
            ->join('users', 'users.id', '=', 'payments.user_id')
            ->select(
                'payments.id as paymentId',
                'payments.t_code',
                'payments.payment_type',
                'payments.payment_status',
                'payments.total_amount',
                DB::raw('DATE(payments.created_at) as date'),
                'users.name',
                'users.contact_number',
                'users.address',
                'users.latitude',
                'users.longitude',
            )
            ->where('payments.user_id', $id)

            ->get();


        foreach ($uerPaymetnDetails as $order) {
            $orderDetails = DB::table('orders')
                ->join('services', 'services.id', '=', 'orders.service_id')
                ->where('orders.t_code', $order->t_code)
                ->select(
                    'orders.id as order_id',
                    'services.service_name',
                    'orders.order_quantity',
                    'orders.order_amount',
                )
                ->get();


            $a = [];
            foreach ($orderDetails as $aItem) {
                array_push($a, $aItem);
            }
            $data = [
                'name' => $order->name,
                'contact_number' => $order->contact_number,
                'address' => $order->address,
                'latitude' => $order->latitude,
                'longitude' => $order->longitude,
                'paymentId' => $order->paymentId,
                't_code' => $order->t_code,
                'payment_type' => $order->payment_type,
                'payment_status' => $order->payment_status,
                'total_amount' => $order->total_amount,
                'date' => $order->date,

                'orderDetails' => $a,
            ];
            array_push($uerOrderDetails, $data);
        }
        return view('customer.ledger', compact('uerOrderDetails'));
    }

    /**
     * Display user details.
     */
    public function userDetail()
    {
        $id = session()->get('userLogedIn');
        $user = DB::table('users')
            ->where('id', $id)
            ->first();

        return view('customer.userDetail', compact('user'));
    }

    /**
     * Display user profile page.
     */
    public function profile()
    {
        $id = session()->get('userLogedIn');
        $user = DB::table('users')
            ->where('id', $id)
            ->first();

        return view('customer.profile', compact('user'));
    }

    /**
     * Update user profile.
     */
    public function updateProfile(Request $request,)
    {
        // dd($request->all());
        $request->validate([
            'name' => 'required ',
            'email' => 'required | email | max:50  ',
            'contact_number' => 'required | min:10 | ',
            'address' => 'required | max:100',
            'profile_picture' => 'mimes:jpeg,png,jpg,gif|max:2048'
        ]);


        $username = ucfirst($request->name);
        $email = strtolower($request->email);
        $contact_number = $request->contact_number;
        $address = $request->address;
        $profilePicture = $request->profile_picture;
        $latitude = $request->latitude;
        $longitude = $request->longitude;
        $description = ucfirst($request->description);


        try {
            $id = session()->get('userLogedIn');

            $data = DB::table('users')
                ->where('id', $id)
                ->first();
            if ($data->email != $email) {
                $request->validate([
                    'email' => 'unique:users',
                ]);
            }
            if ($data->contact_number != $contact_number) {
                // dd('phone number');
                $request->validate([
                    'contact_number' => 'unique:users',
                ]);
            }

            if (
                $data->name == $username &&
                $data->email == $email &&
                $data->contact_number == $contact_number &&
                $data->address == $address &&
                $profilePicture == null &&
                $data->latitude == $latitude &&
                $data->longitude == $longitude &&
                $data->description == $description
            ) {
                return redirect()->back()->with('error', 'No changes made');
            }

            $user = User::find($id);
            $user->name = $username;
            $user->email = $email;
            $user->contact_number = $contact_number;
            $user->address = $address;

            if ($latitude != null) {
                $user->latitude = $latitude;
            }
            if ($longitude != null) {
                $user->longitude = $longitude;
            }
            if ($description != null) {
                $user->description = $description;
            }

            if ($profilePicture != null) {
                $new_image = hexdec(uniqid()) . '.' . $profilePicture->getClientOriginalExtension();
                $profilePicture->move('site/uploads/user/', $new_image);
                $save_url = '/site/uploads/user/' . $new_image;
                $user->profile_picture = $save_url;
            }
            $user->save();

            return redirect()->back()->with('success', 'Profile Updated');
        } catch (\Exception $e) {
            dd($e->getMessage());
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Display user credentials change page .
     */
    public function credentials()
    {
        return view('customer.credentials');
    }

    /**
     * Update user credentials.
     */
    public function updateCredentials(Request $request)
    {
        // return redirect()->back()->with('error', 'Invalid Mobile Number.');
        $request->validate([
            'current_Password' => 'required',
            'new_password' => 'required ',
            'conform_password' => 'required | same:new_password',
        ]);

        try {


            $currentPassword = $request->current_Password;
            $newPassword = $request->new_password;
            $id = session()->get('userLogedIn');


            $user = User::find($id);
            $usersPassword = DB::table('users')
                ->where('id', $id)
                ->value('password');

            if (!Hash::check($currentPassword, $usersPassword)) {
                dd('old == old');
                return redirect()->back()->with('error', 'Current Password not matched');
            }

            if (Hash::check($newPassword, $usersPassword)) {
                dd('new == old');
                return redirect()->back()->with('error', 'New Password cannot be same as your current password. Please choose a different password.');
            }

            $user = User::find($id);
            $user->password = $newPassword;
            $user->save();

            return redirect()->back()->with('success', 'Credentials Updated');
        } catch (\Exception $e) {
            // dd($e->getMessage());
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Display service purchase.
     */

    public function purchaseService()
    {

        $services = DB::table('services')
            ->join('user_types', 'services.user_type_id', '=', 'user_types.id')
            ->join('users', 'user_types.id', '=', 'users.user_type_id')
            ->select(
                'services.id as service_id',
                'services.service_name',
                'services.service_price',
                'services.service_description',
                'services.service_image',
                'user_types.user_type_name'
            )
            ->where('users.id', session()->get('userLogedIn'))
            ->get();
        // dd($services);
        return view('customer.purchaseService', compact('services'));
    }

    /**
     * Display user cart.
     */
    public function cart()
    {
        $cartDatas = DB::table('baskets')
            ->join('services', 'baskets.service_id', '=', 'services.id')
            ->select(
                'baskets.id as basket_id',
                'baskets.user_id',
                'baskets.quantity',
                'baskets.totalAmount',
                'services.id as service_id',
                'services.service_name',
                'services.service_price'
            )
            ->where('baskets.user_id', session()->get('userLogedIn'))
            ->get();
        // dd($cartDatas);
        return view('customer.cart', compact('cartDatas'));
    }

    /**
     * Add to cart.
     */
    public function addToCart(Request $request)
    {
        // $request->validate([
        //     'service_id' => 'required',
        //     'quantity' => 'required',
        // ]);

        try {
            $id = session()->get('userLogedIn');
            $service_id = $request->service_id;
            $quantity = $request->quantity;
            $Amount = $request->totalAmount;

            // Select only the "service_price" column from the "services" table
            $servicePrice = DB::table('services')
                ->where('id', $service_id)
                ->value('service_price');

            // Check if the service is already in the cart for the user
            $existingBasket = Basket::where('user_id', $id)
                ->where('service_id', $service_id)
                ->first();

            if ($existingBasket) {
                // If the service is already in the cart, update the quantity and total amount
                $existingBasket->quantity += $quantity;
                $existingBasket->totalAmount += ($servicePrice * $quantity);
                $existingBasket->save();
            } else {
                // If the service is not in the cart, create a new basket entry
                $totalAmount = $servicePrice * $quantity;

                $basket = new Basket();
                $basket->user_id = $id;
                $basket->service_id = $service_id;
                $basket->quantity = $quantity;
                $basket->totalAmount = $totalAmount;
                $basket->save();
            }

            return response()->json([
                'success' => true,
                'message' => 'Service added to cart',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Service not added to cart',
                'error' => $e->getMessage(),
            ]);
        }
    }

    /**
     * Remove from cart.
     */
    public function removeFromCart($basket_id)
    {
        try {
            $cartItem = Basket::findOrFail($basket_id);
            $cartItem->delete();

            return redirect()->back()->with('success', 'Item removed from cart.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to remove item from cart.');
        }
    }

    /**
     * Remove all from cart.
     */
    public function removeAllFromCart()
    {
        // dd('removeAllFromCart');
        try {
            $id = session()->get('userLogedIn');
            $cartItems = Basket::where('user_id', $id)->get();

            foreach ($cartItems as $cartItem) {
                $cartItem->delete();
            }
            return redirect()->back()->with('success', 'All items removed from cart.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to remove all items from cart.');
        }
    }

    /**
     *  orer to recive
     */
    public function orderToRecive(Request $request)
    {
        $startDate = $request->startDate;
        $endDate = $request->endDate;
        
        $id = session()->get('userLogedIn');
        try {
            $purchaseDetails = DB::table('users')
                ->join('payments', 'users.id', '=', 'payments.user_id')
                ->join('orders', 'payments.t_code', '=', 'orders.t_code')
                ->join('services', 'orders.service_id', '=', 'services.id')
                ->select(
                    DB::raw('DATE(orders.created_at) as order_date'),
                    'users.name as user_name',
                    'services.id as service_id',
                    'services.service_name',
                    'orders.order_quantity',
                    'orders.order_amount',
                    'payments.payment_type',
                    'payments.t_code',
                )
                ->where('users.id', $id)
                ->where('orders.status', 2);
            if ($startDate != null && $endDate != null) {
                $purchaseDetails->whereBetween('orders.created_at', [$startDate, $endDate]);
            }

            $purchaseDetails = $purchaseDetails->get();
            // dd($purchaseDetails);


            return view('customer.orderToRecive', compact('purchaseDetails'));
        } catch (\Exception $e) {
            dd($e->getMessage());
            return redirect()->back()->withErrors([$e->getMessage()]);
        }
    }


    /**
     * Display purchase history.
     */
    public function purchaseHistory(Request $request)
    {
        $startDate = $request->startDate;
        $endDate = $request->endDate;

        $id = session()->get('userLogedIn');
        try {
            $purchaseDetails = DB::table('users')
                ->join('payments', 'users.id', '=', 'payments.user_id')
                ->join('orders', 'payments.t_code', '=', 'orders.t_code')
                ->join('services', 'orders.service_id', '=', 'services.id')
                ->select(
                    DB::raw('DATE(orders.created_at) as order_date'),
                    'users.name as user_name',
                    'services.id as service_id',
                    'services.service_name',
                    'orders.order_quantity',
                    'orders.order_amount',
                    'payments.payment_type',
                    'payments.t_code',
                    'reviews.status as review_status',
                )
                ->leftJoin('reviews', function ($join) {
                    $join->on('reviews.t_code', '=', 'payments.t_code')
                        ->on('reviews.service_id', '=', 'orders.service_id');
                })
                ->where('users.id', $id)
                ->where('orders.status', 1);
            if ($startDate != null && $endDate != null) {
                $purchaseDetails->whereBetween('orders.created_at', [$startDate, $endDate]);
            }

            $purchaseDetails = $purchaseDetails->get();


            return view('customer.purchase', compact('purchaseDetails'));
        } catch (\Exception $e) {
            return redirect()->back()->withErrors([$e->getMessage()]);
        }
    }

    /**
     * Display user review.
     */
    public function review()
    {
        $id = session()->get('userLogedIn');

        $reviewedDatas = DB::table('reviews')
            ->join('services', 'reviews.service_id', '=', 'services.id')
            ->select(
                'reviews.rating',
                'reviews.review',
                'reviews.review_date',
                'services.service_name',
                'services.service_description',
            )
            ->where('reviews.user_id', $id)
            ->get();
        // dd($reviewedDatas);
        return view('customer.reviews', compact('reviewedDatas'));
    }

    /**
     * Post user review.
     */
    public function reviewData(Request $request)
    {
        $request->validate([
            'review' => 'required',
        ]);

        try {
            $id = session()->get('userLogedIn');

            $reviewText = ucfirst($request->review);
            $t_code = $request->t_code;
            $rating = $request->rating;
            $serviceId = $request->service_id;

            $currentDate = Carbon::now();
            $formattedDate = $currentDate->format('Y-m-d H:i:s');

            $data = DB::table('reviews')
                ->where('user_id', $id)
                ->where('service_id', $serviceId)
                ->first();
            if ($data) {
                return redirect()->back()->with('error', 'You have already reviewed this service.');
            }

            $review = new Review();
            $review->user_id = $id;
            $review->service_id = $serviceId;
            $review->rating = $rating;
            $review->review = $reviewText; // Corrected variable name
            $review->review_date = $formattedDate;
            $review->t_code = $t_code;
            $review->status = 1;
            $review->save();
            return response()->json([
                'success' => true,
                'message' => 'Review posted successfully.',
            ]);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to post review.');
        }
    }
}
