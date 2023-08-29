@extends('layouts.app')

@section('title', 'Edit Food Menu')

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
            <!--begin::Row-->
            <div class="card card-dashed">
                <div class="card-header mb-4">
                    <h3 class="card-title">Edit Food Menu</h3>
                </div>
                <div class="card-body">
                    <form @submit.prevent="submitForm" enctype="multipart/form-data">
                        <div class="row form-group mb-4 col-12">
                            <div class="col-4">
                                <h4>Food Menu</h4>
                            </div>
                            <div class="col-8">
                                <h4><input type="text" name="" id="" class="form-control" v-model="food_menu"></h4>
                            </div>
                        </div>
                        <div class="row form-group mb-4 col-12">
                            <div class="col-4">
                                <h4>Food Category</h4>
                            </div>
                            <div class="col-8">
                                <h4>
                                    {{-- <input type="text" name="" id="" class="form-control" v-model="food_menu"> --}}
                                    <select v-model="food_categories_id" class="form-select mb-2">
                                        <option value="">- Select Category -</option>
                                        <option v-for="categories in category" :value="categories.id">@{{ categories.name }}</option>
                                    </select>
                                </h4>
                            </div>
                        </div>
                        <div class="row form-group mb-4 col-12">
                            <div class="col-4">
                                <h4>Foto Menu</h4>
                                {{-- <small>File harus berupa jpeg / png / jpg </small> --}}
                            </div>
                            <div class="col-8">
                                <h4>
                                    <div class="alert alert-warning">
                                        <div class="d-flex flex-column">
                                            <input type="file" ref="foto_menu" class="custom-file-input" accept=".jpeg, .png, .jpg" v-on:change="handleLogoUpload">
                                        </div>
                                    </div>
                                </h4>
                            </div>
                        </div>
                        <div class="text-end">
                            <a href="/admin/manage-food" class="btn btn-secondary me-2">Cancel</a>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <br>
        <br>

    </div>
    @endsection
    @section('script')
    <script src="{{ asset('assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
    @endsection

    @section('pagescript')
    <script>
        const category = <?php echo Illuminate\Support\Js::from($category) ?>;
        let app = new Vue({
            el: '#app',
            data: {
                category,
                foto_menu: '',
                food_categories_id: '{{ $food->food_categories_id }}',
                food_menu: '{{ $food->food_menu }}',
                loading: false,
            },
            methods: {
                handleLogoUpload: function() {
                    this.foto_menu = this.$refs.foto_menu.files[0];
                },
                submitForm: function() {
                    this.sendData();
                },
                sendData: function() {
                    let vm = this;
                    //vm.loading = true;
                    let data = {
                        foto_menu: vm.foto_menu,
                        food_menu: this.food_menu,
                        food_categories_id: this.food_categories_id,
                        foto_menu_name: this.foto_menu['name'],
                    }
                    let formData = new FormData();
                    for (var key in data) {
                        formData.append(key, data[key]);
                    }
                    axios.post('/admin/manage-food/{{ $food->id }}/update', formData)
                        .then(function(response) {
                            vm.loading = false;
                            Swal.fire({
                                title: 'Success',
                                text: 'Food Menu Updated successfully.',
                                icon: 'success',
                                allowOutsideClick: false,
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    window.location.href = '/admin/manage-food';
                                }
                            })
                            console.log(response);
                        })
                        .catch(function(error) {
                            vm.loading = false;
                            console.log(error);
                            Swal.fire({
                                title: 'Not Save',
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