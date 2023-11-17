<H1>Акт передачи картриджей на заправку от {{date("d.m.Y")}}</H1>
<table class="table table-bordered">
    <tr>
        <th>Код</th><th>Модель картриджа</th><th>Марка принтера</th>
    </tr>
    @foreach($cartridges as $cartridge)
        <tr>
            <td>{{$cartridge->sh_code}}</td>
            <td>{{$cartridge->cartName->name}}</td>
            <td>{{$cartridge->printName->name}}</td>
        </tr>
    @endforeach
</table>
