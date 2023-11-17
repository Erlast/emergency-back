@extends("start")

@section('divtype')
    "container"
@endsection

@section('content')
<div align="center" class="navbar text-light bg-dark">
    <div class="container"  style="margin-top: 10px; margin-bottom: 10px;">
	<div class="mtb-2 text-dark row">
    	    <div class="col-auto text-light">
		Выберите отделение:
    		@include('listotd', ['data' => $data])
            @if(\Illuminate\Support\Facades\Auth::check())
                
                    <button type="button" class="btn btn-success btn-sm" id='otd_butt'>
                    <i class="bi bi-vector-pen" width='32' height='32'>&nbspДобавить</i>
                    </button>

                   
                    <button type="button" id="addph_button" class="btn btn-warning btn-sm updph" style="margin-left:15px;" data-id="0">
                    <i class="bi bi-phone-vibrate" width='32' height='32'>&nbspДоб. номер</i>			    
		    </button>
                  
                
            @endif

            </div>
       </div>
    </div>
</div>

<div class="container-fluid" id="maindiv">
@endsection


%
<div class="modal fade" id="add_phone_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div id="mbody" class="modal-body container">
              <div class="row">
		<table>
		  <tr>
		    <td>
                	Выберите отделение:
		    </td>
		    <td>
    	    		@include('listotd', ['data' => $data])
		    </td>
		  </tr>
		</table>
              </div>
	      
              <div class="row numdata">
	      </div>    
            </div>
            <div class="modal-footer">

                <button type="button" class="btn btn-success"id="savedata">
                    <i class="bi bi-vector-pen" style="font-size: 1rem;">&nbspДоб./Ред.</i>
                </button>
            
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    <i class="bi bi-door-open" style="font-size: 1rem;">&nbspЗакрыть</i>
                </button>
            </div>
        </div>
    </div>
</div>
