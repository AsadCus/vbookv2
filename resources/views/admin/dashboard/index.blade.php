@extends('layouts.app')

@section('title', auth()->user()->company->aplication_name)

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
                <!--begin::Row-->
                @if (auth()->user()->role_id == 2)
                    <div class="row g-5 g-xl-10">
                        <!--begin::Col-->
                        <div class="col-xl-12 mb-xl-10">
                            <!--begin::Lists Widget 19-->
                            <div class="card card-flush h-xl-100">
                                <!--begin::Heading-->
                                <div class="card-header rounded bgi-no-repeat bgi-size-cover bgi-position-y-top bgi-position-x-center align-items-start h-250px"
                                    {{-- style="background-image:url('assets/media/svg/shapes/top-green.png') --}} style="background-color:#2F4F4F">
                                    <!--begin::Title-->
                                    <h3 class="card-title align-items-start flex-column text-white pt-15">
                                        <span class="fw-bolder fs-2x mb-3">Hello, {{ auth()->user()->name }}</span>
                                        <div class="fs-4 text-white">
                                            <span class="opacity-75">Welcome to the admin dashboard
                                                {{ auth()->user()->company->aplication_name }}</span>
                                            <span class="position-relative d-inline-block">
                                        </div>
                                    </h3>
                                    <!--end::Title-->
                                    <!--begin::Toolbar-->
                                    <div class="card-toolbar pt-5">

                                    </div>
                                    <!--end::Toolbar-->
                                </div>
                                <!--end::Heading-->
                                <!--begin::Body-->
                                <div class="card-body mt-n20">
                                    <!--begin::Stats-->
                                    <div class="mt-n20 position-relative">
                                        <!--begin::Row-->
                                        <div class="row g-3 g-lg-6">
                                            <!--begin::Col-->
                                            <div class="col-6">
                                                <!--begin::Items-->
                                                <div class="bg-gray-100 bg-opacity-70 rounded-2 px-6 py-5">
                                                    <!--begin::Symbol-->
                                                    <div class="symbol symbol-30px me-5 mb-8">
                                                        <span class="symbol-label">
                                                            <!--begin::Svg Icon | path: icons/duotune/medicine/med005.svg-->
                                                            <span class="svg-icon svg-icon-1 svg-icon-primary">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                                    height="16" fill="currentColor"
                                                                    class="bi bi-people-fill" viewBox="0 0 16 16">
                                                                    <path
                                                                        d="M7 14s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1H7Zm4-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6Zm-5.784 6A2.238 2.238 0 0 1 5 13c0-1.355.68-2.75 1.936-3.72A6.325 6.325 0 0 0 5 9c-4 0-5 3-5 4s1 1 1 1h4.216ZM4.5 8a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5Z" />
                                                                </svg>
                                                            </span>
                                                            <!--end::Svg Icon-->
                                                        </span>
                                                    </div>
                                                    <!--end::Symbol-->
                                                    <!--begin::Stats-->
                                                    <div class="m-0">
                                                        <!--begin::Number-->
                                                        <span
                                                            class="text-gray-700 fw-boldest d-block fs-2qx lh-1 ls-n1 mb-1">{{ $count_user }}</span>
                                                        <!--end::Number-->
                                                        <!--begin::Desc-->
                                                        <span class="text-gray-500 fw-bold fs-6">User</span>
                                                        <!--end::Desc-->
                                                    </div>
                                                    <!--end::Stats-->
                                                </div>
                                                <!--end::Items-->
                                            </div>
                                            <!--end::Col-->
                                            <!--begin::Col-->
                                            <div class="col-6">
                                                <!--begin::Items-->
                                                <div class="bg-gray-100 bg-opacity-70 rounded-2 px-6 py-5">
                                                    <!--begin::Symbol-->
                                                    <div class="symbol symbol-30px me-5 mb-8">
                                                        <span class="symbol-label">
                                                            <!--begin::Svg Icon | path: icons/duotune/finance/fin001.svg-->
                                                            <span class="svg-icon svg-icon-1 svg-icon-primary">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                    height="24" viewBox="0 0 24 24" fill="none">
                                                                    <path
                                                                        d="M20 19.725V18.725C20 18.125 19.6 17.725 19 17.725H5C4.4 17.725 4 18.125 4 18.725V19.725H3C2.4 19.725 2 20.125 2 20.725V21.725H22V20.725C22 20.125 21.6 19.725 21 19.725H20Z"
                                                                        fill="currentColor" />
                                                                    <path opacity="0.3"
                                                                        d="M22 6.725V7.725C22 8.325 21.6 8.725 21 8.725H18C18.6 8.725 19 9.125 19 9.725C19 10.325 18.6 10.725 18 10.725V15.725C18.6 15.725 19 16.125 19 16.725V17.725H15V16.725C15 16.125 15.4 15.725 16 15.725V10.725C15.4 10.725 15 10.325 15 9.725C15 9.125 15.4 8.725 16 8.725H13C13.6 8.725 14 9.125 14 9.725C14 10.325 13.6 10.725 13 10.725V15.725C13.6 15.725 14 16.125 14 16.725V17.725H10V16.725C10 16.125 10.4 15.725 11 15.725V10.725C10.4 10.725 10 10.325 10 9.725C10 9.125 10.4 8.725 11 8.725H8C8.6 8.725 9 9.125 9 9.725C9 10.325 8.6 10.725 8 10.725V15.725C8.6 15.725 9 16.125 9 16.725V17.725H5V16.725C5 16.125 5.4 15.725 6 15.725V10.725C5.4 10.725 5 10.325 5 9.725C5 9.125 5.4 8.725 6 8.725H3C2.4 8.725 2 8.325 2 7.725V6.725L11 2.225C11.6 1.925 12.4 1.925 13.1 2.225L22 6.725ZM12 3.725C11.2 3.725 10.5 4.425 10.5 5.225C10.5 6.025 11.2 6.725 12 6.725C12.8 6.725 13.5 6.025 13.5 5.225C13.5 4.425 12.8 3.725 12 3.725Z"
                                                                        fill="currentColor" />
                                                                </svg>
                                                            </span>
                                                            <!--end::Svg Icon-->
                                                        </span>
                                                    </div>
                                                    <!--end::Symbol-->
                                                    <!--begin::Stats-->
                                                    <div class="m-0">
                                                        <!--begin::Number-->
                                                        <span
                                                            class="text-gray-700 fw-boldest d-block fs-2qx lh-1 ls-n1 mb-1">{{ $count_room }}</span>
                                                        <!--end::Number-->
                                                        <!--begin::Desc-->
                                                        <span class="text-gray-500 fw-bold fs-6">Room</span>
                                                        <!--end::Desc-->
                                                    </div>
                                                    <!--end::Stats-->
                                                </div>
                                                <!--end::Items-->
                                            </div>
                                        </div>
                                        <!--end::Row-->
                                    </div>
                                    <!--end::Stats-->
                                </div>
                                <!--end::Body-->
                            </div>
                            <!--end::Lists Widget 19-->
                        </div>
                        <!--end::Col-->
                    </div>
                    <div class="row gx-5 gx-xl-10">
                        <div class="col-xxl-6 mb-5 mb-xl-10">
                            <div class="card card-flush h-xl-100">

                                <div class="card-header pt-5">
                                    <h3 class="card-title align-items-start flex-column">
                                        <span class="card-label fw-bold text-dark">Activity Login Device</span>
                                        <span class="text-gray-400 mt-1 fw-semibold fs-6">Device in room</span>
                                    </h3>
                                </div>

                                <div class="card-body pt-6">
                                    <div class="table-responsive">

                                        <table class="table align-middle border rounded table-row-dashed fs-6 g-5">
                                            <!--begin::Table head-->
                                            <thead>
                                                <!--begin::Table row-->
                                                <tr class="text-start text-gray-400 fw-bolder fs-7 text-uppercase gs-0">

                                                    <th class="text-start min-w-100px">Room</th>
                                                    <th class="text-center min-w-100px">Last Seen</th>
                                                    <th class="text-center min-w-100px">Status</th>
                                                </tr>
                                                <!--end::Table row-->
                                            </thead>
                                            <tbody class="fw-bold text-gray-600">
                                                <!--begin::Table row-->
                                                @foreach ($user_activity as $index => $user)
                                                    <tr>

                                                        <td>
                                                            <div class="text-start">

                                                                <span
                                                                    class="text-gray-800 text-hover-primary fs-5 fw-bolder">{{ $user->name }}</span>

                                                            </div>
                                                        </td>


                                                        <td class="text-center">
                                                            @if (Cache::has('user-is-online-' . $user->id))
                                                                <span
                                                                    class="fw-bolder ms-3">{{ Carbon\Carbon::parse($user->last_seen)->diffForHumans() }}</span>
                                                            @else
                                                                <span class="fw-bolder ms-3">-</span>
                                                            @endif

                                                        </td>

                                                        <td class="text-center">
                                                            @if (Cache::has('user-is-online-' . $user->id))
                                                                <span
                                                                    class="badge badge-primary fw-bolder ms-3">Online</span>
                                                            @else
                                                                <span
                                                                    class="badge badge-danger fw-bolder ms-3">Offline</span>
                                                            @endif

                                                        </td>
                                                    </tr>
                                                @endforeach

                                                <!--end::Table row-->
                                            </tbody>
                                            <!--end::Table body-->
                                        </table>
                                    </div>

                                </div>
                                <!--end::Body-->
                            </div>
                            <!--end::Chart widget 8-->
                        </div>
                        <!--end::Col-->

                        <!--begin::Col-->
                        <div class="col-xl-6 mb-5 mb-xl-10">

                            <!--begin::Tables widget 16-->
                            <div class="card card-flush h-xl-100">
                                <!--begin::Header-->
                                <div class="card-header pt-5">
                                    <!--begin::Title-->
                                    <h3 class="card-title align-items-start flex-column">
                                        <span class="card-label fw-bold text-gray-800">Booking Latest</span>

                                        <span class="text-gray-400 mt-1 fw-semibold fs-6">List Max 6 Booking Latest</span>
                                    </h3>

                                </div>

                                <div class="card-body pt-6">

                                    <div class="table-responsive">

                                        <table class="table align-middle border rounded table-row-dashed fs-6 g-5">
                                            <!--begin::Table head-->
                                            <thead>
                                                <!--begin::Table row-->
                                                <tr class="text-start text-gray-400 fw-bolder fs-7 text-uppercase gs-0">

                                                    <th class="text-start min-w-100px">Organizer</th>
                                                    <th class="text-start min-w-100px">Room</th>
                                                    <th class="text-center min-w-100px">Title</th>
                                                    <th class="text-center min-w-100px">Start</th>
                                                    <th class="text-center min-w-100px">End</th>
                                                    <th class="text-center min-w-100px">Status</th>
                                                </tr>
                                                <!--end::Table row-->
                                            </thead>
                                            <tbody class="fw-bold text-gray-600">
                                                <!--begin::Table row-->
                                                @foreach ($latest_booking as $index => $userBooking)
                                                    <tr>

                                                        <td>
                                                            <div class="text-start">

                                                                <span
                                                                    class="text-gray-800 text-hover-primary fs-5 fw-bolder">{{ $userBooking->user->name }}</span>

                                                            </div>
                                                        </td>

                                                        <td class="text-center">

                                                            <span
                                                                class="fw-bolder ms-3">{{ $userBooking->room->name ?? 'removed*' }}</span>

                                                        </td>
                                                        <td class="text-center">

                                                            <span class="fw-bolder ms-3">{{ $userBooking->title }}</span>

                                                        </td>

                                                        <td class="text-center">

                                                            <span
                                                                class="fw-bolder ms-3">{{ Carbon\Carbon::parse($userBooking->start_date) }}</span>

                                                        </td>

                                                        <td class="text-center">

                                                            <span
                                                                class="fw-bolder ms-3">{{ Carbon\Carbon::parse($userBooking->end_date) }}</span>

                                                        </td>

                                                        <td class="text-center">
                                                            @if ($userBooking->status_booking == 'ongoing')
                                                                <span
                                                                    class="badge badge-info fw-bolder ms-3">ongoing</span>
                                                            @elseif($userBooking->status_booking == 'waiting')
                                                                <span
                                                                    class="badge badge-primary fw-bolder ms-3">waiting</span>
                                                            @endif
                                                        </td>
                                                    </tr>
                                                @endforeach

                                                <!--end::Table row-->
                                            </tbody>
                                            <!--end::Table body-->
                                        </table>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
            </div>
            @endif
        </div>
        <br>
        <br>
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


    <script>
        const userActivity = <?php echo Illuminate\Support\Js::from($user_activity); ?>;

        let app = new Vue({
            el: '#app',
            data: {
                userActivity,

                loading: false,
            },
            methods: {
                toCurrency: function(number) {
                    return new Intl.NumberFormat('De-de').format(number);
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
                            return axios.delete('/central-goods/' + id)
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
                                text: 'Outlet Berhasil Dihapus',
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    window.location.reload();
                                }
                            })
                        }
                    })
                },
            }
        });
    </script>
@endsection
