@extends('layouts.new.master')
@section('head')
    <link rel="stylesheet" href="{{ asset('/css/custom.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/newTheme/assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css') }}" />

    <style>
        .bred-color {
            background-color: white;
        }
    </style>
@endsection
@section('title')
    Employee
@endsection
@section('content')
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        @if (session('success_message'))
            <div class="alert alert-success" role="alert">
                {{ session('success_message') }}
            </div>
        @endif
        @if (session('error_message'))
            <div class="alert alert-danger" role="alert">
                {{ session('error_message') }}
            </div>
        @endif
        <div class="title d-flex justify-content-between breadcrumbSpacing">
            <div class="sub-title">
                <h3>Employee</h3>
                <a>Employee </a>
                <span><i class="fa-solid fa-circle fa-xs"></i></span>
                <a>List</a>
            </div>

            <div class="addBtn">
                <a href="{{ route('employees.create') }}" class="add-new">
                    Add New
                </a>
            </div>
        </div>

        <div class="main bg-white p-3 justify-content-end">
            <div class="main-search d-flex justify-content-end d-none">
                <div class="category">
                    <label class="search-lable"><i class="fa-solid fa-magnifying-glass search"></i>
                        <input type="search" class="form-control search1" placeholder="Search Here"
                            aria-controls="DataTables_Table_0"></label>
                </div>
                <div class="quick d-flex">
                    <h3>QUICK FILTERS :</h3>
                    <div class="btn btn-primary me-3 mb-0" role="alert">
                        <a class="status" value="0">IN-ACTIVE</a>
                    </div>
                    <div class="btn btn-primary mb-0" role="alert">
                        <a class="status" value="1">ACTIVE</a>
                    </div>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-12 col-xl-12 col-sm-12 order-1 order-lg-2 mb-4 mb-lg-0">
                    <table class="table responsive" id="faqstable">
                        <thead>
                            <tr class="id-head">
                                <th>Id</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Email</th>
                                <th>Mobile No.</th>
                                <th>Gender</th>
                                <th style="text-align: center;" width="10%">ACTION</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- / Content -->
@endsection
@section('scripts')
    <script src="{{ asset('js/customJs.js') }}"></script>

    <script src="{{ asset('admin/newTheme/assets/vendor/js/jquery.min.js') }}"></script>
    <script src="{{ asset('admin/newTheme/assets/vendor/js/jquery.dataTables.min.js') }}"></script>

    <script src="{{ asset('admin/newTheme/assets/vendor/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('vendors/js/tables/datatable/dataTables.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('/js/customJs.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert2/11.15.10/sweetalert2.all.min.js"></script>

    <script>
        $(document).on('click', '.delete_confirm', function() {
            var url = $(this).attr('data-href');
            console.log('url ', url);
            deleteRow(url);
        });
    </script>
    <script>
        $(document).on('click', '.custom-css', function() {
            var changeStatusUrl = $(this).attr('data-href');
            console.log('changeStatusUrl ', changeStatusUrl);
            changeStatus(changeStatusUrl);

        });
    </script>
    <script type="text/javascript">
        $(document).ready(function() {
            getListData()
        });

        // var table;

        function getListData() {
            var table = $('#faqstable').DataTable({
                dom: 'Blfrtip',
                order: [[0, 'desc']],
                serverSide: true,
                ajax: "{{ route('employees.index') }}",
                // dataType: 'jsonp',
                columns: [
                    {
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        title: '#',
                        orderable:false,
                        searchable: false
                    },
                    {
                        data: 'first_name',
                        name: 'first_name',
                        orderable: true,
                        class: 'text-left',
                        render: function(data, type, row) {
                            return `
                        <div style="text-transform: capitalize;">
                                ${row.first_name}
                        </div>`;
                        }
                    },
                    {
                        data: 'last_name',
                        name: 'last_name',
                        orderable: true,
                        class: 'text-left',
                        render: function(data, type, row) {
                            return `
                        <div style="text-transform: capitalize;">
                                ${row.last_name}
                        </div>`;
                        }
                    },
                    {
                        data: 'email',
                        name: 'email',
                        orderable: true,
                        class: 'text-left',
                        render: function(data, type, row) {
                            return `
                        <div style="text-transform: capitalize;">
                                ${row.email}
                        </div>`;
                        }
                    },
                    {
                        data: 'mobile_number',
                        name: 'mobile_number',
                        orderable: true,
                        class: 'text-left',
                        render: function(data, type, row) {
                            return `
                        <div style="text-transform: capitalize;">
                                ${row.mobile_number}
                        </div>`;
                        }
                    },
                    {
                        data: 'gender',
                        name: 'gender',
                        orderable: true,
                        class: 'text-left',
                        render: function(data, type, row) {
                            return `
                        <div style="text-transform: capitalize;">
                                ${row.gender}
                        </div>`;
                        }
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ],
            });
        }
    </script>
@endsection
