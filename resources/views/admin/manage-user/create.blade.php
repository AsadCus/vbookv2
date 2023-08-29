@extends('layouts.app')

@section('title', 'Add User')

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
                <div class="d-flex flex-column flex-row-fluid gap-7 gap-lg-10">
                    <div class="d-flex flex-column gap-7 gap-lg-10">
                        <div class="card card-flush py-4">
                            <div class="card-header">
                                <div class="card-title">
                                    <h2>Add User</h2>
                                </div>
                            </div>
                            <div class="card-body pt-0">
                                <div class="mb-10 fv-row">
                                    <div class="col-lg-12">
                                        <label class="required form-label">Is Pantry? &nbsp; </label>
                                        <div class="text-muted fs-7 mb-4">Is this account pantry? &nbsp;
                                            <i class="bi bi-cart-fill"></i>
                                        </div>
                                        <div class="form-check mb-4">
                                            <input class="form-check-input" type="radio" name="flexRadioIsPantry" v-model="isPantry" value="1" id="flexRadioIsPantry">
                                            <label class="form-check-label" for="flexRadioIsPantry">
                                                Yes
                                            </label>
                                        </div>
                                        <div class="form-check mb-4">
                                            <input class="form-check-input" type="radio" name="flexRadioIsPantry2" v-model="isPantry" value="2" id="flexRadioIsPantry2">
                                            <label class="form-check-label" for="flexRadioIsPantry2">
                                                No
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-10 fv-row">
                                    <label class="required form-label">Name</label>
                                    <input type="text" v-model="name" class="form-control mb-2" placeholder="Nama" />
                                </div>
                                <div class="mb-10 fv-row">
                                    <label class="required form-label">Division</label>
                                    <select class="form-select mb-2" v-model="divisionId">
                                        <option value="0">- SELECT DIVISION -</option>
                                        <option v-for="divisions in division" :value="divisions.id">@{{ divisions.name }}</option>
                                    </select>
                                </div>
                                <div class="mb-10 fv-row">
                                    <label class="required form-label">Email</label>
                                    <input type="email" v-model="email" class="form-control mb-2" placeholder="Email" value="" />
                                </div>
                                <div class="mb-10 fv-row">
                                    <label class="required form-label">Password</label>
                                    <input type="password" v-model="password" class="form-control mb-2" placeholder="Password" value="" />
                                </div>
                                <div class="mb-10 fv-row">
                                    <label class="required form-label">No Handphone</label>
                                    <input type="text" v-model="noHp" class="form-control mb-2" maxlength="13" placeholder="No Telepon" value="" />
                                </div>
                                <!-- <div class="mb-10 fv-row">
                                    <label class="required form-label">Select Role</label>
                                    <select class="form-select mb-2" v-model="roleId">
                                        <option value="0">- SELECT ROLE -</option>
                                        <option value="3">USER</option>
                                    </select>
                                </div> -->
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-end">
                        <a href="/admin/manage-user" id="kt_ecommerce_add_product_cancel" class="btn btn-secondary me-5">Cancel</a>
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
    const division = <?php echo Illuminate\Support\Js::from($division) ?>;
    let app = new Vue({
        el: '#app',
        data: {
            division,
            name: '',
            email: '',
            password: '',
            noHp: '',
            isPantry: '',
            roleId: '0',
            divisionId: '0',
            loading: false,
        },
        methods: {
            submitForm: function() {
                if (this.divisionId == '0' && this.isPantry == 2) {
                    Swal.fire(
                        'Warning !',
                        'division cannot be empty .',
                        'warning'
                    )
                } else if (this.name == '') {
                    Swal.fire(
                        'Warning !',
                        'name cannot be empty .',
                        'warning'
                    )
                } else if (this.email == '') {
                    Swal.fire(
                        'Warning !',
                        'email cannot be empty .',
                        'warning'
                    )
                } else if (this.password == '') {
                    Swal.fire(
                        'Warning !',
                        'password cannot be empty .',
                        'warning'
                    )
                } else {
                    this.sendData();
                }
            },
            sendData: function() {
                let vm = this;
                vm.loading = true;
                axios.post('/admin/manage-user', {
                    name: this.name,
                    email: this.email,
                    password: this.password,
                    no_telp: this.noHp,
                    role_id: this.roleId,
                    division_id: this.divisionId,
                    is_pantry: this.isPantry,
                })
                .then(function(response) {
                    vm.loading = false;
                    Swal.fire({
                        title: 'Berhasil',
                        text: 'User berhasil disimpan.',
                        icon: 'success',
                        showConfirmButton: false,
                    })
                    setTimeout(function() {
                        window.location.href = '/admin/manage-user';
                    }, 2000);
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
@endsection