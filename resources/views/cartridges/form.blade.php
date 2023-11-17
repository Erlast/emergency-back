<div id="mod_context" data-modal="registration">
    <div class="row">
        Марка картриджа&nbsp
        <select id="sel_cartmark">
            @foreach($cartridgeBrands as $brand)
                <option value={{$brand->id}}>
                    {{$brand->name}}
                </option>
            @endforeach
        </select>
    </div>

    <div class="row" style="margin-top: 5px;">
        Куда ставится&nbsp
        <select id="sel_printmark">
            @foreach($printerModels as $printerModel)
                <option value={{$printerModel->id}}>
                    {{$printerModel->name}}
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
        <p>Картридж успешно добавлен в базу!</p>
    </div>
</div>
