<!DOCTYPE html>

<html lang="en">
<!--begin::Head-->

<head>

    <title>Login Device Room</title>
    <meta charset="utf-8" />
    <link rel="shortcut icon" href="{{ asset('gambar/logo-vbook.png') }}" />
    <!--begin::Fonts-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
    <!--end::Fonts-->
    <!--begin::Global Stylesheets Bundle(used by all pages)-->
    <link href="{{ asset('assets/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />
    <!--end::Global Stylesheets Bundle-->
</head>
<!--end::Head-->
<!--begin::Body-->
<!-- <div id="app"> -->

<body id="kt_body" class="bg-body">
    <!--begin::Main-->
    <!--begin::Root-->
    <div class="d-flex flex-column flex-root">
        <!--begin::Authentication - Two-stes -->
        <div class="d-flex flex-column flex-column-fluid bgi-position-y-bottom position-x-center bgi-no-repeat bgi-size-contain bgi-attachment-fixed">
            <!--begin::Content-->
            <div class="d-flex flex-center flex-column flex-column-fluid p-10 pb-lg-20">
                <!--begin::Logo-->
                <a href="#" class="mb-12">
                    <img alt="Logo" src="{{ asset('gambar/logo-vbook.png') }}" class="h-40px" />
                </a>
                <!--end::Logo-->
                <!--begin::Wrapper-->
                <div class="w-lg-600px bg-body rounded shadow-sm p-10 p-lg-15 mx-auto">
                    <!--begin::Form-->
                    <form action="{{ route('room.authenticate') }}" method="post" class="form w-100 mb-10" id="kt_sing_in_two_steps_form">
                        @csrf
                        <!--begin::Icon-->
                        <div class="text-center mb-10">
                            <img alt="Logo" class="mh-125px" src="{{ asset('gambar/device.png') }}" />
                        </div>
                        <!--end::Icon-->
                        <!--begin::Heading-->
                        <div class="text-center mb-10">
                            <!--begin::Title-->
                            <h1 class="text-dark mb-3">Login Device Room</h1>
                            @if (isset($errors) && count($errors))

                            <ul>
                                @foreach($errors->all() as $error)
                                <li>{{ $error }} </li>
                                @endforeach
                            </ul>

                            @endif
                        </div>

                        @if (Session::has('error'))
                        <div class="alert alert-dismissible bg-danger d-flex flex-column flex-sm-row p-5 mb-10">
                            <div class="d-flex flex-column text-light pe-0 pe-sm-10">
                                <span>{{ Session::get('error') }}</span>
                            </div>

                        </div>
                        @endif
                        <!--end::Heading-->
                        <!--begin::Section-->
                        <div class="mb-10 px-md-10">
                            <!--begin::Label-->
                            <div class="fw-bolder text-start text-dark fs-6 mb-1 ms-1">Masukan 6 digit PIN</div>
                            <!--end::Label-->
                            <!--begin::Input group-->
                            <div class="d-flex flex-wrap flex-stack">
                                <input type="text" id="n0" name="pin1" data-inputmask="'mask': '9', 'placeholder': ''" maxlength="1" class="inputs form-control form-control-solid h-60px w-60px fs-2qx text-center border-primary border-hover mx-1 my-2" autocomplete="off" autofocus data-next="1" value="" />
                                <input type="text" id="n1" name="pin2" data-inputmask="'mask': '9', 'placeholder': ''" maxlength="1" class="inputs form-control form-control-solid h-60px w-60px fs-2qx text-center border-primary border-hover mx-1 my-2" autocomplete="off" autofocus data-next="2" value="" />
                                <input type="text" id="n2" name="pin3" data-inputmask="'mask': '9', 'placeholder': ''" maxlength="1" class="inputs form-control form-control-solid h-60px w-60px fs-2qx text-center border-primary border-hover mx-1 my-2" autocomplete="off" autofocus data-next="3" value="" />
                                <input type="text" id="n3" name="pin4" data-inputmask="'mask': '9', 'placeholder': ''" maxlength="1" class="inputs form-control form-control-solid h-60px w-60px fs-2qx text-center border-primary border-hover mx-1 my-2" autocomplete="off" autofocus data-next="4" value="" />
                                <input type="text" id="n4" name="pin5" data-inputmask="'mask': '9', 'placeholder': ''" maxlength="1" class="inputs form-control form-control-solid h-60px w-60px fs-2qx text-center border-primary border-hover mx-1 my-2" autocomplete="off" autofocus data-next="5" value="" />
                                <input type="text" id="n5" name="pin6" data-inputmask="'mask': '9', 'placeholder': ''" maxlength="1" class="inputs form-control form-control-solid h-60px w-60px fs-2qx text-center border-primary border-hover mx-1 my-2" value="" />
                            </div>

                            <!--begin::Input group-->
                        </div>
                        <!--end::Section-->
                        <!--begin::Submit-->
                        <div class="d-flex flex-center">
                            <button type="submit" class="btn btn-lg btn-primary fw-bolder">
                                <span class="indicator-label">Masuk</span>
                            </button>
                        </div>
                        <!--end::Submit-->
                    </form>

                </div>
                <!--end::Wrapper-->
            </div>
            <!--end::Content-->

        </div>
        <!--end::Authentication - Two-stes-->
    </div>
    <!--end::Root-->
    <!--end::Main-->
    <!--begin::Javascript-->

    <!--begin::Global Javascript Bundle(used by all pages)-->

    <!--end::Page Custom Javascript-->
    <!--end::Javascript-->
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script> -->
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>


</body>
<!-- </div> -->
<!--end::Body-->
<script type="text/javascript">
    window.setTimeout(function() {
        $(".alert").fadeTo(300, 0).slideUp(300, function() {
            $(this).remove();
        });

    }, 3000);
</script>

<!-- <script>
    $(".inputs").keyup(function() {
        if (this.value.length == this.maxLength) {
            $(this).next('.inputs').focus();
        }
    });
</script> -->

<script>
    $('.inputs').keyup(function(e) {
        if (this.value.length === this.maxLength) {
            let next = $(this).data('next');
            $('#n' + next).focus();
        }
    });
</script>

<!-- <script>
    var container = document.getElementsByClassName("inputs form-control")[0];
    container.onkeyup = function(e) {
        var target = e.srcElement;
        var maxLength = parseInt(target.attributes["maxlength"].value, 10);
        var myLength = target.value.length;
        if (myLength >= maxLength) {
            var next = target;
            while ((next = next.nextElementSibling)) {
                if (next == null) break;
                if (next.tagName.toLowerCase() == "input") {
                    next.focus();
                    break;
                }
            }
        }
    }
</script> -->



<script src="{{ asset('assets/plugins/global/plugins.bundle.js') }}"></script>
<script src="{{ asset('assets/js/scripts.bundle.js') }}"></script>
<!--end::Global Javascript Bundle-->
<!--begin::Page Custom Javascript(used by this page)-->
<script src="{{ asset('assets/js/custom/authentication/sign-in/two-steps.js') }}"></script>

<!-- <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
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
            pin1: '',
            pin2: '',
            pin3: '',
            pin4: '',
            pin5: '',
            pin6: '',
            loading: false,
        },
        computed: {
            pinRoom: function() {
                const self = this;
                const pinRoom1 = self.pin1;
                const pinRoom2 = self.pin2;
                const pinRoom3 = self.pin3;
                const pinRoom4 = self.pin4;
                const pinRoom5 = self.pin5;
                const pinRoom6 = self.pin6;

                return pinRoom1 + pinRoom2 + pinRoom3 + pinRoom4 + pinRoom5 + pinRoom6;

            },
        },
        methods: {
            submitForm: function() {
                this.sendData();
            },
            sendData: function() {
                let vm = this;
                vm.loading = true;
                axios.post('/room/login', {
                    pin: this.pinRoom,
                })
            },

        }
    })
</script> -->

</html>
