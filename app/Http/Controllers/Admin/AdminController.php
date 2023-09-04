<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\AssignOrder;
use App\Models\Order;
use App\Models\Payment;
use App\Models\Service;
use App\Models\User;
use App\Models\UserType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AdminController extends Controller
{
    // dashboard
    // ===========================================================================================
    /**
     * admin dashboard
     */
    public function dashboard()
    {
        $userDetails = DB::table('users')
            ->join('user_types', 'users.user_type_id', '=', 'user_types.id')
            ->select(
                'users.*',
                'user_types.user_type_name'
            )
            ->get();
        return view('admin.dashboard', compact('userDetails'));
    }

    // customer
    // ===========================================================================================

    /**
     * show Customer Details page
     */
    public function customerDetail()
    {
        $userDetails = DB::table('users')
            ->join('user_types', 'users.user_type_id', '=', 'user_types.id')
            ->select(
                'users.*',
                'user_types.user_type_name'
            )
            ->get();
        return view('admin.customer.customerDetail', compact('userDetails'));
    }

    /**
     * Add customer form
     */
    public function addCustomerPage()
    {
        $userTypes = UserType::all();
        return view('admin.customer.addCustomer', compact('userTypes'));
    }

    /**
     * Add customer data
     */
    public function addCustomerData(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'name' => 'required',
            'contact_number' => 'required | min:10 | unique:users',
            'email' => 'required | email | unique:users',
            'password' => 'required',
            'conform_password' => 'required | same:password',
            'address' => 'required',
            'user_type_id' => 'required',
        ]);
        try {
            // user input data
            $user_email = $request->email;
            $user_contact_number = $request->contact_number;
            $user_password = $request->password;


            $latitude = $request->latitude;
            $longitude = $request->longitude;
            $description = $request->description;

            $user = new User();
            $user->user_type_id = $request->user_type_id;
            $user->name = ucfirst($request->name);
            $user->address = $request->address;
            $user->email = strtolower($user_email);
            $user->contact_number = $user_contact_number;
            $user->password = $user_password;
            if ($latitude != null) {
                $user->latitude = $latitude;
            }
            if ($longitude != null) {
                $user->longitude = $longitude;
            }
            if ($description != null) {
                $user->description = $description;
            }
            $user->save();

            return redirect()->back()->with('success', 'User Registered Successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Active User
     */
    public function activeUser($id)
    {
        try {
            $user = User::find($id);
            $user->status = "1";
            $user->save();
            return redirect()->back()->with('success', 'User Active Successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Deactive User
     */
    public function deactiveUser($id)
    {
        try {
            $user = User::find($id);
            $user->status = "0";
            $user->save();
            return redirect()->back()->with('success', 'User Deactive Successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Edit User
     */
    public function editUser($id)
    {
        $updateUser = User::find($id);
        $userTypes = UserType::all();
        // dd($updateUser);
        return view('admin.customer.addCustomer', compact('updateUser', 'userTypes'));
    }

    /**
     * Update User
     */
    public function updateUser(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'contact_number' => 'required | min:10 | unique:users,contact_number,' . $id,
            'email' => 'required | email | unique:users,email,' . $id,
            'password' => '',
            'conform_password' => 'same:password',
            'address' => 'required',
            'user_type_id' => 'required',
        ]);
        try {

            $userdetils = DB::table('users')
                ->select(
                    'users.*',
                )
                ->where('users.id', '=', $id)
                ->get();

            $user_password = $request->password;
            $latitude = $request->latitude;
            $longitude = $request->longitude;
            $description = ucfirst($request->description);

            $user = User::find($id);
            $user->user_type_id = $request->user_type_id;
            $user->name = ucfirst($request->name);
            $user->address = $request->address;
            $user->email = strtolower($request->email);
            $user->contact_number = $request->contact_number;
            if ($user_password != null) {
                $user->password = $user_password;
            } else {
                $user->password = $userdetils[0]->password;
            }
            if ($latitude != null) {
                $user->latitude = $latitude;
            }
            if ($longitude != null) {
                $user->longitude = $longitude;
            }
            if ($description != null) {
                $user->description = $description;
            }
            $user->save();

            return redirect()->to(route('admin.customerDetail'))->with('success', 'User Updated Successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
    // User type
    // ===========================================================================================
    /**
     * Add User type form
     */
    public function userTypeFormPage()
    {
        return view('admin.customer.userType');
    }

    /**
     * Add User type
     */
    public function addUserType(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);

        try {
            $userType = new UserType();
            $userType->user_type_name = ucfirst($request->name);
            $userType->save();
            return redirect()->back()->with('success', 'User Type Added Sucessfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Display User type
     */
    public function userTypeList()
    {
        $userTypes = UserType::all();
        return view('admin.customer.userTypeDetails', compact('userTypes'));
    }
    /**
     * Edit User type
     */
    public function editUserType($id)
    {
        $userTypeDetail = UserType::find($id);
        return view('admin.customer.userType', compact('userTypeDetail'));
    }
    /**
     * Update User type
     */
    public function updateUserType(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
        ]);

        try {
            $userType = UserType::find($id);
            $userType->user_type_name = ucfirst($request->name);
            $userType->save();
            return redirect()->to(route('admin.userTypeList'))->with('success', 'User Type Updated Sucessfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
    /**
     * Active User type
     */
    public function activeUserType($id)
    {
        try {
            $userType = UserType::find($id);
            $userType->status = "1";
            $userType->save();
            return redirect()->back()->with('success', 'User Type Active Successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
    /**
     * Deactive User type
     */
    public function deactiveUserType($id)
    {
        try {
            $userType = UserType::find($id);
            $userType->status = "0";
            $userType->save();
            return redirect()->back()->with('success', 'User Type Deactive Successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }


    // service
    // ===========================================================================================

    /**
     * Add Service form
     */
    public function serviceFormPage()
    {
        $userTypes = UserType::all();
        return view('admin.service.addService', compact('userTypes'));
    }

    /**
     * Add Service
     */
    public function addService(Request $request)
    {
        $request->validate([
            'user_type_id' => 'required ',
            'name' => 'required',
            'price' => 'required | numeric',
            'description' => 'required ',
            'image' => 'required | mimes:jpg,png,jpeg | max:5048',
        ]);
        try {
            $profilePicture = $request->file('image');

            $new_image = hexdec(uniqid()) . '.' . $profilePicture->getClientOriginalExtension();
            $profilePicture->move('site/uploads/service/', $new_image);
            $save_url = '/site/uploads/service/' . $new_image;

            $service = new Service();
            $service->service_name = ucfirst($request->name);
            $service->user_type_id = $request->user_type_id;
            $service->service_price = $request->price;
            $service->service_description = ucfirst($request->description);
            $service->service_image = $save_url;
            $service->save();
            return redirect()->back()->with('success', 'Service Added Sucessfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Display Service
     */
    public function serviceDetails()
    {
        $services = DB::table('services')
            ->join('user_types', 'services.user_type_id', '=', 'user_types.id')
            ->select(
                'services.*',
                'services.id as service_id',
                'services.status as service_status',
                'user_types.*'
            )
            ->get();
        return view('admin.service.serviceDetail', compact('services'));
    }

    /**
     * Edit Service
     */
    public function editService($id)
    {
        $serviceDetail = Service::find($id);
        $userTypes = UserType::all();
        return view('admin.service.addService', compact('serviceDetail', 'userTypes'));
    }

    /**
     * Update Service
     */
    public function updateService(Request $request, $id)
    {
        $request->validate([
            'user_type_id' => 'required ',
            'name' => 'required',
            'price' => 'required | numeric',
            'description' => 'required ',
            'image' => 'mimes:jpg,png,jpeg | max:5048',
        ]);
        try {
            $service = Service::find($id);
            $service->service_name = ucfirst($request->name);
            $service->user_type_id = $request->user_type_id;
            $service->service_price = $request->price;
            $service->service_description = ucfirst($request->description);
            if ($request->file('image') != null) {
                $profilePicture = $request->file('image');

                $new_image = hexdec(uniqid()) . '.' . $profilePicture->getClientOriginalExtension();
                $profilePicture->move('site/uploads/service/', $new_image);
                $save_url = '/site/uploads/service/' . $new_image;
                $service->service_image = $save_url;
            }
            $service->save();
            return redirect()->to(route('admin.serviceDetails'))->with('success', 'Service Updated Sucessfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Active Service
     */
    public function activeService($id)
    {
        try {
            $service = Service::find($id);
            $service->status = "1";
            $service->save();
            return redirect()->back()->with('success', 'Service Active Successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Deactive Service
     */
    public function deactiveService($id)
    {
        try {
            $service = Service::find($id);
            $service->status = "0";
            $service->save();

            return redirect()->back()->with('success', 'Service Deactive Successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    // delete service
    public function deleteService($id)
    {
        try {
            $service = Service::find($id);
            $service->delete();
            return redirect()->back()->with('success', 'Service Deleted Successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }


    // order
    // ===========================================================================================

    /**
     * Display Order Details
     */
    public function orders()
    {
        $purchaseDetails = DB::table('payments')
            ->join('users', 'payments.user_id', '=', 'users.id')
            ->join('user_types', 'users.user_type_id', '=', 'user_types.id')
            ->select(
                'users.id as user_id',
                'users.name as user_name',
                'users.email as user_email',
                'users.contact_number as user_phone',
                'users.address as user_address',
                'payments.payment_type',
                'payments.t_code as t_code',
                'payments.total_amount as payment_amount',
                'payments.payment_status as payment_status',
                DB::raw('DATE(payments.created_at) as payment_date'),
                'user_types.user_type_name',
                'payments.t_code'
            )
            ->leftJoin('assign_orders', 'payments.t_code', '=', 'assign_orders.t_code') // left join assign_orders table with payments table
            ->whereNull('assign_orders.t_code') // where assign_orders.t_code is null
            ->get();
        $stafDetails = DB::table('admins')
            ->where('admin_type', '=', 0)
            ->select('admins.id', 'admins.name', 'admins.email', 'admins.contact_number',)
            ->get();
        // dd($stafDetails);
        return view('admin.order.order', compact('stafDetails', 'purchaseDetails'));
    }

    /**
     * Display Order Details By Tcode
     */
    public function orderDetailsByTcode(Request $request)
    {
        // dd($request->all());
        $t_code = $request->t_code;
        $orderDetails = DB::table('orders')
            ->join('payments', 'orders.t_code', '=', 'payments.t_code')
            ->join('users', 'payments.user_id', '=', 'users.id')
            ->join('services', 'orders.service_id', '=', 'services.id')
            ->join('user_types', 'users.user_type_id', '=', 'user_types.id')
            ->select(
                'orders.id as order_id',
                'users.id as user_id',
                'users.name as user_name',
                'users.email as user_email',
                'users.contact_number as user_phone',
                'users.address as user_address',
                'payments.payment_type',
                'payments.t_code as t_code',
                'payments.total_amount as payment_amount',
                'payments.payment_status as payment_status',
                'orders.status as order_status',
                DB::raw('DATE(orders.created_at) as order_date'),
                'orders.order_quantity',
                'orders.order_amount',
                'services.id as service_id',
                'services.service_name',
                'services.service_price',
                'user_types.user_type_name'
            )
            ->where('payments.t_code', '=', $t_code)
            ->get();
        return response()->json([
            'success' => true,
            'message' => 'Order Details',
            'data' => $orderDetails,
        ]);
    }

    /**
     * Assign Order
     */
    public function assignTask(Request $request)
    {
        $request->validate([
            't_code' => 'required',
            'staff_data' => 'required|array',
        ]);

        try {
            $t_code = $request->t_code;
            $staffData = $request->staff_data; // Updated variable name

            foreach ($staffData as $data) {
                $staff_id = $data['staff_id']; // Extract staff_id from the data
                $remark = $data['remark']; // Extract remark from the data

                // Create and save a new AssignOrder instance
                $assignedTask = new AssignOrder();
                $assignedTask->t_code = $t_code;
                $assignedTask->staff_id = $staff_id;
                
                $assignedTask->remark = $remark; // Save the remark

                $assignedTask->save();
            }

            return response()->json([
                'success' => true,
                'message' => 'Task Assigned Successfully',
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Display Assigned Order Details
     */
    public function assignedOrderDetails()
    {
        $orderQuery = DB::table('payments')
            ->join('users', 'payments.user_id', '=', 'users.id')
            ->join('user_types', 'users.user_type_id', '=', 'user_types.id')
            ->select(
                'users.id as user_id',
                'users.name as user_name',
                'users.email as user_email',
                'users.contact_number as user_phone',
                'users.address as user_address',
                'payments.payment_type',
                'payments.total_amount as payment_amount',
                'payments.payment_status as payment_status',
                DB::raw('DATE(payments.created_at) as payment_date'),
                'user_types.user_type_name',
                'payments.t_code',
            )->get();


        $assignedOrderDetails = [];

        foreach ($orderQuery as $item) {
            $assignData = DB::table('assign_orders')
                ->join('admins', 'assign_orders.staff_id', '=', 'admins.id')
                ->select('assign_orders.*', 'admins.*')
                ->where('assign_orders.t_code', '=', $item->t_code)
                ->where('assign_orders.status', '=', 2)
                ->get();

            $serviceData = DB::table('orders')
                ->join('services', 'orders.service_id', '=', 'services.id')
                ->select('orders.*', 'services.*')
                ->where('orders.t_code', '=', $item->t_code)
                ->get();

            $a = [];
            $c = [];
            foreach ($assignData as $aItem) {
                $a[] = $aItem;
            }
            foreach ($serviceData as $sItem) {
                $c[] = $sItem;
            }
            if (!empty($a)) {
                $assignedOrderDetails[] = [
                    'user_id' => $item->user_id,
                    'user_name' => $item->user_name,
                    'user_email' => $item->user_email,
                    'user_phone' => $item->user_phone,
                    'user_address' => $item->user_address,
                    'payment_type' => $item->payment_type,
                    'payment_amount' => $item->payment_amount,
                    'payment_status' => $item->payment_status,
                    'payment_date' => $item->payment_date,
                    'user_type_name' => $item->user_type_name,
                    't_code' => $item->t_code,
                    'assignData' => $a,
                    'serviceData' => $c,
                ];
            }
        }

        // $assignedOrderDetails = array_values($assignedOrderDetails);
        // dd($assignedOrderDetails);
        return view('admin.order.assignedOrderDetails', compact('assignedOrderDetails'));
    }

    /**
     * Display Completed Order Details
     */
    public function completedOrderDetails()
    {
        $orderQuery = DB::table('payments')
            ->join('users', 'payments.user_id', '=', 'users.id')
            ->join('user_types', 'users.user_type_id', '=', 'user_types.id')
            ->select(
                'users.id as user_id',
                'users.name as user_name',
                'users.email as user_email',
                'users.contact_number as user_phone',
                'users.address as user_address',
                'payments.payment_type',
                'payments.total_amount as payment_amount',
                'payments.payment_status as payment_status',
                DB::raw('DATE(payments.created_at) as payment_date'),
                'user_types.user_type_name',
                'payments.t_code',
            )->get();


        $assignedOrderDetails = [];

        foreach ($orderQuery as $item) {
            $assignData = DB::table('assign_orders')
                ->join('admins', 'assign_orders.staff_id', '=', 'admins.id')
                ->select('assign_orders.*', 'assign_orders.status as assignOrdersStatus', 'admins.*')
                ->where('assign_orders.t_code', '=', $item->t_code)
                ->get();
                
            // complete order where status = 1
            $completeOrder = DB::table('orders')
                ->join('services', 'orders.service_id', '=', 'services.id')
                ->select('orders.*', 'services.*')
                ->where('orders.t_code', '=', $item->t_code)
                ->where('orders.status', '=', 1)
                ->get();

            // incomplete / pending  order where status = 2 
            $inCompleteOrder = DB::table('orders')
                ->join('services', 'orders.service_id', '=', 'services.id')
                ->select('orders.*', 'orders.status as orderStatus', 'services.*')
                ->where('orders.t_code', '=', $item->t_code)
                ->where('orders.status', '=', 2)
                ->get();

            $a = [];
            $c = [];
            $d = [];




            foreach ($assignData as $aItem) {
                $a[] = $aItem;
            }
            foreach ($completeOrder as $sItem) {
                $c[] = $sItem;
            }
            foreach ($inCompleteOrder as $sItem) {
                $d[] = $sItem;
            }
            if (!empty($a) && !empty($c)) {

                $assignedOrderDetails[] = [
                    'user_id' => $item->user_id,
                    'user_name' => $item->user_name,
                    'user_email' => $item->user_email,
                    'user_phone' => $item->user_phone,
                    'user_address' => $item->user_address,
                    'payment_type' => $item->payment_type,
                    'payment_amount' => $item->payment_amount,
                    'payment_status' => $item->payment_status,
                    'payment_date' => $item->payment_date,
                    'user_type_name' => $item->user_type_name,
                    't_code' => $item->t_code,
                    'assignData' => $a,
                    'completeOrder' => $c,
                    'inCompleteOrder' => $d,
                ];
            }
        }

        // $assignedOrderDetails = array_values($assignedOrderDetails);
        // dd($assignedOrderDetails);
        return view('admin.order.orderCompeted', compact('assignedOrderDetails'));
    }

    /**
     * Display Order Cancel by Staff
     */
    public function cancelOrder()
    {
        $orderQuery = DB::table('payments')
            ->join('users', 'payments.user_id', '=', 'users.id')
            ->join('user_types', 'users.user_type_id', '=', 'user_types.id')
            ->select(
                'users.id as user_id',
                'users.name as user_name',
                'users.email as user_email',
                'users.contact_number as user_phone',
                'users.address as user_address',
                'payments.payment_type',
                'payments.total_amount as payment_amount',
                'payments.payment_status as payment_status',
                DB::raw('DATE(payments.created_at) as payment_date'),
                'user_types.user_type_name',
                'payments.t_code',
            )->get();


        $assignedOrderDetails = [];

        foreach ($orderQuery as $item) {
            $assignData = DB::table('assign_orders')
                ->join('admins', 'assign_orders.staff_id', '=', 'admins.id')
                ->select('assign_orders.*', 'admins.*')
                ->where('assign_orders.t_code', '=', $item->t_code)
                ->where('assign_orders.status', '=', 0)
                ->get();

            $serviceData = DB::table('orders')
                ->join('services', 'orders.service_id', '=', 'services.id')
                ->select('orders.*', 'services.*')
                ->where('orders.t_code', '=', $item->t_code)
                ->get();

            $a = [];
            $c = [];
            foreach ($assignData as $aItem) {
                $a[] = $aItem;
            }
            foreach ($serviceData as $sItem) {
                $c[] = $sItem;
            }
            if (!empty($a)) {
                $assignedOrderDetails[] = [
                    'user_id' => $item->user_id,
                    'user_name' => $item->user_name,
                    'user_email' => $item->user_email,
                    'user_phone' => $item->user_phone,
                    'user_address' => $item->user_address,
                    'payment_type' => $item->payment_type,
                    'payment_amount' => $item->payment_amount,
                    'payment_status' => $item->payment_status,
                    'payment_date' => $item->payment_date,
                    'user_type_name' => $item->user_type_name,
                    't_code' => $item->t_code,
                    'assignData' => $a,
                    'serviceData' => $c,
                ];
            }
        }

        // $assignedOrderDetails = array_values($assignedOrderDetails);
        // dd($assignedOrderDetails);
        return view('admin.order.cancellAsignedOrder', compact('assignedOrderDetails'));
    }


    // staff
    // ===========================================================================================

    /**
     * Display Staff Form
     */
    public function staffRegisterPage()
    {
        return view('admin.staff.addStaff');
    }

    /**
     * Display Staff List
     */
    public function staffDetail()
    {
        $staffDetails = DB::table('admins')
            ->where('admin_type', '=', 0)
            ->select('admins.id', 'admins.name', 'admins.email', 'admins.contact_number', 'admins.status')
            ->get();
        return view('admin.staff.staffDetail', compact('staffDetails'));
    }

    /**
     * Add Staff Details
     */
    public function addStaff(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'contact_number' => 'required | min:10 | unique:admins',
            'email' => 'required | email | unique:admins',
            'password' => 'required',
            'conform_password' => 'required | same:password',
        ]);
        try {
            $staff = new Admin();
            $staff->name = ucfirst($request->name);
            $staff->email = $request->email;
            $staff->contact_number = $request->contact_number;
            $staff->password = $request->password;
            $staff->admin_type = 0;
            $staff->status = 1;
            $staff->save();
            return redirect()->back()->with('success', 'Staff Added Sucessfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Edit Staff Details
     */
    public function editStaff($id)
    {
        $staffDetail = Admin::find($id);
        return view('admin.staff.addStaff', compact('staffDetail'));
    }

    /**
     * Update Staff Details
     */
    public function updateStaff(Request $request, $id)

    {
        $request->validate([
            'name' => 'required',
            'contact_number' => 'required | min:10 | unique:admins,contact_number,' . $id,
            'email' => 'required | email | unique:admins,email,' . $id,
            'password' => '',
            'conform_password' => 'same:password',
        ]);
        try {
            $userdetils = DB::table('admins')
                ->select(
                    'admins.password',
                )
                ->where('admins.id', '=', $id)
                ->get();
            $staff = Admin::find($id);
            $staff->name = $request->name;
            $staff->email = $request->email;
            $staff->contact_number = $request->contact_number;
            if ($request->password != null) {
                $staff->password = Hash::make($request->password);
            } else {
                $staff->password = $userdetils[0]->password;
            }
            $staff->save();
            return redirect()->to(route('admin.staffDetail'))->with('success', 'Staff Updated Sucessfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Active Staff
     */
    public function activeStaff($id)
    {
        try {
            $staff = Admin::find($id);
            $staff->status = 1;
            $staff->save();
            return redirect()->back()->with('success', 'Staff Active Successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Deactive Staff
     */
    public function deactiveStaff($id)
    {
        try {
            $staff = Admin::find($id);
            $staff->status = 0;
            $staff->save();
            return redirect()->back()->with('success', 'Staff Deactive Successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    // delete staff
    public function deleteStaff($id)
    {
        try {
            $staff = Admin::find($id);
            $staff->delete();
            return redirect()->back()->with('success', 'Staff Deleted Successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }



    /**
     * Display Assigned Order Staff Details
     */
    public function assignedOrderStaffDetailsByTcode(Request $request)
    {
        $staffDetails = DB::table('assign_orders')
            ->join('admins', 'assign_orders.staff_id', '=', 'admins.id')
            ->select(
                'assign_orders.id as assign_id',
                'assign_orders.t_code',
                'assign_orders.staff_id',
                'assign_orders.status',
                'assign_orders.remark',
                'admins.id as staff_id',
                'admins.name',
                'admins.email',
                'admins.contact_number',
            )
            ->where('assign_orders.t_code', '=', $request->t_code)
            ->get();
        // dd($staffDetails);

        return response()->json([
            'success' => true,
            'message' => 'Staff Details',
            'data' => $staffDetails,
        ]);
    }
    // ===========================================================================================

    // reports

    /**
     * Display report
     */
    public function purchaseReport(){
        $orderQuery = DB::table('payments')
            ->join('users', 'payments.user_id', '=', 'users.id')
            ->join('user_types', 'users.user_type_id', '=', 'user_types.id')
            ->select(
                'users.id as user_id',
                'users.name as user_name',
                'users.email as user_email',
                'users.contact_number as user_phone',
                'users.address as user_address',
                'payments.payment_type',
                'payments.total_amount as payment_amount',
                'payments.payment_status as payment_status',
                DB::raw('DATE(payments.created_at) as payment_date'),
                'user_types.user_type_name',
                'payments.t_code')
                ->where('payments.payment_status', '=', 2)
            ->get();


        $assignedOrderDetails = [];

        foreach ($orderQuery as $item) {
            $assignData = DB::table('assign_orders')
                ->join('admins', 'assign_orders.staff_id', '=', 'admins.id')
                ->select('assign_orders.*', 'admins.*')
                ->where('assign_orders.t_code', '=', $item->t_code)
                ->get();

            $serviceData = DB::table('orders')
                ->join('services', 'orders.service_id', '=', 'services.id')
                ->select('orders.*', 'services.*')
                ->where('orders.t_code', '=', $item->t_code)
                ->get();

            $a = [];
            $c = [];
            foreach ($assignData as $aItem) {
                $a[] = $aItem;
            }
            foreach ($serviceData as $sItem) {
                $c[] = $sItem;
            }
            if (!empty($a)) {
                $assignedOrderDetails[] = [
                    'user_id' => $item->user_id,
                    'user_name' => $item->user_name,
                    'user_email' => $item->user_email,
                    'user_phone' => $item->user_phone,
                    'user_address' => $item->user_address,
                    'payment_type' => $item->payment_type,
                    'payment_amount' => $item->payment_amount,
                    'payment_status' => $item->payment_status,
                    'payment_date' => $item->payment_date,
                    'user_type_name' => $item->user_type_name,
                    't_code' => $item->t_code,
                    'assignData' => $a,
                    'serviceData' => $c,
                ];
            }
        }
        // dd($assignedOrderDetails);
        
        return view('admin.report.purchaseReport',compact('assignedOrderDetails'));
    }














    // ====================================================

    public function profile()
    {
        dd('admin profile');
        return view('admin.profile');
    }

    public function updateProfile(Request $request)
    {
        dd('admin update profile');
        return view('admin.updateProfile');
    }

    public function credentials()
    {
        dd('admin credentials');
        return view('admin.credentials');
    }

    public function updateCredentials(Request $request)
    {
        dd('admin update credentials');
        return view('admin.updateCredentials');
    }

    public function adminLogout()
    {
        if (Session::has('adminLogedIn')) {
            Session::pull('adminLogedIn');

            return redirect()->to('/');
            return response()->json([
                'success' => true,
                'message' => 'admin log out sucessfully',
            ]);
        } else {
            return redirect()->to('/');
            return response()->json([
                'success' => false,
                'message' => 'User Login page',
            ]);
        }
    }
}
