<div id="row-card" class="row" style="margin-bottom: 5rem;">
    @foreach($monitor as $mon)
    {{-- @if ($mon->bookingRoom->where('status_booking', '!=', 'done')->count() > 0) --}}
    <div class="col-xxl-4 col-xl-4 col-lg-6 col-md-6 mt-4">
        <div class="content-table">
        <div class="ct-box">
            <div class="ct-header d-flex align-items-center justify-content-between"
                style="background-color: {{$mon->color_code}}; padding: .5rem 1rem;">
                <div class="cth-left">
                    <h4 class="mb-0 text-white">{{$mon->name}}</h4>
                </div>
                <div class="cth-right d-flex align-items-center gap-1">
                    <div class="arrow-left">
                        <img src="{{ asset('image_monitor/arrow.png')}}" alt="">
                    </div>
                    <div class="lantai d-flex align-items-center" style="background-color: white; padding: .1rem .5rem; border-radius: .25rem;">
                        <img src="{{ asset('image_monitor/loc-merah.png')}}" alt="">
                        <p class="mb-0 fw-bold" style="color: #A10000">Lt.{{$mon->floor}}</p>
                    </div>
                </div>
            </div>
            <div class="ct-subheader" style="padding: .5rem 1rem; width: 100%;">
                <div class="cts-content d-flex gap-2 align-items-center">
                    <div class="box" style="width: 15px; height: 15px; background: black"></div>
                    @if($mon->bookingRoom->where("status_booking", "ongoing")->count() > 0)
                    <p class="mb-0 fw-bold" style="color: #A10000;">
                    Saat Ini Berlangsung : {{ $mon->bookingRoom->where("status_booking", "ongoing")->first()->title }}</p>
                    @else
                    <p class="mb-0 fw-bold" style="color: #A10000;">
                    Tidak Ada Meeting Berlangsung
                    </p>
                    @endif
                </div>
                <hr style="border-top: 1px solid black; margin: .5rem 0;">
                <div class="next-meeting d-flex justify-content-between">
                    <p style="color: black; font-weight: 600;">Next Meeting</p>
                    <p class="fw-bolder" style="color: grey;">Hari Ini</p>
                </div>
                {{-- {{var_dump($mon->booking_rooms)}} --}}
                @foreach($mon->bookingRoom->where("status_booking", "waiting") as $item)
                <div class="row list-project">
                    <div class="col-md-1 col-1">  
                        <div class="box">
                        </div>
                    </div>
                    <div class="col-md-11 col-11">
                        <div class="row">
                            <div class="col-md-5 col-5 text-start">
                                <p class="pm mb-0" style="font-weight: 600;">{{Str::limit($item->title, 14)}}</p>
                            </div>
                            <div class="col-md-7 col-7 text-end">
                                <p class="pm mb-0" style="font-weight: 600;">{{date('h:i A', strtotime($item->start_date))}} - {{date('h:i A', strtotime($item->end_date))}}</p>
                            </div>
                        </div>
                        <hr style="border-top: 1px solid black; margin: .25rem 0;">
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        </div>
    </div>
    {{-- @endif --}}
    @endforeach
</div>