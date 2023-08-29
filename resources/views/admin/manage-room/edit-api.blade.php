@extends('layouts.app')
@section('title', 'Dashboard | Manage Room | Edit Room API')
@inject('carbon', 'Carbon\Carbon')
@inject('carbonInterval', 'Carbon\CarbonInterval')

@section('content')
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <div class="container-xxl" id="kt_content_container">
        <form action="/admin/manage-room/{{ $room->id }}/update-api" method="POST" enctype="multipart/form-data" class="form d-flex flex-column flex-lg-row">
            @csrf
            <div class="d-flex flex-column flex-row-fluid gap-7 gap-lg-10">
                <div class="d-flex flex-column gap-7 gap-lg-10">
                    <div class="card card-flush py-4">
                        <div class="card-header">
                            <div class="card-title">
                                <h2>Edit Api {{ $room->name }}</h2>
                            </div>
                        </div>
                        <div class="card-body pt-0">
                            <div class="mb-10 fv-row">
                                <div class="row col-lg-12">
                                    <input type="hidden" name="room_id" value="{{ $room->id }}">
                                    @if ($room->apiRoom->count() > 0)    
                                    @foreach ($room->apiRoom as $itemApiRoom)  
                                    <div class="col-lg-6 mb-5">
                                        <label class="required form-label">{{ $itemApiRoom->api->name }}</label>
                                        <input type="text" class="form-control mb-2" name="api[]" value="{{ $itemApiRoom->name }}" placeholder="ex : https://" />
                                        <div class="text-muted fs-7">{{ $itemApiRoom->api->desc }}.</div>
                                    </div>
                                    @endforeach
                                    @else
                                    @foreach ($apis as $itemApi)  
                                    <div class="col-lg-6 mb-5">
                                        <label class="required form-label">{{ $itemApi->name }}</label>
                                        <input type="text" class="form-control mb-2" name="api[]" placeholder="ex : https://" />
                                        <div class="text-muted fs-7">{{ $itemApi->desc }}.</div>
                                    </div>
                                    @endforeach
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-end">
                    <a href="/admin/manage-room" id="kt_ecommerce_add_product_cancel" class="btn btn-secondary me-5">Cancel</a>
                    <button type="submit" class="btn btn-primary">
                        <span class="indicator-label">Save</span>
                        <span class="indicator-progress">Please wait...
                            <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                        </span>
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection