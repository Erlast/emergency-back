@extends('start')

@section('divtype')
    "container"
@endsection

@section('content')
<h3 class="border border-success rounded-pill" style="background: green; color: white">Последние новости нашей больницы:</h3>
    @foreach ($rss as $oneNews)
	
	<div class=" container border border-info rounded rounded-bottom" style="margin-top: 15px;">
	    <div class="row">
		<div class="col-sm-4" style="background:#11a5fa; text-align: left">
		     @if(\Illuminate\Support\Facades\Auth::check())
	                <button type="button" class="removenews btn btn-small btn-danger" name="del_news_butt" data-id="{{$oneNews->id}}">
        	            <i class="bi bi-trash"></i>
    	                </button>
		     @endif
		</div>
		<div class="col-sm-4" style="background:#11a5fa; font-weight: bold; color: darkred;">
		    {{$oneNews->news_title}}
		</div>
		<div class="col-sm-4" style="background:#11a5fa; color:black">
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
