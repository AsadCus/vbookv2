@extends('layouts.app')
@section('title', 'Create Room')
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
            <div class="col-12 mb-4">
                <div class="notice d-flex bg-light-primary rounded border-primary border border-dashed p-6">
                    <!--begin::Icon-->
                    <!--begin::Svg Icon | path: icons/duotune/general/gen048.svg-->
                    <span class="svg-icon svg-icon-2tx svg-icon-primary me-4">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-ticket-perforated" viewBox="0 0 16 16">
                            <path d="M4 4.85v.9h1v-.9H4Zm7 0v.9h1v-.9h-1Zm-7 1.8v.9h1v-.9H4Zm7 0v.9h1v-.9h-1Zm-7 1.8v.9h1v-.9H4Zm7 0v.9h1v-.9h-1Zm-7 1.8v.9h1v-.9H4Zm7 0v.9h1v-.9h-1Z" />
                            <path d="M1.5 3A1.5 1.5 0 0 0 0 4.5V6a.5.5 0 0 0 .5.5 1.5 1.5 0 1 1 0 3 .5.5 0 0 0-.5.5v1.5A1.5 1.5 0 0 0 1.5 13h13a1.5 1.5 0 0 0 1.5-1.5V10a.5.5 0 0 0-.5-.5 1.5 1.5 0 0 1 0-3A.5.5 0 0 0 16 6V4.5A1.5 1.5 0 0 0 14.5 3h-13ZM1 4.5a.5.5 0 0 1 .5-.5h13a.5.5 0 0 1 .5.5v1.05a2.5 2.5 0 0 0 0 4.9v1.05a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-1.05a2.5 2.5 0 0 0 0-4.9V4.5Z" />
                        </svg>
                    </span>
                    <!--end::Svg Icon-->
                    <!--end::Icon-->
                    <!--begin::Wrapper-->
                    <div class="d-flex flex-stack flex-grow-1 flex-wrap flex-md-nowrap">
                        <!--begin::Content-->
                        <div class="mb-3 mb-md-0 fw-bold">
                            <h4 class="text-gray-900 fw-bolder">Your subscription license </h4>
                            <div class="fs-6 text-gray-700 pe-7">You subscribe to <span class="badge badge-info">@{{ license.license?.max_device }} device</span> licenses in a room</div>
                        </div>
                        <!--end::Content-->
                        <!--begin::Action-->
                        <a href="/admin/setting" class="btn btn-primary px-6 align-self-center text-nowrap">Check License</a>
                        <!--end::Action-->
                    </div>
                    <!--end::Wrapper-->
                </div>
            </div>
            <!--begin::Form-->
            <form @submit.prevent="submitForm" enctype="multipart/form-data" id="kt_ecommerce_add_product_form" class="form d-flex flex-column flex-lg-row" data-kt-redirect="../../demo4/dist/apps/ecommerce/catalog/products.html">
                <!--begin::Aside column-->
                <div class="d-flex flex-column gap-7 gap-lg-10 w-100 w-lg-300px mb-7 me-lg-10">
                    <div class="card card-flush py-4">
                        <!--begin::Card header-->
                        <div class="card-header">
                            <!--begin::Card title-->
                            <div class="card-title">
                                <h2>Device</h2>
                            </div>
                            <div class="card-toolbar">
                                <i class="bi bi-display"></i>
                            </div>
                            <!--begin::Card toolbar-->
                        </div>
                        <div class="card-body pt-0">
                            <!--begin::Select2-->
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
                            <!--end::Datepicker-->
                        </div>
                        <!--end::Card body-->
                    </div>
                    <div class="card card-flush py-4">
                        <!--begin::Card header-->
                        <div class="card-header">
                            <!--begin::Card title-->
                            <div class="card-title">
                                <h2>room restrictions</h2>
                            </div>
                            <!--begin::Card toolbar-->
                        </div>
                        <div class="card-body pt-0">
                            <!--begin::Select2-->
                            <div class="py-6 m-0">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault" v-model="isRestricionRoom">
                                    <label class="form-check-label" for="flexSwitchCheckDefault">Clik if room restrictions</label>
                                </div>
                            </div>
                            <div :class="isRestricionRoom ? '': 'd-none'">
                                <select multiple class="form-control form-control-sm" id="selectEvents">
                                    @foreach ($division as $divisions)
                                    <option value="{{ $divisions->id }}">{{$divisions->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="d-none mt-10">
                                <label for="kt_ecommerce_add_product_status_datepicker" class="form-label">Select
                                    publishing date and time</label>
                                <input class="form-control" id="kt_ecommerce_add_product_status_datepicker" placeholder="Pick date &amp; time" />
                            </div>
                            <!--end::Datepicker-->
                        </div>
                        <!--end::Card body-->
                    </div>
                    <!--end::Status-->
                </div>
                <div class="modal fade" tabindex="-1" id="kt_modal_1">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Create Device</h5>
                                <!--begin::Close-->
                                <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                                    <span class="svg-icon svg-icon-2x"></span>
                                </div>
                                <!--end::Close-->
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
                <!--end::Aside column-->
                <!--begin::Main column-->
                <div class="d-flex flex-column flex-row-fluid gap-7 gap-lg-10">
                    <!--begin:::Tabs-->
                    <div class="d-flex flex-column gap-7 gap-lg-10">
                        <!--begin::Inventory-->
                        <div class="card card-flush py-4">
                            <!--begin::Card header-->
                            <div class="card-header">
                                <div class="card-title">
                                    <h2>Create Room</h2>
                                </div>
                            </div>
                            <div class="card-body pt-0">
                                <div class="notice d-flex bg-light-primary rounded border-primary border border-dashed p-6">
                                    <div class="col-lg-6 mb-10">
                                        <label class="form-label">This is Merge Room ?</label>
                                        <div class="form-check mb-4">
                                            <input class="form-check-input" type="checkbox" v-model="mergeRoom" value="" id="flexCheckDefault">
                                            <label class="form-check-label" for="flexCheckDefault">
                                                Yes
                                            </label>
                                        </div>
                                        <div class="text-muted fs-7">Checked if this is a merge room</div>
                                        <div v-if="mergeRoom == true">
                                            <label class="required form-label">IP Address Device 1</label>
                                            <input type="text" v-model="ipAddressDevice1" class="form-control mb-2" placeholder="ex : 192.168.xxx.xx" value="" />
                                            <div class="text-muted fs-7">Input IP Address local in device 1 .</div>
                                            <label class="required form-label">IP Address Device 2</label>
                                            <input type="text" v-model="ipAddressDevice2" class="form-control mb-2" placeholder="ex : 192.168.xxx.xx" value="" />
                                            <div class="text-muted fs-7">Input IP Address local in device 2 .</div>
                                        </div>
                                    </div>
                                </div>
                                <br>
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
                                        <div class="col-lg-6" v-if="mergeRoom == false">
                                            <label class="required form-label">IP Address</label>
                                            <input type="text" v-model="ipAddress" class="form-control mb-2" placeholder="ex : 192.168.xxx.xx" value="" />
                                            <div class="text-muted fs-7">IP local in display .</div>
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
    const device = <?php echo Illuminate\Support\Js::from($device) ?>;
    const division = <?php echo Illuminate\Support\Js::from($division) ?>;
    const license = <?php echo Illuminate\Support\Js::from($license) ?>;
    let app = new Vue({
        el: '#app',
        data: {
            device,
            division,
            license,
            ipAddressDevice1: '',
            ipAddressDevice2: '',
            mergeRoom: '',
            isRestricionRoom: '',
            name: '',
            email: '',
            password: '',
            baseId: '',
            calendarId: '',
            projector: '',
            internet: '',
            seat: '',
            floor: '',
            capacity: '',
            colorCode: '',
            ipAddress: '',
            deviceId: '0',
            divisionId: [],
            deviceName: '',
            // taphomeOn: '',
            // taphomeOff: '',
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
                // } else if (this.taphomeOn == '') {
                //     Swal.fire(
                //         'Warning !',
                //         'URL taphome cannot be empty .',
                //         'warning'
                //     )
                // } else if (this.taphomeOff == '') {
                //     Swal.fire(
                //         'Warning !',
                //         'URL taphome cannot be empty .',
                //         'warning'
                //     )
                } else {
                    this.sendData();
                }
            },
            sendData: function() {
                let vm = this;
                vm.loading = true;
                axios.post('/admin/manage-room', {
                        merge_room: this.mergeRoom,
                        ip_address_device1: this.ipAddressDevice1,
                        ip_address_device2: this.ipAddressDevice2,
                        name: this.name,
                        email: this.email,
                        password: this.password,
                        base_id: this.baseId,
                        calendar_id: this.calendarId,
                        projector: this.projector,
                        internet: this.internet,
                        seat: this.seat,
                        floor: this.floor,
                        capacity: this.capacity,
                        color_code: this.colorCode,
                        ip_address: this.ipAddress,
                        device_id: this.deviceId,
                        isRestricionRoom: this.isRestricionRoom,
                        divisionId: this.divisionId,
                        // taphome_on: this.taphomeOn,
                        // taphome_off: this.taphomeOff,
                    })
                    .then(function(response) {
                        vm.loading = false;
                        Swal.fire({
                            title: 'Berhasil',
                            text: 'Room Created Successfully.',
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