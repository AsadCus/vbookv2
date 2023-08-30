<!doctype html>
<html lang="en">

<head>
    
<link rel="shortcut icon" href="{{ asset('gambar/logo-vbook.png') }}" />
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    <title>Monitor</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/index.css">
    <style>
        body{
            overflow-x: hidden;
        }
        /* .footer{
    position: sticky; 
    bottom: 0;
    background-color: white; */

    </style>
</head>

<body>
    <section class="content pt-4">
        <div class="container d-flex justify-content-between align-items-center">
            <div class="top-left">
                <img src="{{ asset("gambar/company/$company->logo" )}}" alt="">
            </div>
            <div class="top-middle text-center">
                <h4 class="fw-bold">Schedule Activities</h5>
                <h4>{{$company->name}}</h5>
            </div>
            <div class="top-right text-end">
                <h5 class="fw-bold">{{ \Carbon\Carbon::parse()->format('d M Y')}}</h5>
                <h5 id="MyClockDisplay" onload="showTime()"></h5>
            </div>
        </div>

        <div class="container py-4" id="Banner">
                    <img class="img-dnh" src="{{ asset('image_monitor/denah.png')}}" alt="">
                    <div class="content-top">
                        <video width="100%" height="250px" style="background-color: #000;" controls autoplay loop>
                            <source src="{{ asset("video/company/$company->video") }}">
                        </video>
                    </div>
                    <div class="content-qr text-center" style="padding: 1rem;box-shadow: 0px 0px 4px rgba(0, 0, 0, 0.25); height: max-content;">
                        <p class="mb-0 fw-bold">ABSENSI</p>
                        <p class="mb-0 fw-bold">KEHADIRAN RAPAT</p>
                        <img class="img-qr mt-3" src="{{ asset('qrcode/attendance-qrcode.png')}}" alt="">
                    </div>
        </div>
        <div class="container" id="container-monitor-info">
            <div id="row-card" class="row" style="margin-bottom: 5rem;">
            @foreach($monitor as $monitorList)
            {{-- @if ($monitorList->bookingRoom->where('status_booking', '!=', 'finished')->count() > 0) --}}
            <div class="col-xxl-4 col-xl-4 col-lg-6 col-md-6 mt-4">
                <div class="content-table">
                <div class="ct-box">
                    <div class="ct-header d-flex align-items-center justify-content-between"
                        style="background-color: {{$monitorList->color_code}}; padding: .5rem 1rem;">
                        <div class="cth-left">
                            <h4 class="mb-0 text-white">{{$monitorList->name}}</h4>
                        </div>
                        <div class="cth-right d-flex align-items-center gap-1">
                            <div class="arrow-left">
                                <img src="{{ asset('image_monitor/arrow.png')}}" alt="">
                            </div>
                            <div class="lantai d-flex align-items-center" style="background-color: white; padding: .1rem .5rem; border-radius: .25rem;">
                                <img src="{{ asset('image_monitor/loc-merah.png')}}" alt="">
                                <p class="mb-0 fw-bold" style="color: #A10000">Lt.{{$monitorList->floor}}</p>
                            </div>
                        </div>
                    </div>
                    <div class="ct-subheader" style="padding: .5rem 1rem; width: 100%;">
                        <div class="cts-content d-flex gap-2 align-items-center">
                            <div class="box" style="width: 15px; height: 15px; background: black"></div>
                            @if($monitorList->bookingRoom->where("status_booking", "ongoing")->count() > 0)
                            <p class="mb-0 fw-bold" style="color: #A10000;">
                            Saat Ini Berlangsung : {{ $monitorList->bookingRoom->where("status_booking", "ongoing")->first()->title }}</p>
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
                        @foreach($monitorList->bookingRoom->where("status_booking", "waiting") as $item)
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
            {{-- @if ($monitor)
                
            @endif --}}
        </div>
        <footer>
            <div class="row" style="border: .5px solid rgb(199, 198, 198); position: fixed; bottom: 0; background: white; width: 105%;";>
                <div class="col-12 col-sm-3 col-lg-2" style="background: #A10000;">
                    <div class="footer-red d-flex justify-content-center align-items-center gap-2" style="padding: .75rem;">
                        <div class="">
                            <img src="{{ asset('image_monitor\toa.png')}}" alt="">
                        </div>
                        <p class="text-white fw-bold mb-0">INFORMATION :</p>
                    </div>
                </div>
                <div class="col-12 col-sm-9 col-lg-10 my-auto">
                    <p class="information mb-0 fw-bold">Lorem ipsum dolor sit amet consectetur. Eros suspendisse aliquam lacus sit a nascetur. Cursus faucibus molestie arcu viverra.</p>
                </div>
            </div>
        </footer>
    </section>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

    <script>
        // function refreshContent() {
        //     $.ajax({
        //         type: 'GET',
        //         url: '{{ route('monitor.card') }}'
        //     }).done(function (data) {
        //         $("#row-card").remove();
        //         $("#container-monitor-info").append(data)
        //     });
        // }
        // setInterval(refreshContent, 5000);

        function showTime(){
            var date = new Date();
            var h = date.getHours(); // 0 - 23
            var m = date.getMinutes(); // 0 - 59
            var s = date.getSeconds(); // 0 - 59
            var session = "AM";
            if(h == 0){
                h = 12;
            }
            if(h > 12){
                h = h - 12;
                session = "PM";
            }
            h = (h < 10) ? "0" + h : h;
            m = (m < 10) ? "0" + m : m;
            s = (s < 10) ? "0" + s : s;
            var time = h + ":" + m + ":" + s + " " + session;
            document.getElementById("MyClockDisplay").innerText = time;
            document.getElementById("MyClockDisplay").textContent = time;
            setTimeout(showTime, 100);    
        }
    
        console.log(showTime());
    </script>
</body>

</html>
