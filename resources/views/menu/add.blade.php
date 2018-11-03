@extends('layout.default')
@section('contents')
    @include('layout._errors')
    <!--引入CSS-->
    <link rel="stylesheet" type="text/css" href="/webuploader/webuploader.css">

    <!--引入JS-->
    <script type="text/javascript" src="/webuploader/webuploader.js"></script>

    <!--SWF在初始化的时候指定，在后面将展示-->
    <form action="{{ route('menus.store') }}" method="post">
        <div class="form-group">
            <label>名称</label>
            <input type="text" name="goods_name" class="form-control" value="{{ old('goods_name') }}">
        </div>
        <div class="form-group">
            <label>评分</label>
            <input type="number" name="rating" class="form-control" value="{{ old('rating') }}">
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
            <label>所属分类ID</label>
            <select name="category_id" class="form-control">
                @foreach($menucategorys as $menucategory)
                    <option value="{{ $menucategory->id }}">{{ $menucategory->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label>价格</label>
            <input type="number" name="goods_price" class="form-control" value="{{ old('goods_price') }}">
        </div>
        <div class="form-group">
            <label>描述</label>
            <input type="text" name="description" class="form-control" value="{{ old('description') }}">
        </div>
        <div class="form-group">
            <label>月销量</label>
            <input type="number" name="month_sales" class="form-control" value="{{ old('month_sales') }}">
        </div>
        <div class="form-group">
            <label>评分数量</label>
            <input type="number" name="rating_count" class="form-control" value="{{ old('rating_count') }}">
        </div>
        <div class="form-group">
            <label>提示信息</label>
            <input type="text" name="tips" class="form-control" value="{{ old('tips') }}">
        </div>
        <div class="form-group">
            <label>满意度数量</label>
            <input type="number" name="satisfy_count" class="form-control" value="{{ old('satisfy_count') }}">
        </div>
        <div class="form-group">
            <label>满意度评分</label>
            <input type="number" name="satisfy_rate" class="form-control" value="{{ old('satisfy_rate') }}">
        </div>
       {{-- <div class="form-group">
            <label>商品图片</label>
            <input type="text" name="goods_img">
            <div id="uploader-demo">
                <!--用来存放item-->
                <div id="fileList" class="uploader-list"></div>
                <div id="filePicker">选择图片</div>
            </div>
            <img>
        </div>--}}
        <div class="form-group">
            <label>商品图片</label>
            <input type="hidden" name="goods_img" id="img">
            <!--dom结构部分-->
            <div id="uploader-demo">
                <!--用来存放item-->
                <div id="fileList" class="uploader-list"></div>
                <div id="filePicker">选择图片</div>
            </div>
            <img id="pic" style="width: 100px;"/>
        </div>


        <div class="form-group">
            <label>状态</label>
            <input type="checkbox" name="status" value="1" @if(old('status')) checked="checked" @endif>
        </div>

        {{ csrf_field() }}
        <button class="btn btn-primary btn-block">添加</button>
    </form>
@stop
@section('javascript')
    <script>
        // 初始化Web Uploader
        var uploader = WebUploader.create({
            // 选完文件后，是否自动上传。
            auto: true,
            // swf文件路径
            //swf: BASE_URL + '/js/Uploader.swf',
            // 文件接收服务端。
            server: '{{route('upload')}}',
            // 选择文件的按钮。可选。
            // 内部根据当前运行是创建，可能是input元素，也可能是flash.
            pick: '#filePicker',

            // 只允许选择图片文件。
            accept: {
                title: 'Images',
                extensions: 'gif,jpg,jpeg,bmp,png',
                mimeTypes: 'image/*'
            },

            formData:{
                _token:"{{csrf_token()}}"
            }
        });

        uploader.on('uploadSuccess',function (file,response) {
            $("#pic").attr('src',response.path);
            $("#img").val(response.path);
        });

    </script>
@stop

