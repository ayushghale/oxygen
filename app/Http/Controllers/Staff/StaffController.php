<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Order;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StaffController extends Controller
{
    /**
     * Display staff dashboard.
     */
    public function dashboard()
    {
        return view('Staff.dashboard');
    }

    /**
     * Display staff profile.
     */
    public function profile()
    {
        $admins = Admin::find(session('staffLogedIn'));

        return view('Staff.profile', compact('admins'));
    }

    /**
     * Display staff profile update.
     */
    public function updateProfile(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'contact_number' => 'required',
            'email' => 'required',
            'address' => 'required',
            'profile_picture' => 'mimes:jpg,jpeg,png|max:2048',
        ]);
        try {

            $profilePicture = $request->file('profile_picture');

            $staff = Admin::find($id);
            $staff->name = $request->name;
            $staff->contact_number = $request->contact_number;
            $staff->email = $request->email;
            $staff->address = $request->address;



            if ($profilePicture != null) {
                $new_image = hexdec(uniqid()) . '.' . $profilePicture->getClientOriginalExtension();
                $profilePicture->move('site/uploads/staff/', $new_image);
                $save_url = '/site/uploads/staff/' . $new_image;
                $staff->profile_picture = $save_url;
            }

            $staff->save();
            return redirect()->back()->with('success', 'Profile Updated');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors([$e->getMessage()]);
        }
    }

    /**
     * Display staff credentials.
     */
    public function credentials()
    {
        return view('Staff.credentials');
    }

    /**
     * Display staff credentials update.
     */

    public function updateCredentials(Request $request, $id)
    {
        try {
            $staff = Admin::find($id);
            $staff->password = $request->password;
            $staff->save();
            return redirect()->back()->with('success', 'Credentials Updated');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors([$e->getMessage()]);
        }
    }

    /**
     * Display staff ledger.
     */
    public function ledger()
    {
        return view('Staff.ledger');
    }

    /**
     * Display review.
     */
    public function review()
    {
        return view('Staff.review');
    }

    /**
     * Display staff order incomplete / new order.
     */
    public function orderAsigned()
    {
        $staff = Admin::find(session('staffLogedIn'));

        $assignedOrderDetails = [];


        $asignedOrder = DB::table('assign_orders')
            ->join('admins', 'admins.id', '=', 'assign_orders.staff_id')
            ->join('payments', 'payments.t_code', '=', 'assign_orders.t_code')
            ->join('users', 'users.id', '=', 'payments.user_id')
            ->select(
                'assign_orders.id as assign_order_id',
                'users.name',
                'users.contact_number',
                'users.address',
                'payments.payment_status',
                'payments.payment_type',
                'payments.total_amount',
                'payments.t_code',
                'payments.created_at',
                'payments.updated_at',
                'admins.contact_number',
                DB::raw('DATE(assign_orders.created_at) as date'),
            )
            ->where('assign_orders.staff_id', $staff->id)
            ->where('assign_orders.status', 2)
            ->get();

        // dd($asignedOrder);

        foreach ($asignedOrder as $order) {
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
                'id' => $order->assign_order_id,
                'user' => $order->name,
                'contact_number' => $order->contact_number,
                'address' => $order->address,
                'payment_status' => $order->payment_status,
                'payment_method' => $order->payment_type,
                'total' => $order->total_amount,
                't_code' => $order->t_code,
                'created_at' => $order->date,
                'updated_at' => $order->updated_at,
                'staff_contact_number' => $order->contact_number,
                'orderDetails' => $a,
            ];
            array_push($assignedOrderDetails, $data);
        }

        // dd($assignedOrderDetails); 

        return view('Staff.orderAsigned', compact('assignedOrderDetails'));
    }

    /**
     * Display staff order done.
     */
    public function orderCompleted()
    {
        $staff = Admin::find(session('staffLogedIn'));

        $assignedOrderDetails = [];


        $asignedOrder = DB::table('assign_orders')
            ->join('admins', 'admins.id', '=', 'assign_orders.staff_id')
            ->join('payments', 'payments.t_code', '=', 'assign_orders.t_code')
            ->join('users', 'users.id', '=', 'payments.user_id')
            ->select(
                'assign_orders.id as assign_order_id',
                'users.name',
                'users.contact_number',
                'users.address',
                'payments.payment_status',
                'payments.payment_type',
                'payments.total_amount',
                'payments.t_code',
                'payments.created_at',
                'payments.updated_at',
                'admins.contact_number',
                DB::raw('DATE(assign_orders.created_at) as date'),
            )
            ->where('assign_orders.staff_id', $staff->id)
            ->where('assign_orders.status', 1)
            ->get();

        // dd($asignedOrder);

        foreach ($asignedOrder as $order) {
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
                'id' => $order->assign_order_id,
                'user' => $order->name,
                'contact_number' => $order->contact_number,
                'address' => $order->address,
                'payment_status' => $order->payment_status,
                'payment_method' => $order->payment_type,
                'total' => $order->total_amount,
                't_code' => $order->t_code,
                'created_at' => $order->date,
                'updated_at' => $order->updated_at,
                'staff_contact_number' => $order->contact_number,
                'orderDetails' => $a,
            ];
            array_push($assignedOrderDetails, $data);
        }

        // dd($assignedOrderDetails); 

        return view('Staff.orderCompleted', compact('assignedOrderDetails'));
    }
    /**
     * Display staff order.
     */
    public function orderDone($tCode, $id)
    {
        $orderDone = DB::table('assign_orders')
            ->where('id', $id)
            ->update(['status' => 1]);

        $asignedDoneStatus = DB::table('assign_orders')
            ->where('t_code', $tCode)
            ->select('id', 'status')
            ->get();

        $allStatusOne = true;

        foreach ($asignedDoneStatus as $order) {
            if ($order->status != 1) {
                $allStatusOne = false;
                break; // No need to check further
            }
        }

        if ($allStatusOne) {
            $orderDatas = DB::table('orders')
                ->where('orders.t_code', '=', $tCode)
                ->get();

            foreach ($orderDatas as $orderData) {
                    $orderStatus = 1; 
                    Order::where('t_code', $tCode)->update(['status' => $orderStatus]);
            }
        }

        

        return redirect()->back()->with('success', 'Order Done');
    }
    /**
     * Display staff logout.
     */
    public function logout()
    {
        if (session()->has('staffLogedIn')) {
            session()->pull('staffLogedIn');
            return redirect()->route('staff.login');
        }
    }
}
