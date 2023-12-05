/**
 *
 * You can write your JS code here, DO NOT touch the default style file
 * because it will make it harder for you to update.
 *
 */

"use strict";


$(document).ready(function () {
    $(document).on('click', '#delete', function () {
        var del_id = $(this).data('id');
        // var url = $(this).attr('data-url');
        // alert(url);
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        swal({
            title: "Are you sure?",
            text: "You will not be able to recover this imaginary file!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes, delete it!",
            cancelButtonText: "No, Cancel!",
            closeOnConfirm: true,
        }, function (isConfirm) {
            if (!isConfirm) return;

            document.getElementById('delete-booking-' + del_id).submit();
        });
    });
});

function getLiveTime(date) {
    "use strict";
    var hours = date.getHours();
    var minutes = date.getMinutes();
    var seconds = date.getSeconds();
    var ampm = hours >= 12 ? 'PM' : 'AM';
    hours = hours % 12;
    hours = hours ? hours : 12;
    minutes = minutes < 10 ? '0' + minutes : minutes;
    seconds = seconds < 10 ? '0' + seconds : seconds;
    var strTime = hours + ':' + minutes + ':' + seconds + ' ' + ampm;
    return strTime;
}

$('.liveTime').text(getLiveTime(new Date));

function addTime() {
    $('.liveTime').text(getLiveTime(new Date));
}

setInterval(function () {
    addTime();
}, 1000);

//*** LIVE DATE ***//
function getDate(date) {
    var d = new Date(date),
        month = '' + (d.getMonth() + 1),
        day = '' + d.getDate(),
        year = d.getFullYear();

    if (month.length < 2) month = '0' + month;
    if (day.length < 2) day = '0' + day;
    return [day, month, year,].join('/');
}
$('.getDate').text(getDate(new Date));


$('.progressCounter').each(function() {
    var bar = $(this).find('.progress-bar');
    var value = $(this).find('.count');
    bar.prop('Counter', 0).animate({
            Counter: parseFloat(bar.attr('aria-valuenow'))
        },
        {
            duration: 3000,
            easing: 'swing',
            step: function(now) {
                var number = parseFloat(Math.round(now * 100) / 100).toFixed(2);
                bar.css({ 'width': number + '%' });
            }
        });
    jQuery({Counter: 0}).animate({Counter: value.text()}, {
        duration: 3000,
        easing: 'swing',
        step: function(num) {
            var num = Math.ceil(this.Counter).toString();
            if(Number(num) > 999){
                while (/(\d+)(\d{3})/.test(num)) {
                    num = num.replace(/(\d+)(\d{3})/, '$1' + ',' + '$2');
                }
            }
            value.text(num);
        }
    });
});
function ExpiryDate() {

    var year
    var months

    today = new Date();
    expiry = new Date(year, month);

    if (today.getTime() > expiry.getTime())

        return false;
    else
        return true;
};

// code Generate

$(document).on('click', '#code-generate', function () {
    var length = 10;
    var result = '';
    var characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
    var charactersLength = characters.length;
    for (var i = 0; i < length; i++) {
        result += characters.charAt(Math.floor(Math.random() * charactersLength));
    }
    $('#auto-code').val(result);
});





