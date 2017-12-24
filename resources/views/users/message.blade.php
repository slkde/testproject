@extends('parents')
@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <table class="table table-hover table-inverse table-responsive">
                <thead class="thead-inverse">
                    <tr>
                        <th>发件人</th>
                        <th>标题</th>
                        <th>内容</th>
                    </tr>
                    </thead>
                    <tbody>
                        {!! dd($messages) !!}
                        @foreach($messages as $v)
                        <tr>
                            <td scope="row">{{ $v->message_title }}</td>
                            <td>{!! dd($v) !!}</td>
                            <td></td>
                        </tr>
                        @endforeach
                    </tbody>
            </table>
        </div>
        
    </div>
</div>


@endsection