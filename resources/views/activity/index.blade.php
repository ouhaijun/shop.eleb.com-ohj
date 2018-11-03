
@extends('layout.default')
@section('contents')
    <table class="table table-bordered">
        <tr>
            <th>ID</th>
            <th>活动名称</th>
            <th>活动开始时间</th>
            <th>活动结束时间</th>
            <th>操作</th>
        </tr>
        @foreach($activitys as $activity)
            <tr>
                <td>{{ $activity->id }}</td>
                <td>{{ $activity->title }}</td>
                <td>{{ date('Y-m-d',$activity->start_time) }}</td>
                <td>{{ date('Y-m-d',$activity->end_time) }}</td>
                <td>
                    <a href="{{ route('activitys.show',$activity) }}" class="btn-primary btn-sm" style="float: left;">查看</a>
                    {{--<a href="{{ route('activitys.edit',$activity) }}" class="btn-warning btn-sm" style="float: left;">修改</a>
                    <form action="{{ route('activitys.destroy',$activity) }}" method="post">
                        {{ csrf_field() }}
                        {{ method_field('delete') }}
                        <button class="btn btn-danger btn-sm" style="float: left;">删除</button>
                    </form>--}}
                </td>
            </tr>
        @endforeach
    </table>
    {{ $activitys->links() }}

@endsection