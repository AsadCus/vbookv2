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
<head>
    <base href="../">
    <title>Create Booking</title>
    <meta charset="utf-8" />

    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta property="og:locale" content="en_US" />
    <link rel="shortcut icon" href="{{ asset('gambar/logo-vbook.png') }}" />

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.css" /> --}}
    <link href="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/css/tom-select.css" rel="stylesheet">

    {{-- <link href="{{ asset('assets/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css" /> --}}
    <link href="{{ asset('assets/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />
</head>
<body id="kt_body" class="header-fixed header-tablet-and-mobile-fixed aside-fixed aside-secondary-disabled">
    <div id="app">
        <div class="d-flex flex-column flex-root">
            <div class="page d-flex flex-row flex-column-fluid">
                <div id="kt_aside" class="aside bg-dark" data-kt-drawer="true" data-kt-drawer-name="aside" data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true" data-kt-drawer-width="auto" data-kt-drawer-direction="start" data-kt-drawer-toggle="#kt_aside_toggle">
                    <div class="aside-logo d-none d-lg-flex flex-column align-items-center flex-column-auto py-8" id="kt_aside_logo">
                        <img alt="Logo" src="{{ asset('gambar/logo-vbook.png') }}" class="h-40px" />
                    </div>
                    <div class="aside-nav d-flex flex-column align-lg-center flex-column-fluid w-100 pt-5 pt-lg-0" id="kt_aside_nav">
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
                                <a class="menu-link" href="/history-booking">
                                    <span class="menu-link menu-center" title="History Booking" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-dismiss="click" data-bs-placement="right">
                                        <span class="menu-icon me-0">
                                            <i class="bi bi-clock-history fs-2"></i>
                                        </span>
                                    </span>
                                </a>
                            </div>
                            <div class="menu-item">
                                <a class="menu-link" href="/recurring-booking">
                                    <span class="menu-link menu-center" title="Recurring Booking" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-dismiss="click" data-bs-placement="right">
                                        <span class="menu-icon me-0">
                                            <i class="bi bi-arrow-left-right fs-2"></i>
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
                </div>
                <div class="wrapper d-flex flex-column flex-row-fluid" id="kt_wrapper">
                    <div id="kt_header" style="" class="header bg-white align-items-stretch">
                        <div class="container-fluid d-flex align-items-stretch justify-content-between">
                            <div class="d-flex align-items-center d-lg-none ms-n3 me-1" title="Show aside menu">
                                <div class="btn btn-icon btn-active-color-primary w-40px h-40px" id="kt_aside_toggle">
                                    <span class="svg-icon svg-icon-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                            <path d="M21 7H3C2.4 7 2 6.6 2 6V4C2 3.4 2.4 3 3 3H21C21.6 3 22 3.4 22 4V6C22 6.6 21.6 7 21 7Z" fill="currentColor" />
                                            <path opacity="0.3" d="M21 14H3C2.4 14 2 13.6 2 13V11C2 10.4 2.4 10 3 10H21C21.6 10 22 10.4 22 11V13C22 13.6 21.6 14 21 14ZM22 20V18C22 17.4 21.6 17 21 17H3C2.4 17 2 17.4 2 18V20C2 20.6 2.4 21 3 21H21C21.6 21 22 20.6 22 20Z" fill="currentColor" />
                                        </svg>
                                    </span>
                                </div>
                            </div>
                            <div class="d-flex align-items-center flex-grow-1 flex-lg-grow-0">
                                <a href="#" class="d-lg-none">
                                    <img alt="Logo" src="{{ asset('gambar/logo-vbook.png') }}" class="h-30px" />
                                </a>
                            </div>
                            <div class="d-flex align-items-center" id="kt_header_wrapper">
                                <div class="page-title d-flex flex-column align-items-start justify-content-center flex-wrap me-lg-20 pb-2 pb-lg-0" data-kt-swapper="true" data-kt-swapper-mode="prepend" data-kt-swapper-parent="{default: '#kt_content_container', lg: '#kt_header_wrapper'}">
                                    <h1 class="text-dark fw-bolder my-1 fs-3 lh-1">Booking Room</h1>
                                </div>
                            </div>
                            <div class="d-flex align-items-stretch justify-content-between flex-lg-grow-1">
                                <div class="d-flex align-items-stretch" id="kt_header_nav">
                                    <div class="header-menu align-items-stretch" data-kt-drawer="true" data-kt-drawer-name="header-menu" data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true" data-kt-drawer-width="{default:'200px', '300px': '250px'}" data-kt-drawer-direction="end" data-kt-drawer-toggle="#kt_header_menu_mobile_toggle" data-kt-swapper="true" data-kt-swapper-mode="prepend" data-kt-swapper-parent="{default: '#kt_body', lg: '#kt_header_nav'}">
                                    </div>
                                </div>
                                <div class="d-flex align-items-stretch justify-self-end flex-shrink-0">
                                    <div class="d-flex align-items-center ms-1 ms-lg-3" id="kt_header_user_menu_toggle">
                                        <div class="cursor-pointer symbol symbol-30px symbol-md-40px" data-kt-menu-trigger="click" data-kt-menu-attach="parent" data-kt-menu-placement="bottom-end">
                                            <img src="{{ asset('gambar/profile.png') }}" alt="user" />
                                        </div>
                                        @if (auth()->user()->role_id == 2)
                                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg menu-state-primary fw-bold py-4 fs-6 w-275px" data-kt-menu="true">
                                            <div class="menu-item px-3">
                                                <div class="menu-content d-flex align-items-center px-3">
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
                        </div>
                    </div>
                    <nav class="navbar navbar-light bg-light border-top navbar-expand d-md-none d-lg-none d-xl-none fixed-bottom">
                        <ul class="navbar-nav nav-justified w-100">
                            <li class="nav-item">
                                <a href="/booking" class="nav-link">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-house" viewBox="0 0 16 16">
                                        <path d="M8.707 1.5a1 1 0 0 0-1.414 0L.646 8.146a.5.5 0 0 0 .708.708L2 8.207V13.5A1.5 1.5 0 0 0 3.5 15h9a1.5 1.5 0 0 0 1.5-1.5V8.207l.646.647a.5.5 0 0 0 .708-.708L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293L8.707 1.5ZM13 7.207V13.5a.5.5 0 0 1-.5.5h-9a.5.5 0 0 1-.5-.5V7.207l5-5 5 5Z" />
                                    </svg>
                                </a>
                            </li>
                            <li class="nav-item">
                                <!-- <a href="#" class="nav-link" id="kt_engage_demos_toggle">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-archive" viewBox="0 0 16 16">
                                    <path d="M0 2a1 1 0 0 1 1-1h14a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1v7.5a2.5 2.5 0 0 1-2.5 2.5h-9A2.5 2.5 0 0 1 1 12.5V5a1 1 0 0 1-1-1V2zm2 3v7.5A1.5 1.5 0 0 0 3.5 14h9a1.5 1.5 0 0 0 1.5-1.5V5H2zm13-3H1v2h14V2zM5 7.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5z" />
                                </svg>
                            </a> -->
                                <a href="/recurring-booking" class="nav-link">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-repeat" viewBox="0 0 16 16">
                                        <path d="M11 5.466V4H5a4 4 0 0 0-3.584 5.777.5.5 0 1 1-.896.446A5 5 0 0 1 5 3h6V1.534a.25.25 0 0 1 .41-.192l2.36 1.966c.12.1.12.284 0 .384l-2.36 1.966a.25.25 0 0 1-.41-.192Zm3.81.086a.5.5 0 0 1 .67.225A5 5 0 0 1 11 13H5v1.466a.25.25 0 0 1-.41.192l-2.36-1.966a.25.25 0 0 1 0-.384l2.36-1.966a.25.25 0 0 1 .41.192V12h6a4 4 0 0 0 3.585-5.777.5.5 0 0 1 .225-.67Z" />
                                    </svg>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="/booking/search" class="nav-link circle-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-calendar-plus-fill" viewBox="0 0 16 16">
                                        <path d="M4 .5a.5.5 0 0 0-1 0V1H2a2 2 0 0 0-2 2v1h16V3a2 2 0 0 0-2-2h-1V.5a.5.5 0 0 0-1 0V1H4V.5zM16 14V5H0v9a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2zM8.5 8.5V10H10a.5.5 0 0 1 0 1H8.5v1.5a.5.5 0 0 1-1 0V11H6a.5.5 0 0 1 0-1h1.5V8.5a.5.5 0 0 1 1 0z" />
                                    </svg>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="/history-booking" class="nav-link">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-hourglass-split" viewBox="0 0 16 16">
                                        <path d="M2.5 15a.5.5 0 1 1 0-1h1v-1a4.5 4.5 0 0 1 2.557-4.06c.29-.139.443-.377.443-.59v-.7c0-.213-.154-.451-.443-.59A4.5 4.5 0 0 1 3.5 3V2h-1a.5.5 0 0 1 0-1h11a.5.5 0 0 1 0 1h-1v1a4.5 4.5 0 0 1-2.557 4.06c-.29.139-.443.377-.443.59v.7c0 .213.154.451.443.59A4.5 4.5 0 0 1 12.5 13v1h1a.5.5 0 0 1 0 1h-11zm2-13v1c0 .537.12 1.045.337 1.5h6.326c.216-.455.337-.963.337-1.5V2h-7zm3 6.35c0 .701-.478 1.236-1.011 1.492A3.5 3.5 0 0 0 4.5 13s.866-1.299 3-1.48V8.35zm1 0v3.17c2.134.181 3 1.48 3 1.48a3.5 3.5 0 0 0-1.989-3.158C8.978 9.586 8.5 9.052 8.5 8.351z" />
                                    </svg>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="/user/profile" class="nav-link">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-person-bounding-box" viewBox="0 0 16 16">
                                        <path d="M1.5 1a.5.5 0 0 0-.5.5v3a.5.5 0 0 1-1 0v-3A1.5 1.5 0 0 1 1.5 0h3a.5.5 0 0 1 0 1h-3zM11 .5a.5.5 0 0 1 .5-.5h3A1.5 1.5 0 0 1 16 1.5v3a.5.5 0 0 1-1 0v-3a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 1-.5-.5zM.5 11a.5.5 0 0 1 .5.5v3a.5.5 0 0 0 .5.5h3a.5.5 0 0 1 0 1h-3A1.5 1.5 0 0 1 0 14.5v-3a.5.5 0 0 1 .5-.5zm15 0a.5.5 0 0 1 .5.5v3a1.5 1.5 0 0 1-1.5 1.5h-3a.5.5 0 0 1 0-1h3a.5.5 0 0 0 .5-.5v-3a.5.5 0 0 1 .5-.5z" />
                                        <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3zm8-9a3 3 0 1 1-6 0 3 3 0 0 1 6 0z" />
                                    </svg>
                                </a>
                            </li>
                        </ul>
                    </nav>
                    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
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
                                    </div>
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
                                                    <select name="" v-model="department" id="selectdepartment">
                                                        <option value="">- Select Department -</option>
                                                        <option v-for="divisions in division" :value="divisions.id">@{{ divisions.name }}</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="card-body pt-0">
                                                <div class="mb-2 fv-row">
                                                    <label class="required form-label">Description</label>
                                                    <textarea v-model="description" class="form-control mb-2" placeholder="Description" style="height: 80px"></textarea>
                                                </div>
                                            </div>
                                            <div class="card-body pt-0">
                                                <div class="d-flex justify-content-between align-items-center mb-4">
                                                    <div>
                                                        <label class="required form-label">Participant</label> <br>
                                                        <small> Invited participants cannot be more than <b>{{ $rooms->capacity }} users </b> </small>
                                                    </div>
                                                    <div>
                                                        <a @click="addEmail" class="btn btn-light btn-sm">
                                                            <i class="bi bi-plus"></i>
                                                            Add Participant
                                                        </a>
                                                    </div>
                                                </div>
                                                <div v-for="(participants2, index) in participant" :key="index" class="row">
                                                    <div class="col-1 fw-bold pt-1">
                                                        <span>@{{ index + 1 }}.</span>
                                                    </div>
                                                    <template v-if="index != 0">
                                                        <div class="col-11">
                                                            <div class="row align-items-center">
                                                                <div class="col-sm-8">
                                                                    <input type="text" v-model="participants2.email" class="form-control form-control-sm" placeholder="Masukkan Email">
                                                                </div>
                                                                <div class="col-sm-2">
                                                                    <a href="#" class="btn btn-active-light-danger text-danger btn-sm" @click.prevent="removeEmailParticipant(index)"><i class="bi bi-trash text-danger align-middle"></i>Hapus</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </template>
                                                    <template v-else>
                                                        <div class="col-11">
                                                            <div class="row align-items-center">
                                                                <div class="col-sm-8">
                                                                    <input type="text" v-model="participants2.email" class="form-control form-control-sm" placeholder="Masukkan Email" readonly>
                                                                    <small class="text-danger"><span class="text-dark">note: </span>Cannot be changed.</small>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </template>
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
                                            <div class="card-body pt-0">
                                                <div class="mb-2 fv-row">
                                                    <div>
                                                        <label class="required form-label">reminder for participants</label>
                                                    </div>
                                                    <div class="input-group mb-3">
                                                        <input type="number" v-model="remainderAt" placeholder="EX: 10" class="form-control mb-2">
                                                        <div class="input-group-append">
                                                            <span class="input-group-text">Minutes</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-body pt-0">
                                                <a href="#" data-bs-toggle="modal" data-bs-target="#kt_modal_create" class="text-gray-900 fw-bolder">Do you want ordering food?</a>
                                            </div>
                                        </div>
                                    </div>
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
                            </form>
                        </div>
                    </div>
                </div>
            </div>
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

        {{-- begin::create order modal--}}
        <div class="modal fade" tabindex="-1" id="kt_modal_create">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <form @submit.prevent="submitFormOrder" enctype="multipart/form-data">
                    @csrf
                        <div class="modal-header">
                            <h5 class="modal-title">Create Order</h5>
                            <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                                <span class="svg-icon svg-icon-2x"></span>
                            </div>
                        </div>
                        <div class="modal-body">
                            <div class="row g-3 align-items-center mb-4">
                                <div class="col-sm-3">
                                    <label for="" class="form-label form-label-sm">Participant</label>
                                </div>
                                <div class="col-sm-9">
                                    <span class="fw-bolder text-dark">: &nbsp; @{{ participant.length }}</span>
                                </div>
                            </div>
                            <div class="row g-3 align-items-center mb-4">
                                <div class="col-sm-12">
                                    <ul class="nav nav-tabs nav-line-tabs mb-5 fs-6">
                                        @foreach ($foodCategory as $key => $item)
                                        <li class="nav-item">
                                            @if ($key == 0)
                                            <a class="nav-link active" data-bs-toggle="tab" href="#tab_{{ $item->name }}">{{ $item->name }}</a>                                                    
                                            @else
                                            <a class="nav-link" data-bs-toggle="tab" href="#tab_{{ $item->name }}">{{ $item->name }}</a>
                                            @endif
                                        </li>
                                        @endforeach
                                    </ul>
                                    <div class="tab-content">
                                        @foreach ($foodCategory as $key => $item)
                                            @if ($key == 0)
                                            <div class="tab-pane fade show active" id="tab_{{ $item->name }}" role="tabpanel">
                                                <div class="row" data-kt-buttons="true" data-kt-buttons-target=".form-check-card, .form-check-input">
                                                    @foreach ($item->food as $keyf => $food)    
                                                    <div class="col-12 col-sm-6 mb-3">
                                                        <label class="card shadow-sm form-check-card">
                                                            <div class="card-body p-2">
                                                                <div class="row">
                                                                    <div class="col-6">
                                                                        <div class="form-check-wrapper">
                                                                            <img style="width: 100%; height: 120px; object-fit: cover; border-radius: 4px;" src="{{ asset('gambar/makanan/'.$food->foto_menu) }}" alt="masukkan gambar">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-6">
                                                                        <h4 class="card-title">{{ $food->food_menu }}</h4>
                                                                        <div class="form-check form-check-custom form-check-solid">
                                                                            <input class="form-check-input" type="checkbox" value="{{ $food->id }}" name="" v-model="food"/>
                                                                        </div>
                                                                        <div class="input-group mt-2">
                                                                            <span class="input-group-text p-2">Amount</span>
                                                                            <input class="form-control p-2" type="number" v-model="food_count[{{ $food->id - 1 }}]">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </label>
                                                    </div>
                                                    @endforeach
                                                </div> 
                                            </div>
                                            @else
                                            <div class="tab-pane fade" id="tab_{{ $item->name }}" role="tabpanel">
                                                <div class="row" data-kt-buttons="true" data-kt-buttons-target=".form-check-card, .form-check-input">
                                                    @foreach ($item->food as $keyf => $food)    
                                                    <div class="col-12 col-sm-6 mb-3">
                                                        <label class="card shadow-sm form-check-card">
                                                            <div class="card-body p-2">
                                                                <div class="row">
                                                                    <div class="col-6">
                                                                        <div class="form-check-wrapper">
                                                                            <img style="width: 100%; height: 120px; object-fit: cover; border-radius: 4px;" src="{{ asset('gambar/makanan/'.$food->foto_menu) }}" alt="masukkan gambar">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-6">
                                                                        <h4 class="card-title">{{ $food->food_menu }}</h4>
                                                                        <div class="form-check form-check-custom form-check-solid">
                                                                            <input class="form-check-input" type="checkbox" value="{{ $food->id }}" name="" v-model="food"/>
                                                                        </div>
                                                                        <div class="input-group mt-2">
                                                                            <span class="input-group-text p-2">Amount</span>
                                                                            <input class="form-control p-2" type="number" v-model="food_count[{{ $food->id - 1 }}]">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </label>
                                                    </div>
                                                    @endforeach
                                                </div> 
                                            </div>
                                            @endif
                                        @endforeach
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
        {{-- end::create order modal--}}
    </div>

    <script src="{{ asset('assets/plugins/global/plugins.bundle.js') }}"></script>
    <script src="{{ asset('assets/js/scripts.bundle.js') }}"></script>
    {{-- <script src="{{ asset('assets/plugins/custom/fullcalendar/fullcalendar.bundle.js') }}"></script> --}}
    {{-- <script src="{{ asset('assets/plugins/custom/datatables/datatables.bundle.js') }}"></script> --}}
    {{-- <script src="{{ asset('assets/js/custom/apps/calendar/calendar.js') }}"></script> --}}
    {{-- <script src="{{ asset('assets/js/widgets.bundle.js') }}"></script> --}}
    {{-- <script src="{{ asset('assets/js/custom/widgets.js') }}"></script> --}}
    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>

    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/vue@2/dist/vue.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/cleave.js@1.6.0/dist/cleave.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/vue-cleave-component@2"></script>
    <script src="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/js/tom-select.complete.min.js"></script>

    <script>
        const division = <?php echo Illuminate\Support\Js::from($division) ?>;
        const foodlist = <?php echo Illuminate\Support\Js::from($food) ?>;
        const foodcategory = <?php echo Illuminate\Support\Js::from($foodCategory) ?>;

        let app = new Vue({
            el: '#app',
            data: {
                division,
                foodlist,
                foodcategory,
                email_organizer: '{{ $emailOrganizer}}',
                title: '',
                department: '',
                description: '',
                start_date: '',
                end_date: '',
                remainderAt: '',
                roomId: '{{ $rooms->id}}',
                participant: [{
                    email: '{{ $emailOrganizer}}',
                }],
                participant_count: '',
                food: [],
                food_count: [],
                loading: false,
            },
            methods: {
                addEmail() {
                    const emailParticipant = {
                        email: '',
                    };
                    this.participant.push(emailParticipant);
                },
                removeEmailParticipant(index) {
                    this.participant.splice(index, 1);
                },
                submitForm: function() {
                    if (this.title == '') {
                        Swal.fire(
                            'There is an error!',
                            'Title cannot be empty .',
                            'warning'
                        )
                    } else if (this.department == '') {
                        Swal.fire(
                            'There is an error!',
                            'Department cannot be empty .',
                            'warning'
                        )
                    } else if (this.start_date == '') {
                        Swal.fire(
                            'There is an error!',
                            'Start Date cannot be empty .',
                            'warning'
                        )
                    } else if (this.end_date == '') {
                        Swal.fire(
                            'There is an error!',
                            'End Date cannot be empty .',
                            'warning'
                        )
                    } else if (this.remainderAt == '') {
                        Swal.fire(
                            'There is an error!',
                            'Reminder For Participants cannot be empty .',
                            'warning'
                        )
                    } else {
                        this.sendData();
                    }
                },
                submitFormOrder: function() {
                    // this.sendDataTes();
                    if (this.title == '') {
                        Swal.fire(
                            'There is an error!',
                            'Title cannot be empty .',
                            'warning'
                        )
                    } else if (this.department == '') {
                        Swal.fire(
                            'There is an error!',
                            'Department cannot be empty .',
                            'warning'
                        )
                    } else if (this.start_date == '') {
                        Swal.fire(
                            'There is an error!',
                            'Start Date cannot be empty .',
                            'warning'
                        )
                    } else if (this.end_date == '') {
                        Swal.fire(
                            'There is an error!',
                            'End Date cannot be empty .',
                            'warning'
                        )
                    } else if (this.remainderAt == '') {
                        Swal.fire(
                            'There is an error!',
                            'Reminder For Participants cannot be empty .',
                            'warning'
                        )
                    } else {
                        this.sendDataOrder();
                    }
                },
                // sendDataTes: function() {
                //     let vm = this;
                //     vm.loading = true;
                //     console.log(this.food);
                //     console.log(this.food_count);
                //     axios.post('/manage-food-ordering/store', {
                //         booking_id: response.data.id,
                //         food: this.food,
                //         pieces: this.food_count,
                //     })
                //     .then(function(response) {
                //         vm.loading = false;
                //         console.log(response.data)
                //     })
                //     .catch(function(error) {
                //         console.log(error);
                //     });
                // },
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
                        remainder_at: this.remainderAt,
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
                sendDataOrder: function() {
                    let vm = this;
                    vm.loading = true;
                    axios.post('/booking', {
                        title: this.title,
                        department: this.department,
                        description: this.description,
                        start_date: this.start_date,
                        end_date: this.end_date,
                        room_id: this.roomId,
                        remainder_at: this.remainderAt,
                        participant: this.participant,
                    })
                    .then((response) => {
                        return axios.post('/manage-food-ordering/store', {
                            booking_id: response.data.id,
                            food: this.food,
                            pieces: this.food_count,
                        })
                        .then(function(response) {
                            vm.loading = false;
                            console.log(response.data)
                        })
                        .catch(function(error) {
                            console.log(error);
                        });
                    })
                    .then((response) => {
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
        });
        
        new TomSelect("#selectdepartment",{
            persist: false,
            createOnBlur: true,
            create: false
        });
    </script>

</body>
</html>