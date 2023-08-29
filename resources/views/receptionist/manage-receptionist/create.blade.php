@extends('layouts.app')

@section('title', 'Create Guest')

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
            <!--begin::Form-->

            <form @submit.prevent="submitForm" enctype="multipart/form-data" id="kt_ecommerce_add_product_form" class="form d-flex flex-column flex-lg-row" data-kt-redirect="../../demo4/dist/apps/ecommerce/catalog/products.html">

                <div class="d-flex flex-column flex-row-fluid gap-7 gap-lg-10">
                    <!--begin:::Tabs-->

                    <div class="d-flex flex-column gap-7 gap-lg-10">
                        <!--begin::Inventory-->
                        <div class="card card-flush py-4">
                            <!--begin::Card header-->
                            <div class="card-header">
                                <div class="card-title">
                                    <h2>Add New Guest</h2>
                                </div>
                            </div>
                            <div class="card-body pt-0">
                                <div class="mb-10 fv-row">
                                    <label class="required form-label">Name</label>
                                    <input type="text" v-model="name" class="form-control mb-2" placeholder="Name" />
                                </div>



                                <div class="mb-10 fv-row">
                                    <label class="required form-label">Email</label>
                                    <input type="text" v-model="email" class="form-control mb-2" placeholder="Email" value="" />
                                </div>

                                <div class="mb-10 fv-row">
                                    <label class="required form-label">Phone Number</label>
                                    <input type="text" v-model="noHp" class="form-control mb-2" placeholder="Phone Number" value="" />
                                </div>

                                <div class="mb-10 fv-row">
                                    <label class="required form-label">Floor</label>
                                    <input type="text" v-model="floor" class="form-control mb-2" placeholder="Floor" value="" />
                                </div>

                                <div class="mb-10 fv-row">
                                    <label class="required form-label">Division</label>
                                    <select class="form-select " name="" id="" v-model="divisionId">
                                        <option value="0">- SELECT DIVISION - </option>
                                        <option v-for="divisions in division" :value="divisions.id">@{{ divisions.name }}</option>
                                    </select>

                                </div>



                                <div class="row">
                                    <div class="col-12">
                                        <div class="alert alert-warning">
                                            <div class="d-flex flex-column">
                                                <h4 class="mb-1 text-dark">Id Card </h4><small>Files must be jpeg / png / jpg </small>
                                                <br>
                                                <input type="file" ref="idCard" class="custom-file-input" accept=".jpeg, .png, .jpg" v-on:change="handleImageUpload">
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
                        <a href="/suadmin/manage-company" id="kt_ecommerce_add_product_cancel" class="btn btn-secondary me-5">Cancel</a>
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
    const division = <?php echo Illuminate\Support\Js::from($division) ?>;
    let app = new Vue({
        el: '#app',
        data: {
            division,
            divisionId: '0',
            floor: '',
            name: '',
            idCard: '',
            email: '',
            noHp: '',
            loading: false,
        },
        methods: {
            handleImageUpload: function() {
                this.idCard = this.$refs.idCard.files[0];

            },
            submitForm: function() {
                this.sendData();
            },
            sendData: function() {
                let vm = this;
                //vm.loading = true;
                let data = {
                    id_card: vm.idCard,
                    name: this.name,
                    email: this.email,
                    no_telp: this.noHp,
                    floor: this.floor,
                    division_id: this.divisionId,
                    id_card_name: this.idCard['name'],
                }
                let formData = new FormData();
                for (var key in data) {
                    formData.append(key, data[key]);
                }
                axios.post('/receptionist/manage-guest', formData)
                    .then(function(response) {
                        vm.loading = false;
                        Swal.fire({
                            title: 'Berhasil',
                            text: 'Guest berhasil disimpan.',
                            icon: 'success',
                            allowOutsideClick: false,
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.href = '/receptionist/manage-guest';
                            }
                        })
                        // console.log(response);
                    })
                    .catch(function(error) {
                        vm.loading = false;
                        console.log(error);
                        Swal.fire({
                            title: 'error',
                            error: true,
                            icon: 'error',
                            text: error.response.data.message,
                        })
                    });
            },

        }
    })
</script>


@endsection