if (document.querySelector('table.table-fetch')) {
    [...document.body.querySelectorAll('table.table-fetch')].map((item) => {
        let order = $(item).data('bsOrder') || null;
        let tableFetch = $(item).DataTable({
            language: {
                url: 'https://cdn.datatables.net/plug-ins/1.13.6/i18n/id.json',
                paginate: {
                    previous: '<i class="bi bi-caret-left-fill"></i>',
                    next: '<i class="bi bi-caret-right-fill"></i>'
                },
                infoFiltered: '',
                lengthMenu: '_MENU_',
                search: '',
                searchPlaceholder: 'Pencarian',
                processing: 'Mengambil data...'
            },
            initComplete: function(settings, json) {
                $('.dataTables_filter input').removeClass('form-control-sm');
                $('.dataTables_length select').removeClass('form-select-sm');
                $('.dataTables_wrapper > .row:last-child').addClass('mt-2');
            },
            createdRow: function(row, data, index) {
                if (data.deleted_at) {
                    $(row).addClass('deleted');
                }
            }
        });

        if (order != null) {
            order.map((item) => {
                tableFetch.order([item[0], item[1]]);
            });
        }
    });
}

if (document.querySelector('table.table-no-info')) {
    [...document.body.querySelectorAll('table.table-no-info')].map((item) => {
        let emptyDef = $(item).data('bsEmpty') || 'JK';
        let orderDef = $(item).data('bsOrder') || null;
        let tableNoInfo = $(item).DataTable({
            language: {
                url: 'https://cdn.datatables.net/plug-ins/1.13.6/i18n/id.json',
                paginate: {
                    previous: '<i class="bi bi-caret-left-fill"></i>',
                    next: '<i class="bi bi-caret-right-fill"></i>'
                },
                infoFiltered: '',
                lengthMenu: '_MENU_',
                search: '',
                searchPlaceholder: 'Pencarian',
                processing: 'Mengambil data...',
                emptyTable: emptyDef
            },
            initComplete: function(settings, json) {
                $('.dataTables_filter input').removeClass('form-control-sm');
                $('.dataTables_length select').removeClass('form-select-sm');
                $('.dataTables_wrapper > .row:last-child').addClass('mt-2');
            },
            paging: false,
            ordering: false,
            searching: false,
            orderCellsTop: false,
            info: false
        });
    });
}

let token = $('#token').val() || null;

$('#scoringTable').DataTable({
	ajax: {
		url: '/server/fetch/scores',
        type: 'GET',
        data: {
            token: token
        }
	},
    processing: true,
    serverSide: true,
    orderCellsTop: true,
    scrollCollapse: true,
    scrollY: true,
    scrollX: true,
    language: {
        url: 'https://cdn.datatables.net/plug-ins/1.13.6/i18n/id.json',
        paginate: {
            previous: '<i class="bi bi-caret-left-fill"></i>',
            next: '<i class="bi bi-caret-right-fill"></i>'
        },
        infoFiltered: '',
        lengthMenu: '_MENU_',
        search: '',
        emptyTable: 'Masukkan TOKEN untuk melihat rincian',
        searchPlaceholder: 'Pencarian',
        processing: 'Mengambil data...'
    },
    initComplete: function(settings, json) {
        $('.dataTables_filter input').removeClass('form-control-sm');
        $('.dataTables_length select').removeClass('form-select-sm');
        $('.dataTables_wrapper > .row:last-child').addClass('mt-2');
    },
    order: [
        [4, 'asc'],
        [2, 'asc']
    ],
    columns: [
	    {
            data: null,
            title: 'Aksi',
            render: function(data, type, row, meta) {
                return '<a href="/evaluation/create?token='+ token + '&evaluatee_id='+ row['id'] +'" data-bs-table="Evaluation" data-bs-type="Add" data-bs-target="#modalControl" data-bs-toggle="modal" class="btn btn-primary px-3 rounded-0 btn-sm">Nilai<i class="bi bi-box-arrow-up-right ms-2"></i></a>';
            }
        },
        {
            data: 'card_number',
            title: 'NIK',
            render: function(data, type, row, meta) {
                if (data == null || data == '') {
                    return '<em>null</em>';
                }
                return data;
            }
        },
        {
            data: 'name',
            title: 'Nama',
            render: function(data, type, row, meta) {
                if (data == null || data == '') {
                    return '<em>null</em>';
                }
                return data.toUpperCase();
            }
        },
        {
            data: 'region',
            title: 'Wilayah',
            render: function(data, type, row, meta) {
                if (data == null || data == '') {
                    return '<em>null</em>';
                }
                return data.toUpperCase() + ' ' + '<strong>[' + row['zone'].toUpperCase() + ']</strong>';
            }
        },
        /*
        {
            data: 'departments',
            title: 'Divisi',
            render: function(data, type, row, meta) {
                if (!data.length) {
                    return '<em>null</em>';
                }

                return data.map((item) => {
                    let pad = '';
                    if (data.length > 1) { pad = 'me-1'; }
                    // return '<span class="badge text-bg-dark rounded-0' + pad + '">' + item.name + '</span>';
                    return item.name.toUpperCase();
                }).join(', ');
            }
        }
        */
        {
            data: 'project_number',
            title: 'No. PO'
        }
    ],
    createdRow: function(row, data, index) {
        if (data.deleted_at) {
            $(row).addClass('deleted');
        }
    }
});

$('#tokenTable').DataTable({
    ajax: {
        url: '/server/fetch/tokens',
    },
    processing: true,
    serverSide: true,
    orderCellsTop: true,
    scrollCollapse: true,
    scrollY: true,
    scrollX: true,
    language: {
        url: 'https://cdn.datatables.net/plug-ins/1.13.6/i18n/id.json',
        paginate: {
            previous: '<i class="bi bi-caret-left-fill"></i>',
            next: '<i class="bi bi-caret-right-fill"></i>'
        },
        infoFiltered: '',
        lengthMenu: '_MENU_',
        search: '',
        searchPlaceholder: 'Pencarian',
        processing: 'Mengambil data...'
    },
    initComplete: function(settings, json) {
        $('.dataTables_filter input').removeClass('form-control-sm');
        $('.dataTables_length select').removeClass('form-select-sm');
        $('.dataTables_wrapper > .row:last-child').addClass('mt-2');
    },
    order: [
        [0, 'asc'],
        [6, 'desc'],
        [5, 'desc']
    ],
    columns: [
        {
	    	data: 'is_used',
	    	title: 'Status',
    		render: function(data, type, row, meta) {
    			if (data) {
                    if (row['evaluator']['evaluations_count']) {
                        return '<span class="badge text-bg-success rounded-0 me-2"><i class="bi bi-check-circle me-2"></i>Sudah dibagikan</span><span class="badge text-bg-info rounded-0"><i class="bi bi-check-circle me-2"></i>Sudah menilai</span>';
                    }
        			return '<span class="badge text-bg-success rounded-0 me-2"><i class="bi bi-check-circle me-2"></i>Sudah dibagikan</span><span class="badge text-bg-warning rounded-0"><i class="bi bi-question-circle me-2"></i>Belum menilai</span>';
    			} else {
                    return '<span class="badge text-bg-dark rounded-0 me-2"><i class="bi bi-question-circle me-2"></i>Belum dibagikan</span><span class="badge text-bg-warning rounded-0"><i class="bi bi-question-circle me-2"></i>Belum menilai</span>';
    			}
    		}
	    },
    	{
    		data: 'token',
    		title: 'Token',
    		render: function(data, type, row, meta) {
    			return '<a onclick="copyToClipboard(event, \'' + data + '\');" href="#" class="dotted text-code">'+ data +'<i class="bi bi-copy ms-2"></i></a>';
    		}
    	},
        {
            data: 'evaluator.name',
            title: 'Nama Penilai',
            render: function(data, type, row, meta) {
                if (data == null || data == '') {
                    return '<em>null</em>';
                }
                return data.toUpperCase();
            }
        },
        {
            data: 'project.project_number',
            title: 'No. PO',
            render: function(data, type, row, meta) {
                if (!data.length) {
                    return '<em>null</em>';
                }

                return '<strong>' + data + '</strong>';
                /*
                return data.map((item) => {
                    let pad = '';
                    if (data.length > 1) { pad = 'me-1'; }
                    return '<strong>[' + item.project_number + ']</strong> ' + truncateText(item.name, 24);
                }).join('<br>');
                */
            }
        },
        {
            data: 'project.name',
            title: 'Nama Project',
            render: function(data, type, row, meta) {
                if (!data.length) {
                    return '<em>null</em>';
                }

                return truncateText(data, 24);
            }
        },
        {
            data: 'evaluatees_count',
            title: 'Total',
            render: function(data, type, row, meta) {
                if (data == 0 || data == null || data == '') {
                    return '<strong>0</strong> Peserta';
                }
                return '<strong>' + data + '</strong> Peserta';
            }
        },
        /*
    	{
    		data: 'departments',
    		title: 'Divisi',
    		render: function(data, type, row, meta) {
    			if (!data.length) {
    				return '<em>null</em>';
    			}

    			return data.map((item) => {
    				let pad = '';
    				if (data.length > 1) { pad = 'me-1'; }
    				return item.name;
    			}).join(', ');
    		}
    	},
        */
	    {
	    	data: 'used_at',
	    	title: 'Digunakan Pada',
    		render: function(data, type, row, meta) {
    			if (data == null) {
    				return '<em>null</em>';
    			}
    			return dateTimeIndoFormat(data);
    		}
	    },
        {
            data: 'created_at',
            title: 'Aksi',
            render: function(data, type, row, meta) {
                return '<a href="/dashboard/token/'+ row['id'] +'" onclick="confirmDelete(event, \'#vanisher\');" class="text-left btn btn-sm btn-danger px-3 rounded-0 btn-sm">Hapus<i class="bi bi-trash3 ms-2"></i></a>';
            },
            orderable: false,
            searchable: false
        }
	],
    createdRow: function(row, data, index) {
        if (data.deleted_at) {
            $(row).addClass('deleted');
        }
        $(row).find('td:eq(4)').attr('title', data.project.name);
    }
});

$('#memberTable').DataTable({
	ajax: {
		url: '/server/fetch/members',
	},
    processing: true,
    serverSide: true,
    orderCellsTop: true,
    scrollCollapse: true,
    scrollY: true,
    scrollX: true,
    language: {
        url: 'https://cdn.datatables.net/plug-ins/1.13.6/i18n/id.json',
        paginate: {
            previous: '<i class="bi bi-caret-left-fill"></i>',
            next: '<i class="bi bi-caret-right-fill"></i>'
        },
        infoFiltered: '',
        lengthMenu: '_MENU_',
        search: '',
        searchPlaceholder: 'Pencarian',
        processing: 'Mengambil data...'
    },
    initComplete: function(settings, json) {
        $('.dataTables_filter input').removeClass('form-control-sm');
        $('.dataTables_length select').removeClass('form-select-sm');
        $('.dataTables_wrapper > .row:last-child').addClass('mt-2');
    },
    order: [
        [0, 'asc'],
        [2, 'asc']
    ],
    columns: [
    	{
    		data: 'project_number',
    		title: 'No. PO',
            render: function(data, type, row, meta) {
                return '<span class="text-code">' + data + '</span>';
            }
    	},
        {
            data: 'card_number',
            title: 'NIK',
            render: function(data, type, row, meta) {
                return '<span class="text-code">' + data + '</span>';
            }
        },
    	{
    		data: 'name',
    		title: 'Nama',
    		render: function(data, type, row, meta) {
    			if (data == null) {
	    			return '<em>null</em>';
    			}
    			return data.toUpperCase();
    		}
    	},
    	{
    		data: 'departments',
    		title: 'Divisi',
    		render: function(data, type, row, meta) {
                if (!data.length) {
                    return '<em>null</em>';
                }

                return data.map((item) => {
                    let pad = '';
                    if (data.length > 1) { pad = 'me-1'; }
                    return item.name.toUpperCase();
                }).join(', ');
    		}
    	},
    	{
    		data: 'area',
    		title: 'Area',
    		render: function(data, type, row, meta) {
    			if (data == null) {
	    			return '<em>null</em>';
    			}
    			return data.toUpperCase();
    		}
    	},
    	{
    		data: 'region',
    		title: 'Wilayah',
    		render: function(data, type, row, meta) {
    			if (data == null) {
	    			return '<em>null</em>';
    			}
    			return data.toUpperCase();
    		}
    	},
    	{
    		data: 'zone',
    		title: 'Zona',
    		render: function(data, type, row, meta) {
    			if (data == null) {
	    			return '<em>null</em>';
    			}
    			return data.toUpperCase();
    		}
    	},
        {
            data: null,
            title: 'Aksi',
            render: function(data, type, row, meta) {
                return '<a href="/dashboard/member/'+ row['id'] +'" onclick="confirmDelete(event, \'#vanisher\');" class="text-left btn btn-danger px-3 rounded-0 btn-sm">Hapus<i class="bi bi-trash3 ms-2"></i></a>';
            }
        }
	]
});

$('#projectTable').DataTable({
    ajax: {
        url: '/server/fetch/projects',
    },
    processing: true,
    serverSide: true,
    orderCellsTop: true,
    scrollCollapse: true,
    scrollY: true,
    scrollX: true,
    language: {
        url: 'https://cdn.datatables.net/plug-ins/1.13.6/i18n/id.json',
        paginate: {
            previous: '<i class="bi bi-caret-left-fill"></i>',
            next: '<i class="bi bi-caret-right-fill"></i>'
        },
        infoFiltered: '',
        lengthMenu: '_MENU_',
        search: '',
        searchPlaceholder: 'Pencarian',
        processing: 'Mengambil data...'
    },
    initComplete: function(settings, json) {
        $('.dataTables_filter input').removeClass('form-control-sm');
        $('.dataTables_length select').removeClass('form-select-sm');
        $('.dataTables_wrapper > .row:last-child').addClass('mt-2');
    },
    order: [[0, 'asc'], [1, 'asc']],
    columns: [
        {
            data: 'project_number',
            title: 'No. PO',
            render: function(data, type, row, meta) {
                if (data == null || data == '') {
                    return '<em>null</em>';
                }
                return data;
            }
        },
        {
            data: 'name',
            title: 'Nama',
            render: function(data, type, row, meta) {
                if (data == null || data == '') {
                    return '<em>null</em>';
                }
                return truncateText(data, 32);
            }
        },
        /*
        {
            data: 'description',
            title: 'Deskripsi',
            render: function(data, type, row, meta) {
                if (data == null || data == '') {
                    return '<em>null</em>';
                }
                return truncateText(data, 36);
            }
        },
        */
        {
            data: 'total',
            title: 'Total',
            render: function(data, type, row, meta) {
                if (data == null || data == '' || data == 0) {
                    return '<strong>0</strong> Peserta';
                }
                return '<strong>' + data + '</strong> Peserta';
            }
        },
        {
            data: null,
            title: 'Aksi',
            render: function(data, type, row, meta) {
                return '<a href="/dashboard/project/'+ row['id'] +'/edit" data-bs-toggle="modal" data-bs-target="#modalControl" data-bs-table="Project" data-bs-type="Edit" class="text-left btn btn-dark rounded-0 btn-sm px-3">Ubah<i class="bi bi-pencil-square ms-2"></i></a>';
            }
        }
    ],
    createdRow: function(row, data, index) {
        if (data.deleted_at) {
            $(row).addClass('deleted');
        }
        $(row).find('td:eq(1)').attr('title', data.name);
    }
});

$('#criteriaTable').DataTable({
    ajax: {
        url: '/server/fetch/criterias',
    },
    processing: true,
    serverSide: true,
    orderCellsTop: true,
    scrollCollapse: true,
    scrollY: true,
    scrollX: true,
    language: {
        url: 'https://cdn.datatables.net/plug-ins/1.13.6/i18n/id.json',
        paginate: {
            previous: '<i class="bi bi-caret-left-fill"></i>',
            next: '<i class="bi bi-caret-right-fill"></i>'
        },
        infoFiltered: '',
        lengthMenu: '_MENU_',
        search: '',
        searchPlaceholder: 'Pencarian',
        processing: 'Mengambil data...'
    },
    initComplete: function(settings, json) {
        $('.dataTables_filter input').removeClass('form-control-sm');
        $('.dataTables_length select').removeClass('form-select-sm');
        $('.dataTables_wrapper > .row:last-child').addClass('mt-2');
    },
    order: [[0, 'asc']],
    columns: [
        {
            data: 'name',
            title: 'Nama',
            render: function(data, type, row, meta) {
                if (data == null || data == '') {
                    return '<em>null</em>';
                }
                return data;
            }
        },
        {
            data: 'type.name',
            title: 'Tipe',
            render: function(data, type, row, meta) {
                if (data == null || data == '') {
                    return '<em>null</em>';
                }
                return data;
            }
        },
        {
            data: 'description',
            title: 'Deskripsi',
            render: function(data, type, row, meta) {
                if (data == null || data == '') {
                    return '<em>null</em>';
                }
                return truncateText(data, 57);
            }
        }
    ],
    createdRow: function(row, data, index) {
        if (data.deleted_at) {
            $(row).addClass('deleted');
        }
        $(row).find('td:eq(2)').attr('title', data.description);
    }
});

$('#assessmentTable').DataTable({
    ajax: {
        url: '/server/fetch/assessments',
    },
    processing: true,
    serverSide: true,
    orderCellsTop: true,
    scrollCollapse: true,
    scrollY: true,
    scrollX: true,
    language: {
        url: 'https://cdn.datatables.net/plug-ins/1.13.6/i18n/id.json',
        paginate: {
            previous: '<i class="bi bi-caret-left-fill"></i>',
            next: '<i class="bi bi-caret-right-fill"></i>'
        },
        infoFiltered: '',
        lengthMenu: '_MENU_',
        search: '',
        searchPlaceholder: 'Pencarian',
        processing: 'Mengambil data...'
    },
    initComplete: function(settings, json) {
        $('.dataTables_filter input').removeClass('form-control-sm');
        $('.dataTables_length select').removeClass('form-select-sm');
        $('.dataTables_wrapper > .row:last-child').addClass('mt-2');
    },
    order: [
    ],
    columns: [
        {
            data: 'name',
            title: 'Nama',
            render: function(data, type, row, meta) {
                if (data == null || data == '') {
                    return '<em>null</em>';
                }
                return data;
            }
        },
        {
            data: 'criterias',
            title: 'Kriteria',
            render: function(data, type, row, meta) {
                if (data == null || data == '') {
                    return '<em>null</em>';
                }

                return '<ol class="m-0 ps-4">' + data.map((item) => {
                    let pad = '';
                    if (data.length > 1) { pad = 'me-1'; }
                    return '<li class="text-code">' + item.name + '</li>';
                }).join('') + '</ol>';
            }
        }
    ],
    createdRow: function(row, data, index) {
        if (data.deleted_at) {
            $(row).addClass('deleted');
        }
    }
});

if (document.querySelector('#evaluationTable')) {
let evaluationTable = $('#evaluationTable').DataTable({
    ajax: {
        url: '/server/fetch/evaluations'
    },
    processing: true,
    serverSide: true,
    orderCellsTop: true,
    scrollCollapse: true,
    scrollY: true,
    scrollX: true,
    lengthMenu: [ [10, 25, 50, 100, -1], ['10', '25', '50', '100', 'All'] ],
    language: {
        url: 'https://cdn.datatables.net/plug-ins/1.13.6/i18n/id.json',
        paginate: {
            previous: '<i class="bi bi-caret-left-fill"></i>',
            next: '<i class="bi bi-caret-right-fill"></i>'
        },
        infoFiltered: '',
        lengthMenu: '_MENU_',
        search: '',
        searchPlaceholder: 'Pencarian',
        processing: 'Mengambil data...'
    },
    initComplete: function(settings, json) {
        $('.dataTables_filter input').removeClass('form-control-sm');
        $('.dataTables_length select').removeClass('form-select-sm');
        $('.dataTables_wrapper > .row:last-child').addClass('mt-2');
    },
     order: [
        [1, 'desc'],
        [3, 'asc']
    ],
    columns: [
        {
            data: null,
            title: 'Aksi',
            render: function(data, type, row, meta) {
                return '<a href="/evaluation/'+ row['batch'] +'/edit?token='+ row['evaluator']['token'] +'&evaluatee_id='+ row['evaluatee']['id'] +'" data-bs-toggle="modal" data-bs-target="#modalControl" data-bs-table="Evaluation" data-bs-type="Detail" class="text-left btn btn-secondary rounded-0 btn-sm px-3 me-2">Rincian<i class="bi bi-box-arrow-up-right ms-2"></i></a><a href="/evaluation/'+ row['id'] +'" onclick="confirmDelete(event, \'#vanisher\');" class="text-left btn btn-danger px-3 rounded-0 btn-sm">Hapus<i class="bi bi-trash3 ms-2"></i></a>';
            },
            orderable: false,
            searchable: false
        },
        {
            data: 'created_at',
            title: 'Tgl. Penilaian',
            render: function(data, type, row, meta) {
                return '<span class="text-code">' + dateTimeIndoFormat(data).toUpperCase() + '</span>';
            }
        },
        {
            data: 'evaluatee.name',
            title: 'Nama Peserta',
            render: function(data, type, row, meta) {
                if (data == null || data == '') {
                    return '<em>null</em>';
                }
                return data.toUpperCase();
            }
        },
        {
            data: 'evaluator.name',
            title: 'Nama Penilai',
            render: function(data, type, row, meta) {
                if (data == null || data == '') {
                    return '<em>null</em>';
                }
                return data.toUpperCase();
            }
        },
        {
            data: 'evaluatee.project_number',
            title: 'No. PO',
            render: function(data, type, row, meta) {
                if (data == null || data == '') {
                    return '<em>null</em>';
                }
                return data.toUpperCase();
            }
        },
        /*
        {
            data: 'others',
            title: 'Kriteria',
            render: function(data, type, row, meta) {
                if (!data.length) {
                    return '<em>null</em>';
                }

                return data.map((item) => {
                    let pad = '';
                    if (data.length > 1) { pad = 'me-1'; }
                    return '<span class="text-code">Q' + item.other_id + ': ' + item.other_remarks + '</span>';
                }).join('<span class="me-2">,</span>');
            }
        },
        */
        ...columnDefs,
        {
            data: 'percentage',
            title: '%',
            render: function(data, type, row, meta) {
                if (data == null || data == '' || data == 0) {
                    return '0';
                }
                return Math.round(data);
            }
        },
        {
            data: 'remarks',
            title: 'Status',
            render: function(data, type, row, meta) {
                if (data == null || data == '') {
                    return '<em>null</em>';
                }

                if (data === 'Direkomendasikan') {
                    return '<span class="badge text-bg-success rounded-5 pe-3"><i class="bi bi-check-circle me-2"></i>' + data + '</span>';
                } else if (data === 'Dipertimbangkan') {
                    return '<span class="badge text-bg-secondary rounded-5 pe-3"><i class="bi bi-question-circle me-2"></i>' + data + '</span>';
                } else if (data === 'Belum direkomendasikan') {
                    return '<span class="badge text-bg-danger rounded-5 pe-3"><i class="bi bi-x-circle me-2"></i>' + data + '</span>';
                } else {
                    return data.toUpperCase();
                }
            }
        }
    ],
    createdRow: function(row, data, index) {
        if (data.deleted_at) {
            $(row).addClass('deleted');
        }
        $('#evaluationTable_wrapper').find('th:eq(0)').addClass('excluded');
        $(row).find('td.scale').addClass('text-center');
    }
});

new $.fn.dataTable.Buttons(evaluationTable, {
    buttons: [
        {
            extend: 'copy',
            split: [
                {
                    extend: 'excel',
                    text: 'Export as Excel',
                    exportOptions: {
                        columns: ':not(.excluded)'
                    },
                    footer: true
                },
                {
                    extend: 'pdf',
                    text: 'Export as PDF',
                    exportOptions: {
                        columns: ':not(.excluded)'
                    },
                    footer: true
                }
            ]
        },
        {
            extend: 'print',
            text: '<i class="bi bi-printer"></i>',
            exportOptions: {
                columns: ':not(.excluded)'
            },
            customize: function (csv) {
                return 'Text: ' + csv;
            },
            footer: true
        }
    ]
});

evaluationTable.buttons().container().appendTo($('#buttons', evaluationTable.table().container()));
}

$('#evaluationHistoryTable').DataTable({
    ajax: {
        url: '/server/fetch/evaluations/history',
        type: 'GET',
        data: {
            token: token
        }
    },
    processing: true,
    serverSide: true,
    orderCellsTop: true,
    scrollCollapse: true,
    scrollY: true,
    scrollX: true,
    language: {
        url: 'https://cdn.datatables.net/plug-ins/1.13.6/i18n/id.json',
        paginate: {
            previous: '<i class="bi bi-caret-left-fill"></i>',
            next: '<i class="bi bi-caret-right-fill"></i>'
        },
        infoFiltered: '',
        lengthMenu: '_MENU_',
        search: '',
        emptyTable: 'Masukkan TOKEN untuk melihat rincian',
        searchPlaceholder: 'Pencarian',
        processing: 'Mengambil data...'
    },
    initComplete: function(settings, json) {
        $('.dataTables_filter input').removeClass('form-control-sm');
        $('.dataTables_length select').removeClass('form-select-sm');
        $('.dataTables_wrapper > .row:last-child').addClass('mt-2');
    },
    order: [
        [1, 'desc'],
        [3, 'asc']
    ],
    columns: [
        {
            data: null,
            title: 'Aksi',
            render: function(data, type, row, meta) {
                return '<a href="/evaluation/'+ row['batch'] +'/edit?token='+ row['evaluator']['token'] +'&evaluatee_id='+ row['evaluatee']['id'] +'" data-bs-toggle="modal" data-bs-target="#modalControl" data-bs-table="Evaluation" data-bs-type="Edit" class="text-left btn btn-secondary px-3 rounded-0 btn-sm me-2">Rincian<i class="bi bi-box-arrow-up-right ms-2"></i></a><a href="/evaluation/'+ row['id'] +'" onclick="confirmDelete(event, \'#vanisher\');" class="text-left btn btn-danger px-3 rounded-0 btn-sm">Hapus<i class="bi bi-trash3 ms-2"></i></a>';
            },
            orderable: false,
            searchable: false
        },
        {
            data: 'created_at',
            title: 'Tgl. Penilaian',
            render: function(data, type, row, meta) {
                return dateTimeIndoFormat(data);
            }
        },
        {
            data: 'evaluatee.project_number',
            title: 'No. PO'
        },
        {
            data: 'evaluatee.card_number',
            title: 'NIK',
            render: function(data, type, row, meta) {
                if (data == null || data == '') {
                    return '<em>null</em>';
                }
                return data;
            }
        },
        {
            data: 'evaluatee.name',
            title: 'Nama',
            render: function(data, type, row, meta) {
                if (data == null || data == '') {
                    return '<em>null</em>';
                }
                return data.toUpperCase();
            }
        },
        {
            data: 'evaluatee.region',
            title: 'Wilayah',
            render: function(data, type, row, meta) {
                if (data == null || data == '') {
                    return '<em>null</em>';
                }
                return data.toUpperCase() + ' ' + '<strong>[' + row['evaluatee']['zone'].toUpperCase() + ']</strong>';
            }
        },
        /*
        {
            data: 'evaluatee.departments',
            title: 'Divisi',
            render: function(data, type, row, meta) {
                if (!data.length) {
                    return '<em>null</em>';
                }

                return data.map((item) => {
                    let pad = '';
                    if (data.length > 1) { pad = 'me-1'; }
                    return item.name.toUpperCase();
                }).join(', ');
            }
        },
        */
        {
            data: 'percentage',
            title: '%',
            render: function(data, type, row, meta) {
                if (data == null || data == '' || data == 0) {
                    return '0';
                }
                return Math.round(data);
            }
        },
        {
            data: 'remarks',
            title: 'Status',
            render: function(data, type, row, meta) {
                if (data == null || data == '') {
                    return '<em>null</em>';
                }

                if (data === 'Direkomendasikan') {
                    return '<span class="badge text-bg-success rounded-5 pe-3"><i class="bi bi-check-circle me-2"></i>' + data + '</span>';
                } else if (data === 'Dipertimbangkan') {
                    return '<span class="badge text-bg-secondary rounded-5 pe-3"><i class="bi bi-question-circle me-2"></i>' + data + '</span>';
                } else if (data === 'Belum direkomendasikan') {
                    return '<span class="badge text-bg-danger rounded-5 pe-3"><i class="bi bi-x-circle me-2"></i>' + data + '</span>';
                } else {
                    return data.toUpperCase();
                }
            }
        }
    ],
    createdRow: function(row, data, index) {
        if (data.deleted_at) {
            $(row).addClass('deleted');
        }
    }
});