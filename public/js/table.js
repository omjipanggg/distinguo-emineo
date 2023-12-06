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
        let order = $(item).data('bsOrder') || null;
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
                processing: 'Mengambil data...'
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
    order: [
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
    order: [
        [0, 'asc'],
        [4, 'desc']
    ],
    columns: [
        {
	    	data: 'is_used',
	    	title: 'Status',
    		render: function(data, type, row, meta) {
    			if (data) {
    				return '<span class="badge text-bg-success rounded-0"><i class="bi bi-check-circle me-2"></i>Used</em>';
    			} else {
    				return '<span class="badge text-bg-dark rounded-0"><i class="bi bi-question-circle me-2"></i>Unused</em>';
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
    	{
    		data: 'region',
    		title: 'region',
    		render: function(data, type, row, meta) {
    			if (data == null || data == '') {
    				return '<em>null</em>';
    			}

    			return data + ' ' + '<strong>[' + row['zone'] + ']</strong>';
    		}
    	},
	    {
	    	data: 'used_at',
	    	title: 'Digunakan Pada',
    		render: function(data, type, row, meta) {
    			if (data == null) {
    				return '<em>null</em>';
    			}
    			return dateTimeIndoFormat(data);
    		}
	    }
	]
});

$('#userTable').DataTable({
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
    order: [
    ],
    columns: [
    	{
    		data: 'card_number',
    		title: 'ID'
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
    	}
	]
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
        },
    ],
    createdRow: function(row, data, index) {
        if (data.deleted_at) {
            $(row).addClass('deleted');
        }
        $(row).find('td:eq(2)').attr('title', data.description);
    }
});

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
    order: [
        [1, 'desc'],
        [3, 'asc']
    ],
    columns: [
        {
            data: null,
            title: 'Aksi',
            render: function(data, type, row, meta) {
                return '<a href="/evaluation/'+ row['batch'] +'?token='+ row['evaluator']['token'] +'&evaluatee_id='+ row['evaluatee']['id'] +'" data-bs-target="#modalPlain" data-bs-toggle="modal" data-bs-table="Evaluation" data-bs-type="Detail" data-bs-footer="'+ row['evaluatee']['id'] +'" class="text-left btn btn-secondary px-3 rounded-0 btn-sm">Rincian<i class="bi bi-box-arrow-up-right ms-2"></i></a><a href="/evaluation/'+ row['batch'] +'/edit?token='+ row['evaluator']['token'] +'&evaluatee_id='+ row['evaluatee']['id'] +'" data-bs-toggle="modal" data-bs-target="#modalControl" data-bs-table="Evaluation" data-bs-type="Edit" class="text-left btn btn-dark px-3 rounded-0 btn-sm mx-2">Ubah<i class="bi bi-pencil-square ms-2"></i></a><a href="/evaluation/'+ row['id'] +'" onclick="confirmDelete(event, \'#vanisher\');" class="text-left btn btn-danger px-3 rounded-0 btn-sm">Hapus<i class="bi bi-trash3 ms-2"></i></a>';
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
        },
    ],
    createdRow: function(row, data, index) {
        if (data.deleted_at) {
            $(row).addClass('deleted');
        }
    }
});