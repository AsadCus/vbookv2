@extends('layouts.app')

@section('title', 'Dashboard | Manage Guest')

@section('prehead')
<link href="{{ asset('assets/plugins/custom/fullcalendar/fullcalendar.bundle.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css" />
@endsection

@inject('carbon', 'Carbon\Carbon')
@inject('carbonInterval', 'Carbon\CarbonInterval')

@section('content')
<div id="app" v-cloak>


    <div class="modal fade" tabindex="-1" id="kt_modal_edit">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form @submit.prevent="submitFormEdit" enctype="multipart/form-data">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Guest</h5>

                        <!--begin::Close-->
                        <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                            <span class="svg-icon svg-icon-2x"></span>
                        </div>
                        <!--end::Close-->
                    </div>

                    <div class="modal-body">



                        <div class="row g-3 align-items-center mb-4">
                            <div class="col-sm-3">
                                <label for="" class="form-label form-label-sm">Nama</label>
                            </div>

                            <div class="col-sm-9">
                                <input type="text" v-model="guestDetail.name" class="form-control mb-2" placeholder="Nama" />
                            </div>
                        </div>

                        <div class="row g-3 align-items-center mb-4">
                            <div class="col-sm-3">
                                <label for="" class="form-label form-label-sm">Email</label>
                            </div>

                            <div class="col-sm-9">
                                <input type="text" v-model="guestDetail.email" class="form-control mb-2" placeholder="Email" />
                            </div>
                        </div>


                        <div class="row g-3 align-items-center mb-4">
                            <div class="col-sm-3">
                                <label for="" class="form-label form-label-sm">No Hp</label>
                            </div>

                            <div class="col-sm-9">
                                <input type="text" v-model="guestDetail.no_telp" class="form-control mb-2" placeholder="no hp" />
                            </div>
                        </div>


                    </div>

                    <div class="modal-footer">
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </div>


    <div class="modal fade" tabindex="-1" id="kt_modal_1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form @submit.prevent="submitForm" enctype="multipart/form-data">
                    <div class="modal-header">
                        <h5 class="modal-title">Detail Guest</h5>

                        <!--begin::Close-->
                        <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                            <span class="svg-icon svg-icon-2x"></span>
                        </div>
                        <!--end::Close-->
                    </div>

                    <div class="modal-body">



                        <div class="row g-3 align-items-center mb-4">
                            <div class="col-sm-3">
                                <label for="" class="form-label form-label-sm">Name</label>
                            </div>

                            <div class="col-sm-9">
                                <span class="fw-bolder text-dark">: &nbsp; @{{ guestDetail.name }}</span>
                            </div>
                        </div>

                        <div class="row g-3 align-items-center mb-4">
                            <div class="col-sm-3">
                                <label for="" class="form-label form-label-sm">Division</label>
                            </div>

                            <div class="col-sm-9">
                                <span class="fw-bolder text-dark">: &nbsp; @{{ guestDetail.division?.name }}</span>
                            </div>
                        </div>

                        <div class="row g-3 align-items-center mb-4">
                            <div class="col-sm-3">
                                <label for="" class="form-label form-label-sm">Email</label>
                            </div>

                            <div class="col-sm-9">
                                <span class="fw-bolder text-dark">: &nbsp; @{{ guestDetail.email }}</span>
                            </div>
                        </div>



                        <div class="row g-3 align-items-center mb-4">
                            <div class="col-sm-3">
                                <label for="" class="form-label form-label-sm">No Hp</label>
                            </div>

                            <div class="col-sm-9">
                                <span class="fw-bolder text-dark">: &nbsp; @{{ guestDetail.phone }}</span>
                            </div>
                        </div>

                        <div class="row g-3 align-items-center mb-4">
                            <div class="col-sm-3">
                                <label for="" class="form-label form-label-sm">Floor</label>
                            </div>

                            <div class="col-sm-9">
                                <span class="fw-bolder text-dark">: &nbsp; @{{ guestDetail.floor }}</span>
                            </div>
                        </div>

                        <div class="row g-3 align-items-center mb-4">
                            <div class="col-sm-3">
                                <label for="" class="form-label form-label-sm">Active Until</label>
                            </div>

                            <div class="col-sm-9">
                                <span class="fw-bolder text-dark">: &nbsp; -</span>
                            </div>
                        </div>

                        <div class="row g-3 align-items-center mb-4">
                            <div class="col-sm-3">
                                <label for="" class="form-label form-label-sm">Id Card</label>
                            </div>

                            <div class="col-sm-9">
                                <span class="fw-bolder text-dark">: &nbsp; <img :src="`/gambar/idcard/`+guestDetail?.id_card" alt="" width="120px"> </span>
                            </div>
                        </div>


                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

                    </div>
                </form>
            </div>
        </div>
    </div>


    <div class="modal fade" tabindex="-1" id="kt_modal_2">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form @submit.prevent="submitForm" enctype="multipart/form-data">
                    <div class="modal-header">
                        <h5 class="modal-title">Detail Guest</h5>

                        <!--begin::Close-->
                        <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                            <span class="svg-icon svg-icon-2x"></span>
                        </div>
                        <!--end::Close-->
                    </div>

                    <div class="modal-body">



                        <div class="row g-3 align-items-center mb-4">
                            <div class="col-sm-3">
                                <label for="" class="form-label form-label-sm">Name</label>
                            </div>

                            <div class="col-sm-9">
                                <span class="fw-bolder text-dark">: &nbsp; @{{ guestDetailNonAktive.name }}</span>
                            </div>
                        </div>

                        <div class="row g-3 align-items-center mb-4">
                            <div class="col-sm-3">
                                <label for="" class="form-label form-label-sm">Division</label>
                            </div>

                            <div class="col-sm-9">
                                <span class="fw-bolder text-dark">: &nbsp; @{{ guestDetailNonAktive.division?.name }}</span>
                            </div>
                        </div>

                        <div class="row g-3 align-items-center mb-4">
                            <div class="col-sm-3">
                                <label for="" class="form-label form-label-sm">Email</label>
                            </div>

                            <div class="col-sm-9">
                                <span class="fw-bolder text-dark">: &nbsp; @{{ guestDetailNonAktive.email }}</span>
                            </div>
                        </div>



                        <div class="row g-3 align-items-center mb-4">
                            <div class="col-sm-3">
                                <label for="" class="form-label form-label-sm">No Hp</label>
                            </div>

                            <div class="col-sm-9">
                                <span class="fw-bolder text-dark">: &nbsp; @{{ guestDetailNonAktive.phone }}</span>
                            </div>
                        </div>

                        <div class="row g-3 align-items-center mb-4">
                            <div class="col-sm-3">
                                <label for="" class="form-label form-label-sm">Floor</label>
                            </div>

                            <div class="col-sm-9">
                                <span class="fw-bolder text-dark">: &nbsp; @{{ guestDetailNonAktive.floor }}</span>
                            </div>
                        </div>

                        <div class="row g-3 align-items-center mb-4">
                            <div class="col-sm-3">
                                <label for="" class="form-label form-label-sm">Active Until</label>
                            </div>

                            <div class="col-sm-9">
                                <span class="fw-bolder text-dark">: &nbsp; -</span>
                            </div>
                        </div>

                        <div class="row g-3 align-items-center mb-4">
                            <div class="col-sm-3">
                                <label for="" class="form-label form-label-sm">Id Card</label>
                            </div>

                            <div class="col-sm-9">
                                <span class="fw-bolder text-dark">: &nbsp; <img :src="`/gambar/idcard/`+guestDetailNonAktive?.id_card" alt="" width="120px"> </span>
                            </div>
                        </div>


                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

                    </div>
                </form>
            </div>
        </div>
    </div>



    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <div class="container-xxl" id="kt_content_container">
            <div class="card card-flush">
                <!--begin::Card header-->
                <div class="card-header align-items-center py-5 gap-2 gap-md-5">
                    <!--begin::Card title-->
                    <div class="card-title">
                        <!--begin::Search-->
                        <div class="d-flex align-items-center position-relative my-1">
                            <span class="svg-icon svg-icon-1 position-absolute ms-4">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                                    <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
                                </svg>
                            </span>
                            <input type="text" data-kt-filter="search" class="form-control form-control-solid w-250px ps-14" placeholder="Search" />
                        </div>
                        <!--end::Search-->
                    </div>
                    <div class="card-toolbar flex-row-fluid justify-content-end gap-5">

                        <a href="/receptionist/manage-guest/create" class="btn btn-primary">Create Guest</a>
                        <!--end::Add product-->
                    </div>
                    <!--end::Card toolbar-->
                </div>

                <div class="container">
                    <ul class="nav nav-tabs nav-pills fs-6">
                        <li class="nav-item me-2 mb-md-2">
                            <a class="nav-link active btn btn-flex btn-active-primary" data-bs-toggle="tab" href="#guest_aktif">
                                <!--begin::Svg Icon | path: icons/duotune/general/gen003.svg-->
                                <span class="svg-icon svg-icon-2 svg-icon-primary">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check2-square" viewBox="0 0 16 16">
                                        <path d="M3 14.5A1.5 1.5 0 0 1 1.5 13V3A1.5 1.5 0 0 1 3 1.5h8a.5.5 0 0 1 0 1H3a.5.5 0 0 0-.5.5v10a.5.5 0 0 0 .5.5h10a.5.5 0 0 0 .5-.5V8a.5.5 0 0 1 1 0v5a1.5 1.5 0 0 1-1.5 1.5H3z" />
                                        <path d="m8.354 10.354 7-7a.5.5 0 0 0-.708-.708L8 9.293 5.354 6.646a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0z" />
                                    </svg>
                                </span>
                                <!--end::Svg Icon-->
                                <span class="d-flex flex-column align-items-start">
                                    <span class="fs-4 fw-bolder">Aktif</span>

                                </span>
                            </a>
                        </li>

                        <li class="nav-item me-2 mb-md-2">
                            <a class="nav-link btn btn-flex btn-active-primary" data-bs-toggle="tab" href="#guest_non_aktif">
                                <!--begin::Svg Icon | path: icons/duotune/general/gen003.svg-->
                                <span class="svg-icon svg-icon-2 svg-icon-primary">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-square" viewBox="0 0 16 16">
                                        <path d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h12zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z" />
                                        <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z" />
                                    </svg>
                                </span>
                                <!--end::Svg Icon-->
                                <span class="d-flex flex-column align-items-start">
                                    <span class="fs-4 fw-bolder">Non Aktif</span>

                                </span>
                            </a>
                        </li>
                    </ul>
                </div>
                <!--end::Card header-->
                <!--begin::Card body-->
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="guest_aktif" role="tabpanel">
                        <div class="card-body pt-0">
                            <!--begin::Table-->

                            <table class="table align-middle border rounded table-row-dashed fs-6 g-5" id="kt_datatable_example_1">
                                <!--begin::Table head-->
                                <thead>
                                    <!--begin::Table row-->
                                    <tr class="text-start text-gray-400 fw-bolder fs-7 text-uppercase gs-0">
                                        <th class="text-center min-w-20px">No</th>
                                        <th class="text-center min-w-100px">Name</th>
                                        <th class="text-center min-w-100px">Email</th>
                                        <th class="text-center min-w-100px">Role</th>
                                        <th class="text-center min-w-70px">Actions</th>
                                    </tr>
                                    <!--end::Table row-->
                                </thead>
                                <tbody class="fw-bold text-gray-600">
                                    <!--begin::Table row-->
                                    <tr v-for="(guests, index) in guest">

                                        <td class="text-center">
                                            <span class="fw-bolder ms-3">@{{ index +1 }}</span>
                                        </td>


                                        <td>
                                            <div class="d-flex align-items-center">

                                                <div class="ms-5">
                                                    <!--begin::Title-->
                                                    <a href="#" @click="onSelcected(guests.id)" data-bs-toggle="modal" data-bs-target="#kt_modal_1" class="text-gray-800 text-hover-primary fs-5 fw-bolder" data-kt-ecommerce-product-filter="product_name">@{{ guests.name }}</a>
                                                    <!--end::Title-->
                                                </div>
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            <span class="fw-bolder ms-3">@{{ guests.email }}</span>
                                        </td>


                                        <td class="text-center">

                                            <div class="badge badge-light-primary">Guest</div>

                                        </td>
                                        <td class="text-center">
                                            <a href="#" @click="onSelcected(guests.id)" data-bs-toggle="modal" data-bs-target="#kt_modal_1" class="btn btn-icon btn-info btn-sm">
                                                <span class="svg-icon">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                                                        <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z" />
                                                        <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z" />
                                                    </svg>
                                                </span>
                                            </a>


                                            <a href="#" class="btn btn-icon btn-danger btn-sm" @click.prevent="deleteRecord(guests.id)">
                                                <span class="svg-icon">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-square" viewBox="0 0 16 16">
                                                        <path d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h12zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z" />
                                                        <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z" />
                                                    </svg>
                                                </span>
                                            </a>

                                        </td>
                                        <!--end::Action=-->
                                    </tr>

                                    <!--end::Table row-->
                                </tbody>
                                <!--end::Table body-->
                            </table>


                            <!--end::Table-->
                        </div>
                    </div>

                    <div class="tab-pane fade show" id="guest_non_aktif" role="tabpanel">
                        <div class="card-body pt-0">
                            <!--begin::Table-->

                            <table class="table align-middle border rounded table-row-dashed fs-6 g-5" id="kt_datatable_example_2">
                                <!--begin::Table head-->
                                <thead>
                                    <!--begin::Table row-->
                                    <tr class="text-start text-gray-400 fw-bolder fs-7 text-uppercase gs-0">
                                        <th class="text-center min-w-20px">No</th>
                                        <th class="text-center min-w-100px">Name</th>
                                        <th class="text-center min-w-100px">Email</th>
                                        <th class="text-center min-w-100px">Role</th>
                                        <th class="text-center min-w-70px">Actions</th>
                                    </tr>
                                    <!--end::Table row-->
                                </thead>
                                <tbody class="fw-bold text-gray-600">
                                    <!--begin::Table row-->
                                    <tr v-for="(guestNonActives, index) in guestNonActive">

                                        <td class="text-center">
                                            <span class="fw-bolder ms-3">@{{ index +1 }}</span>
                                        </td>


                                        <td>
                                            <div class="d-flex align-items-center">

                                                <div class="ms-5">
                                                    <!--begin::Title-->
                                                    <a href="#" @click="onSelcectedNonAktif(guestNonActives.id)" data-bs-toggle="modal" data-bs-target="#kt_modal_2" class="text-gray-800 text-hover-primary fs-5 fw-bolder" data-kt-ecommerce-product-filter="product_name">@{{ guestNonActives.name }}</a>
                                                    <!--end::Title-->
                                                </div>
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            <span class="fw-bolder ms-3">@{{ guestNonActives.email }}</span>
                                        </td>


                                        <td class="text-center">

                                            <div class="badge badge-light-primary">Guest</div>

                                        </td>
                                        <td class="text-center">
                                            <a href="#" @click="onSelcectedNonAktif(guestNonActives.id)" data-bs-toggle="modal" data-bs-target="#kt_modal_2" class="btn btn-icon btn-info btn-sm">
                                                <span class="svg-icon">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                                                        <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z" />
                                                        <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z" />
                                                    </svg>
                                                </span>
                                            </a>


                                            <a href="#" class="btn btn-icon btn-success btn-sm" @click.prevent="restoreRecord(guestNonActives.id)">
                                                <span class=" svg-icon">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check2-square" viewBox="0 0 16 16">
                                                        <path d="M3 14.5A1.5 1.5 0 0 1 1.5 13V3A1.5 1.5 0 0 1 3 1.5h8a.5.5 0 0 1 0 1H3a.5.5 0 0 0-.5.5v10a.5.5 0 0 0 .5.5h10a.5.5 0 0 0 .5-.5V8a.5.5 0 0 1 1 0v5a1.5 1.5 0 0 1-1.5 1.5H3z" />
                                                        <path d="m8.354 10.354 7-7a.5.5 0 0 0-.708-.708L8 9.293 5.354 6.646a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0z" />
                                                    </svg>
                                                </span>
                                            </a>

                                        </td>
                                        <!--end::Action=-->
                                    </tr>

                                    <!--end::Table row-->
                                </tbody>
                                <!--end::Table body-->
                            </table>


                            <!--end::Table-->
                        </div>
                    </div>
                </div>
                <!--end::Card body-->
            </div>
        </div>
    </div>

</div>
@endsection
@section('script')
<script src="{{ asset('assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>

@endsection

@section('pagescript')

<script>
    "use strict";

    // Class definition
    var KTDatatablesButtons = function() {
        // Shared variables
        var table;
        var datatable;

        // Private functions
        var initDatatable = function() {
            // Set date data order
            const tableRows = table.querySelectorAll('tbody tr');

            tableRows.forEach(row => {
                const dateRow = row.querySelectorAll('td');
                const realDate = moment(dateRow[3].innerHTML, "DD MMM YYYY, LT").format(); // select date from 4th column in table
                dateRow[3].setAttribute('data-order', realDate);
            });

            // Init datatable --- more info on datatables: https://datatables.net/manual/
            datatable = $(table).DataTable({
                "info": false,
                'order': [],
                'pageLength': 10,
            });
        }

        // Hook export buttons
        var exportButtons = () => {
            const documentTitle = 'Nama File Nya';
            var buttons = new $.fn.dataTable.Buttons(table, {
                buttons: [{
                        extend: 'copyHtml5',
                        title: documentTitle
                    },
                    {
                        extend: 'excelHtml5',
                        title: documentTitle
                    },
                    {
                        extend: 'csvHtml5',
                        title: documentTitle
                    },
                    {
                        extend: 'pdfHtml5',
                        title: documentTitle
                    }
                ]
            }).container().appendTo($('#kt_datatable_example_1_export'));

            // Hook dropdown menu click event to datatable export buttons
            const exportButtons = document.querySelectorAll('#kt_datatable_example_1_export_menu [data-kt-export]');
            exportButtons.forEach(exportButton => {
                exportButton.addEventListener('click', e => {
                    e.preventDefault();

                    // Get clicked export value
                    const exportValue = e.target.getAttribute('data-kt-export');
                    const target = document.querySelector('.dt-buttons .buttons-' + exportValue);

                    // Trigger click event on hidden datatable export buttons
                    target.click();
                });
            });
        }

        var handleSearchDatatable = () => {
            const filterSearch = document.querySelector('[data-kt-filter="search"]');
            filterSearch.addEventListener('keyup', function(e) {
                datatable.search(e.target.value).draw();
            });
        }

        // Public methods
        return {
            init: function() {
                table = document.querySelector('#kt_datatable_example_1');

                if (!table) {
                    return;
                }

                initDatatable();
                exportButtons();
                handleSearchDatatable();
            }
        };
    }();

    // On document ready
    KTUtil.onDOMContentLoaded(function() {
        KTDatatablesButtons.init();
    });
</script>


<script>
    "use strict";

    // Class definition
    var KTDatatablesButtons2 = function() {
        // Shared variables
        var table;
        var datatable;

        // Private functions
        var initDatatable2 = function() {
            // Set date data order
            const tableRows = table.querySelectorAll('tbody tr');

            tableRows.forEach(row => {
                const dateRow = row.querySelectorAll('td');
                const realDate = moment(dateRow[3].innerHTML, "DD MMM YYYY, LT").format(); // select date from 4th column in table
                dateRow[3].setAttribute('data-order', realDate);
            });

            // Init datatable --- more info on datatables: https://datatables.net/manual/
            datatable = $(table).DataTable({
                "info": false,
                'order': [],
                'pageLength': 10,
            });
        }

        // Hook export buttons
        var exportButtons = () => {
            const documentTitle = 'Nama File Nya';
            var buttons = new $.fn.dataTable.Buttons(table, {
                buttons: [{
                        extend: 'copyHtml5',
                        title: documentTitle
                    },
                    {
                        extend: 'excelHtml5',
                        title: documentTitle
                    },
                    {
                        extend: 'csvHtml5',
                        title: documentTitle
                    },
                    {
                        extend: 'pdfHtml5',
                        title: documentTitle
                    }
                ]
            }).container().appendTo($('#kt_datatable_example_2_export'));

            // Hook dropdown menu click event to datatable export buttons
            const exportButtons = document.querySelectorAll('#kt_datatable_example_2_export_menu [data-kt-export]');
            exportButtons.forEach(exportButton => {
                exportButton.addEventListener('click', e => {
                    e.preventDefault();

                    // Get clicked export value
                    const exportValue = e.target.getAttribute('data-kt-export');
                    const target = document.querySelector('.dt-buttons .buttons-' + exportValue);

                    // Trigger click event on hidden datatable export buttons
                    target.click();
                });
            });
        }

        var handleSearchDatatable = () => {
            const filterSearch = document.querySelector('[data-kt-filter="search"]');
            filterSearch.addEventListener('keyup', function(e) {
                datatable.search(e.target.value).draw();
            });
        }

        // Public methods
        return {
            init: function() {
                table = document.querySelector('#kt_datatable_example_2');

                if (!table) {
                    return;
                }

                initDatatable2();
                exportButtons();
                handleSearchDatatable();
            }
        };
    }();

    // On document ready
    KTUtil.onDOMContentLoaded(function() {
        KTDatatablesButtons2.init();
    });
</script>

<script>
    const guest = <?php echo Illuminate\Support\Js::from($guest) ?>;
    const guestNonActive = <?php echo Illuminate\Support\Js::from($guest_non_active) ?>;
    let app = new Vue({
        el: '#app',
        data: {
            guest,
            guestNonActive,
            guestDetail: [],
            guestDetailNonAktive: [],

            loading: false,
        },
        methods: {
            onSelcected: function(id) {
                this.guestDetail = this.guest.filter((item) => {
                    return item.id == id;
                })[0]

            },
            onSelcectedNonAktif: function(id) {
                this.guestDetailNonAktive = this.guestNonActive.filter((item) => {
                    return item.id == id;
                })[0]

            },
            submitFormEdit: function() {
                this.sendData();
            },
            sendData: function() {
                let vm = this;
                vm.loading = true;
                axios.post('/admin/manage-user/' + this.guestDetail['id'] + '/edit', {
                        name: this.guestDetail['name'],
                        email: this.guestDetail['email'],
                        role_id: this.guestDetail['role_id'],
                        no_telp: this.guestDetail['no_telp'],
                    })
                    .then(function(response) {
                        vm.loading = false;
                        Swal.fire({
                            title: 'Berhasil',
                            text: 'User berhasil di update.',
                            icon: 'success',
                            allowOutsideClick: false,
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.href = '/admin/manage-user';
                            }
                        })
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
            deleteRecord: function(id) {
                Swal.fire({
                    title: 'Yakin Ingin Nonaktifkan data?',
                    text: "data akan di hapus di system",
                    icon: 'warning',
                    reverseButtons: true,
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Nonaktifkan',
                    cancelButtonText: 'Cancel',
                    showLoaderOnConfirm: true,
                    preConfirm: () => {
                        return axios.delete('/receptionist/manage-guest/' + id)
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
                            text: 'Guest Berhasil di Nonaktifkan',
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.reload();
                            }
                        })
                    }
                })
            },

            restoreRecord: function(id) {
                Swal.fire({
                    title: 'Yakin Ingin Restore data?',
                    text: "data akan di restore di system",
                    icon: 'warning',
                    reverseButtons: true,
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Restore',
                    cancelButtonText: 'Cancel',
                    showLoaderOnConfirm: true,
                    preConfirm: () => {
                        return axios.post('/receptionist/manage-guest/' + id)
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
                            text: 'Guest Berhasil di Aktifkan',
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