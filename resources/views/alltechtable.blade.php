
    <table class="table table-bordered">
        <thead class="table-dark">
        <tr>
            <th>Инв.№</th>
	    <th>Марка</th>
            <th>Место</th>
            <th>Прим.</th>
        </tr>
        </thead>
        <tbody>
        @foreach($tab as $otdel)
	  <tr style="background: yellow; font-weight: bold;"><td colspan="5">{{$otdel->otd_name}}</td></tr>
	    @foreach($otdel->searchOrg as $row)
	      <tr>	
		<td>{{$row->inv_num}}</td>
                <td>{{$row->printName->name}}</td>
                <td>{{$row->mesto}}</td>
                <td>{{$row->drum}}</td>
	      </tr>
	    @endforeach
        @endforeach
        </tbody>
    </table>

