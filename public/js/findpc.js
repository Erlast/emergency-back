$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$("#sb").on('click', function (event) {
    let inpnum=$('#inv').val();
    let inpip=$('#ip').val();
    if (inpnum && inpip){alert("Номера или IP хватит. Не надо и то и то"); return;}
    $.ajax({
        type:'POST',
        url:'pcl',
        data:{inpnum:inpnum,inpip:inpip},
        success:function (response) {
            console.log(response)
            $('#maindiv').html(response)
        }
    })
});

$("#krp").on('change', function (event) {
    let korp=$('#krp').val();
    $.ajax({
        type:'POST',
        url: 'pcl',
        data:{krp:korp},
        success:function (response) {
            console.log(response)
            $('#maindiv').html(response)
        }
    })
//        alert('here')
});

$("#iplist").on('click', function (event) {
    $.ajax({
        type:'POST',
        url:'ipl',
        data:{},
        success:function (response) {
            console.log(response)
            $('#maindiv').html(response)
        }
    })
});

$("#ab").on('click', function (event) {
    let type=$('#itype').val();
    let inv=$('#inn').val();
    let target=$('#sprava').val();
    if (type=="all" || !inv || !target){alert('Заполните все данные пожалллста!'); return false}
    $.ajax({
        type:'POST',
        url:'ttable',
        data:{type:type,inv:inv,target:target},
        success:function (response) {
            console.log(response)
            alert('Инфо добавлено!');
        }
    })
});

$("#rembutt").on('click', function (event) {
    let type=$('#itype').val();
    let inv=$('#inn').val();
    $.ajax({
        type:'POST',
        url:'allwork',
        data:{type:type,inv:inv},
        success:function (response) {
            console.log(response)
            $('#tabdiv').html(response)
        }
    })
});

