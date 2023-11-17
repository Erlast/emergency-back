@extends("start")

@section('divtype')
    "container"
@endsection

@section('content')

    <table class="table table-bordered">
        <thead class="table-dark">
        <tr>
            <th>Приказ и инструкции</th>
        </tr>
        </thead>
        <tbody>
            @foreach($fdirs as $dir)
                <tr><td> <a href="{{url('kadr/?id='.$path.'/'.$dir)}}">{{'['.$dir.']'}}</a> </td></tr>

            @endforeach
            @foreach($ffiles as $ffile)
                <tr><td> <a href="{{url('storage/'.$path.'/'.$ffile)}}">{{$ffile}}</a> </td></tr>
            @endforeach

        </tbody>
    </table>
@endsection
