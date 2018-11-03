<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    //订单列表
    public function index()
    {
        $orders=Order::paginate(3);
        return view('order.index',compact('orders'));

    }
    //订单详情
    public function show(order $order)
    {
        //$tel=OrderDetail::where('order_id',$order->id)->get();
        //dd($tel[1]->id);
        return view('order.show',compact('order'));

    }
    //取消订单
    public function del(order $order)
    {
        //dd(1);
        $order->update([
            'status'=>-1,
        ]);

        return redirect('orders')->with('success','取消成功');
    }
    //发货
    public function save(order $order)
    {
        $order->update([
            'status'=>1,
        ]);
        return redirect('orders')->with('success','发货成功');
    }



}
