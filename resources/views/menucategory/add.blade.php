@extends('layout.default')
@section('contents')
    @include('layout._errors')
    <form action="{{ route('menucategorys.store') }}" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label>名称</label>
            <input type="text" name="name" class="form-control" value="{{ old('name') }}">
        </div>
        <div class="form-group">
            <label>菜品编号</label>
            <input type="text" name="type_accumulation" class="form-control" value="{{ old('type_accumulation') }}">
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
            <input type="text" name="description" class="form-control" value="{{ old('description') }}">
        </div>
        <div class="form-group">
            <label>是否是默认分类</label>
            <input type="checkbox" name="is_selected" value="1" @if(old('is_selected')) checked="checked" @endif>
        </div>
        {{ csrf_field() }}
        <button class="btn btn-primary btn-block">添加</button>
    </form>

@stop
