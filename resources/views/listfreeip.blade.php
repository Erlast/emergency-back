<ul class="nav nav-tabs" id="myTab" role="tablist">
    <li class="nav-item" role="presentation">
        <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">IP 36.x</button>
    </li>
    <li class="nav-item" role="presentation">
        <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">IP 37.x</button>
    </li>
    <li class="nav-item" role="presentation">
        <button class="nav-link" id="messages-tab" data-bs-toggle="tab" data-bs-target="#messages" type="button" role="tab" aria-controls="messages" aria-selected="false">IP 38.x</button>
    </li>
    <li class="nav-item" role="presentation">
        <button class="nav-link" id="settings-tab" data-bs-toggle="tab" data-bs-target="#settings" type="button" role="tab" aria-controls="settings" aria-selected="false">IP 39.x</button>
    </li>
</ul>

<!-- Tab panes -->
<div class="tab-content">
    <div class="tab-pane active" id="home" role="tabpanel" aria-labelledby="home-tab">
            <table class="table table-bordered">
                <tbody>
                @foreach($tab36 as $ip36)
                <tr><td>{{$ip36->ip}}</td></tr>
                @endforeach
                </tbody>
            </table>
    </div>
    <div class="tab-pane" id="profile" role="tabpanel" aria-labelledby="profile-tab">
        <table class="table table-bordered">
            <tbody>
            @foreach($tab37 as $ip37)
                <tr><td>{{$ip37->ip}}</td></tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <div class="tab-pane" id="messages" role="tabpanel" aria-labelledby="messages-tab">
        <table class="table table-bordered">
            <tbody>
            @foreach($tab38 as $ip38)
                <tr><td>{{$ip38->ip}}</td></tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <div class="tab-pane" id="settings" role="tabpanel" aria-labelledby="settings-tab">
        <table class="table table-bordered">
            <tbody>
            @foreach($tab39 as $ip39)
                <tr><td>{{$ip39->ip}}</td></tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
