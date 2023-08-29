<!DOCTYPE html>
<html lang="en">

<head>

    <title>Search Room</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta property="og:locale" content="en_US" />
    <link rel="shortcut icon" href="{{ asset('gambar/logo-vbook.png') }}" />
    <!--begin::Fonts-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
    <!--end::Fonts-->
    <!--begin::Page Vendor Stylesheets(used by this page)-->
    <link href="{{ asset('assets/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />
    <!--end::Global Stylesheets Bundle-->
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
                                <a class="menu-link" href="/guest-booking">
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
                                                <a href="/guest-booking/profile" class="menu-link px-5">My Profile</a>
                                                <a href="/guest-booking/logout" class="menu-link px-5">Logout</a>
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

                    <div class="modal bg-white fade" tabindex="-1" id="kt_modal_2">
                        <div class="modal-dialog modal-fullscreen">
                            <div class="modal-content shadow-none">
                                <div class="modal-header">
                                    <h5 class="modal-title">Spesific Filter</h5>

                                    <!--begin::Close-->
                                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                                        <span class="svg-icon svg-icon-2x"></span>
                                    </div>
                                    <!--end::Close-->
                                </div>

                                <div class="modal-body">
                                    <div class="d-flex flex-column flex-grow-1">
                                        <form @submit.prevent="submitForm">

                                            <div class="row">
                                                <div class="col-12 mb-4">
                                                    <label class="form-label fs-6 mb-2">Internet</label>
                                                    <div class="form-check mb-2">
                                                        <input class="form-check-input" type="radio" v-model="internet" value="1" id="internetTersedia">
                                                        <label class="form-check-label" for="internetTersedia">
                                                            Available
                                                        </label>
                                                    </div>
                                                    <div class="form-check mb-2">
                                                        <input class="form-check-input" type="radio" v-model="internet" value="2" id="internetTidakTersedia">
                                                        <label class="form-check-label" for="internetTidakTersedia">
                                                            Not Available
                                                        </label>
                                                    </div>
                                                </div>

                                            </div>

                                            <div class="row">
                                                <div class="col-12 mb-4">
                                                    <label class="form-label fs-6 mb-2">Internet</label>
                                                    <div class="form-check mb-2">
                                                        <input class="form-check-input" type="radio" v-model="internet" value="1" id="internetTersedia">
                                                        <label class="form-check-label" for="internetTersedia">
                                                            Available
                                                        </label>
                                                    </div>
                                                    <div class="form-check mb-2">
                                                        <input class="form-check-input" type="radio" v-model="internet" value="2" id="internetTidakTersedia">
                                                        <label class="form-check-label" for="internetTidakTersedia">
                                                            Not Available
                                                        </label>
                                                    </div>
                                                </div>

                                            </div>


                                            <div class="row">
                                                <div class="col-12 mb-4">
                                                    <label class="form-label fs-6 mb-2">Projector</label>
                                                    <br>
                                                    <div class="form-check mb-2">
                                                        <input class="form-check-input" type="radio" v-model="projector" value="1" id="projectorTersedia">
                                                        <label class="form-check-label" for="projectorTersedia">
                                                            Available
                                                        </label>
                                                    </div>
                                                    <div class="form-check mb-2">
                                                        <input class="form-check-input" type="radio" v-model="projector" value="2" id="projectorTidakTersedia">
                                                        <label class="form-check-label" for="projectorTidakTersedia">
                                                            Not Available
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="row">
                                                <div class="col-12 mb-4">
                                                    <label class="form-label fs-6 mb-2">Capacity</label>
                                                    <div class="input-group input-group-sm mb-5">
                                                        <select class="form-select" aria-label="Select example" v-model="capacity">

                                                            <option value="">
                                                                -- SELECT CAPACITY--</option>
                                                            <option value="10">
                                                                0 to 10</option>
                                                            <option value="20">
                                                                10 to 20</option>
                                                            <option value="30">
                                                                20 to 30</option>
                                                            <option value="50">
                                                                30 to 50</option>
                                                            <option value="51">
                                                                more than 51</option>
                                                        </select>
                                                    </div>
                                                </div>

                                            </div>
                                            <br>


                                            <div class="row">
                                                <div class="input-field col s12">
                                                    <button class="btn btn-warning">
                                                        <i class="fas fa-filter"> &nbsp; Filter</i>
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
                        <!--begin::Container-->
                        <div class="container-xxl" id="kt_content_container">
                            <!--begin::Card-->
                            <div class="mb-n10 mb-lg-n20 z-index-2">
                                <div class="container">
                                    <div class="row justify-content-between align-items-start">
                                        <div class="col-xl-3 card mb-2 d-none d-md-block">
                                            <div class="card-header">
                                                <h3 class="card-title">Spesific Filter</h3>
                                            </div>
                                            <div class="hover-scroll-overlay-y pe-6 me-n6">
                                                <div class="card-body">


                                                    <form @submit.prevent="submitForm">

                                                        <div class="row">
                                                            <div class="col-12 mb-4">
                                                                <label class="form-label fs-6 mb-2">Internet</label>
                                                                <div class="form-check mb-2">
                                                                    <input class="form-check-input" type="radio" v-model="internet" value="1" id="internetTersedia">
                                                                    <label class="form-check-label" for="internetTersedia">
                                                                        Available
                                                                    </label>
                                                                </div>
                                                                <div class="form-check mb-2">
                                                                    <input class="form-check-input" type="radio" v-model="internet" value="2" id="internetTidakTersedia">
                                                                    <label class="form-check-label" for="internetTidakTersedia">
                                                                        Not Available
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="row">
                                                            <div class="col-12 mb-4">
                                                                <label class="form-label fs-6 mb-2">Projector</label>
                                                                <br>
                                                                <div class="form-check mb-2">
                                                                    <input class="form-check-input" type="radio" v-model="projector" value="1" id="projectorTersedia">
                                                                    <label class="form-check-label" for="projectorTersedia">
                                                                        Available
                                                                    </label>
                                                                </div>
                                                                <div class="form-check mb-2">
                                                                    <input class="form-check-input" type="radio" v-model="projector" value="2" id="projectorTidakTersedia">
                                                                    <label class="form-check-label" for="projectorTidakTersedia">
                                                                        Not Available
                                                                    </label>
                                                                </div>
                                                                <br>

                                                            </div>

                                                        </div>


                                                        <div class="row mb-7">
                                                            <div class="col-12">
                                                                <label class="form-label fs-6 mb-2">Capacity</label>
                                                                <div class="input-group input-group-sm mb-1">
                                                                    <select class="form-select" aria-label="Select example" v-model="capacity">

                                                                        <option value="">
                                                                            -- SELECT CAPACITY--</option>
                                                                        <option value="10">
                                                                            0 to 10</option>
                                                                        <option value="20">
                                                                            10 to 20</option>
                                                                        <option value="30">
                                                                            20 to 30</option>
                                                                        <option value="50">
                                                                            30 to 50</option>
                                                                        <option value="51">
                                                                            more than 51</option>
                                                                    </select>

                                                                </div>
                                                            </div>

                                                        </div>


                                                        <div class="text-end">
                                                            <button class="btn btn-warning">
                                                                <i class="fas fa-filter"></i> Filter
                                                            </button>
                                                        </div>

                                                    </form>

                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-xl-8">
                                            <form @submit.prevent="submitSearch" class="mb-10">
                                                <div class="d-flex align-items-center">

                                                    <div class="position-relative me-md-2" style="flex: 1;">


                                                        <div class="input-group">
                                                            <input placeholder="Search Room" type="text" v-model="search" class="form-control" />
                                                            <button type="submit" class="btn btn-warning input-group-text"><i class="fas fa-search"></i></button>
                                                        </div>

                                                    </div>

                                                </div>
                                            </form>

                                            <div class="d-flex mb-5">

                                                <div>
                                                    <button type="button" class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#kt_modal_2">
                                                        <i class="fas fa-filter"></i> Filter
                                                    </button>
                                                </div>
                                            </div>
                                            <div class="row">
                                                @foreach ($room_restrict as $room_restricts)
                                                <div class="col-md-6 col-xl-6">
                                                    <!--begin::Card-->
                                                    <a href="/guest-booking/create/{{ $room_restricts->id }}" class="card border-hover-primary mb-6">
                                                        <!--begin::Card header-->
                                                        <div class="card-header ribbon ribbon-top border-0 pt-9">

                                                            <div class="ribbon-label bg-dark">
                                                                <span class="svg-icon align-middle">
                                                                    <span class="badge badge-pill badge-warning">
                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-bookmark-star" viewBox="0 0 16 16">
                                                                            <path d="M7.84 4.1a.178.178 0 0 1 .32 0l.634 1.285a.178.178 0 0 0 .134.098l1.42.206c.145.021.204.2.098.303L9.42 6.993a.178.178 0 0 0-.051.158l.242 1.414a.178.178 0 0 1-.258.187l-1.27-.668a.178.178 0 0 0-.165 0l-1.27.668a.178.178 0 0 1-.257-.187l.242-1.414a.178.178 0 0 0-.05-.158l-1.03-1.001a.178.178 0 0 1 .098-.303l1.42-.206a.178.178 0 0 0 .134-.098L7.84 4.1z" />
                                                                            <path d="M2 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v13.5a.5.5 0 0 1-.777.416L8 13.101l-5.223 2.815A.5.5 0 0 1 2 15.5V2zm2-1a1 1 0 0 0-1 1v12.566l4.723-2.482a.5.5 0 0 1 .554 0L13 14.566V2a1 1 0 0 0-1-1H4z" />
                                                                        </svg>
                                                                    </span>

                                                                </span>

                                                                &nbsp; Special Room
                                                            </div>
                                                            <!--begin::Card Title-->
                                                            <div class="card-title m-0">
                                                                <!--begin::Avatar-->
                                                                <div class="d-flex align-items-center">

                                                                    <div class="symbol symbol-100px w-100px bg-light">
                                                                        <img alt="Logo " src="{{ asset('assets/booking-room/asset_all_new/room.png') }}" alt="image" class="p-3" loading="lazy">

                                                                    </div>
                                                                    <div class="ps-3">
                                                                        <div class="fs-3 fw-bolder text-dark">{{ $room_restricts->name }}</div>


                                                                    </div>
                                                                </div>
                                                                <!--end::Avatar-->
                                                            </div>

                                                            <div class="card-toolbar">

                                                            </div>

                                                        </div>

                                                        <div class="card-body px-9 pb-9">



                                                            <div>
                                                                <div class="d-flex flex-stack">
                                                                    <div class="text-gray-600 fw-bold me-2">FLOOR</div>
                                                                    <span class="text-white fw-bold"> <span class="badge badge-pill badge-dark">{{ $room_restricts->floor }}</span> </span>
                                                                </div>
                                                                <div class="separator separator-dashed my-3"></div>
                                                                <div class="d-flex flex-stack">
                                                                    <div class="text-gray-600 fw-bold me-2">CAPACITY</div>
                                                                    <span class="text-white fw-bold"> <span class="badge badge-pill badge-secondary">{{ $room_restricts->capacity }}</span> </span>
                                                                </div>
                                                                <div class="separator separator-dashed my-3"></div>
                                                                <div class="d-flex flex-stack">
                                                                    <div class="text-gray-600 fw-bold me-2">PROJECTOR</div>
                                                                    <span class="text-white fw-bold">
                                                                        @if ($room_restricts->projector == 1)
                                                                        <span class="badge" style="background:#03fc24;"> <i class="bi bi-check-circle"></i></span>
                                                                        @else
                                                                        <span class="badge badge-danger"><i class="bi bi-x-circle"></i></span>
                                                                        @endif
                                                                    </span>
                                                                </div>
                                                                <div class="separator separator-dashed my-3"></div>
                                                                <div class="d-flex flex-stack">
                                                                    <div class="text-gray-600 fw-bold me-2">INTERNET</div>
                                                                    <span class="text-white fw-bold">
                                                                        @if ($room_restricts->internet == 1)
                                                                        <span class="badge" style="background:#03fc24;"> <i class="bi bi-check-circle"></i></span>
                                                                        @else
                                                                        <span class="badge badge-danger"> <i class="bi bi-x-circle"></i></span>
                                                                        @endif

                                                                    </span>
                                                                </div>
                                                            </div>



                                                        </div>

                                                    </a>

                                                </div>
                                                @endforeach
                                                @foreach ($rooms as $room)
                                                <div class="col-md-6 col-xl-6">
                                                    <!--begin::Card-->
                                                    <a href="/guest-booking/create/{{ $room->id }}" class="card border-hover-primary mb-6">
                                                        <!--begin::Card header-->
                                                        <div class="card-header ribbon ribbon-top border-0 pt-9">
                                                            <div class="ribbon-label bg-dark">
                                                                <span class="svg-icon svg-icon-muted align-middle">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-intersect" viewBox="0 0 16 16">
                                                                        <path d="M0 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v2h2a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2v-2H2a2 2 0 0 1-2-2V2zm5 10v2a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V6a1 1 0 0 0-1-1h-2v5a2 2 0 0 1-2 2H5zm6-8V2a1 1 0 0 0-1-1H2a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h2V6a2 2 0 0 1 2-2h5z" />
                                                                    </svg>
                                                                </span>

                                                                &nbsp; Floor : {{ $room->floor }}
                                                            </div>
                                                            <!--begin::Card Title-->
                                                            <div class="card-title m-0">
                                                                <!--begin::Avatar-->
                                                                <div class="d-flex align-items-center">

                                                                    <div class="symbol symbol-100px w-100px bg-light">
                                                                        <img alt="Logo " src="{{ asset('assets/booking-room/asset_all_new/room.png') }}" alt="image" class="p-3" loading="lazy">

                                                                    </div>
                                                                    <div class="ps-3">
                                                                        <div class="fs-3 fw-bolder text-dark">{{ $room->name }}</div>


                                                                    </div>
                                                                </div>
                                                                <!--end::Avatar-->
                                                            </div>

                                                            <div class="card-toolbar">

                                                            </div>

                                                        </div>

                                                        <div class="card-body px-9 pb-9">



                                                            <div>
                                                                <div class="d-flex flex-stack">
                                                                    <div class="text-gray-600 fw-bold me-2">CAPACITY</div>
                                                                    <span class="text-white fw-bold"> <span class="badge badge-pill badge-secondary">{{ $room->capacity }}</span> </span>
                                                                </div>
                                                                <div class="separator separator-dashed my-3"></div>
                                                                <div class="d-flex flex-stack">
                                                                    <div class="text-gray-600 fw-bold me-2">PROJECTOR</div>
                                                                    <span class="text-white fw-bold">
                                                                        @if ($room->projector == 1)
                                                                        <span class="badge" style="background:#03fc24;"> <i class="bi bi-check-circle"></i></span>
                                                                        @else
                                                                        <span class="badge badge-danger"><i class="bi bi-x-circle"></i></span>
                                                                        @endif
                                                                    </span>
                                                                </div>
                                                                <div class="separator separator-dashed my-3"></div>
                                                                <div class="d-flex flex-stack">
                                                                    <div class="text-gray-600 fw-bold me-2">INTERNET</div>
                                                                    <span class="text-white fw-bold">
                                                                        @if ($room->internet == 1)
                                                                        <span class="badge" style="background:#03fc24;"> <i class="bi bi-check-circle"></i></span>
                                                                        @else
                                                                        <span class="badge badge-danger"> <i class="bi bi-x-circle"></i></span>
                                                                        @endif

                                                                    </span>
                                                                </div>
                                                            </div>



                                                        </div>

                                                    </a>

                                                </div>
                                                @endforeach

                                            </div>
                                            @if($totalItem < 1 && request()->query('search'))
                                                <div class="col-xl-12 text-center">
                                                    <img alt="Not found illustration" src="{{ asset('gambar/ICON RUN.png') }}" width="180px" />
                                                    <p class="mt-5 fs-5">Oops!.. Search Results for <span style="font-weight:bold;">{{ $req_search }}</span>Not found.</p>
                                                </div>
                                                @endif

                                                <div class="mt-10">
                                                    {{ $rooms->links() }}
                                                </div>
                                                <br>
                                                <br>
                                                <br>
                                                <br>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <br>
                    <br>
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

    <script>
        let app = new Vue({
            el: '#app',
            data: {
                search: '{{ $req_search }}',
                internet: '{{ $internet }}',
                projector: '{{ $projector }}',
                capacity: '{{ $capacity }}',
                loading: false,
            },
            computed: {
                generatedURL() {
                    let url = [];
                    if (this.internet) {
                        url.push('internet=' + this.internet);
                    }

                    if (this.capacity) {
                        url.push('capacity=' + this.capacity);
                    }

                    if (this.projector) {
                        url.push('projector=' + this.projector);
                    }

                    if (this.search) {
                        url.push('search=' + this.search);
                    }


                    return url.join('&');
                }
            },
            methods: {
                submitSearch: function() {
                    // console.log(this.sort_by)
                    window.location.href = `/guest-booking/search?` + this.generatedURL;
                },
                submitForm: function() {
                    // console.log(this.sort_by)
                    window.location.href = `/guest-booking/search?` + this.generatedURL;
                },


            }
        })
    </script>
</body>
<!--end::Body-->

</html>