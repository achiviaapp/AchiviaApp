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

                pageSize: 10, // display 20 records per page
                serverPaging: false,
                serverFiltering: false,
                serverSorting: false,
            },


            // layout definition
            layout: {
                scroll: false, // enable/disable datatable scroll both horizontal and vertical when needed.
                footer: false, // display/hide footer
            },

            // column sorting
            sortable: false,
            pagination: false,


            // columns definition
            columns: [
                // {
                //     field: 'id',
                //     title: '#',
                //     width: 20,
                //     textAlign: 'center',
                // },

                {
                    field: "name",
                    title: "Client Info",
                    width: 240,
                    // callback function support for column rendering
                    template: function (data, i) {

                        return window.info(data);
                    }
                },

                {
                    field: "actionId",
                    title: window.title,
                    width: 230,
                    class: 'last',
                    // callback function support for column rendering
                    template: function (data) {

                        return window.last(data);
                    }
                },
                {
                    field: '',
                    title: 'Next Action',
                    width: 650,

                    template: function (data) {

                        return window.output(data);
                    }
                },

            ]
        });
    };


    return {
        // public functions
        init: function () {
            init();
        },
    };
}
();

// On document ready
KTUtil.ready(function () {
    KTUserListDatatable.init();
});