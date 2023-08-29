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
<div class="modal fade" id="showBooking" tabindex="1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <h5 class="modal-title" id="eventTitleDetail">Detail Booking</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <input type="hidden" name="id_event" id="id_event">
            <div class="modal-body show-view-booking pt-3" style="padding: 0 !important">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" data-dismiss="modal" id="" class="btn btn-success">Ok</button>
            </div>
            </form>
        </div>
    </div>
</div>
<div class="d-flex" id="wrapper" style="overflow-x: unset !important">
    <!-- Sidebar-->
    <div class="border-end bg-white" id="sidebar-wrapper" style="width: 25%;">

        <button type="button" id="booking" class="btn">
            <span class=" di-hp-ilang">BOOKING</span> <i class="fa-solid fa-plus"></i>
        </button>

        <div class="sticky-top mb-3">
            <!-- /.card -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Booking Room</h3>
                </div>
                <div class="card-body">
                    @foreach ($bookings as $booking)
                    <div class="row no-gutters">
                        <div class="col-md-12">
                            <div class="external-event" data-url="" id="detailRoom" style="cursor: pointer;background:{{ $booking->room->color_code }};border:0;color:white">
                                {{ $booking->room->name }}
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <h5>MY EVENT</h5>
                    <hr>
                    <div id="external-event">
                        <div class="row">
                            @foreach ($bookings as $booking)
                            <span>{{ $booking->title }}</span>
                            @endforeach
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->
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
                            <img style="border-radius: 50%;" src="{{ asset('assets/booking-room/asset_all_new/user.png') }}" alt="" width="85%">
                        </a>
                        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                            <span class="dropdown-item dropdown-header">User Setting</span>
                            <div class="dropdown-divider"></div>
                            <a href="#" class="dropdown-item">
                                <i class="far fa-user mr-2"></i> My Profile
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="/user/logout">
                                <i class="fas fa-sign-out-alt mr-2"></i> {{ __('Logout') }}
                            </a>
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
                        <div class="card card-primary">
                            <div class="card-body p-0">
                                <!-- THE CALENDAR -->
                                <div id="full_calendar_events"></div>
                            </div>
                            <!-- /.card-body -->
                        </div>
                    </div><!-- /.container-fluid -->
                </section>
                <!-- /.content -->
            </div>
        </div>
    </div>
    <div class="modal fade bd-example-modal-lg room-modal-data" id="pilih-ruangan" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="overflow-y: scroll;">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="popup1" id="popup1">
                    <div class="card1">
                        <div class="row">
                            <div data-spy="scroll" class="col-md-8">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <form class="form-inline" action="/room/cari" method="POST" id="formSeachRoom">
                                            @csrf
                                            <div class="input-group">
                                                <div class="input-group mb-3">
                                                    <input type="text" class="form-control" placeholder="Cari ruangan ..." aria-label="room" id="search_room">
                                                    <div class="input-group-append">
                                                        <button type="submit" id="search_room_btn" class="btn btn-secondary" type="button"><i class="fa-solid fa-magnifying-glass"></i></button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <div class="row" id="all_room_data" style="overflow: auto;">
                                    @foreach ($rooms as $key => $room)
                                    <div class="col-sm-6">
                                        <label class="label-room">
                                            <input type="radio" name="m_room_id" value="{{ $room->id }}" id="{{ $key }}" class="card-input-element m_room_id" id="m_room_id">
                                            <div class="card active card-input-custom">
                                                <img class="card-img-top" src="{{ asset('assets/booking-room/asset_all_new/room.png') }}" alt="Card image cap">
                                                <div class="diklik active card-body" style="padding:13px">
                                                    <div class="row">
                                                        <div class="col-sm">
                                                            <div class="room_card">
                                                                {{ $room->name }}
                                                            </div>
                                                            <div class="floor_card">{{ $room->floor }}</div>
                                                        </div>


                                                        <div class="col-sm d-flex">
                                                            <ul class="check-list d-flex list-unstyled">
                                                                <li><i class="fa-solid fa-user fa-2xs"></i>
                                                                    <i class="fa-solid fa-2xs">{{ $room->kapasitas }}</i>
                                                                </li>
                                                                <li><i class="fa-solid fa-tv fa-2xs"></i>
                                                                    @if ($room->projector == 1)
                                                                    <i class="fa-solid fa-check fa-2xs"></i>
                                                                    @else
                                                                    <i class="fa-solid fa-close fa-2xs"></i>
                                                                    @endif
                                                                </li>
                                                                <li><i class="fa-solid fa-wifi fa-2xs"></i>
                                                                    @if ($room->internet == 1)
                                                                    <i class="fa-solid fa-check fa-2xs"></i>
                                                                    @else
                                                                    <i class="fa-solid fa-close fa-2xs"></i>
                                                                    @endif
                                                                </li>
                                                            </ul>
                                                        </div>


                                                    </div>
                                                </div>
                                            </div>
                                        </label>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                            <div class="modal-footer">
                                <div class="save-close-btn d-flex justify-content-end">
                                    <button type="button" class="btn btn-transparent mr-3" data-dismiss="modal">Cancel</button>
                                    <button data-url="/room/simpan" type="button" id="openCreateEvent" class="btn btn-dark" style="cursor: not-allowed;pointer-events: all !important;" disabled>
                                        Booking
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade bd-example-modal-lg" id="map" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content" style="background-color: #303030;">
                <div class="modal-kepala">
                    <button type="button" class="close mr-3 text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <img src="assets/Map 2.png" alt="">
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="createEvent" data-backdrop-limit="1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-modal-parent="#pilih-ruangan">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header" style="border:0">
                </div>
                <div class="modal-body" style="padding:0">
                    <h4 class="form-header room_name"></h4>
                    <h5 class="form-header floor_name"></h5>
                    {{-- <hr> --}}
                    <form action="" method="POST" id="formData">
                        <input type="hidden" name="_method" value="" id="method">
                        @csrf
                        <div class="form-group">
                            <label for="">Title</label>
                            <input type="text" name="title" id="title" class="form-control" placeholder="Title">
                            <span class="text-danger error-text title_error" style="font-size: 13px"></span>
                        </div>
                        <div class="form-group">
                            <label for="">Department</label>
                            <select name="department" id="department" class="form-control">
                                <option value="">---</option>
                                @php
                                $department = [' Divisi IT', 'Divisi Umum', 'Divisi Finance'];
                                @endphp
                                <option value="Divisi IT">Divisi IT</option>
                                <option value="Divisi Umum">Divisi Umum</option>
                                <option value="Divisi Finance">Divisi Finance</option>
                            </select>
                            <span class="text-danger error-text department_error" style="font-size: 13px"></span>
                        </div>
                        <div class="form-group">
                            <label for="">Description</label>
                            <textarea name="descripsion" id="descripsion" class="form-control" placeholder="Description" style="height: 80px"></textarea>
                            <span class="text-danger error-text descripsion_error" style="font-size: 13px"></span>
                        </div>
                        <div class="form-group">
                            <label for="">Partisipans (Email)</label>
                            <div class="text-error mb-2" style="font-size:13px">Enter tab to multiple email</div>
                            <div class="input-group input-group-md">
                                <input type="text" name="partisipans" id="email" class="form-control email_name" placeholder="Email" value=''>
                                <div class="mb-2 error-multiple-email-message d-none" style="font-size:13px;color:red">
                                    Please input
                                    valid email</div>
                                <span class="text-danger error-text partisipans_error" style="font-size: 13px"></span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Start Date</label>
                                    <input type="datetime-local" name="start" id="start" class="form-control">
                                    <span class="text-danger error-text start_error" style="font-size: 13px"></span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">End Date</label>
                                    <input type="datetime-local" name="end" id="end" class="form-control">
                                    <span class="text-danger error-text end_error" style="font-size: 13px"></span>
                                </div>
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-transparent mr-3" data-dismiss="modal">Cancel</button>
                    <button type="submit" id="btn-create" class="btn btn-dark">
                        Booking Now
                    </button>
                </div>
                </form>
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
@endsection
@push('script')
<script src="{{ asset('js/multiple-email-form/index.js') }}"></script>
<script>
    $(document).on('show.bs.modal', '.modal', function() {
        // run your validation... ( or shown.bs.modal )
        $('.error-text').text('');
        $('#descripsion').text('');
    });
    $(document).on('hide.bs.modal', '.modal', function() {
        // loadList();
        $('.opacity').addClass('d-none').css({
            'cursor': 'default'
        });
    });

    $(document).on('click', '#booking', function() {
        $('#pilih-ruangan').modal('show');
    })
</script>


<script>
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        var booking = @json($events);
        $('#full_calendar_events').fullCalendar({
            header: {
                left: 'prev, next today',
                center: 'title',
                right: 'month, agendaWeek, agendaDay',
            },
            events: booking,
            selectable: true,
            selectHelper: true,
            editable: true,
            eventLimit: 5,
            eventLimitText: "more",
            displayEventTime: true,
            selectable: true,
            selectHelper: true,
            editable: false,
            disableDragging: true,
            selectHelper: true,

            selectAllow: function(event) {
                return moment(event.start).utcOffset(false).isSame(moment(event.end).subtract(1, 'second').utcOffset(false), 'day');
            },
        });

    });
</script>
@endpush
