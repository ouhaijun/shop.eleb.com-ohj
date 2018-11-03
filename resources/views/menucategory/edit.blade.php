@extends('layout.default')
@section('contents')
    @include('layout._errors')
    <form action="{{ route('menucategorys.update',$menucategory) }}" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label>名称</label>
            <input type="text" name="name" class="form-control" value="{{ $menucategory->name }}">
        </div>
        <div class="form-group">
            <label>菜品编号</label>
            <input type="text" name="type_accumulation" class="form-control" value="{{ $menucategory->type_accumulation }}">
        </div>
        {{--<div class="form-group">
            <label>所属商家ID</label>
            <select name="shop_id" class="form-control">
                @foreach($shops as $shop)
                    <option value="{{ $shop->id }}">{{ $shop->shop_name }}</option>
                @endforeach
            </select>
        </div>--}}
        <div class="form-group">
            <label>	描述</label>
            <input type="text" name="description" class="form-control" value="{{ $menucategory->description }}">
        </div>
        <div class="form-group">
            <label>
                @if($menucategory->is_selected==1)
                <input type="checkbox" name="is_selected" value="0">取消默认
                @else
                <input type="checkbox" name="is_selected" value="1">默认
                @endif
            </label>
        </div>
        {{ csrf_field() }}
        {{ method_field('put') }}
        <button class="btn btn-primary btn-block">添加</button>
    </form>

@stop
