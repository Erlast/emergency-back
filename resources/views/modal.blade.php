<table style="margin-left: 20px;">
    <tr>
	    <input type="hidden" id="hideid" data-id="{{$num_data->id}}">
	<td>
	    Введите городской номер:
	</td>
	<td>
	    <input type="text" id="newcitynum" value="{{$num_data->sity_num}}">
	</td>
    </tr>
    <tr>
	<td>
	    Введите внутренний номер:
	</td>
	<td>
	    <input type="text" id="newlocnum" value="{{$num_data->loc_num}}">
	</td>
    </tr>
    <tr>
	<td>
	    Чьих будет?:
	</td>
	<td>
	    <input type="text" id="location" value="{{$num_data->location}}">
	</td>
    </tr>
</table>