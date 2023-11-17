
</table>

    <table class="table table-bordered">
        <thead class="table-primary">
	
        <tr>
            <th>Абонент</th>
            <th>Номер</th>
            	    @if(\Illuminate\Support\Facades\Auth::check())
		<th>#</th>
	    @endif
        </tr>
        </thead>
        <tbody>	
@foreach($spisok as $row)

    @isset($row->sity_num)
     <tr>
      <td> {{$row->location}} </td>
      <td> {{$row->sity_num}}  </td>
	    	
     @if(\Illuminate\Support\Facades\Auth::check())
	 <td>
            <button type="button" class="remph btn btn-danger" data-id="{{$row->id}}">
                <i class="bi bi-trash"></i>
            </button>
            <button type="button" class="updph btn btn-success" data-id="{{$row->id}}">
                <i class="bi bi-vector-pen"></i>
            </button>
	 </td>
     @endif
   @endisset

   @if(!empty($row->loc_num))
    <tr>
	<td> {{$row->location}} </td>
	<td> {{$row->loc_num}}  </td>
       @if(\Illuminate\Support\Facades\Auth::check())
	  <td>
            <button type="button" class="remph btn btn-danger" data-id="{{$row->id}}">
                <i class="bi bi-trash"></i>
            </button>
            <button type="button" class="updph btn btn-success" data-id="{{$row->id}}">
                <i class="bi bi-vector-pen"></i>
            </button>
	  </td>
	@endif
   </tr>
    @endif
@endforeach
    </tbody>
</table>
