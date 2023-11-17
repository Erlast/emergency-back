@extends("start")

@section('divtype')
    "container-fluid"
@endsection

@section('content')
<div class="navbar  bg-primary" style="height: 70px;">
 <div class="row container-fluid">
    <div class="col-sm-auto form-inline">
	    <label for="inv" class="col-form-label">Инв. номер</label>
	    <div class="col-sm-auto">
                <input name="inpnum" type="text" id="inv" class="form-control form-control-sm">
	    </div>
                <label for="ip" class="col-form-label">IP</label>
	    <div class="col-sm-auto">
                <input name="inpip" type="text" id="ip" class="form-control form-control-sm">
	    </div>
	    <div class="findtech col-sm-auto">
                <button type="button" class="btn btn-success" id="search_org">
                <i class="bi bi-search">&nbspНайти</i>
                </button>
	    </div>
    </div>
    
    <div class="col-sm-auto form-inline">
        <label class="col-form-label">По отделениям</label>
	<div class="listfortech col-sm-auto">
        @include('listotd', ['data' => $data,'idotd'=>'otdtech'])
	</div>
    </div>
    <div class="listfortech col-auto">

		<button type="button" class="btn btn-warning" id="all_tech">
                <i class="bi bi-receipt-cutoff"></i>&nbspALL
                </button>


		<button type="button" class="btn btn-danger" id="show_repair_button">
                <i class="bi bi-wrench-adjustable"></i>&nbspPem
                </button>

		<button type="button" class="btn btn-success" id="add_print_button">
                <i class="bi bi-printer-fill"></i>&nbsp+Устройство
                </button>
		<button type="button" class="acb btn btn-warning" id="add_cartrige_button">
                <i class="bi bi-window-plus"></i>&nbsp+Картридж
                </button>
    		<button type="button" class="btn btn-warning" id="add_model_button">
                <i class="bi bi-printer-fill"></i>&nbsp+Марка
                </button>

    </div>
 </div>
</div>
    <div class="container-fluid" id="maindiv">

    </div>
@endsection


<div class="modal fade" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" id="orgmodal">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div id="mbody" class="modal-body container">
	
		<div id="org_mod_context">
		</div>
              
            </div>
            <div class="modal-footer">

                <button type="button" class="btn btn-success"id="save_data_button">
                    <i class="bi bi-vector-pen" style="font-size: 1rem;">&nbspДоб./Ред.</i>
                </button>

                <button type="button" class="btn btn-info"id="saveOrg">
                    <i class="bi bi-vector-pen" style="font-size: 1rem;">&nbspДоб./Ред.</i>
                </button>

                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    <i class="bi bi-door-open" style="font-size: 1rem;">&nbspЗакрыть</i>
                </button>
            </div>
        </div>
    </div>
</div>
