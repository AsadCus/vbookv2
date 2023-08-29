<html>

<head>
    @php
    \Carbon\Carbon::setLocale('id')
    @endphp

    <title>Absen </title>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700">

    <link href="{{ asset('assets/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css">
    {{-- <link href="{{ asset('assets/css/style.bundle.css') }}" rel="stylesheet" type="text/css"> --}}
    <link href="/assets/css/style.bundle.css" rel="stylesheet" type="text/css">
    <link rel="shortcut icon" href="{{ asset('gambar/logo-vbook.png') }}">
    <style>
        @media (min-width: 576px) {
            * {
                font-size: 16px;
            }
        }
        @media (min-width: 992px) {
            * {
                font-size: 13px;
            }
        }
    </style>
</head>

<body class="bg-body">
    <div id="app" class="d-flex flex-column flex-root" v-cloak>
        <div class="d-flex flex-column flex-column-fluid bgi-position-y-bottom position-x-center bgi-no-repeat bgi-size-contain bgi-attachment-fixed">
            <div class="d-flex flex-center flex-column flex-column-fluid p-10 pb-lg-20">
                <a href="#" class="mb-12">
                    <img alt="Logo" src="{{ asset('gambar/logo-vbook.png') }}" class="h-60px" />
                </a>
                <div class="w-lg-30 w-sm-60 bg-body rounded shadow-sm p-10 p-lg-15">
                    <form class="form w-100" @submit.prevent="submitForm" enctype="multipart/form-data">
                        @csrf
                        <div class="fv-row mb-10">
                            <label class="form-label fs-lg-6 fs-sm-4 fw-bolder text-dark">Email</label>
                            <input class="form-control form-control-lg form-control-solid" type="text" v-model="email" autocomplete="off"/>
                        </div>
                        <div class="fv-row mb-10">
                            <label class="form-label fs-lg-6 fs-sm-4 fw-bolder text-dark">PIN</label>
                            <input class="form-control form-control-lg form-control-solid" type="text" v-model="pin" autocomplete="off"/>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-lg btn-primary w-100 mb-5">
                                <span class="indicator-label fs-lg-6 fs-sm-4">Absen</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <script src="{{ asset('assets/plugins/global/plugins.bundle.js') }}"></script>
        <script src="{{ asset('assets/js/scripts.bundle.js') }}"></script>
        <script src="{{ asset('assets/js/custom/authentication/sign-in/general.js') }}"></script>
        <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/vue@2/dist/vue.js"></script>
        
        <script>
            let app = new Vue({
                el: '#app',
                data: {
                    email: '',
                    pin: '',
                    loading: false,
                },
                methods: {
                    submitForm: function() {
                        if (this.email == '') {
                            Swal.fire(
                                'Tejadi kesalahan!',
                                'email harus di isi .',
                                'error'
                            )
                        } else if (this.pin == '') {
                            Swal.fire(
                                'Tejadi kesalahan!',
                                'pin harus di isi .',
                                'error'
                            )
                        } else {
                            this.sendData();
                        }
                    },
                    sendData: function() {
                        let vm = this;
                        vm.loading = true;
                        axios.post('/attendance/post', {
                                email: this.email,
                                pin: this.pin,
                            })  
                            .then(function(response) {
                                // alert(JSON.stringify(response.data.ini.booking_room.status_booking));
                                vm.status = response.data.ini.booking_room.status_booking;
                                if (vm.status == "ongoing") {
                                    vm.tes = `Meeting anda berada di ${JSON.stringify(response.data.ini.booking_room.room.name)}, lantai ${JSON.stringify(response.data.ini.booking_room.room.floor)}.`;
                                } else {
                                    vm.tes = 'Meeting belum dimulai.';
                                }

                                vm.loading = false;
                                Swal.fire({
                                    title: 'Berhasil',
                                    // text: 'Anda Berhasil Absen.',
                                    text: vm.tes,
                                    icon: 'success',
                                    allowOutsideClick: false,
                                })
                                .then((result) => {
                                    if (result.isConfirmed) {
                                        window.location.href = '/attendance';
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
    </div>
</body>

</html>