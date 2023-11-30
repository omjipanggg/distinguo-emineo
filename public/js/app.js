$(document).ready(function() {
    let darkMode = localStorage.getItem('mode') === 'true';

    if (darkMode) {
        $('body').attr('data-bs-theme', 'dark');

        $('#toggle-mode-icon').removeClass('bi-cloud-moon');
        $('#toggle-mode-icon').addClass('bi-cloud-sun');
    } else {
        $('body').attr('data-bs-theme', 'light');

        $('#toggle-mode-icon').removeClass('bi-cloud-sun');
        $('#toggle-mode-icon').addClass('bi-cloud-moon');
    }

	$('#loader').fadeOut();

	$(document).on('click', '#trigger', (event) => {
	    $('#btn-modal').trigger('click');
	});

	$(document).on('click', '#toggle-mode', function(event) {
	    event.preventDefault();

	    let body = $('body').attr('data-bs-theme');
	    let icon = $('#toggle-mode-icon');

	    darkMode = !darkMode;

	    if (body == 'light') {
	        $('body').attr('data-bs-theme', 'dark');

	        localStorage.setItem('mode', darkMode.toString());

	        icon.removeClass('bi-cloud-moon');
	        icon.addClass('bi-cloud-sun');
	    } else {
	        $('body').attr('data-bs-theme', 'light');

	        localStorage.setItem('mode', darkMode.toString());

	        icon.removeClass('bi-cloud-sun');
	        icon.addClass('bi-cloud-moon');
	    }
	});


    $(document).on('click', "a[href*='#']:not(a[href='#'])", function() {
        if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'')
            || location.hostname == this.hostname) {
            let target = $(this.hash);
            target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
            if (target.length) {
                $('html, body').animate({
                    scrollTop: target.offset().top - 0,
                }, 240);
                return false;
            }
        }
    });
});

function underMaintenance(event) {
    event.preventDefault();
    Swal.fire({
        title: 'Under Maintenance',
        text: 'Please try again later.',
        icon: 'info'
    })
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
