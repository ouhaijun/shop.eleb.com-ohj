
@extends('layout.default')
@section('contents')
    <table class="table table-bordered">
        <tr>
            <th>ID</th>
            <th>用户ID</th>
            <th>商家ID</th>
            <th>收货人电话</th>
            <th>收货人姓名</th>
            <th>状态</th>
            <th>价格</th>
            <th>操作</th>
        </tr>
        @foreach($orders as $order)
            <tr>
                <td>{{ $order->id }}</td>
                <td>{{ $order->user_id }}</td>
                <td>{{ $order->shop_id }}</td>

                <td>{{ $order->tel }}</td>
                <td>{{ $order->name }}</td>
                <td>@if($order->status==-1)已取消@elseif($order->status==0)待支付@elseif($order->status==1)待发货@elseif($order->status==2)待确认@elseif($order->status==3)完成@endif</td>
                <td>{{ $order->total }}</td>
                <td>
                    <a href="{{ route('orders.show',$order) }}" class="btn  btn-primary" style="float: left">查看</a>
                    <form action="{{ route('order.del',$order) }}" method="post">
                        {{ csrf_field() }}
                        <button class="btn btn-success" style="float: left">取消订单</button>
                    </form>
                    <form action="{{ route('order.save',$order) }}" method="post">
                        {{ csrf_field() }}
                        <button class="btn btn-warning" style="float: left">发货</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
{{ $orders->links() }}

@endsection