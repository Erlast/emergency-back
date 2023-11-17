@if($tab->isEmpty())
    <table class="table table-bordered table-danger">
        <tr><th>Ошибка!</th></tr>
        <tr><td>Ничего не нашли. Проверьте номер/IP. И что ПК уже не списан</td></tr>
    </table>
@else
    <table class="table table-bordered">
        <thead class="table-dark">
        <tr>
            <th>Инв.№</th>
            <th>Сер. №</th>
            <th>Корпус</th>
            <th>Этаж</th>
            <th>Помещение</th>
            <th>Кабинет</th>
            <th>Имя ПК</th>
            <th>Врач</th>
            <th>IP</th>
            <th>МАС адрес</th>
            <th>Система</th>
            <th>Лицензия ОС</th>
            <th>Офис</th>
            <th>Лицензия офиса</th>
            <th>#</th>
        </tr>
	@if($cin)
	    <tr>
		Всего {{$cin}} ПК по корпусу
	    </tr>
	@endif
        </thead>
        <tbody>
        @foreach($tab as $row)
            <tr>
                <td>{{$row->inv}}</td>
                <td>{{$row->ser}}</td>
                <td>{{$row->korp}}</td>
                <td>{{$row->etaj}}</td>
                <td>{{$row->pom}}</td>
                <td>{{$row->kab}}</td>
                <td>{{$row->pc}}</td>
                <td>{{$row->doctor}}</td>
                <td>{{$row->ip}}</td>
                <td>{{$row->mac}}</td>
                <td>{{$row->os}}</td>
                <td>{{$row->licos}}</td>
                <td>{{$row->office}}</td>
                <td>{{$row->licoffice}}</td>
                <td>
                    <button type="button" class="fio btn btn-success" data-id="{{$row->id}}">
			<i class="bi bi-vector-pen" style="font-size: 1rem;"></i>
                    </button>
               </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endif

