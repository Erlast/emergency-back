    <table class="table table-bordered">
        <thead class="table-dark">
        <tr>
            <th>Инв.№</th>
	    <th>Марка</th>
            <th>Отдел</th>
            <th>Место</th>
            <th>Детали</th>
            <th>#</th>
        </tr>
        </thead>
        <tbody>
        @foreach($tab as $row)
            <tr>
                <td>{{$row->inv_num}}</td>
		<td>{{$row->printName->name}}</td>
		<td>{{$row->otdName->otd_name}}</td>
                <td>{{$row->mesto}}</td>
                <td>
		    <button type="button" class="detailtech btn btn-link" data-id="{{$row->id}}">
		    	<i class="bi bi-gear-fill" style="font-size: 1rem;">&nbspДетальная информация</i>
            	    </button>
		</td>
                <td>
                    <button type="button" class="orgtechedit btn btn-success" data-id="{{$row->id}}">
			<i class="bi bi-vector-pen" style="font-size: 1rem;"></i>
                    </button>
                    <button type="button" class="orgtechdelete btn btn-danger" data-id="{{$row->id}}">
			<i class="bi bi-trash" style="font-size: 1rem;"></i>
                    </button>

               </td>
            </tr>
        @endforeach
        </tbody>
    </table>

