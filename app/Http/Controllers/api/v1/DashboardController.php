<?php


namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;



class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function orders()
    {



        $orders = Order::all();


        return JsonResource::make($orders);
    }

    public function index()
    {


        $userscont = User::all()->count();
        $orderCont = Order::Ordercount();
        $totalSaels = Order::TotalSaels();
        $data = [
            'userscont' => $userscont,
            'orderCont' => $orderCont['totalOrders'],
            'paidOrders' => $orderCont['paidOrders'],
            'unpaidOrders' => $orderCont['unpaidOrders'],
            'totalSaels' => $totalSaels

        ];
        return JsonResource::make($data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
