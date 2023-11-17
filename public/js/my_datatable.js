$(document).ready(function () {
    let start = null
    let end = null
    let picker = $('input[name="dates"]')

    picker.daterangepicker({
        startDate: moment().startOf('month'),
        endDate: moment().endOf('month'),
        locale: {
            format: 'DD.MM.YYYY',
            separator: ' - ',
            applyLabel: 'Применить',
            cancelLabel: 'Отмена',
            fromLabel: 'С',
            toLabel: 'До',
            customRangeLabel: 'Разные',
            weekLabel: 'Н',
            daysOfWeek: ['Вс', 'Пн', 'Вт', 'Ср', 'Чт', 'Пт', 'Сб'],
            monthNames: ['Январь', 'Февраль', 'Март', 'Апрель', 'Май', 'Июнь', 'Июль', 'Август', 'Сентябрь', 'Октябрь', 'Ноябрь', 'Декабрь'],
            firstDay: 1
        }
    });

    picker.on('apply.daterangepicker', function (ev, picker) {
        start = picker.startDate.format('YYYY-MM-DD')
        end = picker.endDate.format('YYYY-MM-DD')
        table.ajax.reload()
    });

    let table = $('#cartridge_history').DataTable({
        processing: true,
        serverSide: true,
        searching: false,
      //  stateSave: true,
        "ajax": {
            url: '/cartridge/history/get',
            data: function (d) {
                if (start)
                    d.startDate = start
                if (end)
                    d.endDate = end
            }
        },
        "language": mJson,
        "order": [[0, "desc"]],
        columns: [
            {
                data: 'cartridge_id',
                name: 'cartridge_id'
            },
            {
                data: 'on_fill',
                name: 'on_fill',
            },
            {
                data: 'from_fill',
                name: 'from_fill',
            },
            {
                data: 'to_department',
                name: 'to_department',
            },
            {
                data: 'from_department',
                name: 'from_department',
            },
            {
                data: 'on_storage',
                name: 'on_storage',
            },
        ],
        columnDefs: [{'orderable': false, targets: [5]}],
        aLengthMenu: [
            [10, 50, 100, 200, -1],
            [10, 50, 100, 200, "Все"]],
        iDisplayLength: 10
    });

    $('.download-xlsx').on('click', function () {
        $.ajax({
            xhrFields: {
                responseType: 'blob',
            },
            type: 'POST',
            url: '/cartridge/download',
            data: {
                'startDate': start,
                'endDate': end
            },
            success: function (data) {
                const url = window.URL.createObjectURL(new Blob([data], {
                    type: 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
                }));
                const link = document.createElement('a');
                link.href = url;
                link.download = `Statistics_${start}_-_${end}.xlsx`;
                document.body.appendChild(link);
                link.click();
            }
        })

    })
})


