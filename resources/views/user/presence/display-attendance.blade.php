<html>

<head>
    @php
    \Carbon\Carbon::setLocale('id')
    @endphp

    <title>Display </title>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700">
    <link href="{{ asset('assets/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css">
    <link href="/assets/css/style.bundle.css" rel="stylesheet" type="text/css">
    <link rel="shortcut icon" href="{{ asset('gambar/logo-vbook.png') }}">

    <style>
        @media (min-width: 576px) {
            * {
                font-size: 16px;
            }
            h4 {
                font-size: 20px;
            }
        }
        @media (min-width: 992px) {
            * {
                font-size: 13px;
            }
            h4 {
                font-size: 16px;
            }
        }
    </style>
</head>
<body class="bg-body">
    <div class="d-flex flex-column flex-root" id="app" v-cloak>
        <div class="d-flex flex-column flex-column-fluid bgi-position-y-bottom position-x-center bgi-no-repeat bgi-size-contain bgi-attachment-fixed">
            <div class="d-flex flex-center flex-column flex-column-fluid p-10 pb-lg-20">
                <a href="#" class="mb-12"><img alt="Logo" src="{{ asset('gambar/logo-vbook.png') }}" class="h-60px" /></a>
                <div class="w-lg-40 w-sm-75 bg-body rounded shadow-sm p-10 p-lg-15 mx-auto">
                    <form class="form w-100" @submit.prevent="submitForm" enctype="multipart/form-data">
                        @csrf
                        <div class="text-center mb-10">
                            <h4 class="text-dark mb-2">Absen Partisipan</h4>
                        </div>
                        @if ($booking->status_booking == 'ongoing')
                        <div class="alert alert-primary">
                            <div class="d-flex flex-column">
                                <div class="row col-12 mb-2">
                                    <div class="col-4">
                                        <span class="text-dark">Judul</span>
                                    </div>
                                    <div class="col-8">
                                        <span class="text-dark">: &nbsp; {{ $booking->title }}</span>
                                    </div>
                                </div>
                                <div class="row col-12 mb-2">
                                    <div class="col-4">
                                        <span class="text-dark">Tanggal </span>
                                    </div>
                                    <div class="col-8">
                                        <span class="text-dark">: &nbsp; {{\Carbon\Carbon::parse($booking->start_date)->toFormattedDateString() }}</span>
                                    </div>
                                </div>
                                <div class="row col-12 mb-2">
                                    <div class="col-4">
                                        <span class="text-dark">Status</span>
                                    </div>
                                    <div class="col-8">
                                        @if ($booking->status_booking == 'ongoing')
                                        : &nbsp;<span class="text-dark"> Sedang Berlangsung</span>
                                        @endif
                                        @if ($booking->status_booking == 'waiting')
                                        : &nbsp;<span class="text-dark"> Belum Dimulai</span>
                                        @endif
                                        @if ($booking->status_booking == 'finished')
                                        : &nbsp; <span class="text-dark"> Selesai</span>
                                        @endif
                                    </div>
                                </div>
                                <br>
                                <br>
                                <div class="card shadow-sm">
                                    <div class="card-header">
                                        <h5 class="card-title">Partisipan</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="row col-12 mb-2">
                                            @foreach ($booking->participant as $participant)
                                            <div class="col-8">
                                                <span class="text-dark">
                                                    {{$participant->email}}
                                                </span>
                                            </div>
                                            <div class="col-4">
                                                @if ($participant->participant_confirmation == 1)
                                                : &nbsp; <span class="badge badge-warning"> Belum Absen</span>
                                                @endif

                                                @if ($participant->participant_confirmation == 2)
                                                : &nbsp; <span class="badge badge-success"> Hadir</span>
                                                @endif

                                                @if ($participant->participant_confirmation == 3)
                                                : &nbsp; <span class="badge badge-danger"> Tidak Hadir</span>
                                                @endif
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @elseif($booking->status_booking == 'waiting')
                        <div class="alert alert-warning">
                            <div class="d-flex flex-column">
                                <div class="row col-12 mb-2">
                                    <div class="col-4">
                                        <span class="text-dark">Judul</span>
                                    </div>
                                    <div class="col-8">
                                        <span class="text-dark">: &nbsp; {{ $booking->title }}</span>
                                    </div>
                                </div>
                                <div class="row col-12 mb-2">
                                    <div class="col-4">
                                        <span class="text-dark">Tanggal </span>
                                    </div>
                                    <div class="col-8">
                                        <span class="text-dark">: &nbsp; {{\Carbon\Carbon::parse($booking->start_date)->toFormattedDateString() }}</span>
                                    </div>
                                </div>
                                <div class="row col-12 mb-2">
                                    <div class="col-4">
                                        <span class="text-dark">Status</span>
                                    </div>
                                    <div class="col-8">
                                        @if ($booking->status_booking == 'ongoing')
                                        : &nbsp;<span class="text-dark"> Sedang Berlangsung</span>
                                        @endif
                                        @if ($booking->status_booking == 'waiting')
                                        : &nbsp;<span class="text-dark"> Belum Dimulai</span>
                                        @endif
                                        @if ($booking->status_booking == 'finished')
                                        : &nbsp; <span class="text-dark"> Selesai</span>
                                        @endif
                                    </div>
                                </div>
                                <br>
                                <br>
                                <div class="card shadow-sm">
                                    <div class="card-header">
                                        <h5 class="card-title">Participan</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="row col-12 mb-2">
                                            @foreach ($booking->participant as $participant)
                                            <div class="col-8">
                                                <span class="text-dark">
                                                    {{$participant->email}}
                                                </span>
                                            </div>
                                            <div class="col-4">
                                                @if ($participant->participant_confirmation == 1)
                                                : &nbsp; <span class="badge badge-warning"> Belum Absen</span>
                                                @endif
                                                @if ($participant->participant_confirmation == 2)
                                                : &nbsp; <span class="badge badge-success"> Hadir</span>
                                                @endif
                                                @if ($participant->participant_confirmation == 3)
                                                : &nbsp; <span class="badge badge-danger"> Tidak Hadir</span>
                                                @endif
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @else
                        <div class="alert alert-danger">
                            <div class="d-flex flex-column">
                                <div class="row col-12 mb-2">
                                    <div class="col-4">
                                        <span class="text-dark">Judul</span>
                                    </div>
                                    <div class="col-8">
                                        <span class="text-dark">: &nbsp; {{ $booking->title }}</span>
                                    </div>
                                </div>
                                <div class="row col-12 mb-2">
                                    <div class="col-4">
                                        <span class="text-dark">Tanggal </span>
                                    </div>
                                    <div class="col-8">
                                        <span class="text-dark">: &nbsp; {{\Carbon\Carbon::parse($booking->start_date)->toFormattedDateString() }}</span>
                                    </div>
                                </div>
                                <div class="row col-12 mb-2">
                                    <div class="col-4">
                                        <span class="text-dark">Status</span>
                                    </div>
                                    <div class="col-8">
                                        @if ($booking->status_booking == 'ongoing')
                                        : &nbsp;<span class="text-dark"> Sedang Berlangsung</span>
                                        @endif
                                        @if ($booking->status_booking == 'waiting')
                                        : &nbsp;<span class="text-dark"> Belum Dimulai</span>
                                        @endif
                                        @if ($booking->status_booking == 'finished')
                                        : &nbsp; <span class="text-dark"> Selesai</span>
                                        @endif
                                    </div>
                                </div>
                                <br>
                                <br>
                                <div class="card shadow-sm">
                                    <div class="card-header">
                                        <h5 class="card-title">Participan</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="row col-12 mb-2">
                                            @foreach ($booking->participant as $participant)
                                            <div class="col-8">
                                                <span class="text-dark">
                                                    {{$participant->email}}
                                                </span>
                                            </div>
                                            <div class="col-4">
                                                @if ($participant->participant_confirmation == 1)
                                                : &nbsp; <span class="badge badge-warning"> Belum Absen</span>
                                                @endif
                                                @if ($participant->participant_confirmation == 2)
                                                : &nbsp; <span class="badge badge-success"> Hadir</span>
                                                @endif
                                                @if ($participant->participant_confirmation == 3)
                                                : &nbsp; <span class="badge badge-danger"> Tidak Hadir</span>
                                                @endif
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                        @if ($booking->status_booking == 'ongoing')
                        <input type="hidden" v-model="bookingId" value="booking.id">
                        <div class="fv-row mb-10">
                            <label class="form-label fs-lg-6 fs-sm-4 fw-bolder text-dark">Email</label>
                            <input class="form-control form-control-lg form-control-solid" type="text" v-model="email" autocomplete="off" />
                        </div>
                        <div class="fv-row mb-10">
                            <label class="form-label fs-lg-6 fs-sm-4 fw-bolder text-dark">PIN</label>
                            <input class="form-control form-control-lg form-control-solid" type="text" v-model="pin" autocomplete="off" />
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-lg btn-primary w-100 mb-5">
                                <span class="indicator-label fs-lg-6 fs-sm-4">Absen</span>
                            </button>
                        </div>
                        @endif
                    </form>
                    <div class="text-center mb-4">
                        <a href="/room"><button class="btn btn-secondary fs-lg-6 fs-sm-4">Kembali</button></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

<script src="{{ asset('assets/plugins/global/plugins.bundle.js') }}"></script>
<script src="{{ asset('assets/js/scripts.bundle.js') }}"></script>
<script src="{{ asset('assets/js/custom/authentication/sign-in/general.js') }}"></script>
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/vue@2/dist/vue.js"></script>

<script>
    const booking = <?php echo Illuminate\Support\Js::from($booking) ?>;
    let app = new Vue({
        el: '#app',
        data: {
            booking,
            bookingId: '{!! $booking->id !!}',
            name: '',
            email: '',
            pin: '',
            password: '',
            loading: false,
        },
        methods: {
            submitForm: function() {
                if (this.email == '') {
                    Swal.fire(
                        'Tejadi kesalahan!',
                        'Email harus di isi.',
                        'warning'
                    )
                } else if (this.pin == '') {
                    Swal.fire(
                        'Tejadi kesalahan!',
                        'PIN harus di isi.',
                        'warning'
                    )
                } else {
                    this.sendData();
                }
            },
            sendData: function() {
                let vm = this;
                vm.loading = true;
                axios.post('/participants-attended/display-presence', {
                    email: this.email,
                    pin: this.pin,
                    booking_id: this.bookingId,
                })
                .then(function(response) {
                    vm.loading = false;
                    Swal.fire({
                        title: 'Berhasil',
                        text: 'Anda Berhasil Absen.',
                        icon: 'success',
                        allowOutsideClick: false,
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = `/participants-attended/${response.data.id}/display-presence`;
                        }
                    })
                })
                .catch(function(error) {
                    vm.loading = false;
                    console.log(error);
                    Swal.fire({
                        title: 'warning',
                        error: true,
                        icon: 'warning',
                        text: error.response.data.message,
                    })
                });
            },
        }
    })
</script>


</html>