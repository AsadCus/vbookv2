@extends('layouts.app')

@section('title', 'Edit Admin Page')

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
                    <h3 class="card-title">Edit Admin Page</h3>

                </div>

                <div class="card-body">

                    <form @submit.prevent="submitForm" enctype="multipart/form-data">
                        <div class="row form-group mb-4 col-12">
                            <div class="col-4">
                                <h4>Logo </h4>
                                <small>File harus berupa jpeg / png / jpg </small>
                            </div>
                            <div class="col-8">
                                <h4>
                                    <div class="alert alert-warning">
                                        <div class="d-flex flex-column">

                                            <input type="file" ref="logo" class="custom-file-input" accept=".jpeg, .png, .jpg" v-on:change="handleLogoUpload">
                                        </div>
                                    </div>
                                </h4>
                            </div>
                        </div>

                        <div class="row form-group mb-4 col-12">
                            <div class="col-4">
                                <h4>Video </h4>
                                {{-- <small>File harus berupa jpeg / png / jpg </small> --}}
                            </div>
                            <div class="col-8">
                                <h4>
                                    <div class="alert alert-warning">
                                        <div class="d-flex flex-column">

                                            <input type="file" ref="video" class="custom-file-input" 
                                            {{-- accept=".jpeg, .png, .jpg"  --}}
                                            v-on:change="handleVideoUpload">
                                        </div>
                                    </div>
                                </h4>
                            </div>
                        </div>

                        <div class="row form-group mb-4 col-12">
                            <div class="col-4">
                                <h4>Aplication Name</h4>
                            </div>
                            <div class="col-8">
                                <h4><input type="text" name="" id="" class="form-control" v-model="aplication_name"></h4>
                            </div>
                        </div>

                        <div class="text-end">
                            <a href="/admin/setting" class="btn btn-secondary me-2">Cancel</a>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </form>

                </div>

            </div>
            <!-- <div class="card card-flush border-0 h-xl-100">
 
                <div class="card-body py-9">
    
                    <div class="row gx-9 h-100">
    
                        <div class="col-sm-6 mb-10 mb-sm-0">
  
                            <a class="d-block overlay h-100" data-fslightbox="lightbox-hot-sales" href="{{ asset('assets/booking-room/images/background-display.png') }}">

                                <div class="overlay-wrapper bgi-no-repeat bgi-position-center bgi-size-cover card-rounded min-h-200px h-100" style="background-image:url('{{ asset('assets/booking-room/images/background-display.png') }}')"></div>
                   
                                <div class="overlay-layer card-rounded bg-dark bg-opacity-25">
                                    <i class="bi bi-eye-fill fs-2x text-white"></i>
                                </div>
            
                            </a>

                        </div>

                        <div class="col-sm-6">
                            <div class="d-flex flex-column h-100">
                                <div class="mb-7">

                                    <div class="mb-6">
                                        <a href="../../demo4/dist/apps/projects/users.html" class="text-gray-800 text-hover-primary fs-1 fw-bolder">Tampilan Display</a>
                                    </div>

                                </div>

                                <div class="d-flex flex-column border border-1 border-gray-300 text-center pt-5 pb-7 mb-8 card-rounded">

                                    <span class="fw-bolder text-gray-600 fs-4 pb-5">Upload gambar untuk merubah tampilan display</span>

                                    <span class="fw-bold text-gray-600 fs-7 pb-1">Upload gambar dengan format (.jpg, .jpeg, .png)</span>
                                    <span class="fw-bolder text-gray-800 fs-3"> <input type="file" class="form-control"></span>
                                </div>

                                <div class="d-flex flex-stack mt-auto bd-highlight">

                                    <a href="#" class="btn btn-primary btn-sm flex-shrink-0 me-3" data-bs-toggle="modal" data-bs-target="#kt_modal_bidding">Place a Bid</a>
                                    <a href="#" class="btn btn-light btn-sm flex-shrink-0" data-bs-toggle="modal" data-bs-target="#kt_modal_users_search">View Item</a>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div> -->
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
        let app = new Vue({
            el: '#app',
            data: {
                logo: '',
                video: '',
                aplication_name: '{{ $company->aplication_name }}',
                loading: false,
            },
            methods: {
                handleLogoUpload: function() {
                    this.logo = this.$refs.logo.files[0];

                },
                handleVideoUpload: function() {
                    this.video = this.$refs.video.files[0];

                },
                submitForm: function() {
                    this.sendData();
                },

                sendData: function() {
                    let vm = this;
                    //vm.loading = true;
                    let data = {
                        logo: vm.logo,
                        video: vm.video,
                        aplication_name: this.aplication_name,
                        logo_name: this.logo['name'],
                        video_name: this.video['name'],
                    }
                    let formData = new FormData();
                    for (var key in data) {
                        formData.append(key, data[key]);
                    }
                    axios.post('/admin/setting/{{ $company->id }}/update', formData)
                        .then(function(response) {
                            vm.loading = false;
                            Swal.fire({
                                title: 'Success',
                                text: 'Admin Page Updated successfully.',
                                icon: 'success',
                                allowOutsideClick: false,
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    window.location.href = '/admin/setting';
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
                deleteRecord: function(id) {
                    Swal.fire({
                        title: 'Yakin Ingin Menghapus data?',
                        text: "data akan di hapus di system",
                        icon: 'warning',
                        reverseButtons: true,
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Delete',
                        cancelButtonText: 'Cancel',
                        showLoaderOnConfirm: true,
                        preConfirm: () => {
                            return axios.delete('/central-goods/' + id)
                                .then(function(response) {
                                    console.log(response.data);
                                })
                                .catch(function(error) {
                                    console.log(error.data);
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Oops',
                                        text: 'Something wrong',
                                    })
                                });
                        },
                        allowOutsideClick: () => !Swal.isLoading()
                    }).then((result) => {
                        if (result.isConfirmed) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Success',
                                text: 'Outlet Berhasil Dihapus',
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    window.location.reload();
                                }
                            })
                        }
                    })
                },


            }
        })
    </script>
    @endsection