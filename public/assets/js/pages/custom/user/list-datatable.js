"use strict";
// Class definition

var KTUserListDatatable = function () {

    // variables
    var datatable;

    // init
    var init = function () {
        // init the datatables. Learn more: https://keenthemes.com/metronic/?page=docs&section=datatable
        datatable = $('#kt_apps_user_list_datatable').KTDatatable({
            // datasource definition
            data: {
                type: 'remote',
                source: {
                    read: {
                        url: HREF,
                        method: 'GET',
                    },
                },

                pageSize: 20, // display 20 records per page
                serverPaging: true,
                serverFiltering: true,
                serverSorting: true,
            },


            // layout definition
            layout: {
                scroll: false, // enable/disable datatable scroll both horizontal and vertical when needed.
                footer: false, // display/hide footer
            },

            // column sorting
            sortable: true,
            pagination: true,

            search: {
                input: $('#generalSearch'),
                delay: 500,
            },

            filterSale: {
                input: $('#saleFilter'),
                delay: 500,
            },
            projectFilter: {
                input: $('#projectFilter'),
                delay: 500,
            },
            priorityFilter: {
                input: $('#priorityFilter'),
                delay: 500,
            },
            statusFilter: {
                input: $('#statusFilter'),
                delay: 500,
            },
            propertyFilter: {
                input: $('#propertyFilter'),
                delay: 500,
            },
            areaFilter: {
                input: $('#areaFilter'),
                delay: 500,
            },
            budgetFilter: {
                input: $('#budgetFilter'),
                delay: 500,
            },
            convertToProjectFilter: {
                input: $('#convertToProjectFilter'),
                delay: 500,
            },
            marketerFilter: {
                input: $('#marketerFilter'),
                delay: 500,
            },
            customLinkFilter: {
                input: $('#customLinkFilter'),
                delay: 500,
            },
            campaignFilter: {
                input: $('#campaignFilter'),
                delay: 500,
            },
            platformFilter: {
                input: $('#platformFilter'),
                delay: 500,
            },

            // columns definition
            columns: [
                {
                    field: 'userId',
                    title: '#',
                    width: 10,
                    textAlign: 'center',
                    selector: {
                        class: 'kt-checkbox--solid'
                    }
                },

                {
                    field: "name",
                    title: "Client Info",
                    width: 300,
                    // callback function support for column rendering
                    template: function (data, i) {
                        return window.info(data);
                    }
                },
                {
                    field: "takeActions",
                    title: 'Take An Action',
                    width: 600,
                    // callback function support for column rendering
                    template: function (data) {
                        return window.takeAction(data);
                    }
                },
                {
                    field: "Client'sQuestions",
                    title: "Client's Questions",

                    // callback function support for column rendering
                    template: function (data) {
                        return window.clientsQuestions(data);
                    }
                },
                {
					field: 'Priority',
					title: 'Priority',
                    autoHide: false,
                    width:70,
					// callback function support for column rendering
					template: function(data) {
						var status = {
						    null: {'title': '-', 'state': 'info'},
							High: {'title': 'Online', 'state': 'danger'},
							Normal: {'title': 'Retail', 'state': 'warning'},
							Low: {'title': 'Direct', 'state': 'primary'},
						};
						return '<span class="kt-badge kt-badge--' + status[data.priority].state + ' kt-badge--dot"></span>&nbsp;<span class="kt-font-bold kt-font-' + status[data.priority].state +
							'">' +
							data.priority + '</span>';
					},
                },

                {
                    field: "Actions",
                    width: 50,
                    title: "Actions",
                    sortable: false,
                    autoHide: false,
                    overflow: 'visible',
                    template: function (data) {
                        return '\
							<div class="dropdown">\
								<a href="javascript:;" class="btn btn-sm btn-clean btn-icon btn-icon-md" data-toggle="dropdown">\
									<i class="flaticon-more-1"></i>\
								</a>\
								<div class="dropdown-menu dropdown-menu-right">\
									<ul class="kt-nav">\
										<!-- <li class="kt-nav__item">\
											<a href="#" class="kt-nav__link">\
												<i class="kt-nav__link-icon flaticon2-expand"></i>\
												<span class="kt-nav__link-text">View</span>\
											</a>\
										</li>\ -->\
										<li class="kt-nav__item">\
											<a href="' + URL + '/client-edit/' + data.userId + '" class="kt-nav__link">\
												<i class="kt-nav__link-icon flaticon2-contract"></i>\
												<span class="kt-nav__link-text">Edit</span>\
											</a>\
										</li>\
										<li class="kt-nav__item">\
										<a href="' + URL + '/history-clients/' + data.userId + '" class="kt-nav__link">\
                                            <i class="kt-nav__link-icon fas fa-history"></i>\
                                            <span class="kt-nav__link-text">History</span>\
                                            </a>\
										    </li>\
									        <li class="kt-nav__item">\
											<a href="' + URL + '/delete-clients/' + data.userId + '" class="kt-nav__link">\
                                                <i class="kt-nav__link-icon flaticon2-trash"></i>\
												<span class="kt-nav__link-text">Delete</span>\
											</a>\
										</li>\
									</ul>\
								</div>\
							</div>\
						';
                    },
                }
            ]
        });
    };


    var listners = function () {
        window.addEventListener('date', function (elem) {
            datatable.search(elem.detail.range, "date");
        }, false);
    };


    // search
    var search = function () {
        $('#generalSearch').on('keyup', function () {
            datatable.search($(this).val(), "name");
        });
    }
    // filter
    var filterSale = function () {
        $('#saleFilter').on('change', function () {
            datatable.search($(this).val(), "sale");
        });
    }
    // filter
    var projectFilter = function () {
        $('#projectFilter').on('change', function () {
            datatable.search($(this).val(), "project");
        });
    }
    // filter
    var priorityFilter = function () {
        $('#priorityFilter').on('change', function () {
            datatable.search($(this).val(), "priority");
        });
    }
    // filter
    var statusFilter = function () {
        $('#statusFilter').on('change', function () {
            datatable.search($(this).val(), "status");
        });
    }
    // filter
    var propertyFilter = function () {
        $('#propertyFilter').on('change', function () {
            datatable.search($(this).val(), "property");
        });
    }
    // filter
    var areaFilter = function () {
        $('#areaFilter').on('change', function () {
            datatable.search($(this).val(), "area");
        });
    }
    // // filter
    // var budgetFilter = function () {
    //     $('#budgetFilter').on('change', function () {
    //         datatable.search($(this).val(), "budget");
    //     });
    // }
    // filter
    var budgetFilter = function () {
        $('#budgetFilter').on('change', function () {
            datatable.search($(this).val(), "budget");
        });
    }
    // filter
    var convertToProjectFilter = function () {
        $('#convertToProjectFilter').on('change', function () {
            datatable.search($(this).val(), "convertToProject");
        });
    }
    // filter
    var marketerFilter = function () {
        $('#marketerFilter').on('change', function () {
            datatable.search($(this).val(), "marketer");
        });
    }
    // filter
    var customLinkFilter = function () {
        $('#customLinkFilter').on('change', function () {
            datatable.search($(this).val(), "customLink");
        });
    }
    // filter
    var campaignFilter = function () {
        $('#campaignFilter').on('change', function () {
            datatable.search($(this).val(), "campaign");
        });
    }
    // filter
    var platformFilter = function () {
        $('#platformFilter').on('change', function () {
            datatable.search($(this).val(), "platform");
        });
    }



    // selection
    var selection = function () {
        // init form controls
        $('#kt_form_status, #kt_form_type').selectpicker();

        // event handler on check and uncheck on records
        datatable.on('kt-datatable--on-check kt-datatable--on-uncheck kt-datatable--on-layout-updated', function (e) {
                var checkedNodes = datatable.rows('.kt-datatable__row--active').nodes(); // get selected records
                var count = checkedNodes.length; // selected records count

                $('#kt_subheader_group_selected_rows').html(count);

                if (window.user == 'admin') {
                    if (count > 0) {
                        $('#kt_subheader_search').addClass('kt-hidden');
                        $('#kt_subheader_group_actions').removeClass('kt-hidden');
                    } else {
                        $('#kt_subheader_search').removeClass('kt-hidden');
                        $('#kt_subheader_group_actions').addClass('kt-hidden');
                    }
                }
            }
        );
    }

// fetch selected records
    var selectedFetch = function () {
        // event handler on selected records fetch modal launch
        $('#kt_datatable_records_fetch_modal').on('show.bs.modal', function (e) {
            // show loading dialog
            var loading = new KTDialog({'type': 'loader', 'placement': 'top center', 'message': 'Loading ...'});
            loading.show();

            setTimeout(function () {
                loading.hide();
            }, 5000);

            // fetch selected IDs
            var ids = datatable.rows('.kt-datatable__row--active').nodes().find('.kt-checkbox--single > [type="checkbox"]').map(function (i, chk) {
                return $(chk).val();
            });

            // populate selected IDs
            var c = document.createDocumentFragment();

            for (var i = 0; i < ids.length; i++) {
                var li = document.createElement('li');
                li.setAttribute('data-id', ids[i]);
                li.innerHTML = 'Selected record ID: ' + ids[i];
                c.appendChild(li);
            }

            $(e.target).find('#kt_apps_user_fetch_records_selected').append(c);
        }).on('hide.bs.modal', function (e) {
            $(e.target).find('#kt_apps_user_fetch_records_selected').empty();
        });
    };

// selected records status update
// selected records status update
    var selectedStatusUpdate = function () {
        $('#kt_subheader_group_actions_status_change a.kt-nav__link').on('click', function () {
            var sale = $(this).data('status');
            var status = $(this).find('.sale').text();
            var type = $(this).data('type');

// fetch selected IDs
            var ids = datatable.rows('.kt-datatable__row--active').nodes().find('.kt-checkbox--single > [type="checkbox"]').map(function (i, chk) {
                return $(chk).val();
            });

            if (ids.length > 0) {
// learn more: https://sweetalert2.github.io/
                swal.fire({
                    buttonsStyling: false,

                    html: "Are you sure to Assign " + ids.length + " selected records  to " + status + " ?",
                    type: "info",

                    confirmButtonText: "Yes, update!",
                    confirmButtonClass: "btn btn-sm btn-bold btn-brand",

                    showCancelButton: true,
                    cancelButtonText: "No, cancel",
                    cancelButtonClass: "btn btn-sm btn-bold btn-default"
                }).then(function (result) {
                    if (result.value) {

                        $.ajax({
                            type: "GET",
                            url: URL + '/assign-user',
                            data: {
                                ids: ids.toArray(),
                                sale: sale,
                                type:type
                            },
                            success: function (data) {
                                swal.fire({
                                    title: 'Assigned!',
                                    text: 'Your selected records statuses have been updated!',
                                    type: 'success',
                                    buttonsStyling: false,
                                    confirmButtonText: "OK",
                                    confirmButtonClass: "btn btn-sm btn-bold btn-brand",
                                })
                                    .then((success) => {
                                        if (success) {
                                            location.reload();
                                        }
                                    });
                            },
                        });

// result.dismiss can be 'cancel', 'overlay',
// 'close', and 'timer'
                    } else if (result.dismiss === 'cancel') {
                        swal.fire({
                            title: 'Cancelled',
                            text: 'You selected records statuses have not been updated!',
                            type: 'error',
                            buttonsStyling: false,
                            confirmButtonText: "OK",
                            confirmButtonClass: "btn btn-sm btn-bold btn-brand",
                        })
                            .then((success) => {
                                if (success) {
                                    location.reload();
                                }
                            });
                    }
                });
            }
        });
    }

// selected records delete
    var selectedDelete = function () {
        $('#kt_subheader_group_actions_delete_all').on('click', function () {
// fetch selected IDs
            var ids = datatable.rows('.kt-datatable__row--active').nodes().find('.kt-checkbox--single > [type="checkbox"]').map(function (i, chk) {
                return $(chk).val();
            });

            if (ids.length > 0) {
// learn more: https://sweetalert2.github.io/
                swal.fire({
                    buttonsStyling: false,

                    text: "Are you sure to delete " + ids.length + " selected records ?",
                    type: "danger",

                    confirmButtonText: "Yes, delete!",
                    confirmButtonClass: "btn btn-sm btn-bold btn-danger",

                    showCancelButton: true,
                    cancelButtonText: "No, cancel",
                    cancelButtonClass: "btn btn-sm btn-bold btn-brand"
                }).then(function (result) {
                    if (result.value) {
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('input[name="_token"]').attr('value')
                            }
                        });

                        $.ajax({
                            type: "DELETE",
                            url: URL + '/client-delete',
                            data: {
                                ids: ids.toArray(),
                            },
                            success: function (data) {
                                swal.fire({
                                    title: 'Deleted!',
                                    text: 'Your selected records statuses have been Deleted!',
                                    type: 'success',
                                    buttonsStyling: false,
                                    confirmButtonText: "OK",
                                    confirmButtonClass: "btn btn-sm btn-bold btn-brand",
                                })
                                    .then((success) => {
                                        if (success) {
                                            location.reload();
                                        }
                                    });
                            },
                        });

// result.dismiss can be 'cancel', 'overlay',
// 'close', and 'timer'
                    } else if (result.dismiss === 'cancel') {
                        swal.fire({
                            title: 'Cancelled',
                            text: 'You selected records have not been deleted! :)',
                            type: 'error',
                            buttonsStyling: false,
                            confirmButtonText: "OK",
                            confirmButtonClass: "btn btn-sm btn-bold btn-brand",
                        })
                            .then((success) => {
                                if (success) {
                                    location.reload();
                                }
                            });
                    }
                });
            }
        });
    }

    var updateTotal = function () {
        datatable.on('kt-datatable--on-layout-updated', function () {
            $('#kt_subheader_total').html(datatable.getTotalRows() + ' Total');
        });
    };

    return {
        // public functions
        init: function () {
            init();
            search();
            filterSale();
            projectFilter();
            priorityFilter();
            statusFilter();

            propertyFilter();
            areaFilter();
            budgetFilter();
            convertToProjectFilter();
            marketerFilter();
            customLinkFilter();
            campaignFilter();
            platformFilter();

            listners();
            selection();
            selectedFetch();
            selectedStatusUpdate();
            selectedDelete();
            updateTotal();
        },
    };
}
();

// On document ready
KTUtil.ready(function () {
    KTUserListDatatable.init();
});