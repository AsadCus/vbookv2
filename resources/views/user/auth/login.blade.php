<html>

<head>
    <title>Login User </title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
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
                <a href="../../demo4/dist/index.html" class="mb-12">
                    <img alt="Logo" src="{{ asset('gambar/logo-vbook.png') }}" class="h-40px" />
                </a>
                <div class="w-lg-700px bg-body rounded shadow-sm p-10 p-lg-15 mx-auto">
                    <!--begin::Form-->
                    <form class="form w-100" novalidate="novalidate" id="kt_sign_in_form" data-kt-redirect-url="../../demo4/dist/index.html" action="#">
                        <!--begin::Heading-->
                        <div class="text-center mb-10">
                            @if (Session::has('success'))
                            <div class="card-alert card green">
                                <div class="card-content white-text">
                                    <p> {{ Session::get('success') }}</p>
                                </div>
                                <button type="button" class="close green-text" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>
                            @endif

                            @if (Session::has('error'))
                            <div class="alert alert-dismissible bg-danger d-flex flex-column flex-sm-row p-5 mb-10">
                                <div class="d-flex flex-column text-light pe-0 pe-sm-10">
                                    <span>{{ Session::get('error') }}</span>
                                </div>

                            </div>
                            @endif
                            <!--begin::Title-->

                            <img alt="Logo" src="{{ asset('gambar/Meeting.png') }}" width="150px" class="mb-4" />
                            <h1 class="text-dark mb-4">Login V-BOOK</h1>

                        </div>

                        <div class="text-center">
                            <a href="/auth/google" class="btn btn-flex flex-center btn-light-primary btn-lg w-100 mb-5">
                                <img alt="Logo" src="assets/media/svg/brand-logos/google-icon.svg" class="h-20px me-3" />Login Dengan Google</a>

                            <!-- <div class="text-gray-400 fw-bold fs-4 mb-5">Tidak Punya Akun ?
                                <a href="../../demo4/dist/authentication/layouts/basic/sign-up.html" class="link-primary fw-bolder">Pendaftaran Akun</a>
                            </div> -->
                        </div>

                        <div class="text-center">
                            <a href="/auth/microsoft" class="btn btn-flex flex-center btn-light-primary btn-lg w-100 mb-5">
                                <img alt="Logo" src="gambar/365-logo.jpg" class="h-20px me-3" />Login Dengan Office365</a>

                            <!-- <div class="text-gray-400 fw-bold fs-4 mb-5">Tidak Punya Akun ?
                                <a href="../../demo4/dist/authentication/layouts/basic/sign-up.html" class="link-primary fw-bolder">Pendaftaran Akun</a>
                            </div> -->
                        </div>


                        <!--end::Actions-->
                    </form>
                    <!--end::Form-->
                </div>
                <!--end::Wrapper-->
            </div>
        </div>
        <!--end::Authentication - Sign-in-->
    </div>
    <script type="text/javascript">
        window.setTimeout(function() {
            $(".alert").fadeTo(300, 0).slideUp(300, function() {
                $(this).remove();
            });

        }, 3000);
    </script>
    <script src="{{ asset('assets/plugins/global/plugins.bundle.js') }}"></script>
    <script src="{{ asset('assets/js/scripts.bundle.js') }}"></script>
    <script src="{{ asset('assets/js/custom/authentication/sign-in/general.js') }}"></script>
</body>

</html>