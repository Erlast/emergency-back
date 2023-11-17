@extends('cartridges.index')
@section('inner_content')
    <div class="row justify-content-end">
        <div class="col-xs-1">
            <input name="dates" class="form-control"/>
        </div>
        <div class="col-xs-1" style="margin-left: 5px">
            <button class="btn btn-success download-xlsx"><i class="bi bi-download"></i> Export .xlsx</button>
        </div>
    </div>
    <table class="table table-striped table-bordered" id="cartridge_history">
        <thead>
        <tr>
            <th scope="col">Модель</th>
            <th scope="col">С заправки</th>
            <th scope="col">На заправку</th>
            <th scope="col">Из отдела</th>
            <th scope="col">В отдел</th>
            <th scope="col">На складе</th>
        </tr>
        </thead>
    </table>
@endsection
