<!doctype html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Scan</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">


    <link rel="stylesheet" href="https://testing.vbooksystem.com/sc-qrcode/css/qrcode-reader.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">

    <style>
        .myButton {
            box-shadow: 0px 1px 0px 0px #f0f7fa;
            background: linear-gradient(to bottom, #c3c958 5%, #f2ff00 100%);
            background-color: #c3c958;
            border-radius: 28px;
            border: 3px solid #000000;
            display: inline-block;
            cursor: pointer;
            color: #000000;
            font-family: Arial;
            font-size: 28px;
            font-weight: bold;
            padding: 6px 24px;
            text-decoration: none;
            text-shadow: 0px -1px 0px #5b6178;
        }

        .myButton:hover {
            background: linear-gradient(to bottom, #f2ff00 5%, #c3c958 100%);
            background-color: #f2ff00;
        }

        .myButton:active {
            position: relative;
            top: 1px;
        }
    </style>
</head>

<body style="background-color: white;">
    <div class="">
        <div class="row">

            <div class="col-12">

                <br>
                <br>
                <div class="text-center">
                    <img src="{{ asset('gambar/logo-hitam.png') }}" width="90px" alt="">
                </div>
                <br>
                <div class="text-center">
                    <h3>CLICK SCAN QR</h3>
                    <p>To Open Camera Device</p>
                </div>
                <br>
                <br>
                <br>
                <br>
                <br>
                <div class="text-center py-1 mb-2" style="background-color: #DCAC00;">
                </div>
                <div class="text-center py-4" style="background-color: #DCAC00;">
                    <br>
                    <button class="myButton" id="openreader-single" data-qrr-target="#single" data-qrr-audio-feedback="false" data-qrr-qrcode-regexp="^https?:\/\/">SCAN QR <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-qr-code-scan" viewBox="0 0 16 16">
                            <path d="M0 .5A.5.5 0 0 1 .5 0h3a.5.5 0 0 1 0 1H1v2.5a.5.5 0 0 1-1 0v-3Zm12 0a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 .5.5v3a.5.5 0 0 1-1 0V1h-2.5a.5.5 0 0 1-.5-.5ZM.5 12a.5.5 0 0 1 .5.5V15h2.5a.5.5 0 0 1 0 1h-3a.5.5 0 0 1-.5-.5v-3a.5.5 0 0 1 .5-.5Zm15 0a.5.5 0 0 1 .5.5v3a.5.5 0 0 1-.5.5h-3a.5.5 0 0 1 0-1H15v-2.5a.5.5 0 0 1 .5-.5ZM4 4h1v1H4V4Z" />
                            <path d="M7 2H2v5h5V2ZM3 3h3v3H3V3Zm2 8H4v1h1v-1Z" />
                            <path d="M7 9H2v5h5V9Zm-4 1h3v3H3v-3Zm8-6h1v1h-1V4Z" />
                            <path d="M9 2h5v5H9V2Zm1 1v3h3V3h-3ZM8 8v2h1v1H8v1h2v-2h1v2h1v-1h2v-1h-3V8H8Zm2 2H9V9h1v1Zm4 2h-1v1h-2v1h3v-2Zm-4 2v-1H8v1h2Z" />
                            <path d="M12 9h2V8h-2v1Z" />
                        </svg>
                    </button>

                </div>
                <!-- <div class="container col-sm-6">
                    <div class="text-center py-3">

                        <button type="button" class="btn btn-warning" id="openreader-single" data-qrr-target="#single" data-qrr-audio-feedback="false" data-qrr-qrcode-regexp="^https?:\/\/">SCAN QR <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-qr-code-scan" viewBox="0 0 16 16">
                                <path d="M0 .5A.5.5 0 0 1 .5 0h3a.5.5 0 0 1 0 1H1v2.5a.5.5 0 0 1-1 0v-3Zm12 0a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 .5.5v3a.5.5 0 0 1-1 0V1h-2.5a.5.5 0 0 1-.5-.5ZM.5 12a.5.5 0 0 1 .5.5V15h2.5a.5.5 0 0 1 0 1h-3a.5.5 0 0 1-.5-.5v-3a.5.5 0 0 1 .5-.5Zm15 0a.5.5 0 0 1 .5.5v3a.5.5 0 0 1-.5.5h-3a.5.5 0 0 1 0-1H15v-2.5a.5.5 0 0 1 .5-.5ZM4 4h1v1H4V4Z" />
                                <path d="M7 2H2v5h5V2ZM3 3h3v3H3V3Zm2 8H4v1h1v-1Z" />
                                <path d="M7 9H2v5h5V9Zm-4 1h3v3H3v-3Zm8-6h1v1h-1V4Z" />
                                <path d="M9 2h5v5H9V2Zm1 1v3h3V3h-3ZM8 8v2h1v1H8v1h2v-2h1v2h1v-1h2v-1h-3V8H8Zm2 2H9V9h1v1Zm4 2h-1v1h-2v1h3v-2Zm-4 2v-1H8v1h2Z" />
                                <path d="M12 9h2V8h-2v1Z" />
                            </svg>
                        </button>


                    </div>



                </div> -->
                <div class="text-center py-4 mb-2" style="background-color: #DCAC00;">
                </div>
                <div class="text-center py-1" style="background-color: #DCAC00;">
                </div>
                <div class="bg-image" style="background-image: linear-gradient(to bottom, rgba(255,255,255,0.6) 0%,rgba(255,255,255,0.9) 100%), url('gambar/bg-front.png');
            height: 40vh">
                    <br>
                    <div class="text-center">



                        <a href="/room">
                            <button class="btn btn-lg" style="background-color: #DCAC00;"><b> Kembali </b></button>
                        </a>

                    </div>
                    <!-- bg-front -->
                </div>
                <br>




            </div>
        </div>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="https://testing.vbooksystem.com/sc-qrcode/js/qrcode-reader.min.js"></script>

        <script>
            $(function() {

                // overriding path of JS script and audio 
                $.qrCodeReader.jsQRpath = "https://testing.vbooksystem.com/sc-qrcode/js/jsQR/jsQR.min.js";

                // bind all elements of a given class
                $("#openreader-single").qrCodeReader({
                    callback: function(code) {
                        if (code) {
                            window.location.href = code;
                        }
                    }
                });


                // read or follow qrcode depending on the content of the target input
                $("#openreader-single2").qrCodeReader({
                    callback: function(code) {
                        if (code) {
                            window.location.href = code;
                        }
                    }
                }).off("click.qrCodeReader").on("click", function() {
                    var qrcode = $("#single2").val().trim();
                    if (qrcode) {
                        window.location.href = qrcode;
                    } else {
                        $.qrCodeReader.instance.open.call(this);
                    }
                });


            });
        </script>

</body>

</html>