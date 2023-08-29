@extends('layouts.app')

@section('title', 'Merge Room')

@section('prehead')
<link href="{{ asset('assets/plugins/custom/fullcalendar/fullcalendar.bundle.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css" />
@endsection

@inject('carbon', 'Carbon\Carbon')
@inject('carbonInterval', 'Carbon\CarbonInterval')

@section('content')
<div id="app" v-cloak>


    <!--begin::Content-->
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <!--begin::Container-->
        <div class="container-xxl" id="kt_content_container">



            <form @submit.prevent="submitForm" enctype="multipart/form-data" id="kt_ecommerce_add_product_form" class="form d-flex flex-column flex-lg-row" data-kt-redirect="../../demo4/dist/apps/ecommerce/catalog/products.html">
                <!--begin::Aside column-->



                <div class="d-flex flex-column flex-row-fluid gap-7 gap-lg-10">


                    <div class="d-flex flex-column gap-7 gap-lg-10">
                        <!--begin::Inventory-->
                        <div class="card card-flush py-4">
                            <!--begin::Card header-->
                            <div class="card-header">
                                <div class="card-title">
                                    <h2>Merge Room</h2>
                                </div>
                            </div>
                            <div class="card-body pt-0">

                                <div class="mb-10 fv-row">

                                    <div class="col-lg-12">
                                        <div class="row align-items-center">
                                            <div class="col-4 mb-4">

                                                <div class="card bg-primary shadow-sm">
                                                    <div class="card-header">

                                                        <h3 class="card-title text-white">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-tv" viewBox="0 0 16 16">
                                                                <path d="M2.5 13.5A.5.5 0 0 1 3 13h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zM13.991 3l.024.001a1.46 1.46 0 0 1 .538.143.757.757 0 0 1 .302.254c.067.1.145.277.145.602v5.991l-.001.024a1.464 1.464 0 0 1-.143.538.758.758 0 0 1-.254.302c-.1.067-.277.145-.602.145H2.009l-.024-.001a1.464 1.464 0 0 1-.538-.143.758.758 0 0 1-.302-.254C1.078 10.502 1 10.325 1 10V4.009l.001-.024a1.46 1.46 0 0 1 .143-.538.758.758 0 0 1 .254-.302C1.498 3.078 1.675 3 2 3h11.991zM14 2H2C0 2 0 4 0 4v6c0 2 2 2 2 2h12c2 0 2-2 2-2V4c0-2-2-2-2-2z" />
                                                            </svg> &nbsp; &nbsp;
                                                            DEVICE 1
                                                        </h3>

                                                    </div>
                                                    <div class="card-body">
                                                        <select class="form-select mb-2" v-model="accountDevice1">
                                                            <option value="">- SELECT AKUN DEVICE 1 -</option>
                                                            <option v-for="devices in device" :value="devices.id">AKUN - @{{ devices.name }}</option>
                                                        </select>
                                                        <div>
                                                            <label class="required form-label text-white">IP Address</label>
                                                            <input type="text" v-model="ipAddressDevice1" class="form-control mb-2" placeholder="ex : 192.168.X.XXXX" />
                                                        </div>

                                                    </div>

                                                </div>

                                            </div>

                                            <div class="col-4 mb-4">
                                                <div class="card bg-primary shadow-sm">

                                                    <div class="card-body text-center text-white">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-bar-left" viewBox="0 0 16 16">
                                                            <path fill-rule="evenodd" d="M12.5 15a.5.5 0 0 1-.5-.5v-13a.5.5 0 0 1 1 0v13a.5.5 0 0 1-.5.5ZM10 8a.5.5 0 0 1-.5.5H3.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L3.707 7.5H9.5a.5.5 0 0 1 .5.5Z" />
                                                        </svg>
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-hospital" viewBox="0 0 16 16">
                                                            <path d="M8.5 5.034v1.1l.953-.55.5.867L9 7l.953.55-.5.866-.953-.55v1.1h-1v-1.1l-.953.55-.5-.866L7 7l-.953-.55.5-.866.953.55v-1.1h1ZM13.25 9a.25.25 0 0 0-.25.25v.5c0 .138.112.25.25.25h.5a.25.25 0 0 0 .25-.25v-.5a.25.25 0 0 0-.25-.25h-.5ZM13 11.25a.25.25 0 0 1 .25-.25h.5a.25.25 0 0 1 .25.25v.5a.25.25 0 0 1-.25.25h-.5a.25.25 0 0 1-.25-.25v-.5Zm.25 1.75a.25.25 0 0 0-.25.25v.5c0 .138.112.25.25.25h.5a.25.25 0 0 0 .25-.25v-.5a.25.25 0 0 0-.25-.25h-.5Zm-11-4a.25.25 0 0 0-.25.25v.5c0 .138.112.25.25.25h.5A.25.25 0 0 0 3 9.75v-.5A.25.25 0 0 0 2.75 9h-.5Zm0 2a.25.25 0 0 0-.25.25v.5c0 .138.112.25.25.25h.5a.25.25 0 0 0 .25-.25v-.5a.25.25 0 0 0-.25-.25h-.5ZM2 13.25a.25.25 0 0 1 .25-.25h.5a.25.25 0 0 1 .25.25v.5a.25.25 0 0 1-.25.25h-.5a.25.25 0 0 1-.25-.25v-.5Z" />
                                                            <path d="M5 1a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v1a1 1 0 0 1 1 1v4h3a1 1 0 0 1 1 1v7a1 1 0 0 1-1 1H1a1 1 0 0 1-1-1V8a1 1 0 0 1 1-1h3V3a1 1 0 0 1 1-1V1Zm2 14h2v-3H7v3Zm3 0h1V3H5v12h1v-3a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v3Zm0-14H6v1h4V1Zm2 7v7h3V8h-3Zm-8 7V8H1v7h3Z" />
                                                        </svg>
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-bar-right" viewBox="0 0 16 16">
                                                            <path fill-rule="evenodd" d="M6 8a.5.5 0 0 0 .5.5h5.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3a.5.5 0 0 0 0-.708l-3-3a.5.5 0 0 0-.708.708L12.293 7.5H6.5A.5.5 0 0 0 6 8Zm-2.5 7a.5.5 0 0 1-.5-.5v-13a.5.5 0 0 1 1 0v13a.5.5 0 0 1-.5.5Z" />
                                                        </svg>
                                                        <h4 class="text-white"> PILIH RUANGAN</h4>

                                                        <select class="form-select mb-2" v-model="roomId">
                                                            <option value="">- SELECT ROOM -</option>
                                                            <option v-for="rooms in room" :value="rooms.id">@{{ rooms.name }}</option>
                                                        </select>
                                                    </div>

                                                </div>
                                            </div>

                                            <div class="col-4 mb-4">
                                                <div class="card bg-primary shadow-sm">
                                                    <div class="card-header">
                                                        <h3 class="card-title text-white">

                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-tv" viewBox="0 0 16 16">
                                                                <path d="M2.5 13.5A.5.5 0 0 1 3 13h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zM13.991 3l.024.001a1.46 1.46 0 0 1 .538.143.757.757 0 0 1 .302.254c.067.1.145.277.145.602v5.991l-.001.024a1.464 1.464 0 0 1-.143.538.758.758 0 0 1-.254.302c-.1.067-.277.145-.602.145H2.009l-.024-.001a1.464 1.464 0 0 1-.538-.143.758.758 0 0 1-.302-.254C1.078 10.502 1 10.325 1 10V4.009l.001-.024a1.46 1.46 0 0 1 .143-.538.758.758 0 0 1 .254-.302C1.498 3.078 1.675 3 2 3h11.991zM14 2H2C0 2 0 4 0 4v6c0 2 2 2 2 2h12c2 0 2-2 2-2V4c0-2-2-2-2-2z" />
                                                            </svg> &nbsp; &nbsp;
                                                            DEVICE 2
                                                        </h3>

                                                    </div>
                                                    <div class="card-body">
                                                        <select class="form-select mb-2" v-model="accountDevice2">
                                                            <option value="">- SELECT AKUN DEVICE 2 -</option>
                                                            <option v-for="devices in device" :value="devices.id">AKUN - @{{ devices.name }}</option>
                                                        </select>
                                                        <div>
                                                            <label class="required form-label text-white">IP Address</label>
                                                            <input type="text" v-model="ipAddressDevice2" class="form-control mb-2" placeholder="ex : 192.168.X.XXXX" />
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>


                            </div>
                        </div>


                    </div>

                    <!--end::Tab pane-->

                    <!--end::Tab content-->
                    <div class="d-flex justify-content-end">
                        <!--begin::Button-->
                        <a href="/admin/manage-room" id="kt_ecommerce_add_product_cancel" class="btn btn-secondary me-5">Cancel</a>
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
                <!--end::Main column-->
            </form>
            <!--end::Form-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::Content-->


</div>
@endsection
@section('script')
<script src="{{ asset('assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
@endsection

@section('pagescript')
<script>
    const room = <?php echo Illuminate\Support\Js::from($room) ?>;
    const device = <?php echo Illuminate\Support\Js::from($device) ?>;
    let app = new Vue({
        el: '#app',
        data: {
            room,
            device,
            ipAddressDevice1: '',
            ipAddressDevice2: '',
            accountDevice1: '',
            accountDevice2: '',
            roomId: '',


            loading: false,
        },
        methods: {
            submitForm: function() {
                if (this.accountDevice1 == '') {
                    Swal.fire(
                        'Warning !',
                        'Device 1 cannot be empty .',
                        'warning'
                    )
                } else if (this.accountDevice2 == '') {
                    Swal.fire(
                        'Warning !',
                        'Device 2 cannot be empty .',
                        'warning'
                    )
                } else if (this.roomId == '') {
                    Swal.fire(
                        'Warning !',
                        'Room cannot be empty .',
                        'warning'
                    )
                } else {
                    this.sendData();
                }
            },
            sendData: function() {
                let vm = this;
                vm.loading = true;
                axios.post('/admin/merge-room', {
                        account_device1: this.accountDevice1,
                        account_device2: this.accountDevice2,
                        ip_address_device1: this.ipAddressDevice1,
                        ip_address_device2: this.ipAddressDevice2,
                        room_id: this.roomId,
                    })
                    .then(function(response) {
                        vm.loading = false;
                        Swal.fire({
                            title: 'Berhasil',
                            text: 'Merge Room Created Successfully.',
                            icon: 'success',
                            showConfirmButton: false,
                        })
                        setTimeout(function() {
                            window.location.href = '/admin/merge-room';
                        }, 2000);

                        // Swal.fire({
                        //     title: 'Berhasil',
                        //     text: 'Ruangan berhasil disimpan.',
                        //     icon: 'success',
                        //     allowOutsideClick: false,
                        // }).then((result) => {
                        //     if (result.isConfirmed) {
                        //         window.location.href = '/admin/manage-room';
                        //     }
                        // })
                        // console.log(response);
                    })
                    .catch(function(error) {
                        vm.loading = false;
                        console.log(error);
                        Swal.fire({
                            title: 'Error',
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
        app.$data.divisionId = val;
    });
</script>
@endsection