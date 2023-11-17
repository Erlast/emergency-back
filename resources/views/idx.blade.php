@extends('start')

@section('divtype')
    "container"
@endsection

@section('content')
<h3 class="border border-success rounded-pill" style="background: #17a6a6; color: white">Последние новости нашей больницы:</h3>
    @foreach ($rss as $oneNews)
	
	<div class=" container border border-info rounded rounded-bottom" style="margin-top: 15px;">
	    <div class="row" style="background:#11a5fa">
		<div class="col-sm-4" style="background:#11a5fa; text-align: left">
		     @if(\Illuminate\Support\Facades\Auth::check())
	                
        	            <i class="bi bi-trash removenews btn-danger" data-id="{{$oneNews->id}}"></i>
    	                
		     @endif
		</div>
		<div class="col-sm-4" style="background:#11a5fa; font-weight: bold; color: white;">
		    {{$oneNews->news_title}}
		</div>
		<div class="col-sm-4" style="background:#11a5fa; color:black; text-align: right">
		    {{$oneNews->created_at}}
		</div>
	    </div>
	    <div class="row border-top border-info" style="text-align: left; margin-left: 5px; padding-top: 5px">{!! $oneNews->news_body !!}</div>
	</div>
    @endforeach
    <div style="margin-top: 25px;">
    {{ $rss->links() }}
    </div>
@endsection
