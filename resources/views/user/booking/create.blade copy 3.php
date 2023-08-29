<!DOCTYPE html>
<!--
Author: Keenthemes
Product Name: Metronic - Bootstrap 5 HTML, VueJS, React, Angular & Laravel Admin Dashboard Theme
Purchase: https://1.envato.market/EA4JP
Website: http://www.keenthemes.com
Contact: support@keenthemes.com
Follow: www.twitter.com/keenthemes
Dribbble: www.dribbble.com/keenthemes
Like: www.facebook.com/keenthemes
License: For each use you must have a valid license purchased only from above link in order to legally use the theme for your project.
-->
<html lang="en">
<!--begin::Head-->

<head>
    <base href="../">
    <title>Create Booking</title>
    <meta charset="utf-8" />

    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta property="og:locale" content="en_US" />
    <link rel="shortcut icon" href="{{ asset('gambar/logo-vbook.png') }}" />

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.css" />

    <!-- <link href="{{ asset('assets/plugins/custom/fullcalendar/fullcalendar.bundle.css') }}" rel="stylesheet" type="text/css" /> -->
    <link href="{{ asset('assets/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />
</head>
<!--end::Head-->
<!--begin::Body-->

<body id="kt_body" class="header-fixed header-tablet-and-mobile-fixed aside-fixed aside-secondary-disabled">
    <div id="app">
        <!--begin::Main-->
        <!--begin::Root-->
        <div class="d-flex flex-column flex-root">
            <!--begin::Page-->
            <div class="page d-flex flex-row flex-column-fluid">
                <!--begin::Aside-->
                <div id="kt_aside" class="aside bg-dark" data-kt-drawer="true" data-kt-drawer-name="aside" data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true" data-kt-drawer-width="auto" data-kt-drawer-direction="start" data-kt-drawer-toggle="#kt_aside_toggle">
                    <!--begin::Logo-->
                    <div class="aside-logo d-none d-lg-flex flex-column align-items-center flex-column-auto py-8" id="kt_aside_logo">
                        <img alt="Logo" src="{{ asset('gambar/logo-vbook.png') }}" class="h-40px" />
                    </div>
                    <!--end::Logo-->
                    <!--begin::Nav-->
                    <div class="aside-nav d-flex flex-column align-lg-center flex-column-fluid w-100 pt-5 pt-lg-0" id="kt_aside_nav">
                        <!--begin::Primary menu-->
                        <div id="kt_aside_menu" class="menu menu-column menu-title-gray-600 menu-state-primary menu-state-icon-primary menu-state-bullet-primary menu-arrow-gray-500 fw-bold fs-6" data-kt-menu="true">
                            <div class="menu-item">
                                <a class="menu-link" href="/booking">
                                    <span class="menu-link menu-center" title="Dashboard Booking" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-dismiss="click" data-bs-placement="right">
                                        <span class="menu-icon me-0">

                                            <i class="bi bi-house fs-2"></i>
                                        </span>
                                    </span>
                                </a>
                            </div>


                            @if (auth()->user()->role_id == 3)
                            <div class="menu-item">
                                <a class="menu-link" href="#">
                                    <span class="menu-link menu-center" title="History Booking" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-dismiss="click" data-bs-placement="right">
                                        <span class="menu-icon me-0">
                                            <i class="bi bi-clock-history fs-2"></i>
                                        </span>
                                    </span>
                                </a>
                            </div>
                            <div class="menu-item">
                                <a class="menu-link" href="/user/profile">
                                    <span class="menu-link menu-center" title="Profile" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-dismiss="click" data-bs-placement="right">
                                        <span class="menu-icon me-0">
                                            <i class="bi bi-person fs-2"></i>
                                        </span>
                                    </span>
                                </a>
                            </div>
                            @endif
                        </div>
                    </div>

                    <!--end::Footer-->
                </div>
                <!--end::Aside-->
                <!--begin::Wrapper-->
                <div class="wrapper d-flex flex-column flex-row-fluid" id="kt_wrapper">
                    <!--begin::Header-->
                    <div id="kt_header" style="" class="header bg-white align-items-stretch">
                        <!--begin::Container-->
                        <div class="container-fluid d-flex align-items-stretch justify-content-between">
                            <!--begin::Aside mobile toggle-->
                            <div class="d-flex align-items-center d-lg-none ms-n3 me-1" title="Show aside menu">
                                <div class="btn btn-icon btn-active-color-primary w-40px h-40px" id="kt_aside_toggle">
                                    <!--begin::Svg Icon | path: icons/duotune/abstract/abs015.svg-->
                                    <span class="svg-icon svg-icon-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                            <path d="M21 7H3C2.4 7 2 6.6 2 6V4C2 3.4 2.4 3 3 3H21C21.6 3 22 3.4 22 4V6C22 6.6 21.6 7 21 7Z" fill="currentColor" />
                                            <path opacity="0.3" d="M21 14H3C2.4 14 2 13.6 2 13V11C2 10.4 2.4 10 3 10H21C21.6 10 22 10.4 22 11V13C22 13.6 21.6 14 21 14ZM22 20V18C22 17.4 21.6 17 21 17H3C2.4 17 2 17.4 2 18V20C2 20.6 2.4 21 3 21H21C21.6 21 22 20.6 22 20Z" fill="currentColor" />
                                        </svg>
                                    </span>
                                    <!--end::Svg Icon-->
                                </div>
                            </div>
                            <!--end::Aside mobile toggle-->
                            <!--begin::Mobile logo-->
                            <div class="d-flex align-items-center flex-grow-1 flex-lg-grow-0">
                                <a href="#" class="d-lg-none">
                                    <img alt="Logo" src="{{ asset('gambar/logo-vbook.png') }}" class="h-30px" />
                                </a>
                            </div>
                            <!--end::Mobile logo-->
                            <div class="d-flex align-items-center" id="kt_header_wrapper">
                                <!--begin::Page title-->
                                <div class="page-title d-flex flex-column align-items-start justify-content-center flex-wrap me-lg-20 pb-2 pb-lg-0" data-kt-swapper="true" data-kt-swapper-mode="prepend" data-kt-swapper-parent="{default: '#kt_content_container', lg: '#kt_header_wrapper'}">
                                    <!--begin::Heading-->
                                    <h1 class="text-dark fw-bolder my-1 fs-3 lh-1">Booking Room</h1>

                                </div>
                                <!--end::Page title=-->
                            </div>
                            <!--begin::Wrapper-->
                            <div class="d-flex align-items-stretch justify-content-between flex-lg-grow-1">
                                <!--begin::Navbar-->
                                <div class="d-flex align-items-stretch" id="kt_header_nav">
                                    <div class="header-menu align-items-stretch" data-kt-drawer="true" data-kt-drawer-name="header-menu" data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true" data-kt-drawer-width="{default:'200px', '300px': '250px'}" data-kt-drawer-direction="end" data-kt-drawer-toggle="#kt_header_menu_mobile_toggle" data-kt-swapper="true" data-kt-swapper-mode="prepend" data-kt-swapper-parent="{default: '#kt_body', lg: '#kt_header_nav'}">
                                    </div>
                                </div>
                                <!-- ============================== HEADER USER ==================== -->
                                <div class="d-flex align-items-stretch justify-self-end flex-shrink-0">
                                    <div class="d-flex align-items-center ms-1 ms-lg-3" id="kt_header_user_menu_toggle">

                                        <div class="cursor-pointer symbol symbol-30px symbol-md-40px" data-kt-menu-trigger="click" data-kt-menu-attach="parent" data-kt-menu-placement="bottom-end">
                                            <img src="{{ asset('gambar/profile.png') }}" alt="user" />
                                        </div>
                                        @if (auth()->user()->role_id == 2)

                                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg menu-state-primary fw-bold py-4 fs-6 w-275px" data-kt-menu="true">
                                            <div class="menu-item px-3">
                                                <div class="menu-content d-flex align-items-center px-3">
                                                    <!--begin::Avatar-->
                                                    <div class="symbol symbol-50px me-5">
                                                        <img alt="Logo" src="{{ asset('gambar/profile.png') }}" />
                                                    </div>

                                                    <div class="d-flex flex-column">
                                                        <div class="fw-bolder d-flex align-items-center fs-5">{{ auth()->user()->name }}
                                                        </div>
                                                        <a href="#" class="fw-bold text-muted text-hover-primary fs-7">{{ auth()->user()->email }}</a>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="separator my-2"></div>
                                            <div class="menu-item px-5">
                                                <a href="/admin" class="menu-link px-5">Kembali Ke home</a>
                                            </div>
                                        </div>

                                        @else
                                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg menu-state-primary fw-bold py-4 fs-6 w-275px" data-kt-menu="true">
                                            <div class="menu-item px-3">
                                                <div class="menu-content d-flex align-items-center px-3">
                                                    <!--begin::Avatar-->
                                                    <div class="symbol symbol-50px me-5">
                                                        <img alt="Logo" src="{{ asset('gambar/profile.png') }}" />
                                                    </div>

                                                    <div class="d-flex flex-column">
                                                        <div class="fw-bolder d-flex align-items-center fs-5">{{ auth()->user()->name }}
                                                        </div>
                                                        <a href="#" class="fw-bold text-muted text-hover-primary fs-7">{{ auth()->user()->email }}</a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="separator my-2"></div>
                                            <div class="menu-item px-5">
                                                <a href="/user/profile" class="menu-link px-5">My Profile</a>
                                                <a href="/user/logout" class="menu-link px-5">Logout</a>
                                            </div>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <!--end::Wrapper-->
                        </div>
                        <!--end::Container-->
                    </div>
                    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
                        <!--begin::Container-->
                        <div class="container-xxl" id="kt_content_container">

                            <form @submit.prevent="submitForm" enctype="multipart/form-data" id="kt_ecommerce_add_product_form" class="form d-flex flex-column flex-lg-row">
                                @csrf
                                <div class="d-flex flex-column gap-7 gap-lg-10 w-100 w-lg-300px mb-7 me-lg-10">

                                    <div class="card card-flush py-4">
                                        <!--begin::Card header-->
                                        <div class="card-header">
                                            <!--begin::Card title-->
                                            <div class="card-title">
                                                <h2>Selected Room</h2>
                                            </div>
                                            <div class="card-toolbar">
                                                <i class="bi bi-bank"></i>
                                            </div>
                                            <!--begin::Card toolbar-->
                                        </div>
                                        <div class="card-body pt-0">
                                            <span class="badge text-white" style="background:{{ $rooms->color_code }};border:0; font-size:14px;">
                                                {{ $rooms->name }}
                                            </span>

                                            <br>
                                            <br>
                                            <div class="row col-md-12">
                                                <div class="col-md-6">
                                                    Capacity
                                                </div>

                                                <div class="col-md-6">
                                                    :&nbsp; <b>{{ $rooms->capacity }}</b>
                                                </div>

                                            </div>

                                            <div class="row col-md-12">
                                                <div class="col-md-6">
                                                    Floor
                                                </div>

                                                <div class="col-md-6">
                                                    :&nbsp; <b>{{ $rooms->floor }}</b>
                                                </div>

                                            </div>

                                            <div class="row col-md-12">
                                                <div class="col-md-6">
                                                    Projector
                                                </div>

                                                <div class="col-md-6">
                                                    :&nbsp; <b> @if ($rooms->projector == 1)
                                                        <span class="fw-bolder text-dark">Available</span>
                                                        @else
                                                        <span class="fw-bolder text-dark">Not Available</span>
                                                        @endif
                                                    </b>
                                                </div>

                                            </div>

                                        </div>


                                        <!--end::Card body-->
                                    </div>
                                    <!--end::Status-->

                                </div>



                                <div class="d-flex flex-column flex-row-fluid gap-7 gap-lg-10">

                                    <div class="d-flex flex-column gap-7 gap-lg-10">
                                        <div class="card card-flush py-4">
                                            <div class="card-header">
                                                <div class="card-title">
                                                    <h2>Create Booking</h2>
                                                </div>
                                            </div>
                                            <div class="card-body pt-0">
                                                <div class="mb-2 fv-row">
                                                    <label class="required form-label">Title</label>
                                                    <input type="text" v-model="title" class="form-control mb-2" placeholder="Title" />
                                                </div>

                                            </div>

                                            <div class="card-body pt-0">
                                                <div class="mb-2 fv-row">
                                                    <label class="required form-label">Department</label>
                                                    <input type="text" v-model="department" class="form-control mb-2" placeholder="Department" />
                                                </div>

                                            </div>

                                            <div class="card-body pt-0">
                                                <div class="mb-2 fv-row">
                                                    <label class="required form-label">Description</label>
                                                    <textarea v-model="description" class="form-control mb-2" placeholder="Description" style="height: 80px"></textarea>

                                                </div>

                                            </div>

                                            <div class="card-body pt-0">
                                                <div class="mb-2 fv-row">

                                                    <label class="required form-label">Participant</label> <br>
                                                    <small> Invited participants cannot be more than <b>{{ $rooms->capacity }} users </b> </small>

                                                    <textarea v-model="participant" class="form-control mb-2" style="height: 80px"></textarea>
                                                </div>

                                                <div class="d-flex justify-content-between align-items-center mb-4">
                                                    <div>
                                                        <label class="required form-label">Participant</label> <br>
                                                        <small> Invited participants cannot be more than <b>{{ $rooms->capacity }} users </b> </small>
                                                    </div>
                                                    <div>
                                                        <a @click="addBankAccount" class="btn btn-light btn-sm">
                                                            <i class="bi bi-plus"></i>
                                                            Add Participant
                                                        </a>
                                                    </div>
                                                </div>
                                                <div v-for="(participants2, index) in participant2" :key="index" class="row">
                                                    <div class="col-1 fw-bold pt-1">
                                                        <span>@{{ index + 1 }}.</span>
                                                    </div>
                                                    <div class="col-11">
                                                        <div class="row align-items-center">

                                                            <div class="col-sm-5">
                                                                <input type="text" v-model="participants2.email" class="form-control form-control-sm" placeholder="Masukkan Email">
                                                            </div>
                                                            <div class="col-sm-2">
                                                                <a href="#" class="btn btn-active-light-danger text-danger btn-sm" @click.prevent="removeBankAccount(index)"><i class="bi bi-trash text-danger align-middle"></i>Hapus</a>
                                                            </div>
                                                        </div>


                                                    </div>
                                                    <div class="separator my-8"></div>
                                                </div>

                                            </div>

                                            <div class="card-body pt-0">
                                                <div class="mb-2 fv-row">
                                                    <label class="required form-label">Start Date</label>
                                                    <input type="datetime-local" v-model="start_date" id="start" class="form-control mb-2">

                                                </div>

                                            </div>

                                            <div class="card-body pt-0">
                                                <div class="mb-2 fv-row">
                                                    <label class="required form-label">End Date</label>
                                                    <input type="datetime-local" v-model="end_date" id="end" class="form-control mb-2">

                                                </div>

                                            </div>
                                        </div>


                                    </div>

                                    <!--end::Tab pane-->

                                    <!--end::Tab content-->
                                    <div class="d-flex justify-content-end">
                                        <!--begin::Button-->
                                        <a href="/booking/search" id="kt_ecommerce_add_product_cancel" class="btn btn-secondary me-5">Cancel</a>
                                        <!--end::Button-->
                                        <!--begin::Button-->
                                        <button type="submit" id="kt_ecommerce_add_product_submit" class="btn btn-primary">
                                            <span class="indicator-label">Save</span>
                                            <span class="indicator-progress">Please wait...
                                                <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                        </button>
                                        <!--end::Button-->
                                    </div>
                                </div>
                                <!--end::Main column-->
                            </form>

                        </div>
                    </div>

                </div>
                <!--end::Wrapper-->
            </div>
            <!--end::Page-->
        </div>

        <div id="kt_scrolltop" class="scrolltop" data-kt-scrolltop="true">
            <!--begin::Svg Icon | path: icons/duotune/arrows/arr066.svg-->
            <span class="svg-icon">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                    <rect opacity="0.5" x="13" y="6" width="13" height="2" rx="1" transform="rotate(90 13 6)" fill="currentColor" />
                    <path d="M12.5657 8.56569L16.75 12.75C17.1642 13.1642 17.8358 13.1642 18.25 12.75C18.6642 12.3358 18.6642 11.6642 18.25 11.25L12.7071 5.70711C12.3166 5.31658 11.6834 5.31658 11.2929 5.70711L5.75 11.25C5.33579 11.6642 5.33579 12.3358 5.75 12.75C6.16421 13.1642 6.83579 13.1642 7.25 12.75L11.4343 8.56569C11.7467 8.25327 12.2533 8.25327 12.5657 8.56569Z" fill="currentColor" />
                </svg>
            </span>
            <!--end::Svg Icon-->
        </div>

    </div>


    <script src="{{ asset('assets/plugins/global/plugins.bundle.js') }}"></script>
    <script src="{{ asset('assets/js/scripts.bundle.js') }}"></script>

    <!--end::Global Javascript Bundle-->
    <!--begin::Page Vendors Javascript(used by this page)-->

    <script src="{{ asset('assets/plugins/custom/fullcalendar/fullcalendar.bundle.js') }}"></script>
    <script src="{{ asset('assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>


    <!--end::Page Vendors Javascript-->
    <!--begin::Page Custom Javascript(used by this page)-->
    <script src="{{ asset('assets/js/custom/apps/calendar/calendar.js') }}"></script>
    <script src="{{ asset('assets/js/widgets.bundle.js') }}"></script>
    <script src="{{ asset('assets/js/custom/widgets.js') }}"></script>
    <script src="{{ asset('assets/js/custom/widgets.js') }}"></script>

    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/vue@2/dist/vue.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/cleave.js@1.6.0/dist/cleave.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/vue-cleave-component@2"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>


    <script>
        let app = new Vue({
            el: '#app',
            data: {
                title: '',
                department: '',
                description: '',
                start_date: '',
                end_date: '',
                participant: '{{ $emailOrganizer}},',
                roomId: '{{ $rooms->id}}',

                participant2: [{
                    email: '',

                }],
                loading: false,
            },
            methods: {
                addBankAccount() {
                    const bankAccount = {
                        email: '',

                    };

                    this.participant2.push(bankAccount);
                },
                removeBankAccount(index) {
                    this.participant2.splice(index, 1);
                },
                submitForm: function() {
                    this.sendData();
                },
                sendData: function() {
                    let vm = this;
                    vm.loading = true;
                    axios.post('/booking', {
                            title: this.title,
                            department: this.department,
                            description: this.description,
                            start_date: this.start_date,
                            end_date: this.end_date,
                            room_id: this.roomId,
                            // participant: JSON.stringify(this.participant),
                            participant: this.participant,
                        })
                        .then(function(response) {
                            vm.loading = false;
                            Swal.fire({
                                title: 'Berhasil',
                                text: 'Booking berhasil disimpan.',
                                icon: 'success',
                                showConfirmButton: false,
                            })
                            setTimeout(function() {
                                window.location.href = '/booking';
                            }, 2000);
                            // Swal.fire({
                            //     title: 'Berhasil',
                            //     text: 'Booking berhasil disimpan.',
                            //     icon: 'success',
                            //     allowOutsideClick: false,
                            // }).then((result) => {
                            //     if (result.isConfirmed) {
                            //         window.location.href = '/booking';
                            //     }
                            // })
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


            }
        })
    </script>

    <script>
        $('#selectEvents').select2();
        $('#selectEvents').on('change', function(e) {
            const val = $(this).val();
            app.$data.participant = val;
        });
    </script>
</body>
<!--end::Body-->

</html>