<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css"
        integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
    <link rel="stylesheet" href="./style.css">
    <style>
        body {
            background-color: #1B1A17;
        }

        .text-title {
            font-size: 4rem;
        }

        .centered {
            position: absolute;
            top: 47%;
            left: 18%;
            width: 210px;
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
            height: 70px;
            width: 90px;
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
            overflow: hidden;
            /* Comment this line to understand the trick */
            width: 272px;
            height: 136px;
            /* Half circle (overflow) */
            margin-bottom: -14px;
            /* bring the numbers up */
        }

        .bar {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 272px;
            height: 272px;
            /* full circle! */
            border-radius: 50%;
            box-sizing: border-box;
            border: 10px solid #eee;
            /* half gray, */
            /* border-bottom-color: #22DF41;  half azure
  border-right-color: #22DF41; */
        }

    </style>
    <title>VDESK</title>
</head>

<body>

    <div class="d-flex flex-column justify-content-center align-items-center" style="min-height: 96vh;">
        <h5 class="text-white font-weight-normal m-0">{{ auth()->guard('web')->user()->room->name }}</h5>
        <h1 class="text-title"></h1>
        <div class="progres">
            <div class="barOverflow">
                <div class="bar" style="transform: rotate(405deg);"></div>
            </div>
        </div>
        <div class="centered mx-5">
            <div class="d-flex justify-content-around text-white mb-2">
                <div class="my-auto text-center">
                    <div class="datetime">
                        <h6 class="time">
                            <span id="hour">00</span> :
                            <span id="minutes">00</span>
                            <span id="period">AM</span>
                        </h6>
                        <p class="date">
                            <span id="dayname">Day</span>,
                            <span id="month">Month</span>
                            <span id="daynum">00</span>
                        </p>
                    </div>
                </div>
                <div class="border my-auto" style="height: 70px;"></div>
                <div class="scrollbar my-auto meetingUpComing" id="">

                    {{-- <p class="m-0">11:00 - 12:00 Ravi Ham</p>
                    <p class="m-0">11:00 - 12:00 Ravi Ham</p>
                    <p class="m-0">11:00 - 12:00 Ravi Ham</p>
                    <p class="m-0">11:00 - 12:00 Ravi Ham</p>
                    <p class="m-0">11:00 - 12:00 Ravi Ham</p> --}}
                </div>
            </div>
            <div class="d-flex justify-content-around text-white btn-verify">

            </div>
        </div>
    </div>

    <!-- Optional JavaScript; choose one of the two! -->

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    {{-- <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script> --}}
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>
    <script>
        function display_ct5() {
            var days = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];
            const months = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];

            var x = new Date()
            var ampm = x.getHours() >= 12 ? ' PM' : ' AM';

            var x1 = x.getMonth() + 1 + "/" + x.getDate() + "/" + x.getFullYear();
            x1 = x1 + " - " + x.getHours() + ":" + x.getMinutes() + ":" + x.getSeconds() + ":" + ampm;
            const last2 = new Date().getFullYear().toString().slice(-2);
            // console.log(last2);
            // document.getElementById('hour').innerHTML = x1;

            var dayName = days[x.getDay()];
            var monthNames = months[x.getMonth()];

            document.getElementById('hour').innerHTML = x.getHours()
            document.getElementById('minutes').innerHTML = x.getMinutes()
            document.getElementById('period').innerHTML = ampm;
            document.getElementById('dayname').innerHTML = dayName;
            document.getElementById('month').innerHTML = monthNames;
            document.getElementById('daynum').innerHTML = last2;

            display_c5();
        }

        function display_c5() {
            var refresh = 1000; // Refresh rate in milli seconds
            mytime = setTimeout('display_ct5()', refresh)
        }

        display_c5()

        showTime();

        // program to display time every 5 seconds
        function showTime() {
            $.ajax({
                url: '{{ route('desk.index') }}',
                type: 'GET',
                success: function(res) {
                    // $('.absent').html(res.showButtonVerify);
                    $('.bar').css({
                        'border': '10px solid ' + res.dataColor[0],
                        'border-bottom-color': res.dataColor[0],
                        'border-right-color': res.dataColor[0],
                    })
                    $('.btn-verify').html(res.btnVerify);

                    $('.meetingUpComing').html(res.meetingUpcoming);
                    $('.text-title').html(res.avaiableText);

                    if (res.countdown != '') {
                        // $('.qr').html(res.QrCode);
                        // console.log('ss');
                    } else {
                        axios.post(
                                'http://192.168.20.84:8080/v1/oauth2/token/', {
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

                                axios.post('http://192.168.20.84:8080/v1/led/front_led/', paramsBody,
                                        config)
                                    .then((res) => {
                                        console.log(res)
                                    })
                                    .catch((err) => {
                                        console.log(err);
                                    })

                                axios.post('http://192.168.20.84:8080/v1/led/side_led/', paramsBody, config)
                                    .then((res) => {
                                        console.log(res)
                                    })
                                    .catch((err) => {
                                        console.log(err);
                                    })
                            })
                    }
                },

                error: function(err) {
                    console.log(err)
                },
            })
        }


        let display = setInterval(showTime, 5000);
    </script>
</body>

</html>
