<input type="hidden" value={{$type}} id="type_add">
<select class="selcart" id="selectcart" style="height: 28px;">
<option value="0" style="background:lightgray">у нас уже есть...</option>
@foreach($listCart as $row)
<option value="{{$row->id}}">
{{$row->name}}
</option>
@endforeach
</select>     
<input type="text" placeholder="Добавьте, если не нашли..." id="newvalue">