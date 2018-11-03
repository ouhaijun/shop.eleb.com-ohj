
@extends('layout.default')
@section('contents')
    <table class="table table-bordered">
        <tr>
            <th>订单id</th>
            <th>用户ID</th>
            <th>商家ID</th>
            <th>订单编号</th>
            <th>省</th>
            <th>市</th>
            <th>县</th>
            <th>详细地址</th>
            <th>收货人电话</th>
            <th>收货人姓名</th>
            <th>价格</th>
            <th>状态</th>
            <th>创建时间</th>
            <th>第三方交易号</th>
           {{-- <th>商品id</th>
            <th>商品数量</th>
            <th>商品名称</th>
            <th>商品图片</th>
            <th>商品价格</th>
            <th>操作</th>--}}
        </tr>
            <tr>
                <td>{{ $order->id }}</td>
                <td>{{ $order->user_id }}</td>
                <td>{{ $order->shop_id }}</td>
                <td>{{ $order->sn }}</td>
                <td>{{ $order->province }}</td>
                <td>{{ $order->city }}</td>
                <td>{{ $order->county }}</td>
                <td>{{ $order->address }}</td>
                <td>{{ $order->tel }}</td>
                <td>{{ $order->name }}</td>
                <td>{{ $order->total }}</td>
                <td>@if($order->status==-1)已取消@elseif($order->status==0)待支付@elseif($order->status==1)待发货@elseif($order->status==2)待确认@elseif($order->status==3)完成@endif</td>
                <td>{{ $order->created_at }}</td>
                <td>{{ $order->out_trade_no }}</td>
              {{--  @foreach($tel as $v)
                <td>{{ $v->goods_id }}</td>
                <td>{{ $v->amount }}</td>
                <td>{{ $v->goods_name }}</td>
                <td><img src="{{ $v->goods_img }}" width="100px"></td>
                <td>{{ $v->goods_price }}</td>
                    @endforeach--}}
            </tr>
    </table>

@endsection