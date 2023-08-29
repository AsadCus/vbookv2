@extends('layouts.app')
@push('css')
<link rel="stylesheet" href="{{ asset('assets/booking-room/asset_all_new/assets_app/css/auth.css') }}">
@endpush
@section('content')

<div class="contents">

    <div class="container">
      <div class="row align-items-center justify-content-center">
        <div class="col-md-12">
          <div class="form-block mx-auto">
            <div class="d-flex mb-3" style="align-items: center; flex-direction: column;">
              <a class="brand" href="#"><img src="{{ asset('assets/booking-room/asset_all_new/Logo (1).png') }}" alt=""></a>
            </div>
            <div class="">
                <h3 class="text-center pt-3 ">BOOKING <b style="font-weight: bold">ROOM V2</b></h2>
                    <p class="text-center pb-5 text-dark">
                        Please say <B>PRESENT</B>  to <b>Booking Room V2</b> application - <b>{{ $event_title }}</b> <br>
                        Please enter the email registered in your event 
                    </p>
             </div>
            <form method="POST" action="{{ route('participants.absen.store',[$room_id,$event_id,$event_title]) }}">
                @csrf
              <div class="row mb-3 ">
                  <label for="email" class="col-md-12 col-form-label text-md-start">{{ __('Email Address') }}</label>
                  
                  <div class="col-md-12">
                      <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="Email room in here ...." required autocomplete="email" autofocus>
                      
                      @error('email')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                  </div>
              </div>
              <div class="row mb-0">
                  <div class="col-md-12">
                      <button type="submit" class="btn btn-block btn-dark" style="width: 100%">
                          <i class="mdi mdi-send"></i> {{ __('Sign In') }}
                      </button>
                      
                  </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>


<script>

</script>
@endsection
