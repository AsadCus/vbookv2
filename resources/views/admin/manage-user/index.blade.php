@extends('layouts.app')

@section('title', 'Dashboard | Manage User')

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
                        <h5 class="modal-title">Edit User</h5>

                        <!--begin::Close-->
                        <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                            <span class="svg-icon svg-icon-2x"></span>
                        </div>
                        <!--end::Close-->
                    </div>

                    <div class="modal-body">



                        <div class="row g-3 align-items-center mb-4">
                            <div class="col-sm-3">
                                <label for="" class="form-label form-label-sm">Nama</label>
                            </div>

                            <div class="col-sm-9">
                                <input type="text" v-model="userDetail.name" class="form-control mb-2" placeholder="Nama" />
                            </div>
                        </div>

                        <div class="row g-3 align-items-center mb-4">
                            <div class="col-sm-3">
                                <label for="" class="form-label form-label-sm">Email</label>
                            </div>

                            <div class="col-sm-9">
                                <input type="text" v-model="userDetail.email" class="form-control mb-2" placeholder="Email" />
                            </div>
                        </div>


                        <div class="row g-3 align-items-center mb-4">
                            <div class="col-sm-3">
                                <label for="" class="form-label form-label-sm">No Hp</label>
                            </div>

                            <div class="col-sm-9">
                                <input type="text" v-model="userDetail.no_telp" class="form-control mb-2" placeholder="no hp" />
                            </div>
                        </div>


                    </div>

                    <div class="modal-footer">
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </div>


    <div class="modal fade" tabindex="-1" id="kt_modal_1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form @submit.prevent="submitForm" enctype="multipart/form-data">
                    <div class="modal-header">
                        <h5 class="modal-title">Detail User</h5>

                        <!--begin::Close-->
                        <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                            <span class="svg-icon svg-icon-2x"></span>
                        </div>
                        <!--end::Close-->
                    </div>

                    <div class="modal-body">



                        <div class="row g-3 align-items-center mb-4">
                            <div class="col-sm-3">
                                <label for="" class="form-label form-label-sm">Name</label>
                            </div>

                            <div class="col-sm-9">
                                <span class="fw-bolder text-dark">: &nbsp; @{{ userDetail.name }}</span>
                            </div>
                        </div>

                        <div class="row g-3 align-items-center mb-4">
                            <div class="col-sm-3">
                                <label for="" class="form-label form-label-sm">Division</label>
                            </div>

                            <div class="col-sm-9">
                                <span class="fw-bolder text-dark">: &nbsp; @{{ userDetail.division?.name }}</span>
                            </div>
                        </div>

                        <div class="row g-3 align-items-center mb-4">
                            <div class="col-sm-3">
                                <label for="" class="form-label form-label-sm">Email</label>
                            </div>

                            <div class="col-sm-9">
                                <span class="fw-bolder text-dark">: &nbsp; @{{ userDetail.email }}</span>
                            </div>
                        </div>



                        <div class="row g-3 align-items-center mb-4">
                            <div class="col-sm-3">
                                <label for="" class="form-label form-label-sm">No Hp</label>
                            </div>

                            <div class="col-sm-9">
                                <span class="fw-bolder text-dark">: &nbsp; @{{ userDetail.no_telp }}</span>
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


    <!-- Modal -->
    <div class="modal fade" id="templateExport" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Download Template Import</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-4">
                        <select name="" class="form-select" id="" v-model="divisionId">
                            <option v-for="divisions in divisionSelect" :value="divisions.id">@{{ divisions.name }}</option>
                        </select>
                    </div>
                    <div class="mb-4">
                        <small>Select Division For Download Template</small>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <a :href="'/admin/manage-user/template?division=' + divisionId" type="button" class="btn btn-primary">Download Template</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="uploadFileExcel" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Upload File User Excel</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="post" action="/admin/manage-user/upload-user" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="modal-body">
                        <input type="file" class="form-control" name="file" required="required">
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Upload</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <div class="container-xxl" id="kt_content_container">

            @if (\Session::has('success'))
            <div class="alert alert-dismissible bg-primary d-flex flex-column flex-sm-row p-5 mb-10">
                <div class="d-flex flex-column pe-0 pe-sm-10">
                    <h4 class="fw-semibold text-white">{!! \Session::get('success') !!}</h4>
                </div>
                <button type="button" class="position-absolute position-sm-relative m-2 m-sm-0 top-0 end-0 btn btn-icon ms-sm-auto" data-bs-dismiss="alert">
                    <span class="svg-icon svg-icon-1 svg-icon-white">X</span>
                </button>
            </div>
            @endif


            <div class="alert alert-dismissible bg-light-primary border border-primary d-flex flex-column flex-sm-row p-5 mb-10">
                <span class="svg-icon svg-icon-2hx svg-icon-primary me-4 mb-5 mb-sm-0">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-fill-up" viewBox="0 0 16 16">
                        <path d="M12.5 16a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7Zm.354-5.854 1.5 1.5a.5.5 0 0 1-.708.708L13 11.707V14.5a.5.5 0 0 1-1 0v-2.793l-.646.647a.5.5 0 0 1-.708-.708l1.5-1.5a.5.5 0 0 1 .708 0ZM11 5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                        <path d="M2 13c0 1 1 1 1 1h5.256A4.493 4.493 0 0 1 8 12.5a4.49 4.49 0 0 1 1.544-3.393C9.077 9.038 8.564 9 8 9c-5 0-6 3-6 4Z" />
                    </svg>
                </span>
                <div class="d-flex flex-column pe-0 pe-sm-10">
                    <h5 class="mb-1">Import Excel User</h5>
                    <span>The alert component can be used to highlight certain parts of your page for higher content visibility.
                        <br>
                        <br>
                        <div class="text-start">
                            <button class="btn btn-success me-2" data-bs-toggle="modal" data-bs-target="#templateExport">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-earmark-excel" viewBox="0 0 16 16">
                                    <path d="M5.884 6.68a.5.5 0 1 0-.768.64L7.349 10l-2.233 2.68a.5.5 0 0 0 .768.64L8 10.781l2.116 2.54a.5.5 0 0 0 .768-.641L8.651 10l2.233-2.68a.5.5 0 0 0-.768-.64L8 9.219l-2.116-2.54z" />
                                    <path d="M14 14V4.5L9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2zM9.5 3A1.5 1.5 0 0 0 11 4.5h2V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h5.5v2z" />
                                </svg>
                                Template Impor Excel
                            </button>

                            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#uploadFileExcel">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-earmark-arrow-up" viewBox="0 0 16 16">
                                    <path d="M8.5 11.5a.5.5 0 0 1-1 0V7.707L6.354 8.854a.5.5 0 1 1-.708-.708l2-2a.5.5 0 0 1 .708 0l2 2a.5.5 0 0 1-.708.708L8.5 7.707V11.5z" />
                                    <path d="M14 14V4.5L9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2zM9.5 3A1.5 1.5 0 0 0 11 4.5h2V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h5.5v2z" />
                                </svg>
                                Impor Excel
                            </button>
                        </div>


                    </span>
                </div>

            </div>


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

                        <a href="/admin/manage-user/create" class="btn btn-primary">Create User</a>
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
                                <th class="text-center min-w-100px">Name</th>
                                <th class="text-center min-w-100px">Email</th>
                                <th class="text-center min-w-100px">Role</th>
                                <th class="text-center min-w-70px">Actions</th>
                            </tr>
                            <!--end::Table row-->
                        </thead>
                        <tbody class="fw-bold text-gray-600">
                            <!--begin::Table row-->
                            <tr v-for="(users, index) in user">

                                <td class="text-center">
                                    <span class="fw-bolder ms-3">@{{ index +1 }}</span>
                                </td>


                                <td>
                                    <div class="d-flex align-items-center">

                                        <div class="ms-5">
                                            <!--begin::Title-->
                                            <a href="#" @click="onSelcected(users.id)" data-bs-toggle="modal" data-bs-target="#kt_modal_1" class="text-gray-800 text-hover-primary fs-5 fw-bolder" data-kt-ecommerce-product-filter="product_name">@{{ users.name }}</a>
                                            <!--end::Title-->
                                        </div>
                                    </div>
                                </td>
                                <td class="text-center">
                                    <span class="fw-bolder ms-3">@{{ users.email }}</span>
                                </td>


                                <!--begin::Status=-->
                                <td class="text-center">
                                    <!--begin::Badges-->
                                    <div class="badge badge-light-primary" v-if="users.role_id == 1">Super Admin</div>
                                    <div class="badge badge-light-primary" v-if="users.role_id == 2">Admin</div>
                                    <div class="badge badge-light-primary" v-if="users.role_id == 3">User</div>
                                    <div class="badge badge-light-primary" v-if="users.role_id == 4">Room</div>
                                    <div class="badge badge-light-primary" v-if="users.role_id == 7">Pantry</div>

                                    <!--end::Badges-->
                                </td>
                                <td class="text-center">
                                    <a href="#" class="btn btn-sm btn-light btn-active-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                        <i class="bi bi-three-dots-vertical"></i>
                                    </a>
                                    <!--begin::Menu-->
                                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-bold fs-7 w-125px py-4" data-kt-menu="true">
                                        <!--begin::Menu item-->
                                        <div class="menu-item px-3">
                                            <a href="#" @click="onSelcected(users.id)" data-bs-toggle="modal" data-bs-target="#kt_modal_edit" class="menu-link px-3" v-if="users.role_id == 3 || users.role_id == 4">Edit</a>
                                            <span v-if="users.role_id == 1 || users.role_id == 2">Tidak Bisa Action Di role ini</span>

                                        </div>
                                        <!--end::Menu item-->
                                        <!--begin::Menu item-->
                                        <div class="menu-item px-3">
                                            <a href="#" class="menu-link px-3" data-kt-ecommerce-product-filter="delete_row" @click.prevent="deleteRecord(users.id)" v-if="users.role_id == 3 || users.role_id == 4">Delete</a>
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
            const documentTitle = 'Data Lowongan Kerja';
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
    const user = <?php echo Illuminate\Support\Js::from($user) ?>;
    const divisionSelect = <?php echo Illuminate\Support\Js::from($divisionSelect) ?>;
    let app = new Vue({
        el: '#app',
        data: {
            divisionSelect,
            user,
            divisionId: '',
            userDetail: [],

            loading: false,
        },
        computed: {
            generatedURL() {
                let url = [];
                if (this.divisionId) {
                    url.push('division=' + this.divisionId);
                }

                return url.join('&');
            }
        },
        methods: {
            onSelcected: function(id) {
                this.userDetail = this.user.filter((item) => {
                    return item.id == id;
                })[0]

            },
            submitFormEdit: function() {
                this.sendData();
            },

            submitFormUpload: function() {
                this.sendData();
            },
            sendData: function() {
                let vm = this;
                vm.loading = true;
                axios.post('/admin/manage-user/' + this.userDetail['id'] + '/edit', {
                        name: this.userDetail['name'],
                        email: this.userDetail['email'],
                        role_id: this.userDetail['role_id'],
                        no_telp: this.userDetail['no_telp'],
                    })
                    .then(function(response) {
                        vm.loading = false;
                        Swal.fire({
                            title: 'Berhasil',
                            text: 'User berhasil di update.',
                            icon: 'success',
                            allowOutsideClick: false,
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.href = '/admin/manage-user';
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
                        return axios.delete('/admin/manage-user/' + id)
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
                            text: 'User Berhasil Dihapus',
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