<input type="hidden" id="id" value={{$detail->id}}>
<table>
<tr>
<td>
Отделение установки
</td>
<td>
<select class="selotdels" id="selectotdel" style="height: 28px;">
<option value="0" style="background:lightgray">Устанавливаем в...</option>
@foreach($listOtdels as $row)
@if ($row->id  == $detail->otdel_id)
<option selected value="{{$row->id}}">
@else
<option value="{{$row->id}}">
@endif
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
Инвентарный №
</td>
<td>
<input type="text" id="invnum" value={{$detail->inv_num}}>
</td>
</tr>

<tr>
<td>
IP
</td>
<td>
<input type="text" id="ip" value={{$detail->ip}}>
</td>
</tr>

<tr>
<td>
Прим.
</td>
<td>
<input type="text" id="drum" value={{$detail->drum}}>
</td>
</tr>


<tr>
<td>
В ремонт
</td>
<td>
<label class="checkbox-ios">
<input type="checkbox" class="repairbox" id="repairbox">
<span class="checkbox-ios-switch"></span>
</label>
</td>
</tr>


</table>

