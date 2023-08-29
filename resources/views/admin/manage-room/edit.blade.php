@extends('layouts.app')

@section('title', 'Edit Room')

@section('prehead')
<link href="{{ asset('assets/plugins/custom/fullcalendar/fullcalendar.bundle.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css" />
@endsection

@inject('carbon', 'Carbon\Carbon')
@inject('carbonInterval', 'Carbon\CarbonInterval')

@section('content')
<div id="app" v-cloak>
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <div class="container-xxl" id="kt_content_container">
            <form @submit.prevent="submitForm" enctype="multipart/form-data" id="kt_ecommerce_add_product_form" class="form d-flex flex-column flex-lg-row" data-kt-redirect="../../demo4/dist/apps/ecommerce/catalog/products.html">
                <div class="d-flex flex-column gap-7 gap-lg-10 w-100 w-lg-300px mb-7 me-lg-10">
                    <div class="card card-flush py-4">
                        <div class="card-header">
                            <div class="card-title">
                                <h2>Device</h2>
                            </div>
                            <div class="card-toolbar">
                                <i class="bi bi-display"></i>
                            </div>
                        </div>
                        <div class="card-body pt-0">
                            <select class="form-select mb-2" v-model="deviceId">
                                <option value="0">- SELECT DEVICE -</option>
                                <option v-for="devices in device" :value="devices.device_id">@{{ devices.device?.name }}</option>
                            </select>
                            <div class="text-muted fs-7"> Select the room device</div>
                            <div class="d-none mt-10">
                                <label for="kt_ecommerce_add_product_status_datepicker" class="form-label">Select
                                    publishing date and time</label>
                                <input class="form-control" id="kt_ecommerce_add_product_status_datepicker" placeholder="Pick date &amp; time" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal fade" tabindex="-1" id="kt_modal_1">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Edit Device</h5>
                                <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                                    <span class="svg-icon svg-icon-2x"></span>
                                </div>
                            </div>
                            <div class="modal-body">
                                <label for="" class="form-label">Device Name</label>
                                <input type="text" v-model="deviceName" class="form-control">
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="d-flex flex-column flex-row-fluid gap-7 gap-lg-10">
                    <div class="d-flex flex-column gap-7 gap-lg-10">
                        <div class="card card-flush py-4">
                            <div class="card-header">
                                <div class="card-title">
                                    <h2>Edit Room</h2>
                                </div>
                            </div>
                            <div class="card-body pt-0">
                                <div class="mb-10 fv-row">
                                    <label class="required form-label">Room Name</label>
                                    <input type="text" v-model="name" class="form-control mb-2" placeholder="Room Name" />
                                </div>
                                <!-- <div class="mb-10 fv-row">
                                    <label class="required form-label">Email Room</label>
                                    <input type="text" v-model="email" class="form-control mb-2" placeholder="Email Ruangan" value="" />
                                </div> -->
                                <!-- <div class="mb-10 fv-row">
                                    <label class="required form-label">Password Ruangan</label>
                                    <input type="password" v-model="password" class="form-control mb-2" placeholder="Password Ruangan" value="" />
                                </div> -->
                                <!-- <div class="mb-10 fv-row">
                                    <label class="required form-label">Base ID Ruangan</label>
                                    <input type="text" v-model="baseId" class="form-control mb-2" placeholder="Base ID Ruangan" value="" />
                                </div>
                                <div class="mb-10 fv-row">
                                    <label class="required form-label">Calendar ID</label>
                                    <input type="text" v-model="calendarId" class="form-control mb-2" placeholder="Calendar ID" value="" />
                                </div> -->
                                <div class="mb-10 fv-row">
                                    <div class="col-lg-12">
                                        <label class="required form-label">Projector &nbsp; </label>
                                        <div class="text-muted fs-7 mb-4">Is the projector available in the room? &nbsp;
                                            <i class="bi bi-projector-fill"></i>
                                        </div>

                                        <div class="form-check mb-4">
                                            <input class="form-check-input" type="radio" name="flexRadioProjector" v-model="projector" value="1" id="flexRadioProjector">
                                            <label class="form-check-label" for="flexRadioProjector">
                                                Available
                                            </label>
                                        </div>
                                        <div class="form-check mb-4">
                                            <input class="form-check-input" type="radio" name="flexRadioProjector2" v-model="projector" value="2" id="flexRadioProjector2">
                                            <label class="form-check-label" for="flexRadioProjector2">
                                                Not Available
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-10 fv-row">
                                    <div class="col-lg-12">
                                        <label class="required form-label">Internet &nbsp; </label>
                                        <div class="text-muted fs-7 mb-4">Is internet available in the room &nbsp; <i class="bi bi-wifi"></i></div>
                                        <div class="form-check mb-4">
                                            <input class="form-check-input" type="radio" name="flexRadiointernet1" v-model="internet" value="1" id="flexRadiointernet1">
                                            <label class="form-check-label" for="flexRadiointernet1">
                                                Available
                                            </label>
                                        </div>
                                        <div class="form-check mb-4">
                                            <input class="form-check-input" type="radio" name="flexRadiointernet2" v-model="internet" value="2" id="flexRadiointernet2">
                                            <label class="form-check-label" for="flexRadiointernet2">
                                                Not Available
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-10 fv-row">
                                    <div class="row col-lg-12">
                                        <div class="col-lg-6">
                                            <label class="required form-label">Floor</label>
                                            <input type="text" v-model="floor" class="form-control mb-2" placeholder="ex : 1" value="" />
                                            <div class="text-muted fs-7">Room floor.</div>
                                        </div>
                                        <div class="col-lg-6">
                                            <label class="required form-label">Capacity</label>
                                            <input type="text" v-model="capacity" class="form-control mb-2" placeholder="ex : 20" value="" />
                                            <div class="text-muted fs-7">Total capacity room.</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-10 fv-row">
                                    <div class="row col-lg-12">
                                        <div class="col-lg-6">
                                            <label class="required form-label">Color Room</label>
                                            <input type="color" v-model="colorCode" id="color_code" class="form-control" placeholder="Color Code (code hex : #00000)">
                                            <div class="text-muted fs-7">Room marker color.</div>
                                        </div>
                                        <div class="col-lg-6">
                                            <label class="required form-label">IP Address</label>
                                            <input type="text" v-model="ipAddress" class="form-control mb-2" placeholder="ex : 192.168.xxx.xx" value="" />
                                            <div class="text-muted fs-7">IP local in display.</div>
                                        </div>
                                    </div>
                                </div>
                                {{-- <div class="mb-10 fv-row">
                                    <div class="row col-lg-12">
                                        <div class="col-lg-6">
                                            <label class="required form-label">Taphome On</label>
                                            <input type="text" v-model="taphomeOn" class="form-control mb-2" placeholder="ex : https://" value="" />
                                            <div class="text-muted fs-7">URL taphome on.</div>
                                        </div>
                                        <div class="col-lg-6">
                                            <label class="required form-label">Taphome Off</label>
                                            <input type="text" v-model="taphomeOff" class="form-control mb-2" placeholder="ex : https://" value="" />
                                            <div class="text-muted fs-7">URL taphome off.</div>
                                        </div>
                                    </div>
                                </div> --}}
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-end">
                        <a href="/admin/manage-room" id="kt_ecommerce_add_product_cancel" class="btn btn-secondary me-5">Cancel</a>
                        <button type="submit" id="kt_ecommerce_add_product_submit" class="btn btn-primary">
                            <span class="indicator-label">Save</span>
                            <span class="indicator-progress">Please wait...
                                <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@section('script')
<script src="{{ asset('assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
@endsection

@section('pagescript')
<script>
    const device = <?php echo Illuminate\Support\Js::from($device) ?>;

    let app = new Vue({
        el: '#app',
        data: {
            device,
            user_id: '{{ $room->user[0]->id }}',
            name: '{{ $room->name }}',
            projector: '{{ $room->projector }}',
            internet: '{{ $room->internet }}',
            floor: '{{ $room->floor }}',
            capacity: '{{ $room->capacity }}',
            colorCode: '{{ $room->color_code }}',
            ipAddress: '{{ $room->ip_address }}',
            deviceId: '{{ $room->device_id }}',
            // taphomeOn: '{{ $room->taphome_on }}',
            // taphomeOff: '{{ $room->taphome_off }}',

            loading: false,
        },
        methods: {
            submitForm: function() {
                if (this.name == '') {
                    Swal.fire(
                        'Warning !',
                        'Room Name cannot be empty .',
                        'warning'
                    )
                } else if (this.deviceId == 0) {
                    Swal.fire(
                        'Warning !',
                        'Device cannot be empty .',
                        'warning'
                    )
                } else if (this.colorCode == '') {
                    Swal.fire(
                        'Warning !',
                        'Color Room cannot be empty .',
                        'warning'
                    )
                } else if (this.floor == '') {
                    Swal.fire(
                        'Warning !',
                        'floor cannot be empty .',
                        'warning'
                    )
                } else if (this.capacity == '') {
                    Swal.fire(
                        'Warning !',
                        'Capacity cannot be empty .',
                        'warning'
                    )
                } else if (this.ipAddress == '') {
                    Swal.fire(
                        'Warning !',
                        'IP Address cannot be empty .',
                        'warning'
                    )
                } else if (this.taphomeOn == '') {
                    Swal.fire(
                        'Warning !',
                        'URL taphome cannot be empty .',
                        'warning'
                    )
                } else if (this.taphomeOff == '') {
                    Swal.fire(
                        'Warning !',
                        'URL taphome cannot be empty .',
                        'warning'
                    )
                } else {
                    this.sendData();
                }
            },
            sendData: function() {
                let vm = this;
                vm.loading = true;
                axios.post('/admin/manage-room/{{ $room->id }}/update', {
                    user_id: this.user_id,
                    name: this.name,
                    projector: this.projector,
                    internet: this.internet,
                    floor: this.floor,
                    capacity: this.capacity,
                    color_code: this.colorCode,
                    ip_address: this.ipAddress,
                    device_id: this.deviceId,
                    // taphome_on: this.taphomeOn,
                    // taphome_off: this.taphomeOff,
                })
                .then(function(response) {
                    vm.loading = false;
                    Swal.fire({
                        title: 'Berhasil',
                        text: 'Ruangan berhasil disimpan.',
                        icon: 'success',
                        showConfirmButton: false,
                    })
                    setTimeout(function() {
                        window.location.href = '/admin/manage-room';
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
                    Swal.fire(
                        'Terjadi Kesalahan!',
                        'Pastikan data terisi dengan benar.',
                        'error'
                    )
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