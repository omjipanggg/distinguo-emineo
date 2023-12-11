let modalControl = document.getElementById('modalControl');
if (modalControl) {
    modalControl.addEventListener('show.bs.modal', function (event) {
        let btn = event.relatedTarget;
        let route = btn.getAttribute('href');
        let table = btn.getAttribute('data-bs-table');
        let type = btn.getAttribute('data-bs-type');

        modalControl.querySelector('.modal-title').textContent = table + '—' + type;

        $.ajax({
            url: route,
            async: true,
            type: 'GET',
            beforeSend: () => {
                // console.log('Fetching initialized...');
            },
            success: (response) => {
                $('#modalControlPlaceholders').html(response);
            },
            complete: (response) => {
                // console.log('Fetched successfully...');

                [...document.querySelectorAll('.select2-single-modal')].map((item) => {
                    let table = $(item).data('bsTable') || null;
                    let column = $(item).data('bsColumn') || 'name';
                    let selected = $(item).data('bsSelected') || null;
                    let multiple = $(item).data('bsMultiple') ? true : false;
                    $(item).select2();
                    $(item).select2('destroy');
                    $(item).select2({
                        language: 'id',
                        placeholder: 'Pilih satu',
                        theme: 'bootstrap-5',
                        width: '100%',
                        dropdownAutoWidth: true,
                        dropdownParent: modalControl,
                        cache: true,
                        // allowClear: true,
                        debug: true
                    });

                    /* if (selected != null) {
                        $.ajax({
                            url: '/server/'+ table +'/select',
                            type: 'GET',
                            data: {
                                column: column,
                                multiple: multiple,
                                selected: decodeURIComponent(selected)
                            }
                        }).then(function(data) {
                            if (multiple) {
                                data.map((each) => {
                                    let newOption = new Option(each.name, each.id, true, true);
                                    $(item).append(newOption).trigger('change');
                                });
                            } else {
                                const newOption = new Option(data.name, data.id, true, true);
                                $(item).append(newOption).trigger('change');
                            }
                        });
                    } */
                });

                [...document.querySelectorAll('.select2-multiple-modal')].map((item) => {
                    $(item).select2();
                    $(item).select2('destroy');
                    $(item).select2({
                        language: 'id',
                        placeholder: 'Pilih satu',
                        theme: 'bootstrap-5',
                        width: '100%',
                        dropdownAutoWidth: true,
                        dropdownParent: modalControl,
                        cache: true,
                        tags: true,
                        debug: true
                    });
                });

        		if (document.querySelector('.rating')) {
                    let stars = new StarRating('.rating', {
                        clearable: true
                    });
        		}
            },
            timeout: 4296
        });
    });


    modalControl.addEventListener('hide.bs.modal', function (event) {});
}

let modalPlain = document.getElementById('modalPlain');
if (modalPlain) {
    modalPlain.addEventListener('show.bs.modal', function (event) {
        let btn = event.relatedTarget;
        let route = btn.getAttribute('href');
        let footer = btn.getAttribute('data-bs-footer') || 'NULL';
        let table = btn.getAttribute('data-bs-table') || 'NULL';
        let type = btn.getAttribute('data-bs-type') || 'NULL';

        modalPlain.querySelector('.modal-title').textContent = table + '—' + type;
        modalPlain.querySelector('#modalPlainFooter').textContent = footer;

        $.ajax({
            url: route,
            async: true,
            type: 'GET',
            beforeSend: () => {
                // console.log('Fetching initialized...');
            },
            success: (response) => {
                $('#modalPlainPlaceholders').html(response);
            },
            complete: (response) => {
                // console.log('Fetched successfully...');
            },
            timeout: 4296
        });
    });


    modalPlain.addEventListener('hide.bs.modal', function (event) {});
}
