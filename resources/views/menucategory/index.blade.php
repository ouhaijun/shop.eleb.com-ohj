
@extends('layout.default')
@section('contents')
    <table class="table table-bordered">
        <tr>
            <th>ID</th>
            <th>名称</th>
            <th>菜品编号</th>
            <th>所属商家ID</th>
            <th>描述</th>
            <th>是否是默认分类</th>
            <th>操作</th>
        </tr>
        @foreach($menucategorys as $menucategory)
            <tr>
                <td>{{ $menucategory->id }}</td>
                <td>{{ $menucategory->name }}</td>
                <td>{{ $menucategory->type_accumulation }}</td>
                <td>{{ $menucategory->shop->shop_name }}</td>
                <td>{{ $menucategory->description }}</td>
                <td>@if($menucategory->is_selected)是@else否@endif</td>
                <td>
                    <a href="{{ route('menucategorys.edit',$menucategory) }}" class="btn-warning btn-sm">修改</a>
                    <form action="{{ route('menucategorys.destroy',$menucategory) }}" method="post">
                        {{ csrf_field() }}
                        {{ method_field('delete') }}
                        <button class="btn btn-danger btn-sm">删除</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
    {{ $menucategorys->links() }}

@endsection