<!doctype html>
<html lang="en">

<head>
    @php
    \Carbon\Carbon::setLocale('id')
    @endphp
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests" /> -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <!-- Font Awesome CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;1,100;1,200&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Space+Mono&display=swap" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
    <title>VBOOK </title>
    <style>
        [v-cloak]>* {
            display: none;
        }

        [v-cloak]::before {
            content: "Sedang mengambil data...";
            color: #fff;
        }

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

        #rcorners1 {
            /* hijau */
            border-radius: 15px 50px 30px 5px;
            border: 2px solid #22df41;
            padding: 10px;
            width: 350px;
            height: 75px;
            font-size: 15px;
        }

        #rcorners2 {
            /* merah */
            border-radius: 15px 50px 30px 5px;
            border: 2px solid #ff461f;
            padding: 10px;
            width: 350px;
            height: 75px;
            font-size: 15px;
        }


        #rcorners3 {
            /* hijau  */
            border-radius: 15px 50px 30px 5px;
            border: 2px solid #22df41;
            padding: 10px;
            width: 340px;
            height: 50px;
        }

        #rcorners4 {
            /* merah */
            border-radius: 15px 50px 30px 5px;
            border: 2px solid #ff461f;
            padding: 10px;
            width: 340px;
            height: 50px;
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
            background-image: url('{{ asset("/assets/booking-room/images/background-display.png") }}');
            background-position: left;
            background-repeat: no-repeat;
            background-size: cover;
            height: 100%;
        }

        .garis-led {
            margin-top: 0vh;
            margin-bottom: 0vh;
            /* border: 11px solid #F31111; */


            border-radius: 14vw;
            height: 92vh;
            width: 1px;
            transform: rotate(180deg);

        }

        .garis-led-hijau {
            margin-top: 0vh;
            margin-bottom: 0vh;
            border: 11px solid #22df41;


            border-radius: 14vw;
            height: 92vh;
            width: 1px;
            transform: rotate(180deg);

        }

        .garis-led-merah {
            margin-top: 0vh;
            margin-bottom: 0vh;
            border: 11px solid #ff461f;


            border-radius: 14vw;
            height: 92vh;
            width: 1px;
            transform: rotate(180deg);

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

<body class="background-display">
    <div id="app" v-cloak>
        <div class="container-fluid">
            <div class="row" style="height: 100vh;">
                <div class="col-md-1 px-4 py-3">
                    <hr class="garis-led-merah" v-if="bookingOngoing.length > 0">
                    <hr class="garis-led-hijau" v-if="bookingOngoing.length < 1">
                </div>
                <div class="col-md-5 p-0 py-3 ">
                    <div style="height: 38vh;">
                        <!-- <div class="circle"></div> -->
                        <div class="progre">
                            <div class="barOverflo">
                                <div v-if="bookingOngoing.length > 0" class="bar" style="transform: rotate(405deg); border: 10px solid #ff461f; border-bottom-color: #ff461f; border-right-color: #ff461f;"></div>
                                <div v-if="bookingOngoing.length < 1" class="bar" style="transform: rotate(405deg); border: 10px solid #22df41; border-bottom-color: #22df41; border-right-color: #22df41;"></div>
                            </div>
                        </div>
                    </div>
                    <br>

                    <h4>
                        <div v-if="bookingOngoing.length > 0">
                            @if ($bookingOngoing->count() > 0)
                            <div class="centered mx-5 text-center text-white py-5" id="getCountdown">

                            </div>
                            @endif
                        </div>

                    </h4>

                    <div class="centered mx-5 text-center text-white py-4" v-if="bookingOngoing.length < 1">
                        Tidak ada meeting yang berlangsung
                    </div>




                    <h4 class="m-0 font-weight-normal text-white">Room - {{ auth()->user()->name }}
                    </h4>
                    <span class="badge badge-secondary m-0 font-weight-normal text-white">IP Address - @{{ ip }}</span>

                    <div id="meetingOnProgress">

                    </div>
                    <div id="getNextMeeting">
                    </div>

                    <div class="d-flex mt-3 ">
                        <div class="mr-3 mb-2">
                            <div class="card-body text-white text-center info-card">
                                <h1 class="font-weight-normal m-0 mb-3">
                                    {{ auth()->user()->room->kapasitas }} <i class="fas fa-user-friends"></i>
                                </h1>
                                <h5 class="font-weight-normal m-0 ">{{ auth()->user()->room->capacity }} orang </h5>
                            </div>
                        </div>
                        @if (auth()->user()->room->projector == 1)
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
                        <a class="btn btn-warning mt-auto" href="{{ route('room.logout') }}">
                            <i class="fas fa-sign-out-alt mr-2"></i> {{ __('LOGOUT') }}
                        </a>
                        <form id="logout-form" action="{{ route('room.logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                        @if ($device->device->use_came == 'YES')
                        <a href="/scan" class="btn btn-success">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-qr-code-scan mr-2" viewBox="0 0 16 16">
                                <path d="M0 .5A.5.5 0 0 1 .5 0h3a.5.5 0 0 1 0 1H1v2.5a.5.5 0 0 1-1 0v-3Zm12 0a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 .5.5v3a.5.5 0 0 1-1 0V1h-2.5a.5.5 0 0 1-.5-.5ZM.5 12a.5.5 0 0 1 .5.5V15h2.5a.5.5 0 0 1 0 1h-3a.5.5 0 0 1-.5-.5v-3a.5.5 0 0 1 .5-.5Zm15 0a.5.5 0 0 1 .5.5v3a.5.5 0 0 1-.5.5h-3a.5.5 0 0 1 0-1H15v-2.5a.5.5 0 0 1 .5-.5ZM4 4h1v1H4V4Z" />
                                <path d="M7 2H2v5h5V2ZM3 3h3v3H3V3Zm2 8H4v1h1v-1Z" />
                                <path d="M7 9H2v5h5V9Zm-4 1h3v3H3v-3Zm8-6h1v1h-1V4Z" />
                                <path d="M9 2h5v5H9V2Zm1 1v3h3V3h-3ZM8 8v2h1v1H8v1h2v-2h1v2h1v-1h2v-1h-3V8H8Zm2 2H9V9h1v1Zm4 2h-1v1h-2v1h3v-2Zm-4 2v-1H8v1h2Z" />
                                <path d="M12 9h2V8h-2v1Z" />
                            </svg>SCAN
                        </a>
                        @endif

                        <!-- <span class="btn btn-primary" onclick="location.reload();"> REFRESH</span> -->
                    </div>
                </div>
                <div class="col-md-2 py-4">

                </div>
                <div class="col-md-4 px-4 py-3">
                    <h6 id="ct5" class="text-white font-weight-normal text-center"></h6>


                    <div class="p-4 text-center d-flex justify-content-center">
                        <!-- @if ($QrCode != '')
                    <div class="qr-code-fly">
                        <div class="qr">
                            {{ $QrCode }}
                        </div>
                    </div>
                    @endif -->


                        <div class="text-center">
                            <div class="card" v-if="bookingOngoing.length > 0">
                                <div class="card-body">

                                    @if ($bookingOngoing->count() > 0)
                                    {!! QrCode::size(120)->generate($linkQr) !!}

                                    @endif


                                </div>
                            </div>
                            <h5> <span class="badge badge-danger text-white mb4" v-if="bookingOngoing.length > 0">@{{ bookingOngoing[0]?.title}}</span></h5>

                            <h5> <span class="badge badge-success text-white py-2 mb-4" v-if="bookingOngoing.length < 1">@{{ bookingNull }}</span></h5>


                        </div>


                    </div>
                    <div class="text-center mb-3 absent">
                    </div>
                    <div class="style-after-upcoming">
                        <h2 class="text-white text-center font-weight-normal">Today's Event</h2>
                        <div style="overflow: auto; height: 37vh;">

                            <div v-if="bookingTodays.length > 0">

                                <p v-if="bookingOngoing.length < 1" id="rcorners1" class="text-white h6" v-for="BookToday in bookingTodays"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-calendar-week" viewBox="0 0 16 16">
                                        <path d="M11 6.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1zm-3 0a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1zm-5 3a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1zm3 0a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1z" />
                                        <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4H1z" />
                                    </svg>
                                    &nbsp; @{{ BookToday?.title }} - @{{ BookToday?.start }} <br>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-stopwatch" viewBox="0 0 16 16">
                                        <path d="M8.5 5.6a.5.5 0 1 0-1 0v2.9h-3a.5.5 0 0 0 0 1H8a.5.5 0 0 0 .5-.5V5.6z" />
                                        <path d="M6.5 1A.5.5 0 0 1 7 .5h2a.5.5 0 0 1 0 1v.57c1.36.196 2.594.78 3.584 1.64a.715.715 0 0 1 .012-.013l.354-.354-.354-.353a.5.5 0 0 1 .707-.708l1.414 1.415a.5.5 0 1 1-.707.707l-.353-.354-.354.354a.512.512 0 0 1-.013.012A7 7 0 1 1 7 2.071V1.5a.5.5 0 0 1-.5-.5zM8 3a6 6 0 1 0 .001 12A6 6 0 0 0 8 3z" />
                                    </svg>
                                    &nbsp; @{{ BookToday?.for_human }}
                                </p>

                                <p v-if="bookingOngoing.length > 0" id="rcorners2" class="text-white h6" v-for="BookToday in bookingTodays"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-calendar-week" viewBox="0 0 16 16">
                                        <path d="M11 6.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1zm-3 0a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1zm-5 3a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1zm3 0a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1z" />
                                        <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4H1z" />
                                    </svg>
                                    &nbsp; @{{ BookToday?.title }} - @{{ BookToday?.start }} <br>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-stopwatch" viewBox="0 0 16 16">
                                        <path d="M8.5 5.6a.5.5 0 1 0-1 0v2.9h-3a.5.5 0 0 0 0 1H8a.5.5 0 0 0 .5-.5V5.6z" />
                                        <path d="M6.5 1A.5.5 0 0 1 7 .5h2a.5.5 0 0 1 0 1v.57c1.36.196 2.594.78 3.584 1.64a.715.715 0 0 1 .012-.013l.354-.354-.354-.353a.5.5 0 0 1 .707-.708l1.414 1.415a.5.5 0 1 1-.707.707l-.353-.354-.354.354a.512.512 0 0 1-.013.012A7 7 0 1 1 7 2.071V1.5a.5.5 0 0 1-.5-.5zM8 3a6 6 0 1 0 .001 12A6 6 0 0 0 8 3z" />
                                    </svg>
                                    &nbsp; @{{ BookToday?.for_human }}
                                </p>

                            </div>

                            <div v-if="bookingTodays.length < 1">
                                <p id="rcorners3" class="text-white h6" v-if="bookingOngoing.length < 1">@{{ bookingTodaysNull }}</p>
                                <p id="rcorners4" class="text-white h6" v-if="bookingOngoing.length > 0">@{{ bookingTodaysNull }}</p>
                            </div>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <!-- <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
    </script> -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>
    <script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/vue@2/dist/vue.js"></script>
    <script src="https://js.pusher.com/7.0/pusher.min.js"></script>


    <!-- <script>
        setInterval(function() {
            window.location.reload();
        }, 30000);
    </script> -->

    <script>
        const vue = new Vue({
            el: '#app',
            data() {
                return {
                    bookingOngoing: '',
                    bookingNull: '',
                    bookingTodays: '',
                    bookingTodaysNull: '',
                    ip: '{{ $ip_address->ip_address }}',
                    ipColor: '{{ $ip_address->ip_address }}:8080',
                }
            },
            mounted() {
                setInterval(() => {
                    this.bookingOnGoing();
                    this.bookingToday();

                }, 1000);

                // if (localStorage.getItem('reloaded')) {
                //     localStorage.removeItem('reloaded');
                // } else {
                //     localStorage.setItem('reloaded', '1');
                //     location.reload();
                // }

            },
            methods: {
                bookingOnGoing: function() {
                    let vm = this;

                    axios.get('http://127.0.0.1:8000/api-display', {
                        headers: {
                            'Accept': 'application/json',
                        },
                    }).then(res => {
                        var ipVbook1 = 'http://{{ $ip_address->ip_address }}:8080';
                        vm.bookingOngoing = res.data.bookingOngoing;
                        if (vm.bookingOngoing.length < 1) {
                            vm.bookingNull = 'Tidak ada meeting yang berlangsung';
                        }
                        if (vm.bookingOngoing.length > 0) {
                            if (vm.bookingOngoing[0].reload == 1) {
                                // window.location.reload();



                                axios.post(`${ipVbook1}/v1/oauth2/token/`, {
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

                                        var paramsBody;

                                        paramsBody = {
                                            "red": 255,
                                            "green": 0,
                                            "blue": 0,
                                        };
                                        axios.post(`${ipVbook1}/v1/led/front_led/`,
                                                paramsBody, config)
                                            .then((res) => {
                                                console.log(res)
                                            })
                                            .catch((err) => {
                                                console.log(`Error front led : ${err}`);
                                            })
                                        axios.post(`${ipVbook1}/v1/led/side_led/`,
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


                                axios.post('/room/post-reload', {
                                        booking_id: this.bookingOngoing[0].id,

                                    })
                                    .then(function(response) {
                                        window.location.reload();
                                    })
                                    .catch(function(error) {
                                        console.log(error);

                                    });



                            }
                        }
                    })
                },
                bookingToday: function() {
                    let vm = this;
                    axios.get('http://127.0.0.1:8000/api-display').then(res => {
                        vm.bookingTodays = res.data.getBookingToday;
                        if (vm.bookingTodays.length < 1) {
                            vm.bookingTodaysNull = 'Tidak ada event untuk hari ini';
                        }

                    })
                },
            }
        })
    </script>


    <script type="text/javascript">
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
    </script>

    <script>
        var countDownDate = new Date("{!! $end_date !!}").getTime();
        var x = setInterval(function() {

            var now = new Date().getTime();
            var distance = countDownDate - now;

            var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            var seconds = Math.floor((distance % (1000 * 60)) / 1000);


            document.getElementById("getCountdown").innerHTML = hours + "h " +
                minutes + "m " + seconds + "s ";

            if (distance < 0) {
                clearInterval(x);
                document.getElementById("getCountdown").innerHTML = "MEETING SELESAI";


                var ipVbook = 'http://{{ $ip_address->ip_address }}:8080';
                axios.post(`${ipVbook}/v1/oauth2/token/`, {
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

                        var paramsBody;

                        paramsBody = {
                            "red": 0,
                            "green": 255,
                            "blue": 0,
                        };
                        axios.post(`${ipVbook}/v1/led/front_led/`,
                                paramsBody, config)
                            .then((res) => {
                                console.log(res)
                            })
                            .catch((err) => {
                                console.log(`Error front led : ${err}`);
                            })
                        axios.post(`${ipVbook}/v1/led/side_led/`,
                                paramsBody, config)
                            .then((res) => {
                                setInterval(function() {
                                    window.location.reload();
                                }, 4000);
                            })
                            .catch((err) => {
                                console.log(`Error side led : ${err}`);
                            })
                    })
                    .catch((err) => {
                        console.log(`Error oauth2 token : ${err}`);
                    });



            }
        }, 1000);
    </script>

</body>

</html>