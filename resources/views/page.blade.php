@extends("start")

@section('divtype')
    "container"
@endsection

@section('content')
    <table class="table table-bordered" id="doctab">
        <thead class="table-dark">
        <tr>

            @if(\Illuminate\Support\Facades\Auth::check())
                <th colspan="2">
                    Список документов
                </th>

            @else
                <th>
                    Список документов
                </th>
            @endif
       </tr>
        </thead>
       <tbody>
    @if($id=='mis')
	<tr>
	    <td colspan="2">
		<a href="{{url('page/lis')}}">[ЛИС]</a>
	    </td>
	</tr>
	<tr>
	    <td colspan="2">
		<a href="{{url('page/covid')}}">[COVID19]</a>
	    </td>
	</tr>
	<tr>
	    <td colspan="2">
		<a href="{{url('page/aptech')}}">[АПТЕКА]</a>
	    </td>
	</tr>
	<tr>
	    <td colspan="2">
		<a href="{{url('page/nach')}}">[Оформление отказных ИБ]</a>
	    </td>
	</tr>
	<tr>
	    <td colspan="2">
		<a href="{{url('tfoms?id=tfoms')}}">[Ошибки ТФОМС]</a>
	    </td>
	</tr>


    @endif
    @if($id=='prikaz')
	<tr>
	    <td colspan="2">
		<a href="{{url('medform/?id=medform')}}">[Унифицированные формы мед. документации приказ МЗ РФ №530н]</a>
	    </td>
	</tr>
	<tr>
    @endif

    @foreach($docs as $doc)

        <tr>
            <td>
                <a target="blank" href={{$doc->doc}}>{{$doc->name}}</a>
            </td>
            @if(\Illuminate\Support\Facades\Auth::check())
                <td class="col-sm-1">
                    <button type="button" class="removebutton btn btn-danger" name="delbutt" data-id="{{$doc->id}}">
			<i class="bi bi-trash"></i>
		    </button>
                </td>
            @endif
        </tr>
    @endforeach
        </tbody>
    </table>
@endsection

