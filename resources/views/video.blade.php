@extends("start")

@section('divtype')
    "container"
@endsection

@section('content')
    <table class="table table-bordered">
        <thead class="table-dark">
        <tr>
            <th>
                Список видеоматериалов
            </th>
        </tr>
        </thead>
        <tbody>
        @if( $id==='telemed')
            <tr><td><a href="https://tmc.egisz.rosminzdrav.ru/">ФЕДЕРАЛЬНАЯ ТЕЛЕМЕДИЦИНСКАЯ СИСТЕМА</a></td></tr>
            <tr><td><a href="/storage/telemed/ТМК_ФЭР_Руководство_пользователя_Врач.pdf">«ФЕДЕРАЛЬНАЯ ЭЛЕКТРОННАЯ РЕГИСТРАТУРА» Руководство врача</a></td></tr>
            <tr><td><a href="/storage/telemed/letter804.pdf">Письмо МЗ № 804 О телемедицинских консультациях</a></td></tr>
        @endif
        @foreach($docs as $doc)

            <tr>
                <td>

                    <button class="btn btn-link" onclick="playvideo('{{$doc->doc}}')">{{$doc->name}}</button>
                </td>
            </tr>
        @endforeach

        </tbody>
    </table>
@endsection

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div id="mbody" class="modal-body">
                <iframe width='800' height='450' allowfullscreen ></iframe>
            </div>
            <div class="modal-footer">
                <button type="button" onclick="stopvideo()" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>
            </div>
        </div>
    </div>
</div>

