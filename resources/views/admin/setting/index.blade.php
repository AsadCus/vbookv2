@extends('layouts.app')

@section('title', 'Setting Admin')

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
                    <h3 class="card-title">Admin page setting</h3>
                    <div class="card-toolbar">
                        <a :href="`/admin/setting/` +company.id + `/edit`" type="button" class="btn btn-sm btn-primary">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                            </svg>
                            Edit
                        </a>
                    </div>
                </div>
                <div class="container col-12 mb-6">
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
                                <h4 class="text-gray-900 fw-bolder">Check Your License </h4>

                            </div>
                            <!--end::Content-->
                            <!--begin::Action-->
                            <a :href="`/admin/setting/` +company.licence?.id + `/license`" class="btn btn-primary px-6 align-self-center text-nowrap">Check License</a>
                            <!--end::Action-->
                        </div>
                        <!--end::Wrapper-->
                    </div>
                </div>

                <div class="card-body">

                    <div class="row form-group mb-4 col-12">
                        <div class="col-4">
                            <h4>Logo</h4>
                        </div>
                        <div class="col-8">
                            <h4> <span class="badge badge-light-primary"><img :src="`/gambar/company/`+company.company.logo" alt="" width="90px"> </span></h4>
                        </div>
                    </div>

                    <div class="row form-group mb-4 col-12">
                        <div class="col-4">
                            <h4>Aplication Name</h4>
                        </div>
                        <div class="col-8">
                            <h4> : &nbsp; @{{ company.company.aplication_name }}</h4>
                        </div>
                    </div>

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
        const company = <?php echo Illuminate\Support\Js::from($company) ?>;
        let app = new Vue({
            el: '#app',
            data: {
                company,

                loading: false,
            },
            methods: {
                toCurrency: function(number) {
                    return new Intl.NumberFormat('De-de').format(number);
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