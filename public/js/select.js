[...document.querySelectorAll('.select2-single')].map((item) => {
    let placeholder = $(item).data('bsPlaceholder') || 'Pilih satu';
    $(item).select2();
    $(item).select2('destroy');
    $(item).select2({
        language: 'id',
        placeholder: placeholder,
        dropdownAutoWidth: true,
        // allowClear: true,
        theme: 'bootstrap-5',
        width: '100%',
        cache: true,
        debug: true
    });
});

[...document.querySelectorAll('.select2-multiple')].map((item) => {
    let placeholder = $(item).data('bsPlaceholder') || 'Ketikkan jika tidak tersedia';
    $(item).select2();
    $(item).select2('destroy');
    $(item).select2({
        language: 'id',
        placeholder: placeholder,
        dropdownAutoWidth: true,
        theme: 'bootstrap-5',
        width: '100%',
        tags: true,
        cache: true,
        debug: true
    });
});
