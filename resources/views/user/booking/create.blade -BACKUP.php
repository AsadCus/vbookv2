@extends('app-booking-room.app-booking')
@push('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-daterangepicker/3.0.5/daterangepicker.css" integrity="sha512-gp+RQIipEa1X7Sq1vYXnuOW96C4704yI1n0YB9T/KqdvqaEgL6nAuTSrKufUX3VBONq/TPuKiXGLVgBKicZ0KA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<link href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Detail Room</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="row g-3 align-items-center mb-4">
                        <div class="col-sm-3">
                            <label for="provincesSelect" class="form-label form-label-sm">Room Name</label>
                        </div>

                        <div class="col-sm-9">
                            <span class="fw-bolder text-dark">: &nbsp; {{ $rooms->name }}</span>
                        </div>
                    </div>

                    <div class="row g-3 align-items-center mb-4">
                        <div class="col-sm-3">
                            <label for="provincesSelect" class="form-label form-label-sm">Capacity</label>
                        </div>

                        <div class="col-sm-9">
                            <span class="fw-bolder text-dark">: &nbsp; {{ $rooms->capacity }}</span>
                        </div>
                    </div>

                    <div class="row g-3 align-items-center mb-4">
                        <div class="col-sm-3">
                            <label for="provincesSelect" class="form-label form-label-sm">Floor</label>
                        </div>

                        <div class="col-sm-9">
                            <span class="fw-bolder text-dark">: &nbsp; {{ $rooms->floor }}</span>
                        </div>
                    </div>

                    <div class="row g-3 align-items-center mb-4">
                        <div class="col-sm-3">
                            <label for="provincesSelect" class="form-label form-label-sm">Projector</label>
                        </div>

                        <div class="col-sm-9">
                            @if ($rooms->projector == 1)
                            <span class="fw-bolder text-dark">: &nbsp; Available</span>
                            @else

                            @endif

                        </div>
                    </div>




                    <div class="row g-3 align-items-center mb-4">
                        <div class="col-sm-3">
                            <label for="provincesSelect" class="form-label form-label-sm">IP Address</label>
                        </div>

                        <div class="col-sm-9">
                            <span class="fw-bolder text-dark">: &nbsp; {{ $rooms->ip_address }}</span>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>
    <div class="d-flex" id="wrapper" style="overflow-x: unset !important">
        <!-- Sidebar-->
        <div class="border-end bg-white" id="sidebar-wrapper" style="width: 25%;">
            <a href="/booking">
                <button type="button" id="booking" class="btn">
                    <span class=" di-hp-ilang"> BACK </span>
                </button>
            </a>

            <div class="sticky-top mb-3">
                <!-- /.card -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Room selected</h3>
                    </div>
                    <div class="card-body">

                        <div class="row no-gutters">
                            <div class="col-md-12">
                                <div class="external-event" data-toggle="modal" data-target="#exampleModal">
                                    {{ $rooms->name }} &nbsp; <span class="badge" style="cursor: pointer;background:{{ $rooms->color_code }};border:0;color:white">-</span>
                                </div>
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

                                            @endif
                                        </b>
                                    </div>

                                </div>


                            </div>
                        </div>

                    </div>
                </div>

            </div>
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
                                <img style="border-radius: 50%;" src="{{ asset('assets/booking-room/asset_all_new/Logo1 1.png') }}" alt="" width="85%">
                            </a>
                            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                                <span class="dropdown-item dropdown-header">User Setting</span>
                                <div class="dropdown-divider"></div>
                                @if (auth()->user()->role_id == 2)
                                <a href="#" class="dropdown-item">
                                    {{ auth()->user()->name }}
                                </a>

                                @else
                                <a href="/user/profile" class="dropdown-item">
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
                            <div class="card card-primary mb-4">
                                <div class="card-body p-4">
                                    <!-- THE CALENDAR -->
                                    <div class="col-12 mb-4">
                                        <form @submit.prevent="submitForm" enctype="multipart/form-data">
                                            @csrf
                                            <div class="mb4">
                                                <h5>Create New Event</h5>
                                                <br>
                                                <br>
                                            </div>


                                            <div class="row form-group container">
                                                <div class="col-2">
                                                    <label for="">Title</label>
                                                </div>

                                                <div class="col-8">
                                                    <input type="text" v-model="title" id="title" class="form-control" placeholder="Title">
                                                </div>

                                            </div>

                                            <div class="row form-group container">
                                                <div class="col-2">
                                                    <label for="">Department</label>
                                                </div>

                                                <div class="col-8">

                                                    <input type="text" v-model="department" id="title" class="form-control" placeholder="Department">
                                                </div>

                                            </div>


                                            <div class="row form-group container">
                                                <div class="col-2">
                                                    <label for="">Description</label>
                                                </div>

                                                <div class="col-8">
                                                    <textarea v-model="description" class="form-control" placeholder="Deskripsi" style="height: 80px"></textarea>
                                                </div>

                                            </div>

                                            <div class="row form-group container">
                                                <div class="col-2">
                                                    <label for="">Participant (Email)</label> <small> Invited participants cannot be more than <b>{{ $rooms->capacity }} users </b> </small>
                                                </div>

                                                <!-- <div class="col-8">
                                                    <input type="text" v-model="partisipans" id="email" class="form-control email_name" placeholder="Email" value=''>
                                                    <div class="mb-2 error-multiple-email-message d-none" style="font-size:13px;color:red">
                                                        Please input
                                                        valid email</div>
                                                    <span class="text-danger error-text partisipans_error" style="font-size: 13px"></span>
                                                </div> -->
                                                <div class="col-8">
                                                    <!-- <select class="form-select" size="3" id="selectEvents" multiple>
                                                        @foreach ($users as $user)
                                                        <option value="{{ $user->email }}">{{ $user->email }}</option>

                                                        @endforeach


                                                    </select> -->
                                                    <textarea v-model="participant" class="form-control" cols="30" rows="10"></textarea>
                                                </div>


                                            </div>

                                            <div class="row form-group container">
                                                <div class="col-2">
                                                    <label for="">Start Date</label>
                                                </div>

                                                <div class="col-8">
                                                    <input type="datetime-local" v-model="start_date" id="start" class="form-control">
                                                </div>

                                            </div>

                                            <div class="row form-group container">
                                                <div class="col-2">
                                                    <label for="">End Date</label>
                                                </div>

                                                <div class="col-8">
                                                    <input type="datetime-local" v-model="end_date" id="end" class="form-control">
                                                </div>

                                            </div>

                                            <div class="save-close-btn d-flex justify-content-end">
                                                <a href="/booking"> <button type="button" class="btn btn-secondary mr-3" data-dismiss="modal">Cancel</button></a>
                                                <button type="submit" class="btn btn-success">
                                                    Booking
                                                </button>
                                            </div>

                                        </form>

                                    </div>
                                </div>
                                <!-- /.card-body -->
                            </div>
                        </div><!-- /.container-fluid -->
                    </section>
                    <!-- /.content -->
                </div>
            </div>
        </div>


    </div>
    <div class="modal fade" id="berhasil" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="pembungkus"> <svg class="checkmark " xmlns="http://www.w3.org/2000/svg" viewBox="0 0 52 52">
                            <circle class="checkmark__circle" cx="26" cy="26" r="25" fill="none" />
                        </svg>
                        <svg class="animated-check" viewBox="0 0 24 24">
                            <path d="M4.1 12.7L9 17.6 20.3 6.3" fill="none" />
                        </svg>
                    </div>
                </div>
                <h2 class="text-center"><b>Berhasil</b></h2>
                <div class="modal-footer d-flex justify-content-center">
                    <button type="button" class="btn btn-transparent" data-dismiss="modal">Close</button>
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
            participant: "",
            roomId: '{{ $rooms->id}}',
            loading: false,
        },
        methods: {

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

@endpush
