@extends('start')

@section('divtype')
    'container-fluid'
@endsection

@section('content')
    <div align="center" class="navbar  bg-primary">
      <div align="center" class="container-fluid col-8" style="margin-top: 10px; margin-bottom: 10px;">
        <div class="mtb-2 text-dark row">


             <div class="col-auto">
            <label>Тип оборудования</label>
            <select name="ttype" id="itype">
                <option value="all">-----</option>
                <option value="pc">ПК</option>
                <option value="sys">сист. блок</option>
                <option value="mon">монитор</option>
                <option value="print">принтер</option>
                <option value="mfu">МФУ</option>
                <option value="tech">т-ка</option>
            </select>
          </div>
          <div class="col-auto">
            <label>Инвентарник</label>
            <input type="text" id="inn" name="inpinvnum">
          </div>
          <div class="col-auto">
            <label>Назначение</label>
            <input type="text" id="sprava" name="inptarget">
          </div>
          <div class="col-auto">
            <input type="button" id="ab" class="btn btn-success" value="Добавить операцию">
            <input type="button" id="rembutt" class="btn btn-warning" value="Вспомнить все">
          </div>


        </div>
      </div>
    </div>
    <div class="container" id="tabdiv">

    </div>
@endsection
