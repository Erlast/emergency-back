@extends("start")

@section('divtype')
    "container-fluid"
@endsection

@section('content')
    <div align="center"  class="navbar  bg-primary">
        <div class="container"  style="margin-top: 10px; margin-bottom: 10px;">
            <div class="mtb-2 text-dark row">
                <div class="col-auto">
                    <form method="get" id="formpc" class="row g-3">

                        <div class="col-auto">
                            <label for="inv" class="form-label">Инв. номер</label>
                        </div>
                        <div class="col-auto">
                            <input name="inpnum" type="text" id="inv" class="form-control form-control-sm">
                        </div>

                        <div class="col-auto">
                            <label for="ip" class="form-label">IP</label>
                        </div>
                        <div class="col-auto">
                            <input name="inpip" type="text" id="ip" class="form-control form-control-sm">
                        </div>

                        <div class="col-auto">
                            <input type="button" id="sb" class="btn btn-success btn-sm" value="Hайти"/>
                        </div>

                    </form>

                </div>

                <div class="col-auto row mtb-2">
                    <div class="col-auto">
                        <label for="krp" class="form-label">Или просто выберите корпус</label>
                    </div>
                    <div class="col-auto row mtb-3">
                        <select id="krp" class="form-select form-select-lg">
                            <option value="f">----</option>
                            <option value="Хирургия">Хирургия</option>
                            <option value="Терапия">Терапия</option>
                            <option value="3 корпус">3 корпус</option>
                            <option value="ЛСК">ЛСК</option>
                            <option value="Поликлиника">Поликлиника</option>
                            <option value="Пищеблок">Пищеблок</option>
                            <option value="Патанатомия">Патанатомия</option>
                            <option value="Невроцентр">Невр. центр</option>
                            <option value="all">Все</option>
                        </select>
                    </div>
                   <div class="col-auto row mtb-3" style="margin-left: 5px;">
                    <input type="button" id="iplist" class="btn btn-warning btn-sm" value="Свободные IP">
                   </div>
                </div>
            </div>
        </div>
    </div>
<div class="container-fluid" id="maindiv">

</div>
@endsection
<!--
                    <div class="col-auto">
                        <input type="button" id="stat" class="btn btn-warning" value="Статистика">
                        <input type="button" id="sel" class="btn btn-warning" value="Select">
                        <input type="button" id="iplist" class="btn btn-warning" value="Свободные IP">
                    </div>




-->
