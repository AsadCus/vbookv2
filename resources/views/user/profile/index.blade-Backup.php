@extends('app-booking-room.app-booking')
@push('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-daterangepicker/3.0.5/daterangepicker.css" integrity="sha512-gp+RQIipEa1X7Sq1vYXnuOW96C4704yI1n0YB9T/KqdvqaEgL6nAuTSrKufUX3VBONq/TPuKiXGLVgBKicZ0KA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<style>
    #sidebar-wrapper #booking {
        box-shadow: 5px 2px 5px 2px rgba(0, 0, 0, 0.2);
        border-radius: 50px;
        margin: 20px;
        width: 80%;
        color: #343a40;
    }

    .save-close-btn .button a:hover {
        box-shadow: 5px 2px 5px 2px rgba(0, 0, 0, 0.2);
    }

    .button a :active :hover {
        box-shadow: 5px 2px 5px 2px rgba(0, 0, 0, 0.2);
    }

    .list-icon,
    .list-fast {
        margin-bottom: 5px;
    }

    .popup__content {
        width: 40%;
        position: absolute;
        top: 30%;
        left: 60%;
        transform: translate(-50%, -50%);
        z-index: 2;
        opacity: 0;
        visibility: hidden;
    }

    .popup__img {
        display: flex;
        width: 100%;
        margin-bottom: 30px;
    }

    .popup__img img {
        width: 100%;
        display: block;
    }

    .modal-content {
        border-radius: 20px !important;
    }

    #booking-form .modal-content {
        border-radius: 20px !important;
        padding: 30px;
    }

    ul li .dropdown-item i a {
        display: flex;
    }

    .createEvent .modal-content {
        left: 5%;
    }

    /*popup*/
    .popup1 .card1 {
        width: 100%;
        border-radius: 20px;
        padding: 10px;
    }

    .popup1 .card {
        width: 100%;
        border-radius: 20px;
        width: fit-content;
    }

    .popup1 .card1 {
        border-radius: 20px;
        background-color: #fff;
    }

    .col-sm-12 {
        margin: 10px;
    }

    .bangku ul {
        margin-bottom: 0;
    }

    .bangku-hitam i {
        color: #303030;
    }

    .bangku-hijau i {
        color: #33B679;
    }

    .bangku-merah i {
        color: #F31111;
    }

    .map-desk {
        background: #303030;
        border-radius: 20px;
        margin-top: 10px;
    }

    .slideshow-container .text-center {
        position: relative;
        top: 17px;
    }

    .active,
    .popup1 .card-body:hover {
        background-color: #33B679;
        color: white;
    }

    .popup1 .card-body {
        border-top-left-radius: 0;
        border-top-right-radius: 0;
        border-bottom-right-radius: 20px;
        border-bottom-left-radius: 20px;
        padding: 5px;
        color: #000;
    }

    #map .modal-content {
        box-shadow: none;
    }

    .check-list li i {
        margin-left: 2px;
        margin-right: 4px;
    }

    #createEvent .modal-content {
        padding: 20px;
    }

    .map-popup {
        position: absolute;
    }

    .active,
    .popup1 a:hover {
        color: #000
    }

    .active,
    .carousel-item:hover {
        background: none;
    }

    .prev,
    .next {
        cursor: pointer;
        position: relative;
        width: auto;
        padding: 16px;
        margin-top: -22px;
        color: #303030 !important;
        font-weight: bold;
        font-size: 18px;
        transition: 0.6s ease;
        border-radius: 0 3px 3px 0;
        user-select: none;
    }

    .popup1 .border {
        margin-top: 10px;
        margin-right: 10px;
        border: 0.1px solid #33B679 !important;
    }

    @media screen and (max-width:768px) {

        /*
      .popup1 .card {
        width: 10rem;
        left: 20%;
      }
      .popup1 .card-body {
        padding: 0;
        width: 10rem;
      }
      .modal-content {
        width: fit-content;
        left: -24%;
      }
      */
        .card ul {
            padding-left: 0;
        }

        .save-close-btn {
            margin-top: 0;
        }
    }

    @media screen and (max-width:1024px) {
        .save-close-btn {
            margin-top: 0;
        }

        .card ul {
            padding-left: 0;
        }
    }

    .berhasil .modal-content {
        width: max-content !important;
        display: flex;
        align-items: center;
        justify-content: center;
        left: 25%;
    }

    .berhasil h2 {
        font-family: cool;
        color: #1B1A17;
        letter-spacing: 2px;
    }

    @media screen and (max-width:560px) {
        .di-hp-ilang {
            display: none;
        }

        .btn-left-mobile {
            margin-left: 150px !important;
        }
    }

    /*popup end*/
    /*checkedlist*/
    * {
        padding: 0;
        margin: 0
    }

    .checkmark__circle {
        stroke-dasharray: 166;
        stroke-dashoffset: 166;
        stroke-width: 2;
        stroke-miterlimit: 10;
        stroke: #33B679;
        fill: none;
        animation: stroke 0.6s cubic-bezier(0.65, 0, 0.45, 1) forwards
    }

    .checkmark {
        width: 300px;
        height: 300px;
        border-radius: 50%;
        display: block;
        stroke-width: 2;
        stroke: #fff;
        stroke-miterlimit: 10;
        box-shadow: inset 0px 0px 0px #33B679;
        animation: fill .4s ease-in-out .4s forwards, scale .3s ease-in-out .9s both
    }

    .checkmark__check {
        transform-origin: 50% 50%;
        stroke-dasharray: 48;
        stroke-dashoffset: 48;
        animation: stroke 0.3s cubic-bezier(0.65, 0, 0.45, 1) 0.8s forwards;
        color: #33B679;
    }

    @keyframes stroke {
        100% {
            stroke-dashoffset: 0
        }
    }

    @keyframes scale {

        0%,
        100% {
            transform: none
        }

        50% {
            transform: scale3d(1.1, 1.1, 1)
        }
    }

    @keyframes fill {
        100% {
            box-shadow: inset 0px 0px 0px 30px #33B679;
        }
    }

    .pembungkus {
        display: flex;
        justify-content: center;
        align-items: center;
        background-color: #fff;
    }

    .animated-check {
        height: 10em;
        width: 10em;
        position: absolute;
    }

    .animated-check path {
        fill: none;
        stroke: #33B679;
        stroke-width: 4;
        stroke-dasharray: 23;
        stroke-dashoffset: 23;
        animation: draw 1s linear forwards;
        stroke-linecap: round;
        stroke-linejoin: round
    }

    @keyframes draw {
        to {
            stroke-dashoffset: 0
        }
    }

    /*checklist*/
    /*input search*/
    .input-group-text {
        height: 2.4rem;
    }

    /*
      .form-inline .form-control {
        width: 30rem !important;
      }
      */
    /*input search end*/
    /*nav*/
    nav ul li a .fa-solid {
        color: #000;
    }

    .nav-link:hover,
    .nav-link:focus {
        color: #000;
    }

    .nav-link {
        color: #000;
    }

    /*navv end*/
    .card-input-element {
        display: none;
    }

    .card-input-custom {
        max-width: 100% !important;
    }

    .card-input-custom:hover {
        cursor: pointer;
    }

    .card-input-element:checked+.card-input-custom {
        background: #33B679;
        color: white;
    }

    .multiple_emails-container {
        border: 1px solid #ced4da;
        border-radius: 1px;
        box-shadow: inset 0 1px 1px rgba(0, 0, 0, .075);
        padding: 0;
        margin: 0;
        cursor: text;
        width: 100%;
    }

    .multiple_emails-container input {
        width: 100%;
        border: 0;
        outline: none;
        margin-bottom: 30px;
        padding-left: 5px;
    }

    .multiple_emails-container input {
        border: 0 !important;
    }

    .multiple_emails-container input.multiple_emails-error {
        box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075), 0 0 6px red !important;
        outline: thin auto red !important;
    }

    .multiple_emails-container ul {
        list-style-type: none;
        padding-left: 0;
    }

    .multiple_emails-email {
        margin: 3px 5px 3px 5px;
        padding: 3px 5px 3px 5px;
        border: 1px #BBD8FB solid;
        border-radius: 3px;
        background: #F3F7FD;
    }

    .multiple_emails-close {
        float: left;
        margin: 0 3px;
    }

    .participant-table td,
    .participant-table th {
        padding: 3px;
    }

    #showBooking table tr td,
    #showBooking table tr th {
        background-color: white !important;
    }

    hr {
        border-top: 0 !important;
    }

    .fc .fc-row .fc-content-skeleton table,
    .fc .fc-row .fc-content-skeleton td,
    .fc .fc-row .fc-helper-skeleton td {
        border-color: #e5e5e5 !important;
    }
</style>
@endpush
@section('content-booking-room')
<!-- Modal -->
<div id="app">
    <div class="d-flex" id="wrapper" style="overflow-x: unset !important">
        <!-- Sidebar-->
        <div class="border-end bg-white" id="sidebar-wrapper" style="width: 25%;">
            <a href="/booking">
                <button type="button" id="booking" class="btn">
                    <span class=" di-hp-ilang"> KEMBALI </span>
                </button>
            </a>


        </div>
        <!-- Page content wrapper-->
        <div id="page-content-wrapper">
            <!-- Top navigation-->
            <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
                <div class="container-fluid">
                    <ul class="nav justify-content-start ">
                        <li class="nav-item"><button class="btn btn-left-mobile" id="sidebarToggle"><i class="fa-solid fa-bars"></i></button>
                            <div class="collapse navbar-collapse" id="navbarSupportedContent"></div>
                        </li>
                        <li class="nav-item" style="padding:0 !important"><a style="border: none;" href="#"><img src=" {{ asset('assets/booking-room/asset_all_new/Logo1 1.png') }}" alt=""></a></li>
                    </ul>
                    <ul class="nav justify-content-end mr-2">

                        <li class="nav-item dropdown">
                            <a class="nav-link" data-toggle="dropdown" href="#" style="padding: 0 !important">
                                <img style="border-radius: 50%;" src="{{ asset('assets/booking-room/asset_all_new/user.png') }}" alt="" width="85%">
                            </a>
                            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                                <span class="dropdown-item dropdown-header">User Setting</span>
                                <div class="dropdown-divider"></div>
                                @if (auth()->user()->role_id == 2)
                                <a href="#" class="dropdown-item">
                                    {{ auth()->user()->name }}
                                </a>

                                @else
                                <a href="#" class="dropdown-item">
                                    <i class="far fa-user mr-2"></i> My Profile
                                </a>

                                @endif

                                <div class="dropdown-divider"></div>
                                @if (auth()->user()->role_id == 2)
                                <a class="dropdown-item" href="/admin">
                                    <i class="fas fa-sign-out-alt mr-2"></i>Kembali Ke Home
                                </a>
                                @else
                                <a class="dropdown-item" href="/user/logout">
                                    <i class="fas fa-sign-out-alt mr-2"></i> {{ __('Logout') }}
                                </a>
                                @endif



                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
            <div class="wrapper">
                <div>
                    <!-- Main content -->
                    <section class="content">
                        <div class="container">
                            <!-- /.col -->
                            <br>

                            <div class="card mb-4">
                                <div class="card-header">
                                    Profile User
                                </div>
                                <div class="card-body">
                                    <div class="col-12 mb-4">
                                        <div class="row g-3 align-items-center mb-4">
                                            <div class="col-sm-3">
                                                <label for="provincesSelect" class="form-label form-label-sm">Nama</label>
                                            </div>

                                            <div class="col-sm-9">
                                                <span class="fw-bolder text-dark">: &nbsp; {{ auth()->user()->name }}</span>
                                            </div>
                                        </div>

                                        <div class="row g-3 align-items-center mb-4">
                                            <div class="col-sm-3">
                                                <label for="provincesSelect" class="form-label form-label-sm">Email</label>
                                            </div>

                                            <div class="col-sm-9">
                                                <span class="fw-bolder text-dark">: &nbsp; {{ auth()->user()->email }}</span>
                                            </div>
                                        </div>


                                        <div class="row g-3 align-items-center mb-4">
                                            <div class="col-sm-3">
                                                <label for="provincesSelect" class="form-label form-label-sm">No Hp</label>
                                            </div>

                                            <div class="col-sm-9">
                                                <span class="fw-bolder text-dark">: &nbsp; {{ auth()->user()->no_telp ?? '-' }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>

                </div>
            </div>
        </div>


    </div>


</div>
@endsection
@push('script')
<script src="{{ asset('js/multiple-email-form/index.js') }}"></script>

<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script src="https://unpkg.com/vue@next"></script>

<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/vue@2/dist/vue.js"></script>

<script src="https://cdn.jsdelivr.net/npm/cleave.js@1.6.0/dist/cleave.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/vue-cleave-component@2"></script>

<script>
    let app = new Vue({
        el: '#app',
        data: {
            loading: false,
        },
        methods: {

        }
    })
</script>

@endpush
