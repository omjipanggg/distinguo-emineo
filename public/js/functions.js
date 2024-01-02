function underMaintenance(event) {
    event.preventDefault();
    Swal.fire({
        title: 'Under Maintenance',
        text: 'Please try again later.',
        icon: 'info'
    })
}

const Toast = Swal.mixin({
  toast: true,
  position: "bottom-end",
  showConfirmButton: false,
  timer: 2460,
  timerProgressBar: true,
  didOpen: (toast) => {
    toast.onmouseenter = Swal.stopTimer;
    toast.onmouseleave = Swal.resumeTimer;
  }
});

function padRight(inputString, padChar, desiredLength) {
    const currentLength = inputString.length;
    if (currentLength >= desiredLength) {
        return inputString;
    }

    const padding = padChar.repeat(desiredLength - currentLength);
    return inputString + padding;
}

function truncateText(text, maxLength) {
    if (text.length > maxLength) {
        return text.substring(0, maxLength) + '...';
    } else {
        return text;
    }
}

function clock() {
    const month = [ "Januari", "Februari", "Maret", "April", "Mei", "Juni",
                    "Juli", "Augustus", "September", "Oktober",
                    "November", "Desember" ];

    function harold(standIn) {
        if (standIn < 10) {
            standIn = '0' + standIn;
        } return standIn;
    }

    let time = new Date(),
        theDate = harold(time.getDate()) + ' ' + (month[time.getMonth()]) + ' ' + time.getFullYear(),
        hours = time.getHours(),
        minutes = time.getMinutes(),
        seconds = time.getSeconds();

    document.body.querySelector('#clock').innerHTML = theDate + ' ' + harold(hours) + ":" + harold(minutes) + ":" + harold(seconds);
}

if (document.querySelector('#clock')) {
    setInterval(clock, 1000);
}

function numericOnly(event) {
    let input = event.target;
    let value = input.value;
    let sanitized = value.replace(/\D/g, '');
    input.value = sanitized;
}

function showLoadingOnButton(event) {
    let icon = event.currentTarget.dataset.bsIcon || 'send';
    let initial = event.currentTarget.dataset.bsInitialText || 'Send';
    let text = event.currentTarget.dataset.bsText || 'Sending';

    let btn = $(event.currentTarget);

    btn.html(text + '<div class="spinner-border spinner-border-sm ms-2" role="status"><span class="visually-hidden">Loading...</span></div>');
    btn.attr('disabled', true);

    setTimeout(function() {
        btn.html(initial + '<i class="bi bi-'+ icon +' ms-2"></i>');
        btn.attr('disabled', false);
    }, 1350);
}

function dateMYFormat(date) {
    return new Date(date).toLocaleDateString('id-ID', { year: 'numeric', month: 'long' });
}

function dateFormat(date) {
    let dateString = new Date(date);
    let day = dateString.getDay();
    let dateOfDate = dateString.getDate();
    let month = dateString.getMonth();
    let yearOfDate = dateString.getYear();

    let dayTuple = ['Minggu','Senin','Selasa','Rabu','Kamis','Jum\'at','Sabtu'];
    let monthTuple = ['Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'];

    let year = (yearOfDate < 1000) ? yearOfDate + 1900 : yearOfDate;

    if (dateOfDate < 10) {
        dateOfDate = '0' + dateOfDate;
    }

    return dateOfDate + ' ' + monthTuple[month] + ' ' + year;
}

function dateIndoFormat(date) {
    let dateString = new Date(date);
    let day = dateString.getDay();
    let dateOfDate = dateString.getDate();
    let month = dateString.getMonth();
    let yearOfDate = dateString.getYear();

    let dayTuple = ['Minggu','Senin','Selasa','Rabu','Kamis','Jum\'at','Sabtu'];
    let monthTuple = ['Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'];

    let year = (yearOfDate < 1000) ? yearOfDate + 1900 : yearOfDate;

    if (dateOfDate < 10) {
        dateOfDate = '0' + dateOfDate;
    }

    return dayTuple[day] + ', ' + dateOfDate + ' ' + monthTuple[month] + ' ' + year;
}

function dateTimeIndoFormat(date) {
    let dateString = new Date(date);
    let day = dateString.getDay();
    let dateOfDate = dateString.getDate();
    let month = dateString.getMonth();
    let yearOfDate = dateString.getYear();

    let hour = dateString.getHours();
    let minute = dateString.getMinutes();
    let second = dateString.getSeconds();

    if (hour < 10) {
        hour = '0' + hour;
    }

    if (minute < 10) {
        minute = '0' + minute;
    }

    if (second < 10) {
        second = '0' + second;
    }

    let dayTuple = ['Minggu','Senin','Selasa','Rabu','Kamis','Jum\'at','Sabtu'];
    let monthTuple = ['Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'];

    let year = (yearOfDate < 1000) ? yearOfDate + 1900 : yearOfDate;

    if (dateOfDate < 10) {
        dateOfDate = '0' + dateOfDate;
    }

    return dayTuple[day] + ', ' + dateOfDate + ' ' + monthTuple[month] + ' ' + year + ' ' + hour + ':' + minute + ':' + second;
}

function copyToClipboard(event, text) {
    event.preventDefault();
    navigator.clipboard.writeText(text)
    .then(() => {
        Toast.fire({
            icon: 'success',
            title: 'Token disalin.'
        });
    })
    .catch((err) => {
        Toast.fire({
            icon: 'error',
            title: 'Silakan coba kembali.'
        });
    });
}

function confirmDelete(event, form) {
    event.preventDefault();
    const url = event.currentTarget.getAttribute('href');

    $(form).attr('action', url);

    Swal.fire({
        title: 'Konfirmasi',
        text: 'Hapus data ini?',
        icon: 'warning',
        showCancelButton: true,
        // confirmButtonColor: '#0d6efd',
        // cancelButtonColor: '#dc3545',
        reverseButtons: true,
        confirmButtonText: 'Ya, hapus',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            document.body.querySelector(form).submit();
        }
    });
}

function moneyFormat(amount) {
    amount = parseFloat(amount).toString().replace(/\D/g, '');
    return 'Rp' + amount.replace(/\B(?=(\d{3})+(?!\d))/g, '.') + ',-';
}

function eyeOpen(event) {
    [...document.body.querySelectorAll('.password')].map((item) => {
        item.type = event.target.checked ? 'text' : 'password';
    });
}

function triggerClick(event, element) {
    event.preventDefault();
    $(element).trigger('click');
}

function showLoadingOnButton(event) {
    let btn = $(event.currentTarget);
    let text = $(event.currentTarget).data('bsText') || 'Loading';
    let defaultText = $(event.currentTarget).data('bsDefaultText') || 'Load';

    btn.addClass('disabled');
    btn.attr('disabled', true);
    btn.html(text + '<div class="spinner-border spinner-border-sm ms-2" role="status"><span class="visually-hidden">Loading...</span></div>');

    setTimeout(function() {
        btn.removeClass('disabled');
        btn.removeAttr('disabled');
        btn.html(defaultText);
    }, 1750);
}

function filterHistory(event, token, id) {
    $('#evaluationHistoryTable').DataTable().ajax.url('/server/fetch/evaluations/history?token=' + token + '&department=' + id).load();
}

function filterScore(event, token, id) {
    $('#scoringTable').DataTable().ajax.url('/server/fetch/scores?token=' + token + '&department=' + id).load();
}