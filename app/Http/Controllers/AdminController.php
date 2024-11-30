<?php

namespace App\Http\Controllers;

use App\Models\order;
use App\Models\User;
use Illuminate\Http\Request;
use App\Services\SMSService;

class AdminController extends Controller
{

    protected $smsService;

    public function __construct(SMSService $smsService)
    {
        $this->smsService = $smsService;
    }

    public function sendSampleSMS()
    {
        // Define a sample phone number and message
        $number = "8801779542054"; // Replace with a valid number
        $message = "Your Thikana verification code is- 501598";

        // Send the SMS using the SMSService
        $response = $this->smsService->sendSMS($number, $message);

        // Return the response for testing purposes
        return response()->json(['message' => 'SMS sent successfully', 'response' => $response]);
    }


    // Set Cookies
    public function setCookies()
    {
        $response = response('');
        $response->withCookie('mahedi', 'This is Mahedi', 60);
        return $response;
    }

    // Get Cookies
    public function getCookies()
    {
        $cookies = request()->cookie('guest_id');
        return $cookies;
    }

    // Del Cookies
    public function delCookies()
    {
        $cookies = response('')->cookie('mahedi', null, -1);
        return $cookies;
    }

    public function getBalance()
    {
        $url = "http://bulksmsbd.net/api/getBalanceApi";
        $api_key = "kEgMDDr8FmA5QLv5IyHD"; // Replace with your actual API key

        $data = [
            "api_key" => $api_key
        ];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        $response = curl_exec($ch);
        curl_close($ch);

        return json_decode($response, true); // Assuming the API returns JSON data
    }

    // Dashboard Page
    public function admin()
    {
        $totalOrders = order::count();
        $totalUsers = user::count();
        $orderslist =  order::get();
        $balance = $this->getBalance(); // Get the balance
        $totalSales = Order::sum('total'); // Assuming 'total' is the column for order amounts

        // Fetch total orders for each month dynamically
        $orders = Order::selectRaw("MONTHNAME(created_at) as month, COUNT(*) as total")
            ->groupBy('month')
            ->orderByRaw("MONTH(created_at)")
            ->get();

        // Separate the data into labels and values
        $labels = $orders->pluck('month')->toArray();
        $data = $orders->pluck('total')->toArray();

        return view('admin.dashboard', compact('totalOrders', 'totalUsers', 'orderslist', 'balance', 'totalSales', 'labels', 'data'));
    }

    // Dashboard Profile Page
    public function profile()
    {
        return view('admin.profile');
    }

    // Dashboard Users Page
    public function users()
    {
        $users = User::all();
        return view('admin.users.index', compact('users'));
    }

    // Dashboard product Create Page


    // Dashboard product Create Page


    public function checkemail(Request $request)
    {
        $email = $request->input('email');
        $user = User::where('email', $email)->first();

        if ($user) {
            return response()->json(['exists' => true]);
        }

        return response()->json(['exists' => false]);
    }
}
