<input type="hidden" id="id" value={{$id}}>
<table>
<tr>
<td>
Отделение установки
</td>
<td>
<select class="selotdels" id="selectotdel" style="height: 28px;">
<option value="0" style="background:lightgray">Устанавливаем в...</option>
@foreach($listOtdels as $row)
<option value="{{$row->id}}">
{{$row->otd_name}}
</option>
@endforeach
</select>
</td>
</tr>

<tr>
<td>
Место установки
</td>
<td>
<select class="selotdels" id="target" style="height: 28px;">
    <option value="0">-----</option>
    <option value="Ординаторская">Ординаторская</option>
    <option value="Зав. отделением">Зав. отделением</option>
    <option value="Старшая сестра">старшая сестра</option>
    <option value="Пост">Пост</option>
    <option value="Кабинет">Кабинет</option>
</select>
</td>
</tr>


<tr>
<td>
Марка аппарата
</td>
<td>
<select class="selmodels" id="selectmodel" style="height: 28px;">
<option value="0" style="background:lightgray">Модель...</option>
@foreach($listModels as $row)
<option value="{{$row->id}}">
{{$row->name}}
</option>
@endforeach
</select>
</td>
</tr>

<tr>
<td>
Картридж
</td>
<td>
<select class="selmodels" id="selectcart" style="height: 28px;">
<option value="0" style="background:lightgray">Картридж...</option>
@foreach($listCart as $row)
<option value="{{$row->id}}">
{{$row->name}}
</option>
@endforeach
</select>
</td>
</tr>



<tr>
<td>
Прим.
</td>
<td>
<input type="text" id="drum" value='0'>
</td>
</tr>


<tr>
<td>
Инвентарный №
</td>
<td>
<input type="text" id="invnum">
</td>
</tr>



<tr>
<td>
IP
</td>
<td>
<input type="text" value="{{$row->ip}}" id="ip">
</td>
</tr>

</table>