@extends('layouts.app')

@section('title', 'Pantry | Order List')

@section('prehead')
<link href="{{ asset('assets/plugins/custom/fullcalendar/fullcalendar.bundle.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css" />
@endsection

@inject('carbon', 'Carbon\Carbon')
@inject('carbonInterval', 'Carbon\CarbonInterval')

@section('content')
<div id="app" v-cloak>
    {{-- begin::modal detail --}}
    <div class="modal fade" tabindex="-1" id="kt_modal_1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form @submit.prevent="submitForm" enctype="multipart/form-data">
                    <div class="modal-header">
                        <h5 class="modal-title">Details Order</h5>
                        <!--begin::Close-->
                        <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                            <span class="svg-icon svg-icon-2x"></span>
                        </div>
                        <!--end::Close-->
                    </div>
                    <div class="modal-body">
                        <div class="row g-3 align-items-center mb-4">
                            <div class="col-sm-3">
                                <label for="" class="form-label form-label-sm">Title</label>
                            </div>
                            <div class="col-sm-9">
                                <span class="fw-bolder text-dark">: &nbsp; @{{ orderDetail.booking_room?.title}}</span>
                            </div>
                        </div>
                        <div class="row g-3 align-items-center mb-4">
                            <div class="col-sm-3">
                                <label for="" class="form-label form-label-sm">Room</label>
                            </div>
                            <div class="col-sm-9">
                                <span class="fw-bolder text-dark">: &nbsp; @{{ orderDetail.booking_room?.room.name}}</span>
                            </div>
                        </div>
                        <div class="row g-3 align-items-center mb-4">
                            <div class="col-sm-3">
                                <label for="" class="form-label form-label-sm">Department</label>
                            </div>
                            <div class="col-sm-9">
                                <span class="fw-bolder text-dark">: &nbsp; @{{ orderDetail.booking_room?.division.name}}</span>
                            </div>
                        </div>
                        <div class="row g-3 align-items-center mb-4">
                            <div class="col-sm-3">
                                <label for="" class="form-label form-label-sm">Start</label>
                            </div>
                            <div class="col-sm-9">
                                <span class="fw-bolder text-dark">: &nbsp; @{{ orderDetail.booking_room?.start_date}}</span>
                            </div>
                        </div>
                        <div class="notice bg-light-primary rounded border-primary border border-dashed p-6 mb-4">
                            <div class="row g-3 mb-4">
                                <div class="col-sm-3">
                                    <label for="" class="form-label form-label-sm">Order</label>
                                </div>
                                <div class="col-sm-9">
                                    <table class="table border rounded table-row-dashed">
                                        <thead>
                                            <tr class=" text-gray-400 fw-bolder text-uppercase">
                                                <th class="pt-0 min-w-20px">No</th>
                                                <th class="pt-0 min-w-100px">Food</th>
                                                <th class="pt-0 min-w-20px">Pieces</th>
                                            </tr>
                                        </thead>
                                        <tbody class="fw-bold text-gray-600">
                                            <tr v-for="(detail, index) in orderDetail.detail_orders">
                                                <td>
                                                    <span class="fw-bolder">@{{ index +1 }}</span>
                                                </td>
                                                <td>
                                                    <span class="fw-bolder text-dark">@{{ detail.food?.food_menu }}</span>
                                                </td>
                                                <td>
                                                    <span class="fw-bolder text-dark">@{{ detail?.pieces }}</span>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- end::modal detail --}}

    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <div class="container-xxl" id="kt_content_container">
            <div class="card card-flush">
                <!--begin::Card header-->
                <div class="card-header align-items-center py-5 gap-2 gap-md-5">
                    <!--begin::Card title-->
                    <div class="card-title">
                        <!--begin::Search-->
                        <div class="d-flex align-items-center position-relative my-1">
                            <span class="svg-icon svg-icon-1 position-absolute ms-4">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                                    <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
                                </svg>
                            </span>
                            <input type="text" data-kt-filter="search" class="form-control form-control-solid w-250px ps-14" placeholder="Search" />
                        </div>
                        <!--end::Search-->
                    </div>
                    <div class="card-toolbar flex-row-fluid justify-content-end gap-5">
                        {{-- <a href="#" data-bs-toggle="modal" data-bs-target="#kt_modal_create" class="btn btn-primary">Create New Menu</a> --}}
                    </div>
                    <!--end::Card toolbar-->
                </div>
                <!--end::Card header-->
                <!--begin::Card body-->
                <div class="card-body pt-0">
                    <!--begin::Table-->
                    <table class="table align-middle border rounded table-row-dashed fs-6 g-5" id="kt_datatable_example_1">
                        <!--begin::Table head-->
                        <thead>
                            <tr class="text-start text-gray-400 fw-bolder fs-7 text-uppercase gs-0">
                                <th class="text-center min-w-20px">No</th>
                                <th class="text-center min-w-150px">Room - Title</th>
                                <th class="text-center min-w-70px">Participation</th>
                                <th class="text-center min-w-70px">Start</th>
                                <th class="text-center min-w-70px">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="fw-bold text-gray-600">
                            <!--begin::Table row-->
                            <tr v-for="(order, index) in order" class="text-center">
                                <td>
                                    <span class="fw-bolder ms-3">@{{ index +1 }}</span>
                                </td>
                                <td>
                                    <div>
                                        <a href="#" @click="onSelcected(order.id)" data-bs-toggle="modal" data-bs-target="#kt_modal_1" class="text-gray-800  text-hover-primary fs-5 fw-bolder" data-kt-ecommerce-product-filter="product_name">@{{ order.booking_room.room?.name }} - @{{ order.booking_room?.title }}</a>
                                    </div>
                                </td>
                                <td>
                                    <div>
                                        <span class="fw-bolder text-dark">@{{ order.booking_room.participant.length }}</span>
                                    </div>
                                </td>
                                <td>
                                    <div>
                                        <span class="fw-bolder text-dark">@{{ order.booking_room.start_date}}</span>
                                    </div>
                                </td>
                                <!--begin::Action-->
                                <td class="text-center">
                                    <a href="#" class="btn btn-sm btn-light btn-active-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                        <i class="bi bi-three-dots-vertical"></i>
                                    </a>
                                    <!--begin::Menu-->
                                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-bold fs-7 w-125px py-4" data-kt-menu="true">
                                        <div class="menu-item px-3">
                                            {{-- <a :href="'/pantry/'+food.id+'/edit'" class="menu-link px-3">Edit</a> --}}
                                        </div>
                                        <div class="menu-item px-3">
                                            <a class="menu-link px-3" @click.prevent="orderDone(order.id)">Done</a>
                                        </div>
                                    </div>
                                    <!--end::Menu-->
                                </td>
                                <!--end::Action=-->
                            </tr>
                            <!--end::Table row-->
                        </tbody>
                        <!--end::Table body-->
                    </table>
                    <!--end::Table-->
                </div>
                <!--end::Card body-->
            </div>
        </div>
    </div>
</div>
@endsection

@section('pagescript')
<script src="{{ asset('assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
<script>
    "use strict";
    // Class definition
    var KTDatatablesButtons = function() {
        // Shared variables
        var table;
        var datatable;
        // Private functions
        var initDatatable = function() {
            // Set date data order
            const tableRows = table.querySelectorAll('tbody tr');
            tableRows.forEach(row => {
                const dateRow = row.querySelectorAll('td');
                const realDate = moment(dateRow[3].innerHTML, "DD MMM YYYY, LT").format(); // select date from 4th column in table
                dateRow[3].setAttribute('data-order', realDate);
            });
            // Init datatable --- more info on datatables: https://datatables.net/manual/
            datatable = $(table).DataTable({
                "info": false,
                'order': [],
                'pageLength': 10,
            });
        }
        // Hook export buttons
        var exportButtons = () => {
            const documentTitle = 'Data Company';
            var buttons = new $.fn.dataTable.Buttons(table, {
                buttons: [{
                        extend: 'copyHtml5',
                        title: documentTitle
                    },
                    {
                        extend: 'excelHtml5',
                        title: documentTitle
                    },
                    {
                        extend: 'csvHtml5',
                        title: documentTitle
                    },
                    {
                        extend: 'pdfHtml5',
                        title: documentTitle
                    }
                ]
            }).container().appendTo($('#kt_datatable_example_1_export'));
            // Hook dropdown menu click event to datatable export buttons
            const exportButtons = document.querySelectorAll('#kt_datatable_example_1_export_menu [data-kt-export]');
            exportButtons.forEach(exportButton => {
                exportButton.addEventListener('click', e => {
                    e.preventDefault();
                    // Get clicked export value
                    const exportValue = e.target.getAttribute('data-kt-export');
                    const target = document.querySelector('.dt-buttons .buttons-' + exportValue);
                    // Trigger click event on hidden datatable export buttons
                    target.click();
                });
            });
        }
        var handleSearchDatatable = () => {
            const filterSearch = document.querySelector('[data-kt-filter="search"]');
            filterSearch.addEventListener('keyup', function(e) {
                datatable.search(e.target.value).draw();
            });
        }
        // Public methods
        return {
            init: function() {
                table = document.querySelector('#kt_datatable_example_1');
                if (!table) {
                    return;
                }
                initDatatable();
                exportButtons();
                handleSearchDatatable();
            }
        };
    }();
    // On document ready
    KTUtil.onDOMContentLoaded(function() {
        KTDatatablesButtons.init();
    });
</script>

<script>
    const order = <?php echo Illuminate\Support\Js::from($order) ?>;
    const food = <?php echo Illuminate\Support\Js::from($food) ?>;
    let app = new Vue({
        el: '#app',
        data: {
            order,
            food,
            orderDetail: [],
            loading: false,
        },
        methods: {
            onSelcected: function(id) {
                this.orderDetail = this.order.filter((item) => {
                    return item.id == id;
                })[0]
            },
            orderDone: function(id) {
                Swal.fire({
                    title: 'Yakin Ingin Menyelesaikan Pesanan?',
                    // text: 'Order Updated Successfully.',
                    icon: 'warning',
                    reverseButtons: true,
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Confirm',
                    cancelButtonText: 'Cancel',
                    showLoaderOnConfirm: true,
                    preConfirm: () => {
                        return axios.post('/pantry/' + id)
                            .then(function(response) {
                                console.log(response.data);
                            })
                            .catch(function(error) {
                                console.log(error.data);
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Oops',
                                    text: 'Something wrong',
                                })
                            });
                    },
                    allowOutsideClick: () => !Swal.isLoading()
                }).then((result) => {
                    if (result.isConfirmed) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: 'Pesanan sudah dikonfirmasi',
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.reload();
                            }
                        });
                    }
                });
            },
        },
    });
</script>
@endsection