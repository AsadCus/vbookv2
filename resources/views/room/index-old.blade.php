<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    {{-- <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests"> --}}
    {{-- <link href="https://fonts.googleapis.com/css2?family=Space+Mono&display=swap" rel="stylesheet"> --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;1,100;1,200&display=swap"
        rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css"
        integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
    <title>VBOOK </title>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }

        .blinking {
            animation: blinkingText 1.2s infinite;
        }

        @keyframes blinkingText {
            0% {
                color: #fff;
            }

            49% {
                color: #fff;
            }

            60% {
                color: transparent;
            }

            99% {
                color: transparent;
            }

            100% {
                color: #fff;
            }
        }

        #reader video {
            width: 100% !important;
        }

        .opacity {
            background: 100%;
            height: auto;
            background: #00000078;
        }

        .qr-code-fly {
            position: fixed;
            bottom: 30px;
            right: 30px;
            z-index: 99;
            background: white;
            padding: 10px;
        }

        .bg-vbook {
            background-image: url('{{ asset('assets/booking-room/images/BACKGROUND BOOKING DESK-min.png') }}');
            background-repeat: no-repeat;
            background-size: cover;
            background-attachment: fixed;
        }

    </style>
</head>
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content ">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Scanning room</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="event_id" name="event_id">
                <div style="width: 100%" id="reader"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" id="stop">Stop Scanner</button>
                {{-- <button type="button" class="btn btn-primary">Save changes</button> --}}
            </div>
        </div>
    </div>
</div>

<body onload="initClock()">
    <div class="bg-vbook">
        <div class="opacity">
            @if ($QrCode != '')
                <div class="qr-code-fly">
                    <div class="qr">
                        {{ $QrCode }}
                    </div>
                </div>
            @endif

            <div class="container-fluid">
                @php
                    
                    $bgcolor1 = '#35b552d6';
                    $bgcolor2 = '#358b48';
                    $isShowProgress = false;
                    $changeText = false;
                @endphp
                @if ($mybook->where('status_booking', 'ONPROGRESS')->count() > 0)
                    @php
                        $isShowProgress = true;
                        $onprogress = $mybook->where('status_booking', 'ONPROGRESS')->values();
                        $participant = $onprogress[0]->participants->where('email', $onprogress[0]->user->email)->first();
                        // dd($onprogress[0]->user->email);
                        $changeText = false;
                    @endphp
                    @if ($onprogress[0]->user->email == $participant->email && $participant->status_accept != 1)
                        @php
                            $bgcolor1 = '#3ea554d4';
                            $bgcolor2 = '#358b48';
                        @endphp
                    @else
                        @php
                            $bgcolor1 = '#b53535d6';
                            $bgcolor2 = '#a5322a';
                            $changeText = true;
                        @endphp
                    @endif
                @endif
                <div class="row" style="min-height: 100vh">
                    <div class="col-md-7 px-4 py-3">
                        <div class="container">
                            <div class="d-flex justify-content-center">
                                <video width="420" height="240" controls muted autoplay loop>
                                    <source src="{{ asset('assets/booking-room/images/video (1).mp4') }}"
                                        type="video/mp4">
                                    Your browser does not support the video tag.
                                </video>
                            </div>
                            {{-- <div class="card p-2">
                                <div class="card-body">
                                    <div class="embed-responsive embed-responsive-16by9">
                                        <iframe
                                            src="https://www.youtube.com/embed/UXJ3DGxyKLk?rel=0&autoplay=1"></iframe>
                                    </div>
                                </div>
                            </div> --}}
                            <div id="meetingOnProgress">

                            </div>

                            <div id="getNextMeeting">

                            </div>
                        </div>
                    </div>
                    <div class="col-md-5 px-4 py-3" id="eventRight"
                        style="background: {{ $bgcolor1 }};min-height: 635px;">
                        <h3 class="text-center text-white font-space">
                            <div class="datetime my-3">
                                <div class="time">
                                    <span id="hour">00</span> :
                                    <span id="minutes">00</span>
                                    <span id="seconds" style="display: none;">00</span>
                                    <span id="period">AM</span>
                                </div>
                                <div class="date">
                                    <span id="dayname">Day</span>,
                                    <span id="month">Month</span>
                                    <span id="daynum">00</span>
                                    <span id="year" style="display: none;">Year</span>
                                </div>
                            </div>
                            <h3 class="text-white text-center">Upcoming Event -
                                {{ auth()->guard()->user()->room->name }}</h3>
                            <hr class="border-white">
                            <div id="upComing">

                            </div>
                        </h3>
                        <div class="" style="position: absolute;right:20px;bottom:0">
                            <a class="btn btn-warning mt-auto" href="{{ route('logout') }}" onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
                                <i class="fas fa-sign-out-alt mr-2"></i> {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                class="d-none">
                                @csrf
                            </form>
                            <div class="button-verify text-right mt-3">
                                {{-- <button type="button" data-event="{{ $item->id }}" class="btn text-danger scanner"
                                style="background-color: white;border-radius:0;font-weight:bold">VERIFY QR
                                CODE</button> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>

    </script>
    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    {{-- <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script> --}}
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>
    <script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script src="https://js.pusher.com/7.0/pusher.min.js"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            $(document).on('click','[data-toggle="tooltip"]', function () {
                $(this).tooltip('show');
            });
        })
        function updateClock() {
            var now = new Date();
            var dname = now.getDay(),
                mo = now.getMonth(),
                dnum = now.getDate(),
                yr = now.getFullYear(),
                hou = now.getHours(),
                min = now.getMinutes(),
                sec = now.getSeconds(),
                pe = "AM";

            if (hou >= 12) {
                pe = "PM";
            }
            if (hou == 0) {
                hou = 12;
            }
            if (hou > 12) {
                hou = hou - 12;
            }

            Number.prototype.pad = function(digits) {
                for (var n = this.toString(); n.length < digits; n = 0 + n);
                return n;
            }

            var months = ["January", "February", "March", "April", "May", "June", "July", "Augest", "September", "October",
                "November", "December"
            ];
            var week = ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"];
            var ids = ["dayname", "month", "daynum", "year", "hour", "minutes", "seconds", "period"];
            var values = [week[dname], months[mo], dnum.pad(2), yr, hou.pad(2), min.pad(2), sec.pad(2), pe];
            for (var i = 0; i < ids.length; i++)
                document.getElementById(ids[i]).firstChild.nodeValue = values[i];
        }

        function initClock() {
            updateClock();
            window.setInterval("updateClock()", 1);
        }
    </script>

    <script>
        
        const sendGetRequest = (text) => {
            return new Promise((resolve, reject) => {
                try {
                    axios.post('{{ route('display.checkParticipants') }}', {
                        _token: '{{ csrf_token() }}',
                        decodedTextRequest: text,
                        event_id: $('#event_id').val()
                    }).then((res) => {
                        resolve(res)
                    }).catch((err) => {
                        reject(err)
                    });
                } catch (err) {
                    // Handle Error Here
                    reject(err.response.data)
                }
            })
        };

        // const config = { fps: 10, qrbox: { width: 250, height: 250 } };
        const html5QrCode = new Html5Qrcode("reader");
        let decode = '';
        let no = 0

        const qrCodeSuccessCallback = (decodedText, decodedResult) => {
            /* handle success */
            // console.log(decodedText);
            no++;
            if (no == 1) {
                setTimeout(() => {
                    sendGetRequest(decodedText)
                        .then((response) => {

                            no == 0;
                            axios.get(
                                'https://cloudapi.taphome.com/api/cloudapi/v1/setDeviceValue/3?token=f54767bf-e8c2-4655-b728-91109cc5b8ee&valueTypeId=48&value=1'
                            ).then((response) => {
                                axios.post(
                                'http://192.168.20.113:8080/v1/oauth2/token/', {
                                    grant_type: "password",
                                    username: "admin",
                                    password: "12345678"
                                })
                                .then((res) => {
                                    let token = res.data.access_token;

                                    const config = {
                                        headers: {
                                            Authorization: `Bearer ${token}`
                                        }
                                    };

                                    let paramsBody = {
                                        "red": 255,
                                        "green": 0,
                                        "blue": 0,
                                    };
                                    
                                    axios.post('http://192.168.20.113:8080/v1/led/front_led/',paramsBody,config)
                                    .then((res) => {
                                        console.log(res)
                                    })
                                    .catch((err) => {
                                        console.log(err);
                                    })

                                    axios.post('http://192.168.20.113:8080/v1/led/side_led/',paramsBody,config)
                                    .then((res) => {
                                        console.log(res);
                                    })
                                    .catch((err) => {
                                        console.log(err);
                                    })

                                    Swal.fire(  
                                        'Yeah!',
                                        'Success Scan data',
                                        'success'
                                    )
                                    
                                    setTimeout(() => {
                                        location.reload();
                                    }, 2000);
                                
                                })
                                .catch((err) => {
                                    console.log(err);
                                });
                            })

                           

                        })
                        .catch((err) => {
                            no = 0;
                            Swal.fire(
                                'Failed!',
                                err.response.data.message,
                                'error'
                            )
                        })
                }, 1000);
            }
        };

        const qrCodeFailedCallback = (decodedText, decodedResult) => {

            console.log(decodedText);
        };

        const config = {
            fps: 10,
            qrbox: {
                width: 250,
                height: 250
            }
        };

$('#test').click(function() {

});

    $(document).on('click', '.scanner', function() {
        $('#exampleModal').modal('show');
        let event_id = $(this).data('event');

        $('#event_id').val(event_id);

        html5QrCode.start({
            facingMode: "user"
        }, config, qrCodeSuccessCallback);
    })

    $('#exampleModal').on('hidden.bs.modal', function(e) {
        html5QrCode.stop();
        
    })

    $(document).on('click', '#stop', function() {

        html5QrCode.stop().then((ignore) => {
            // QR Code scanning is stopped.
            $('#exampleModal').modal('hide');
        }).catch((err) => {
            // Stop failed, handle it.
        });
    })

    showTime();

    // program to display time every 5 seconds
    function showTime() {
        $.ajax({
            url: '{{ route('display.index') }}',
            type: 'GET',
            success: function(res) {
                console.log(res);
                $('#meetingOnProgress').html(res.meetingProgress);
                $('#upComing').html(res.meetingUpcoming);
                $('#getNextMeeting').html(res.getNextMeeting);

                $('#eventRight').css({
                    'background': res.dataColor[0]
                });
                
                if (res.QrCode != '') {
                    // $('.qr').html(res.QrCode);

                } else {
                    axios.get(
                        'https://cloudapi.taphome.com/api/cloudapi/v1/setDeviceValue/3?token=f54767bf-e8c2-4655-b728-91109cc5b8ee&valueTypeId=48&value=0'
                    ).then((response) => {
                        axios.post(
                        'http://192.168.20.113:8080/v1/oauth2/token/', {
                            grant_type: "password",
                            username: "admin",
                            password: "12345678"
                        })
                        .then((res) => {
                            let token = res.data.access_token;

                            const config = {
                                headers: {
                                    Authorization: `Bearer ${token}`
                                }
                            };

                            let paramsBody = {
                                "red": 0,
                                "green": 255,
                                "blue": 0,
                            };

                            axios.post('http://192.168.20.113:8080/v1/led/front_led/',paramsBody,config)
                            .then((res) => {
                                console.log(res)
                            })
                            .catch((err) => {
                                console.log(err);
                            })
                            
                            axios.post('http://192.168.20.113:8080/v1/led/side_led/',paramsBody,config)
                            .then((res) => {
                                console.log(res)
                            })
                            .catch((err) => {
                                console.log(err);
                            })
                        })
                    })

                    
                    .catch((err) => {
                        console.log(err);
                    });

                    // alert('HABISS');
                    $('.qr-code-fly').hide();
                }
            },

            error: function(err) {
                console.log(err)
            },
        })
    }
    
    let display = setInterval(showTime, 5000);
</script>

<script>
    // Enable pusher logging - don't include this in production
    Pusher.logToConsole = true;

    var pusher = new Pusher('196f08349d2a05f2f2a6', {
        cluster: 'ap1'
    });

    let id = {{ Auth::id() }};
    var channel = pusher.subscribe('my-channel_' + id);
    channel.bind('create-event_' + id, function(data) {
        // alert(JSON.stringify(data));
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 2000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        })

        Toast.fire({
            icon: 'success',
            title: data.message
        })

        setTimeout(() => {
            location.reload();
        }, 2000)
    });
</script>
</body>

</html>
