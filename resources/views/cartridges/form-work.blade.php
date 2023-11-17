<div id="mod_context" data-modal="work">
    <div class="row" style="margin-top: 5px;">
        Куда выдаем&nbsp
        <select id="sel_otd">
            @foreach($departments as $department)
                <option value={{$department->id}}>
                    {{$department->otd_name}}
                </option>
            @endforeach
        </select>
    </div>

    <div class="row" style="margin-top: 5px;">
        Штрих-код&nbsp
        <input type="text" id="sh_code" OnKeyUp=regCart()>
    </div>

    <div class="alert alert-success" role="alert" style="display:none">
        <h4 class="alert-heading">Отличная работа!</h4>
        <p>Картридж успешно выдан</p>
    </div>

</div>
