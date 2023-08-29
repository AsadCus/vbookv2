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
    <!-- Font Awesome CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"
        integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;1,100;1,200&display=swap"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Space+Mono&display=swap" rel="stylesheet">
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
            background: white;
            width: 133px;
            display: none;
            padding: 10px;
        }

        .font-space {
            font-family: 'Space Mono', monospace;
        }

        .background-display {
            background-image: url('{{ asset('/assets/booking-room/images/background-display.png') }}');
            background-position: left;
            background-repeat: no-repeat;
            background-size: cover;
            height: 100%;
        }

        .garis-led {
            margin-top: 0vh;
            margin-bottom: 0vh;
            border: 11px solid #F31111;
            border-radius: 14vw;
            height: 92vh;
            width: 1px;
            transform: rotate(180deg);
            background-color: #F31111;
        }

        .info-card {
            background-color: #303030;
            border-radius: 15px;
        }

        /* .circle {
        border: 2px solid red;
        height: 100px;
        border-radius:50%;
        width: 100px;
      } */

        .text-title {
            font-size: 4rem;
            color: #F31111;
        }

        .centered {
            position: absolute;
            top: 9%;
            width: 130px;
        }

        .progres {
            position: relative;
            margin: 4px;
            float: left;
            text-align: center;
        }

        .scrollbar {
            float: left;
            overflow-y: scroll;
            height: 40px;
        }

        #style-1::-webkit-scrollbar-track {
            -webkit-box-shadow: inset 0 0 6px rgba(0, 0, 0, 0.3);
            border-radius: 10px;
        }

        #style-1::-webkit-scrollbar {
            width: 4px;
        }

        #style-1::-webkit-scrollbar-thumb {
            border-radius: 10px;
            -webkit-box-shadow: inset 0 0 6px rgba(0, 0, 0, .3);
            background-color: #555;
        }

        .barOverflow {
            /* Wraps the rotating .bar */
            position: relative;
            /* overflow: hidden; Comment this line to understand the trick */
            width: 272px;
            height: 136px;
            /* Half circle (overflow) */
            margin-bottom: -14px;
            /* bring the numbers up */
        }

        .bar {
            position: absolute;
            /* bottom: 0; */
            /* left: 0; */
            width: 225px;
            height: 225px;
            border-radius: 50%;
            box-sizing: border-box;
            border: 10px solid #F31111;
            border-bottom-color: #F31111;
            border-right-color: #F31111;
        }

        .style-after-upcoming {
            position: absolute;
            z-index: 99;
            bottom: 74px;
            right: 100px;
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

<body class="background-display">
    <div class="container-fluid">
        <div class="row" style="height: 100vh;">
            <div class="col-md-1 px-4 py-3">
                <hr class="garis-led">
            </div>
            <div class="col-md-5 p-0 py-3 ">
                <div style="height: 38vh;">
                    <!-- <div class="circle"></div> -->
                    <div class="progre">
                        <div class="barOverflo">
                            <div class="bar" style="transform: rotate(405deg);"></div>
                        </div>
                    </div>
                </div>
                {{-- <div class="d-flex my-3" style="align-items: center;">
                    <a class="brand w-100 mr-3" href="#"><img
                            src="{{ asset('assets/booking-room/images/logo-pelindo.png') }}" class="w-50" alt=""></a>
                </div> --}}
                <div class="centered mx-5 text-center" id="afterCountdown">
                    {{-- <h4 class="m-0 font-weight-normal text-white" id="title-bar">For Next</h4> --}}
                </div>
                <h4 class="m-0 font-weight-normal text-white">Room - {{ auth()->guard('web')->user()->room->name }}
                </h4>
                <div id="meetingOnProgress">
                    {{-- <h1 class="text-title m-0">Daily <br> Meeting</h1>
                    <h2 class="m-0 font-weight-normal text-white" style="font-size: 30px;">in progress until 11:00</h2>
                    <h4 class="m-0 font-weight-normal text-white">Meeting Room 1</h4> --}}
                </div>
                <div id="getNextMeeting">
                </div>
                <div class="d-flex mt-3 ">
                    <div class="mr-3 mb-2">
                        <div class="card-body text-white text-center info-card">
                            <h1 class="font-weight-normal m-0 mb-3">
                                {{ auth()->guard('web')->user()->room->kapasitas }} <i class="fas fa-user-friends"></i>
                            </h1>
                            <h5 class="font-weight-normal m-0 ">Room Capacity</h5>
                        </div>
                    </div>
                    @if (auth()->guard('web')->user()->room->projector == 1)
                        <div class="mr-3 mb-2">
                            <div class="card-body text-white text-center info-card">
                                <h1 class="font-weight-normal m-0 mb-3"><i class="fas fa-tv"></i></h1>
                                <h5 class="font-weight-normal m-0 ">Proyektor</h5>
                            </div>
                        </div>
                    @endif
                    @if (auth()->guard('web')->user()->room->internet == 1)
                        <div class="mr-3 mb-2">
                            <div class="card-body text-white text-center info-card">
                                <h1 class="font-weight-normal m-0 mb-3"><i class="fas fa-wifi"></i></h1>
                                <h5 class="font-weight-normal m-0 ">Internet</h5>
                            </div>
                        </div>
                    @endif
                </div>
                <div class="logout mt-5">
                    <a class="btn btn-warning mt-auto" href="{{ route('booking-room.logout') }}"
                        onclick="event.preventDefault();
                document.getElementById('logout-form').submit();">
                        <i class="fas fa-sign-out-alt mr-2"></i> {{ __('Logout') }}
                    </a>
                    <form id="logout-form" action="{{ route('booking-room.logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                    <a href="{{ route('desk.index') }}" class="btn btn-success">
                        <i class="mdi mdi-home"></i> Desk
                    </a>
                    <span class="btn btn-primary" onclick="location.reload();"> Refresh</span>
                </div>
            </div>
            <div class="col-md-2 py-4">
                {{-- <a class="brand" href="#"><img src="{{ asset('assets/booking-room/images/pelindo-tower.jpeg') }}"
                        class="" style="position: absolute; width: 37vw; left: -252px; top: 50px;"
                        alt=""></a> --}}
            </div>
            <div class="col-md-4 px-4 py-3">
                <h4 id="ct5" class="text-white font-weight-normal text-center"></h4>
                {{-- <h5 class="text-white font-weight-normal text-center d-none">{{ $myRoom[0]->ip_address }}</h5> --}}
                {{-- <button onclick="location.reload();" class="btn btn-success d-none">Refresh</button> --}}
                <div class="p-4 text-center d-flex justify-content-center">
                    {{-- @if ($QrCode != '') --}}
                    <div class="qr-code-fly">
                        <div class="qr">
                            {{-- {{ $QrCode }} --}}
                        </div>
                    </div>
                    {{-- @endif --}}
                </div>
                <div class="text-center mb-3 absent">
                </div>
                <div class="style-after-upcoming">
                    <h2 class="text-white font-weight-normal">Upcoming Event</h3>
                        <div style="overflow: auto; height: 42vh;" id="upComing">
                            <!-- upcoming Event -->
                            <!-- <div class="text-white my-4">
                        <h5 class="font-weight-normal m-0">No event today..</h5>
                    </div> -->
                            <!-- upcoming Event -->
                        </div>
                </div>
            </div>
        </div>
    </div>
    <script></script>
    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    {{-- <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
    </script> --}}
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
        // BUAT GANTI IP 
        let VDESKIP = '';
        // let VBOOKIP = '{{ 'http://' . $myRoom[0]->ip_address }}';
        // let VSLIMIP = '{{ 'http://' . $myRoom[0]->ip_address }}';
        // Ubah yang bawah ini vi
        let VBOOKIP = 'http://10.189.3.90';
        let VSLIMIP = 'http://10.189.3.90';
        let CRESTRONLINK =
            'https://cloudapi.taphome.com/api/cloudapi/v1/setDeviceValue/5?token=f05b3e96-e886-40d4-839e-d9e6744cc031&valueTypeId=48';

        var hasWebcam = false;
        // check device has webcam or not
        function webcam_check_func() {
            return new Promise((resolve, reject) => {
                var device = [];
                if (navigator.mediaDevices && navigator.mediaDevices.enumerateDevices) {
                    navigator.enumerateDevices = function(callback) {
                        navigator.mediaDevices.enumerateDevices().then(callback);
                    };
                    navigator.enumerateDevices(function(devices) {
                        devices.forEach(function(my_device) {
                            if (my_device.kind === 'videoinput') {
                                // debugger;
                                hasWebcam = true;
                                resolve(hasWebcam);
                            }
                        });
                    });
                }
            })
        }

        function display_ct5() {
            var x = new Date()
            var ampm = x.getHours() >= 12 ? ' PM' : ' AM';
            var x1 = x.getMonth() + 1 + "/" + x.getDate() + "/" + x.getFullYear();
            x1 = x1 + " - " + x.getHours() + ":" + x.getMinutes() + ":" + x.getSeconds() + ":" + ampm;
            document.getElementById('ct5').innerHTML = x1;
            display_c5();
        }

        function display_c5() {
            var refresh = 1000; // Refresh rate in milli seconds
            mytime = setTimeout('display_ct5()', refresh)
        }
        display_c5()
        // $(document).ready(function() {
        $(document).on('click', '[data-toggle="tooltip"]', function() {
            $(this).tooltip('show');
        });
        // })
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
        let no = 0;
        let timer;
        const qrCodeSuccessCallback = (decodedText, decodedResult) => {
            /* handle success */
            alert(decodedText);
            no++;
            if (no == 1) {
                setTimeout(() => {
                    sendGetRequest(decodedText)
                        .then((response) => {
                            no == 0;
                            //VBOOK
                            // axios.get(
                            //     // 'https://cloudapi.taphome.com/api/cloudapi/v1/setDeviceValue/3?token=f54767bf-e8c2-4655-b728-91109cc5b8ee&valueTypeId=48&value=1'
                            //     `${CRESTRONLINK}&value=1`
                            // )
                            // .then((response) => {
                            alert('Masuk Fungsi Ubah LED');
                            // VBOOK
                            axios.post(`${VBOOKIP}:8080/v1/oauth2/token/`, {
                                    grant_type: "password",
                                    username: "admin",
                                    password: "12345678"
                                })
                                .then((res) => {
                                    let token = res.data.access_token;
                                    let config = {
                                        headers: {
                                            Authorization: `Bearer ${token}`
                                        }
                                    };
                                    let paramsBody = {
                                        "red": 255,
                                        "green": 0,
                                        "blue": 0,
                                    };
                                    axios.post(
                                            `${VBOOKIP}:8080/v1/led/front_led/`,
                                            paramsBody, config)
                                        .then((res) => {
                                            console.log(res)
                                        })
                                        .catch((err) => {
                                            alert('Error front : ', err.message);
                                            console.log(err);
                                        })
                                    axios.post(
                                            `${VBOOKIP}:8080/v1/led/side_led/`,
                                            paramsBody, config)
                                        .then((res) => {
                                            console.log(res);
                                        })
                                        .catch((err) => {
                                            alert('Error side : ', err.message);
                                            console.log(err);
                                        })
                                })
                                .catch((err) => {
                                    alert('Error : ', err.message);
                                })

                            // })
                            // .catch((err) => {
                            //     alert('Error crestron : '.err.message);
                            //     console.log(err);
                            // });
                            Swal.fire(
                                'Yeah!',
                                'Success Scan data',
                                'success'
                            )
                            setTimeout(() => {
                                location.reload();
                            }, 8000);
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

        function change_led(color) {
            var paramsBody;
            var crestronVal;
            if (color == '#22df41') {
                // alert('berubah hijau');
                paramsBody = {
                    "red": 0,
                    "green": 255,
                    "blue": 0,
                };
                crestronVal = 0;
            } else {
                // alert('berubah merah');
                paramsBody = {
                    "red": 255,
                    "green": 0,
                    "blue": 0,
                };
                crestronVal = 1;
            }
            axios.get(
                    // 'https://cloudapi.taphome.com/api/cloudapi/v1/setDeviceValue/3?token=f54767bf-e8c2-4655-b728-91109cc5b8ee&valueTypeId=48&value=0'
                    `${CRESTRONLINK}&value=${crestronVal}`
                )
                .then((response) => {
                    axios.post(
                            `${VBOOKIP}:8080/v1/oauth2/token/`, {
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
                            axios.post(`${VBOOKIP}:8080/v1/led/front_led/`,
                                    paramsBody, config)
                                .then((res) => {
                                    console.log(res)
                                })
                                .catch((err) => {
                                    console.log(`Error front led : ${err}`);
                                })
                            axios.post(`${VBOOKIP}:8080/v1/led/side_led/`,
                                    paramsBody, config)
                                .then((res) => {
                                    console.log(res);
                                })
                                .catch((err) => {
                                    console.log(`Error side led : ${err}`);
                                })
                        })
                        .catch((err) => {
                            console.log(`Error oauth2 token : ${err}`);
                        });
                })
                .catch((err) => {
                    console.log(`Error CRESTRONLINK : ${err}`);
                });
        }

        const config = {
            fps: 10,
            qrbox: {
                width: 250,
                height: 250
            }
        };
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
            let nos = 0;
            $.ajax({
                url: '{{ route('display.index') }}',
                type: 'GET',
                success: function(res) {
                    // webcam_check_func()
                    // .then((res) => {
                    //     // if(res == true){
                    //         // console.log(res);
                    //     // }
                    // });
                    // navigator.getMedia = ( navigator.getUserMedia || // use the proper vendor prefix
                    //    navigator.webkitGetUserMedia ||
                    //    navigator.mozGetUserMedia ||
                    //    navigator.msGetUserMedia);
                    // navigator.getMedia({video: true}, function() {
                    //     // webcam is available
                    // }, function() {
                    //     // webcam is not available
                    // });
                    $('.bar').css({
                        'border': '10px solid ' + res.dataColor[0],
                        'border-bottom-color': res.dataColor[0],
                        'border-right-color': res.dataColor[0],
                    })
                    $('.garis-led').css({
                        'border': '11px solid ' + res.dataColor[0],
                        'background-color': res.dataColor[0]
                    })
                    $('#meetingOnProgress').html(res.meetingProgress);
                    $('#upComing').html(res.meetingUpcoming);
                    $('#getNextMeeting').html(res.getNextMeeting);
                    $('#title-bar').html("For Next");
                    // $('#afterCountdown').html("")
                    $('#afterCountdown').html(res.minutesText);
                    // console.log(res.QrCode != '');
                    if (res.QrCode != '') {
                        $('.absent').html(res.showButtonVerify);
                        $('.qr').html(res.QrCode);
                        $('.qr-code-fly').show();
                        // console.log('sdsdsdsd');
                        if (res.countdown == '') {
                            $('#title-bar').html("");
                            $('#afterCountdown').html("")
                            clearInterval(timer);
                        }
                    } else {
                        // alert(`Data Color showTime : ${res.dataColor[0]}`);
                        $('.qr-code-fly').hide();
                    }

                    // ubah warna led
                    change_led(res.dataColor[0]);
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
