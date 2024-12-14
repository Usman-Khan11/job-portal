@extends('layouts.admin')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="card">
            <div class="card-header">
                <div class="row align-items-center">
                    <div class="col-6">
                        <h4 class="card-title m-0">{{ $page_title }}</h4>
                    </div>
                    <div class="col-6 text-end">
                        <a href="{{ route('admin.category.create') }}" class="btn btn-primary">Add New Category</a>
                    </div>
                </div>
                <hr />
            </div>
            <div class="card-body">
                <div class="responsive text-nowrap">
                    <table class="table table-sm" id="my_table"></table>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script type="text/javascript">
        $(document).ready(function() {
            var datatable = $("#my_table").DataTable({
                select: {
                    style: "api",
                },
                processing: true,
                searching: true,
                serverSide: true,
                lengthChange: false,
                ordering: false,
                pageLength: 15,
                scrollX: true,
                ajax: {
                    url: "{{ route('admin.category') }}",
                    type: "get",
                    data: function(d) {},
                },
                columns: [{
                        data: 'DT_RowIndex',
                        title: "S.no",
                    },
                    {
                        data: "name",
                        title: "Name",
                        class: "text-nowrap",
                    },
                    {
                        data: "description",
                        title: "description",
                    },
                    {
                        title: "image",
                        render: function(data, type, full, meta) {
                            if (full.image) {
                                return `<img src="{{ asset('${full.image}') }}" width="80px" loading="lazy" />`;
                            } else {
                                return '-';
                            }
                        }
                    },
                    {
                        title: "Options",
                        class: "text-nowrap",
                        render: function(data, type, full, meta) {
                            let button = '';
                            button +=
                                `<a href="/admin/category/edit/${full.id}" class="btn btn-warning btn-xs">Edit</a> `;
                            button +=
                                `<a href="/admin/category/delete/${full.id}" onclick="return checkDelete()" class="btn btn-danger btn-xs">Delete</a> `;

                            return button;
                        },
                    },
                ],
                rowCallback: function(row, data) {},
            });
        });
    </script>
@endpush
