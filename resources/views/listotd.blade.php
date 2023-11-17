<select class="form-select {{$idotd}}" style="height: 28px;">
<option value="0" style="background:lightgray">из списка...</option>
@foreach($data as $row)
<option value="{{$row->id}}">
{{$row->otd_name}}
</option>
@endforeach
</select>     