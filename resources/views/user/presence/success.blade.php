<html>

<head>
    <title>Absen Hadir </title>
    <meta charset="utf-8" />
    <link rel="stylesheet" href='https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700'>


    <link href="{{ asset('assets/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/css/style.bundle.css') }}" rel="stylesheet" type="text/css">
    <link rel="shortcut icon" href="{{ asset('gambar/logo-vbook.png') }}">
</head>


<body id="kt_body" class="bg-body">
    <div class="d-flex flex-column flex-root">
        <!--begin::Authentication - Sign-in -->
        <div class="d-flex flex-column flex-column-fluid bgi-position-y-bottom position-x-center bgi-no-repeat bgi-size-contain bgi-attachment-fixed">
            <!--begin::Content-->
            <div class="d-flex flex-center flex-column flex-column-fluid p-10 pb-lg-20">
                <!--begin::Logo-->
                <a href="#" class="mb-12">
                    <img alt="Logo" src="{{ asset('gambar/logo-vbook.png') }}" class="h-40px" />
                </a>
                <div class="w-lg-500px bg-body rounded shadow-sm p-10 p-lg-15 mx-auto">
                    <!--begin::Form-->

                    <!--begin::Heading-->
                    <div class="mb-10">
                        <!--begin::Title-->
                        <div class="text-center mb-4">
                            <img alt="Logo" src="{{ asset('gambar/selesai.png') }}" class="h-65px" />
                        </div>
                        <h5 class="text-dark mb-4">Selamat Anda Berhasil Konfirmasi Kehadiran <br> dengan Rincian : </h5>

                        <div class="alert alert-success mb-4">
                            <div class="d-flex flex-column">
                                <div class="row col-12 mb-2">
                                    <div class="col-6">
                                        <span class="text-dark">Judul</span>
                                    </div>
                                    <div class="col-6">
                                        <span class="text-dark">: &nbsp; {{ $booking_room->title }}</span>
                                    </div>
                                </div>

                                <div class="row col-12 mb-2">
                                    <div class="col-6">
                                        <span class="text-dark">Tanggal </span>
                                    </div>
                                    <div class="col-6">
                                        <span class="text-dark">: &nbsp; {{\Carbon\Carbon::parse($booking_room->start_date)->toFormattedDateString() }}</span>
                                    </div>
                                </div>

                                <div class="row col-12 mb-2">
                                    <div class="col-6">
                                        <span class="text-dark">Status</span>
                                    </div>
                                    <div class="col-6">
                                        @if ($booking_room->status_booking == 'ongoing')
                                        : &nbsp;<span class="text-dark"> Sedang Berlangsung</span>
                                        @endif
                                        @if ($booking_room->status_booking == 'waiting')
                                        : &nbsp;<span class="text-dark"> Belum Dimulai</span>
                                        @endif
                                        @if ($booking_room->status_booking == 'finished')
                                        : &nbsp; <span class="text-dark"> Selesai</span>
                                        @endif
                                    </div>
                                </div>

                                <!--end::Content-->
                            </div>
                            <!--end::Wrapper-->
                        </div>

                    </div>

                    <div class="text-center">
                        <a href="/user"> <button class="btn btn-primary">Kembali Ke halaman awal</button></a>
                    </div>


                </div>
                <!--end::Wrapper-->
            </div>
        </div>
        <!--end::Authentication - Sign-in-->
    </div>
    <script>
        var hostUrl = "assets/";
    </script>
    <script src="{{ asset('assets/plugins/global/plugins.bundle.js') }}"></script>
    <script src="{{ asset('assets/js/scripts.bundle.js') }}"></script>
    <script src="{{ asset('assets/js/custom/authentication/sign-in/general.js') }}"></script>
</body>

</html>