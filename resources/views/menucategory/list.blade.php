
@extends('layout.default')
@section('contents')

    <form action="/menucategory/list" method="get" class="form-group">
        <input type="hidden" name="id" value="{{ $id }}">
        <input type="text" name="section" size="15" />
        <input type="text" name="sections" size="15" />
        <input type="text" name="keys" size="15" />
        <input type="submit" value="搜索" class="btn btn-warning" />
    </form>
    <ul class="nav nav-pills nav-stacked">
        @foreach($articles as $article)
        <li role="presentation" class="active"><a href="/menucategory/list?id={{ $article->id }}">{{ $article->name }}</a></li>
        @endforeach
    </ul>

    <table class="table table-bordered">
        <tr>
            <th>ID</th>
            <th>名称</th>
            <th>评分</th>
            <th>所属商家ID</th>
            <th>所属分类ID</th>
            <th>价格</th>
            <th>描述</th>
            <th>月销量</th>
            <th>评分数量</th>
            <th>提示信息</th>
            <th>满意度数量</th>
            <th>满意度评分</th>
            <th>商品图片</th>
            <th>状态</th>
            <th>操作</th>
        </tr>
       @foreach($menus as $menu)
            <tr>
                <td>{{ $menu->id }}</td>
                <td>{{ $menu->goods_name }}</td>
                <td>{{ $menu->rating }}</td>
                <td>{{ $menu->shop->shop_name}}</td>
                <td>{{ $menu->category->name }}</td>

                <td>{{ $menu->goods_price }}</td>
                <td>{{ $menu->description }}</td>
                <td>{{ $menu->month_sales }}</td>
                <td>{{ $menu->rating_count }}</td>
                <td>{{ $menu->tips }}</td>
                <td>{{ $menu->satisfy_count }}</td>
                <td>{{ $menu->satisfy_rate }}</td>
                <td>
                    <img src="{{ $menu->goods_img }}" width="100px">
                </td>
                <td>@if($menu->status)上架@else下架@endif</td>
                <td>
                    <a href="{{ route('menus.edit',$menu) }}" class="btn-warning btn-sm">修改</a>
                    <form action="{{ route('menus.destroy',$menu) }}" method="post">
                        {{ csrf_field() }}
                        {{ method_field('delete') }}
                        <button class="btn btn-danger btn-sm">删除</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>


@endsection