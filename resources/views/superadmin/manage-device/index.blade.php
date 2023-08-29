@extends('layouts.app')

@section('title', 'Dashboard | Manage Device')

@section('prehead')
<link href="{{ asset('assets/plugins/custom/fullcalendar/fullcalendar.bundle.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css" />
@endsection

@inject('carbon', 'Carbon\Carbon')
@inject('carbonInterval', 'Carbon\CarbonInterval')

@section('content')
<div id="app" v-cloak>



    <div class="modal fade" tabindex="-1" id="kt_modal_edit">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form @submit.prevent="submitFormEdit" enctype="multipart/form-data">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Device</h5>

                        <!--begin::Close-->
                        <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                            <span class="svg-icon svg-icon-2x"></span>
                        </div>
                        <!--end::Close-->
                    </div>

                    <div class="modal-body">


                        <div class="row g-3 align-items-center mb-4">
                            <div class="col-sm-3">
                                <label for="" class="form-label form-label-sm">Device Name </label>
                            </div>

                            <div class="col-sm-9">
                                <input type="text" v-model="deviceDetail.name" class="form-control mb-2" placeholder="Device Name" />
                            </div>
                        </div>

                        <div class="row g-3 align-items-center mb-4">

                            <div class="col-sm-3">
                                <label for="" class="form-label form-label-sm">Type Device </label>
                            </div>

                            <div class="col-sm-9">
                                <select class="form-control" name="" id="" v-model="deviceDetail.type_device">
                                    <option value="">- SELECT TYPE -</option>
                                    <option value="PRO">PRO</option>
                                    <option value="NON-PRO">NON-PRO</option>
                                    <option value="SLIM">SLIM</option>
                                    <option value="SAMSUNG">SAMSUNG</option>
                                </select>

                            </div>
                        </div>

                        <div class="row g-3 align-items-center mb-4">

                            <div class="col-sm-3">
                                <label for="" class="form-label form-label-sm">Use Camera ? </label>
                            </div>

                            <div class="col-sm-9">
                                <select class="form-control" name="" id="" v-model="deviceDetail.use_came">
                                    <option value="">- SELECT TYPE -</option>
                                    <option value="YES">YES</option>
                                    <option value="NO">NO</option>
                                </select>

                            </div>
                        </div>

                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <div class="modal fade" tabindex="-1" id="kt_modal_detail">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form @submit.prevent="submitFormEdit" enctype="multipart/form-data">
                    <div class="modal-header">
                        <h5 class="modal-title">Detail Device</h5>

                        <!--begin::Close-->
                        <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                            <span class="svg-icon svg-icon-2x"></span>
                        </div>
                        <!--end::Close-->
                    </div>

                    <div class="modal-body">


                        <div class="row g-3 align-items-center mb-4">
                            <div class="col-sm-3">
                                <label for="" class="form-label form-label-sm">Device Name </label>
                            </div>

                            <div class="col-sm-9">
                                <input type="text" v-model="deviceDetail.name" class="form-control mb-2" placeholder="Device Name" disabled>
                            </div>
                        </div>

                        <div class="row g-3 align-items-center mb-4">

                            <div class="col-sm-3">
                                <label for="" class="form-label form-label-sm">Type Device </label>
                            </div>

                            <div class="col-sm-9">
                                <select class="form-control" name="" id="" v-model="deviceDetail.type_device" disabled>
                                    <option value="">- SELECT TYPE -</option>
                                    <option value="PRO">PRO</option>
                                    <option value="NON-PRO">NON-PRO</option>
                                    <option value="SLIM">SLIM</option>
                                    <option value="SAMSUNG">SAMSUNG</option>
                                </select>

                            </div>
                        </div>

                        <div class="row g-3 align-items-center mb-4">

                            <div class="col-sm-3">
                                <label for="" class="form-label form-label-sm">Use Camera ? </label>
                            </div>

                            <div class="col-sm-9">
                                <select class="form-control" name="" id="" v-model="deviceDetail.use_came" disabled>
                                    <option value="">- SELECT TYPE -</option>
                                    <option value="YES">YES</option>
                                    <option value="NO">NO</option>
                                </select>

                            </div>
                        </div>

                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" tabindex="-1" id="kt_modal_create">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form @submit.prevent="submitForm" enctype="multipart/form-data">
                    <div class="modal-header">
                        <h5 class="modal-title">Create Device</h5>

                        <!--begin::Close-->
                        <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                            <span class="svg-icon svg-icon-2x"></span>
                        </div>
                        <!--end::Close-->
                    </div>

                    <div class="modal-body">


                        <div class="row g-3 align-items-center mb-4">
                            <div class="col-sm-3">
                                <label for="" class="form-label form-label-sm">Device Name </label>
                            </div>

                            <div class="col-sm-9">
                                <input type="text" v-model="name" class="form-control mb-2" placeholder="Device Name" />
                            </div>
                        </div>

                        <div class="row g-3 align-items-center mb-4">

                            <div class="col-sm-3">
                                <label for="" class="form-label form-label-sm">Type Device </label>
                            </div>

                            <div class="col-sm-9">
                                <select class="form-control" name="" id="" v-model="typeDevice">
                                    <option value="">- SELECT TYPE -</option>
                                    <option value="PRO">PRO</option>
                                    <option value="NON-PRO">NON-PRO</option>
                                    <option value="SLIM">SLIM</option>
                                    <option value="SAMSUNG">SAMSUNG</option>
                                </select>

                            </div>
                        </div>

                        <div class="row g-3 align-items-center mb-4">

                            <div class="col-sm-3">
                                <label for="" class="form-label form-label-sm">Use Camera ? </label>
                            </div>

                            <div class="col-sm-9">
                                <select class="form-control" name="" id="" v-model="useCame">
                                    <option value="">- SELECT -</option>
                                    <option value="YES">YES</option>
                                    <option value="NO">NO</option>
                                </select>

                            </div>
                        </div>

                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


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
                            <input type="text" data-kt-filter="search" class="form-control form-control-solid w-250px ps-14" placeholder="Cari" />
                        </div>
                        <!--end::Search-->
                    </div>

                    <div class="card-toolbar flex-row-fluid justify-content-end gap-5">

                        <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#kt_modal_create">Create Device</a>
                        <!--end::Add product-->
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
                            <!--begin::Table row-->
                            <tr class="text-start text-gray-400 fw-bolder fs-7 text-uppercase gs-0">
                                <th class="text-center min-w-20px">No</th>
                                <th class="text-center min-w-100px">Device</th>
                                <th class="text-center min-w-100px">Type Device</th>
                                <th class="text-center min-w-100px">Camera</th>
                                <th class="text-center min-w-70px">Actions</th>
                            </tr>
                            <!--end::Table row-->
                        </thead>
                        <tbody class="fw-bold text-gray-600">
                            <!--begin::Table row-->
                            <tr v-for="(devices, index) in device">


                                <td class="text-center pe-0">
                                    <span class="fw-bolder text-dark">@{{ index + 1 }}</span>
                                </td>



                                <td class="text-center pe-0">
                                    <span class="fw-bolder text-dark" @click="onSelcected(devices.id)" data-bs-toggle="modal" data-bs-target="#kt_modal_detail">@{{ devices.name }}</span>
                                </td>

                                <td class="text-center pe-0">
                                    <span class="fw-bolder text-dark">@{{ devices.type_device }}</span>
                                </td>

                                <td class="text-center pe-0">
                                    <span class="fw-bolder text-dark">@{{ devices.use_came }}</span>
                                </td>


                                <!--begin::Action=-->
                                <td class="text-center">
                                    <a href="#" class="btn btn-sm btn-secondary btn-active-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                        <i class="bi bi-three-dots-vertical"></i>
                                    </a>
                                    <!--begin::Menu-->
                                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-bold fs-7 w-125px py-4" data-kt-menu="true">
                                        <!--begin::Menu item-->
                                        <div class="menu-item px-3">
                                            <a href="#" @click="onSelcected(devices.id)" data-bs-toggle="modal" data-bs-target="#kt_modal_edit" class="menu-link px-3">Edit</a>
                                        </div>
                                        <!--end::Menu item-->
                                        <!--begin::Menu item-->
                                        <div class="menu-item px-3">
                                            <a href="#" class="menu-link px-3" @click.prevent="deleteRecord(devices.id)">Delete</a>
                                        </div>
                                        <!--end::Menu item-->
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
@section('script')
<script src="{{ asset('assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
@endsection

@section('pagescript')

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
            const documentTitle = 'Data Device';
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
    const device = <?php echo Illuminate\Support\Js::from($devices) ?>;
    let app = new Vue({
        el: '#app',
        data: {
            device,
            name: '',
            typeDevice: '',
            useCame: '',
            deviceDetail: [],

            loading: false,
        },
        methods: {
            onSelcected: function(id) {
                this.deviceDetail = this.device.filter((item) => {
                    return item.id == id;
                })[0]

            },
            submitForm: function() {
                if (this.name == '') {
                    Swal.fire(
                        'Warning !',
                        'Device Name cannot be empty .',
                        'warning'
                    )
                } else if (this.typeDevice == []) {
                    Swal.fire(
                        'Warning !',
                        'Type Device cannot be empty .',
                        'warning'
                    )
                } else if (this.useCame == '') {
                    Swal.fire(
                        'Warning !',
                        'Use Came cannot be empty .',
                        'warning'
                    )

                } else {
                    this.sendData();
                }
            },
            submitFormEdit: function() {
                this.sendDataEdit();
            },
            sendData: function() {
                let vm = this;
                vm.loading = true;
                axios.post('/suadmin/device', {
                        name: this.name,
                        type_device: this.typeDevice,
                        use_came: this.useCame,

                    })
                    .then(function(response) {
                        vm.loading = false;
                        Swal.fire({
                            title: 'Berhasil',
                            text: 'Device berhasil Disimpan.',
                            icon: 'success',
                            allowOutsideClick: false,
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.href = '/suadmin/device';
                            }
                        })
                        // console.log(response);
                    })
                    .catch(function(error) {
                        vm.loading = false;
                        console.log(error);
                        Swal.fire(
                            'Terjadi Kesalahan!',
                            'Pastikan data terisi dengan benar.',
                            'error'
                        )
                    });
            },
            sendDataEdit: function() {
                let vm = this;
                vm.loading = true;
                axios.post('/suadmin/device/' + this.deviceDetail['id'] + '/edit', {
                        name: this.deviceDetail['name'],
                        type_device: this.deviceDetail['type_device'],
                        use_came: this.deviceDetail['use_came'],

                    })
                    .then(function(response) {
                        vm.loading = false;
                        Swal.fire({
                            title: 'Berhasil',
                            text: 'Device berhasil diupdate.',
                            icon: 'success',
                            allowOutsideClick: false,
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.href = '/suadmin/device';
                            }
                        })
                        // console.log(response);
                    })
                    .catch(function(error) {
                        vm.loading = false;
                        console.log(error);
                        Swal.fire({
                            title: 'Gagal Menyimpan',
                            error: true,
                            icon: 'error',
                            text: error.response.data.message,
                        })
                    });
            },
            deleteRecord: function(id) {
                Swal.fire({
                    title: 'Yakin Ingin Menghapus data?',
                    text: "data akan di hapus di system",
                    icon: 'warning',
                    reverseButtons: true,
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Delete',
                    cancelButtonText: 'Cancel',
                    showLoaderOnConfirm: true,
                    preConfirm: () => {
                        return axios.delete('/suadmin/device/' + id)
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
                            text: 'Device Berhasil Dihapus',
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.reload();
                            }
                        })
                    }
                })
            },


        }
    })
</script>
@endsection