<!doctype html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Scan</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">


    <link rel="stylesheet" href="https://demo.vbooksystem.com/sc-qrcode/css/qrcode-reader.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
</head>

<body style="background-color: white;">
    <div class="container-fluid">
        <div class="row">

            <div class="col-12">

                <br>
                <br>
                <div class="text-center">

                    <span class="badge badge-warning">

                        <h4>
                            <b>
                                <span class="badge" style="background-color: whitesmoke;">
                                    <img src="{{ asset('gambar/logo-vbook.png') }}" width="30px" alt="">
                                </span> Absen Meeting
                            </b>
                        </h4>
                    </span>
                </div>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <div class="container col-sm-6">
                    <div class="text-center py-5">

                        <button type="button" class="btn btn-warning" id="openreader-single" data-qrr-target="#single" data-qrr-audio-feedback="false" data-qrr-qrcode-regexp="^https?:\/\/">SACN QR <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-qr-code-scan" viewBox="0 0 16 16">
                                <path d="M0 .5A.5.5 0 0 1 .5 0h3a.5.5 0 0 1 0 1H1v2.5a.5.5 0 0 1-1 0v-3Zm12 0a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 .5.5v3a.5.5 0 0 1-1 0V1h-2.5a.5.5 0 0 1-.5-.5ZM.5 12a.5.5 0 0 1 .5.5V15h2.5a.5.5 0 0 1 0 1h-3a.5.5 0 0 1-.5-.5v-3a.5.5 0 0 1 .5-.5Zm15 0a.5.5 0 0 1 .5.5v3a.5.5 0 0 1-.5.5h-3a.5.5 0 0 1 0-1H15v-2.5a.5.5 0 0 1 .5-.5ZM4 4h1v1H4V4Z" />
                                <path d="M7 2H2v5h5V2ZM3 3h3v3H3V3Zm2 8H4v1h1v-1Z" />
                                <path d="M7 9H2v5h5V9Zm-4 1h3v3H3v-3Zm8-6h1v1h-1V4Z" />
                                <path d="M9 2h5v5H9V2Zm1 1v3h3V3h-3ZM8 8v2h1v1H8v1h2v-2h1v2h1v-1h2v-1h-3V8H8Zm2 2H9V9h1v1Zm4 2h-1v1h-2v1h3v-2Zm-4 2v-1H8v1h2Z" />
                                <path d="M12 9h2V8h-2v1Z" />
                            </svg></button>
                        <br>
                        <br>
                        <br>
                        <br>
                        <br>
                        <br>
                    </div>


                    <div class="text-center">



                        <a href="/room">
                            <button class="btn btn-warning"><b> Kembali </b></button>
                        </a>

                    </div>
                </div>


            </div>
        </div>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="https://demo.vbooksystem.com/sc-qrcode/js/qrcode-reader.min.js"></script>

        <script>
            $(function() {

                // overriding path of JS script and audio 
                $.qrCodeReader.jsQRpath = "https://demo.vbooksystem.com/sc-qrcode/js/jsQR/jsQR.min.js";

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