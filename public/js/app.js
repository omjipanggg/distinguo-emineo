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
	    $('#btnModal').trigger('click');
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

    // SB-PANEL
    // ================================================================================
    const sidebarToggle = document.body.querySelector('#sidebarToggle');
    if (sidebarToggle) {
        if (localStorage.getItem('sidebar-toggle') === 'lumos') {
            document.body.classList.add('sb-sidenav-toggled');
        } else {
            document.body.classList.remove('sb-sidenav-toggled');
        }

        sidebarToggle.addEventListener('click', (event) => {
            event.preventDefault();
            document.body.classList.toggle('sb-sidenav-toggled');
            // localStorage.setItem('sidebar-toggle', document.body.classList.contains('sb-sidenav-toggled'));
            if (document.body.classList.contains('sb-sidenav-toggled')) {
                localStorage.setItem('sidebar-toggle', 'lumos');
            } else {
                localStorage.setItem('sidebar-toggle', 'nox');
            }
        });
    }

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

    if (document.querySelector('#refreshAfter')) {
        setTimeout(function() {
            window.location.reload();
        }, 2048);
    }

    $('#btnCheckToken').click(function(event) {
        event.preventDefault();
        let token = $('#token').val();
        let initial = event.currentTarget.dataset.bsInitialText || 'Send';
        let text = event.currentTarget.dataset.bsText || 'Sending';

        let btn = $(event.currentTarget);

        let agent = navigator.userAgent;
        const names = [
            'Austin', 'Caesar',
            'Emily', 'Lucia', 'Eva',
            'Linda', 'Felix', 'Derek',
            'Diego', 'Georgia', 'Percy'
        ];

        $.ajax({
            url: '/server/token/check',
            type: 'GET',
            data: { token: token },
            beforeSend: () => {
                btn.html(text + '<div class="spinner-border spinner-border-sm ms-2" role="status"><span class="visually-hidden">Loading...</span></div>');
                btn.attr('disabled', true);
            },
            success: (response) => {
                if (response.code === 200) {
                    $('#token').removeClass('is-invalid');
                    $('#token').addClass('is-valid');
                    $('#token').attr('disabled', true);

                    $('#alertTokenHolder').slideDown();
                    let alertCheckToken = '<div class="alert alert-success alert-dismissible rounded-0 mb-2 fade show" role="alert"><i class="bi bi-check-circle me-2"></i>Token dapat digunakan, mohon menunggu...<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
                    $('#alertTokenHolder').append(alertCheckToken);

                    /*
                    setTimeout(function() {
                        // window.location.href = '/evaluator/lounge?token=' + token + '&user=guest&timestamp=' + Date.parse(new Date());
                        window.location.href = '?token=' + token + '&user=guest&timestamp=' + Date.parse(new Date()) + '&ref=home';
                    }, 1350);
                    */

                    setTimeout(function() {
                    Swal.fire({
                        icon: 'question',
                        title: 'Nama Anda',
                        iconColor: 'rgba(112, 102, 224, 1)',
                        backdrop: 'rgba(58, 52, 124, .96)',
                        confirmButtonText: 'Kirim',
                        allowOutsideClick: false,
                        allowEscapeKey: false,
                        input: 'text',
                        inputPlaceholder: names[Math.floor(Math.random() * names.length)],
                        inputValidator: (value) => {
                            return new Promise((resolve) => {
                                if (value != '') { resolve(); }
                                else { resolve('Mohon isikan nama Anda'); }
                            });
                        }
                    }).then((result) => {
                        $.ajax({
                            url: '/server/evaluator/create',
                            type: 'GET',
                            data: {
                                token: token,
                                agent: agent,
                                name: result.value
                            },
                            success: (response) => {
                                if (response.code == 200) {
                                    window.location.href = '/evaluation/score?token=' + response.token + '&user=' + response.name + '&timestamp=' + Date.parse(new Date());
                                }
                            }
                        });
                    });
                    }, 537);
                } else if (response.code === 402) {
                    $('#token').removeClass('is-invalid');
                    $('#token').addClass('is-valid');
                    $('#token').attr('disabled', true);

                    $('#alertTokenHolder').slideDown();
                    let alertCheckToken = '<div class="alert alert-success alert-dismissible rounded-0 mb-2 fade show" role="alert"><i class="bi bi-check-circle me-2"></i>Melanjutkan sesi...<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
                    $('#alertTokenHolder').append(alertCheckToken);

                    setTimeout(function() {
                        window.location.href = '/evaluation/score?token='+ token + '&timestamp=' + Date.parse(new Date());
                    }, 1350);
                } else {
                    $('#alertTokenHolder').slideDown();
                    let alertCheckToken = '<div class="alert alert-danger rounded-0 mb-2 fade alert-check-token show" role="alert"><i class="bi bi-x-circle me-2"></i>Token salah atau sudah digunakan.</div>';
                    $('#alertTokenHolder').append(alertCheckToken);
                    $('#token').removeClass('is-valid');
                    $('#token').addClass('is-invalid');
                    $('#token').val('');
                }
            },
            complete: () => {
                setTimeout(function() {
                    $('.alert-check-token').slideUp();
                }, 2460);

                btn.html(initial + '<i class="bi bi-send ms-2"></i>');
                btn.attr('disabled', false);
            }
        });
    });

    // NEW EVALUATOR REGISTERED =====================================================================
    const urlParams = new URLSearchParams(window.location.search);
    const hasRef = urlParams.has('ref');
    const token = urlParams.get('token');

    if (hasRef) {
        let agent = navigator.userAgent;

        const names = [
            'Austin', 'Caesar',
            'Emily', 'Lucia', 'Eva',
            'Linda', 'Felix', 'Derek',
            'Diego', 'Georgia', 'Percy'
        ];

        Swal.fire({
            icon: 'question',
            title: 'Nama Anda',
            iconColor: 'rgba(112, 102, 224, 1)',
            backdrop: 'rgba(58, 52, 124, .96)',
            confirmButtonText: 'Kirim',
            allowOutsideClick: false,
            allowEscapeKey: false,
            input: 'text',
            inputPlaceholder: names[Math.floor(Math.random() * names.length)],
            inputValidator: (value) => {
                return new Promise((resolve) => {
                    if (value != '') { resolve(); }
                    else { resolve('Mohon isikan nama Anda'); }
                });
            }
        }).then((result) => {
            $.ajax({
                url: '/server/evaluator/create',
                type: 'GET',
                data: {
                    token: token,
                    agent: agent,
                    name: result.value
                },
                success: (response) => {
                    if (response.code == 200) {
                        window.location.href = '/evaluation?token=' + response.token + '&user=' + response.name + '&timestamp=' + Date.parse(new Date());
                    }
                }
            });
        });
    }

    const currentUrl = window.location.href;
    let baseUrl = window.location.origin;
    let $matchingLinks = $('#sidenavAccordion a.nav-link[href="' + currentUrl + '"]');
    let segments = window.location.pathname.split('/');
    let lastSegment = segments[segments.length - 1];

    if ($matchingLinks.length > 0) {
        let $parentCollapse = $matchingLinks.closest('.collapse');
        $parentCollapse.addClass('show');
        $parentCollapse.prev().removeClass('collapsed');
        $parentCollapse.prev().addClass('active');

        let $grandParentCollapse = $parentCollapse.parent().closest('.collapse');
        $grandParentCollapse.addClass('show');
        $grandParentCollapse.prev().removeClass('collapsed');
        $grandParentCollapse.prev().addClass('active');
    } else {
        segments.pop();
        // let parentUrl = baseUrl + segments.join('/');
        let parentUrl = baseUrl + '/' + segments[1];
        let parentStr = new URL(currentUrl);
        parentStr.search = '';
        parentStr = parentStr.toString();

        $('#sidenavAccordion a.nav-link').each(function() {
            let parentHref = $(this).attr('href');
            /*
            if (parentUrl == parentHref || parentStr == parentHref) {
                $(this).addClass('active');

                let $parentCollapse = $(this).closest('.collapse');
                $parentCollapse.addClass('show');
                $parentCollapse.prev().removeClass('collapsed');
                $parentCollapse.prev().addClass('active');

                let $grandParentCollapse = $parentCollapse.closest('.collapse');
                $grandParentCollapse.addClass('show');
                $grandParentCollapse.prev().removeClass('collapsed');
                $grandParentCollapse.prev().addClass('active');
            }
            */
            if (parentHref.includes(parentUrl)) {
                let $parentCollapse = $(this).closest('.collapse');
                $parentCollapse.addClass('show');
                $parentCollapse.prev().removeClass('collapsed');
                $parentCollapse.prev().addClass('active');
            }
        });
    }

    [...document.querySelectorAll('.editor')].map((item) => {
        CKEDITOR.replace(item);
    });


    if (document.querySelector('.rating')) {
        let stars = new StarRating('.rating', {
            clearable: true,
            tooltip: false
        });
    }
});
