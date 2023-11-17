
<div id="mod_context" data-modal="registration">
<div class="row">
Марка картриджа&nbsp
   <select id="sel_cartmark">
     @foreach($cartReestr as $cartModel)
        <option value={{$cartModel->id}}>
            {{$cartModel->name}}
        </option>
    @endforeach
   </select>
</div>

<div class="row" style="margin-top: 5px;"> 
Куда ставится&nbsp
   <select id="sel_printmark">
     @foreach($techReestr as $techModel)
        <option value={{$techModel->id}}>
            {{$techModel->name}}
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
