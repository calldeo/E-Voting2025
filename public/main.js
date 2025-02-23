$(document).ready(function(){
            $('#bendaharaTable').DataTable({
            ordering: true,
            serverSide: true,
            processing: true,
            responsive: true,
            language: {
                processing: '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Memuat...</span>',
                paginate: {
                    next: '<i class="fa fa-angle-double-right" aria-hidden="true"></i>',
                    previous: '<i class="fa fa-angle-double-left" aria-hidden="true"></i>' 
                },
               
            },
            ajax: {
                url: $('#table-url').val(),
                type: 'GET',
                dataType: 'json',
                error: function(jqXHR, textStatus, errorThrown) {
                    console.error('AJAX error:', textStatus, errorThrown);
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Terjadi kesalahan saat memuat data. Silakan coba lagi nanti.'
                    });
                }
            },
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex', width: '50px', orderable: false, searchable: false },
                { data: 'name', name: 'name' },
                { data: 'email', name: 'email' },
                { data: 'kelas', name: 'kelas' },
                { data: 'status_pemilihan', name: 'status_pemilihan' },
                { data: 'roles', name: 'roles' },
                { data: 'opsi', name: 'opsi', orderable: false, searchable: false }
            ],
            columnDefs: [
                {
                    targets: '_all', 
                    className: 'text-center',
                    createdCell: function (td, cellData, rowData, row, col) {
                        if (col < 6) { // Tidak termasuk kolom opsi
                            $(td).css('cursor', 'pointer');
                            $(td).attr('data-url', '/user/' + rowData.id + '/detail');
                            $(td).attr('data-toggle', 'modal');
                            $(td).attr('data-target', '#adminDetailModal');
                        }
                    }
                }
            ],
            dom: '<"row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6"f>>' +
                 '<"row"<"col-sm-12"tr>>' +
                 '<"row"<"col-sm-12 col-md-5"i><"col-sm-12 col-md-7"p>>',
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ]
        });


        var filterData={
            start_created_at : null,
            end_created_at : null
        }
        pemasukanTable(filterData)
        $('.input-daterange-datepicker').val('');
        $('.input-daterange-datepicker').daterangepicker({
            autoUpdateInput : false,
            locale: {
                format: 'DD/MM/YYYY'
            }
        },function (start,end,label) {
                filterData.start_created_at =start.format('YYYY-MM-DD 00:00:00');
                filterData.end_created_at =end.format('YYYY-MM-DD 23:59:59');
                pemasukanTable(filterData)
            });

    
        $('.input-daterange-datepicker').on('apply.daterangepicker', function(ev, picker) {
            var startDate = picker.startDate.format('YYYY-MM-DD');
            var endDate = picker.endDate.format('YYYY-MM-DD');

            console.log('Selected date range: ' + startDate + ' to ' + endDate);

            
        });
        $('.input-daterange-datepicker').on('cancel.daterangepicker', function(ev, picker) {
            $(this).val('');
            filterData.start_created_at =null;
            filterData.end_created_at =null;
            pemasukanTable(filterData)

            
        
        });


        function pemasukanTable(filterData){
            tablePemasukan = $('#pemasukanTable').DataTable({
                ordering: true,
                serverSide: true,
                processing: true,
                responsive: true,
                language: {
                    processing: '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Memuat...</span>',
                    paginate: {
                        next: '<i class="fa fa-angle-double-right" aria-hidden="true"></i>',
                        previous: '<i class="fa fa-angle-double-left" aria-hidden="true"></i>' 
                    },
                  
                },
                ajax: {
                    url: $('#table-url').val(),
                    type: 'GET',
                    dataType: 'json',
                    data: filterData,
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.error('AJAX error:', textStatus, errorThrown);
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Terjadi kesalahan saat memuat data. Silakan coba lagi nanti.'
                        });
                    }
                },
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex', width: '50px', orderable: false, searchable: false },
                    { data: 'name', name: 'name' },
                    { data: 'description', name: 'description' },
                    { data: 'category', name: 'category' },
                    { data: 'date', name: 'date' },
                    { data: 'jumlah', name: 'jumlah' },
                    { data: 'opsi', name: 'opsi', orderable: false, searchable: false }
                ],
                columnDefs: [
                    {
                        targets: '_all',
                        className: 'text-center'
                    }
                ],
                dom: '<"row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6"f>>' +
                     '<"row"<"col-sm-12"tr>>' +
                     '<"row"<"col-sm-12 col-md-5"i><"col-sm-12 col-md-7"p>>',
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ]
            });
        }
        


        $('#kategoriTable').DataTable({
            ordering: true,
            serverSide: true,
            processing: true,
            responsive: true,
            language: {
                processing: '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Memuat...</span>',
                paginate: {
                    next: '<i class="fa fa-angle-double-right" aria-hidden="true"></i>',
                    previous: '<i class="fa fa-angle-double-left" aria-hidden="true"></i>' 
                },
             
            },
            ajax: {
                url: $('#table-url').val(),
                type: 'GET',
                dataType: 'json',
                error: function(jqXHR, textStatus, errorThrown) {
                    console.error('AJAX error:', textStatus, errorThrown);
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Terjadi kesalahan saat memuat data. Silakan coba lagi nanti.'
                    });
                }
            },
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex', width: '50px', orderable: false, searchable: false },
                { data: 'name', name: 'name' },
                { data: 'jenis_kategori', name: 'jenis_kategori' },
                { data: 'description', name: 'description' },
                { data: 'opsi', name: 'opsi', orderable: false, searchable: false }
            ],
            columnDefs: [
                {
                    targets: '_all',
                    className: 'text-center'
                }
            ],
            dom: '<"row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6"f>>' +
                 '<"row"<"col-sm-12"tr>>' +
                 '<"row"<"col-sm-12 col-md-5"i><"col-sm-12 col-md-7"p>>',
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ],
            createdRow: function(row, data, dataIndex) {
                $(row).find('td:not(:last-child)').css('cursor', 'pointer').on('click', function() {
                    $('#adminDetailModal').modal('show');
                    $.ajax({
                        url: '/kategori/' + data.id + '/detail',
                        method: 'GET',
                        success: function(response) {
                            $('#id').text(response.id || 'N/A');
                            $('#name').text(response.name || 'N/A'); 
                            $('#description').text(response.description || 'N/A');
                            console.log('Detail Data:', response); // Log detail data
                        },
                        error: function(xhr, status, error) {
                            console.error('Error:', error);
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: 'Terjadi kesalahan saat memuat detail'
                            });
                        }
                    });
                });
            }
        });

        $('#roleTable').DataTable({
            ordering: true,
            serverSide: true,
            processing: true,
            responsive: true,
            language: {
                processing: '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Memuat...</span>',
                paginate: {
                    next: '<i class="fa fa-angle-double-right" aria-hidden="true"></i>',
                    previous: '<i class="fa fa-angle-double-left" aria-hidden="true"></i>' 
                },
              
            },
            ajax: {
                url: $('#table-url').val(),
                type: 'GET',
                dataType: 'json',
                error: function(jqXHR, textStatus, errorThrown) {
                    console.error('AJAX error:', textStatus, errorThrown);
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Terjadi kesalahan saat memuat data. Silakan coba lagi nanti.'
                    });
                }
            },
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex', width: '50px', orderable: false, searchable: false },
                { data: 'name', name: 'name' },
                // { data: 'guard_name', name: 'guard_name' },
                { data: 'opsi', name: 'opsi', orderable: false, searchable: false }
            ],
            columnDefs: [
                {
                    targets: '_all',
                    className: 'text-center'
                }
            ],
            dom: '<"row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6"f>>' +
                 '<"row"<"col-sm-12"tr>>' +
                 '<"row"<"col-sm-12 col-md-5"i><"col-sm-12 col-md-7"p>>',
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ]
        });

        
    });