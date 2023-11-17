<table class="table table-bordered">
    <thead class="table-dark">
        <tr>
            <th>
                Дата
            </th>
            <th>
                Номер
            </th>
            <th>
                Что делали
            </th>
        </tr>
    </thead>
    <tbody>
@foreach($table as $row)
        <tr>
            <td>{{$row->created_at}}</td>
            <td>{{$row->invnum}}</td>
            <td>{{$row->target}}</td>
        </tr>
@endforeach
    <tbody>
</table>
