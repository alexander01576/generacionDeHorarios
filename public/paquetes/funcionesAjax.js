function message_error(obj) {
    var html = '';
    if (typeof (obj) === 'object') {
        html = '<ul style="text-align: left;">';
        $.each(obj, function (key, value) {
            html += '<li>' + key + ': ' + value + '</li>';
        });
        html += '</ul>';
    } else {
        html = '<p>' + obj + '</p>';
    }
    Swal.fire({
        title: '¡Error!',
        html: html,
        icon: 'error'
    });
}

function submit_with_ajax(url, metodo, parameters, callback) {

    $.ajax({
        url: url,
        type: metodo,
        data: parameters,
        dataType: 'json',
        processData: false,
        contentType: false,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
    }).done(function (data) {
        if (!data.hasOwnProperty('error')) {
            callback(data);
            return false;
        }
        message_error(data.error);
        if (data.message) {
            Swal.fire(
                '¡Correcto!',
                data.message,
                'success'
            )
        }
    }).fail(function (jqXHR, textStatus, errorThrown) {
        alert(textStatus + ': ' + errorThrown);
    }).always(function (data) {

    });
}

function submit_with_ajax_spinner(url, metodo, parameters, callback) {
    var btnSubmit = document.getElementById('btnSubmit');
    var spinner = document.getElementById('spinner');
    btnSubmit.setAttribute('disabled', 'true');
    spinner.setAttribute('class', 'spinner-border spinner-border-sm');

    $.ajax({
        url: url,
        type: metodo,
        data: parameters,
        dataType: 'json',
        processData: false,
        contentType: false,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
    }).done(function (data) {
        btnSubmit.removeAttribute('disabled');
        spinner.setAttribute('class', '');
        if (!data.hasOwnProperty('error')) {
            callback(data);
            return false;
        }
        message_error(data.error);
        if (data.message) {
            Swal.fire(
                '¡Correcto!',
                data.message,
                'success'
            )
        }
    }).fail(function (jqXHR, textStatus, errorThrown) {
        alert(textStatus + ': ' + errorThrown);
        btnSubmit.removeAttribute('disabled');
        spinner.setAttribute('class', '');
    }).always(function (data) {

    });
}
