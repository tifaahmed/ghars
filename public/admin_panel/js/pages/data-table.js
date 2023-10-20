//[Data Table Javascript]

//Project:  Bonito Admin - Responsive Admin Template
//Version:  1.1.0
//Last change:  10/09/2017
//Primary use:   Used only for the Data Table

$(function () {
    "use strict";

    $('#example1').DataTable();
    $('#example2').DataTable({
        'paging': true,
        'lengthChange': false,
        'searching': false,
        'ordering': true,
        'info': true,
        'autoWidth': false
    });
    $('#print_table_1').DataTable({
        'paging': false,
        'lengthChange': false,
        'searching': false,
        'ordering': false,
        'info': false,
        'autoWidth': true
    });
    $('#print_table_2').DataTable({
        'paging': false,
        'lengthChange': false,
        'searching': false,
        'ordering': false,
        'info': false,
        'autoWidth': true
    });
    $('#print_table_3').DataTable({
        'paging': false,
        'lengthChange': false,
        'searching': false,
        'ordering': false,
        'info': false,
        'autoWidth': true
    });
    $('#print_table_4').DataTable({
        'paging': false,
        'lengthChange': false,
        'searching': false,
        'ordering': false,
        'info': false,
        'autoWidth': true
    });
    $('#print_table_5').DataTable({
        'paging': false,
        'lengthChange': false,
        'searching': false,
        'ordering': false,
        'info': false,
        'autoWidth': true
    });

    //Date picker
    $('#date_start').datepicker({
        autoclose: true,
        format: 'yyyy-mm-dd'
    });

    //Date picker
    $('#date_end').datepicker({
        autoclose: true,
        format: 'yyyy-mm-dd'
    });


    $('#example').DataTable({
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'print'
        ]
    });
    $('#example3').DataTable({
        dom: 'Bfrtip',
        'bSort': false,
        buttons: [
            'copy', 'csv', 'excel', 'print'
        ]
    });
    $('#example4').DataTable({
        dom: 'Bfrtip',
        'bSort': false,
        buttons: [
            {
                extend: 'copy',
                exportOptions: {
                    columns: [1]
                }
            },
            {
                extend: 'csv',
                exportOptions: {
                    columns: [1]
                }
            },
            {
                extend: 'excel',
                exportOptions: {
                    columns: [1]
                }
            },
            {
                extend: 'print',
                exportOptions: {
                    columns: [1]
                }
            }
        ]
    });


}); // End of use strict