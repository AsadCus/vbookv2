@extends('layouts.app')

@section('title', 'Dashboard | Report Booking')

@section('prehead')
    <link href="{{ asset('assets/plugins/custom/fullcalendar/fullcalendar.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css" />
@endsection

@inject('carbon', 'Carbon\Carbon')
@inject('carbonInterval', 'Carbon\CarbonInterval')

@section('content')
    <div id="app" v-cloak>


        <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
            <div class="container-xxl" id="kt_content_container">
                <div class="card card-flush">
                    <!--begin::Card header-->
                    <h3 class="container py-4">Report Booking Room</h3>
                    <div class="card-header align-items-center py-5 gap-2 gap-md-5">
                        <!--begin::Card title-->

                        <div class="card-title">
                            <!--begin::Search-->

                            <div class="d-flex align-items-center position-relative my-1">
                                <span class="svg-icon svg-icon-1 position-absolute ms-4">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                                        <path
                                            d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
                                    </svg>
                                </span>
                                <input type="text" data-kt-filter="search"
                                    class="form-control form-control-solid w-250px ps-14" placeholder="Search" />
                            </div>


                            <!--end::Search-->
                        </div>




                        <div class="col-12 mb-7">
                            <div class="card shadow-sm">
                                <div class="card-body">
                                    <form @submit.prevent="submitFilter">
                                        <div class="row ">
                                            <div class="col-4">
                                                <label for="" class="form-label">Start Date</label>
                                                <input type="date" v-model="startDate"
                                                    class="form-control form-control-sm">
                                            </div>

                                            <div class="col-4">
                                                <label for="" class="form-label">Status</label>
                                                <select class="form-control form-control-sm"
                                                    aria-label="Default select example" v-model="status">
                                                    <option value=""></option>
                                                    <option value="finished">Selesai</option>
                                                    <option value="waiting">Menunggu</option>
                                                    <option value="ongoing">Sedang Berlangsung</option>
                                                </select>
                                            </div>
                                            <div class="col-4">
                                                <label for="" class="form-label">Room</label>
                                                <select class="form-control form-control-sm"
                                                    aria-label="Default select example" v-model="room">
                                                    <option value=""></option>
                                                    <option v-for="roomSelects in roomSelect" :value="roomSelects.id">
                                                        @{{ roomSelects.name }}</option>
                                                </select>
                                            </div>
                                            <div class="text-end">
                                                <br>
                                                <button type="submit" class="btn btn-sm btn-primary">Filter<i
                                                        class="fa fa-filter"></i></button>

                                                <a :href="'/admin/report/excel?room={{ $room }} & start_date={{ $start_date }} & status={{ $status }}'"
                                                    class="btn btn-sm btn-primary">
                                                    Export Data
                                                </a>


                                                <!--
                                                <a href="#" class="btn btn-sm btn-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                                    Export Data
                                                </a>
                                                <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-bold fs-7 w-125px py-4" data-kt-menu="true">
                                                    <div class="menu-item px-3">
                                                        <a :href="'/admin/report/excel?room={{ $room }} & start_date={{ $start_date }} & status={{ $status }}'" class="menu-link px-3"> Excel &nbsp; &nbsp; <i class="bi bi-file-earmark-excel"></i></a>
                                                    </div>
                                                    <hr class="hr">
                                                    <div class="menu-item px-3">
                                                        <a href="#" class="menu-link px-3"> PDF &nbsp; &nbsp; <i class="bi bi-file-earmark-pdf"></i></a>
                                                    </div>

                                                </div> -->
                                            </div>



                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <!-- <div class="card-toolbar flex-row-fluid justify-content-end gap-5">

                            <a href="/admin/manage-user/create" class="btn btn-primary">Tambah User</a>

                        </div> -->
                        <!--end::Card toolbar-->
                    </div>

                    <!--end::Card header-->
                    <!--begin::Card body-->
                    <div class="card-body pt-0">

                        <!--begin::Table-->

                        <table class="table align-middle border rounded table-row-dashed fs-6 g-5"
                            id="kt_datatable_example_1">
                            <!--begin::Table head-->
                            <thead>
                                <!--begin::Table row-->
                                <tr class="text-center text-gray-400 fw-bolder fs-7 text-uppercase gs-0">

                                    <th class="text-center min-w-100px">Meeting Name</th>
                                    <th class="text-center min-w-100px">Organizer</th>
                                    <th class="text-center min-w-100px">Participant</th>
                                    <th class="text-center min-w-100px">Start Date</th>
                                    <th class="text-center min-w-100px">End Date</th>
                                    <th class="text-center min-w-100px">Room Name</th>
                                    <th class="text-center min-w-100px">Department</th>
                                    <th class="text-center min-w-70px">Status</th>
                                </tr>
                                <!--end::Table row-->
                            </thead>
                            <tbody class="fw-bold text-gray-600">
                                <!--begin::Table row-->
                                @foreach ($booking_rooms as $booking_room)
                                    <tr>

                                        <td class="text-center">
                                            <span class="fw-bolder">{{ $booking_room->title }}</span>
                                        </td>
                                        <td class="text-center">
                                            <span class="fw-bolder">{{ $booking_room->user->name }}</span>
                                        </td>

                                        <td class="text-start">
                                            @foreach ($booking_room->participant as $participant)
                                                <span class="fw-bolder">({{ $participant->email }} -
                                                    @if ($participant->participant_confirmation == 1)
                                                        <span class="badge badge-warning"> Belum Konfirmasi</span>
                                                    @elseif ($participant->participant_confirmation == 2)
                                                        <span class="badge badge-primary">Hadir</span>
                                                    @else
                                                        <span class="badge badge-danger"> Tidak Hadir</span>
                                                    @endif) <br>
                                                </span>
                                            @endforeach
                                        </td>

                                        <td class="text-center">
                                            <span class="fw-bolder">{{ $booking_room->start_date }}</span>
                                        </td>
                                        <td class="text-center">
                                            <span class="fw-bolder">{{ $booking_room->end_date }}</span>
                                        </td>
                                        <td class="text-center">
                                            <span class="fw-bolder">{{ $booking_room->room->name ?? 'removed*' }}</span>
                                        </td>
                                        <td class="text-center">
                                            <span class="fw-bolder">{{ $booking_room->department }}</span>
                                        </td>

                                        <td class="text-center">
                                            @if ($booking_room->status_booking == 'finished')
                                                <span
                                                    class="badge badge-light-danger">{{ $booking_room->status_booking }}</span>
                                            @elseif($booking_room->status_booking == 'ongoing')
                                                <span
                                                    class="badge badge-light-success">{{ $booking_room->status_booking }}</span>
                                            @else
                                                <span
                                                    class="badge badge-light-primary">{{ $booking_room->status_booking }}</span>
                                            @endif

                                        </td>

                                    </tr>
                                @endforeach
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

    <table class="table align-middle border rounded table-row-dashed fs-6 g-5" id="kt_datatable_example_1">

        <script>
            const roomSelect = <?php echo Illuminate\Support\Js::from($roomSelect); ?>;
            let app = new Vue({
                el: '#app',

                data: {
                    roomSelect,
                    startDate: '{{ $start_date }}',
                    status: '{{ $status }}',
                    room: '{{ $room }}',
                    loading: false,
                },
                computed: {
                    generatedURL() {
                        let url = [];
                        if (this.startDate) {
                            url.push('start_date=' + this.startDate);
                        }

                        if (this.status) {
                            url.push('status=' + this.status);
                        }

                        if (this.room) {
                            url.push('room=' + this.room);
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
                    submitFilter: function() {
                        // console.log(this.sort_by)
                        window.location.href = `/admin/report/?` + this.generatedURL;
                        // window.location.href = `/admin/report?start_date=${this.start_date}&room=${this.room}&status=${this.status}`;
                    },
                    submitFormEdit: function() {
                        this.sendData();
                    },
                    sendData: function() {
                        let vm = this;
                        vm.loading = true;
                        axios.post('/admin/report/excel', {
                                start_date: this.startDate,
                                status: this.status,
                                room: this.room,
                            })
                            .then(function(response) {
                                vm.loading = false;
                                Swal.fire({
                                    title: 'Berhasil',
                                    text: 'Berhasil Mendownload Excel.',
                                    icon: 'success',
                                    allowOutsideClick: false,
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        // window.location.href = '/admin/report';
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
                        const realDate = moment(dateRow[3].innerHTML, "DD MMM YYYY, LT")
                    .format(); // select date from 4th column in table
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
                    const exportButtons = document.querySelectorAll(
                        '#kt_datatable_example_1_export_menu [data-kt-export]');
                    exportButtons.forEach(exportButton => {
                        exportButton.addEventListener('click', e => {
                            e.preventDefault();

                            // Get clicked export value
                            const exportValue = e.target.getAttribute('data-kt-export');
                            const target = document.querySelector('.dt-buttons .buttons-' +
                            exportValue);

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
    @endsection
