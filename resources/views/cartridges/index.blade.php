@extends("start")

@section('divtype')
    "container"
@endsection

@section('content')
    <div class="container bordered" id="maindiv">
        <div class="row">

            <div class="col-sm-auto">
                <button type="button" class="btn btn-success" id="reg_cart">
                    <i class="bi bi-plus-circle-fill">&nbspДобавить</i>
                </button>
            </div>

            <div class="col-sm-auto">
                <button type="button" class="btn btn-info" id="on_storage">
                    <i class="bi bi-hospital-fill">&nbspПринять</i>
                </button>
            </div>

            <div class="col-sm-auto">
                <button type="button" class="btn btn-info" id="on_fill">
                    <i class="bi bi-droplet-fill">&nbspНа заправку</i>
                </button>
            </div>

            <div class="col-sm-auto">
                <button type="button" class="btn btn-info" id="give_cart">
                    <i class="bi bi-printer-fill">&nbspВыдать</i>
                </button>
            </div>

            <div class="col-sm-auto">
                <button type="button" class="btn btn-danger" id="kill_cart">
                    <i class="bi bi-x-octagon-fill">&nbspСписать</i>
                </button>
            </div>
            <div class="col-sm-auto">
                <button type="button" class="btn btn-warning" id="report_fill">
                    <i class="bi bi-chat-left-text-fill">&nbspАкт</i>
                </button>
            </div>

            <div class="col-sm-auto">
                <button type="button" class="btn btn-warning" id="report_storage">
                    <i class="bi  bi-chat-left-text-fill">&nbspУ нас</i>
                </button>
            </div>

            <div class="col-sm-auto">
                <button type="button" class="btn btn-warning" id="clact">
                    <i class="bi  bi-chat path-minus-fill">&nbspОчистить акт</i>
                </button>
            </div>

            <div class="col-sm-auto">
                <a type="button" class="btn btn-link" href="/cartridge/history">История</a>
            </div>


        </div>
    </div>
    @yield('inner_content')
@endsection

<div class="modal fade" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" id="cartModal">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div id="mbody" class="modal-body container">
                <div id="cart_modal_context" style="padding-left: 20px;">
                </div>
            </div>
            <div class="modal-footer">

                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    <i class="bi bi-door-open" style="font-size: 1rem;">&nbspЗакрыть</i>
                </button>
            </div>
        </div>
    </div>
</div>
