<!doctype html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Scan</title>
    <link rel="shortcut icon" href="https://learncodeweb.com/demo/favicon.ico">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">


    <!-- Global site tag (gtag.js) - Google Analytics -->

</head>

<body style="background-color: grey;">
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>


    <div class="container-fluid">
        <div class="row">

            <div class="col-12">
                <script src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>
                <br>
                <br>
                <div class="text-center">

                    <span class="badge badge-warning">

                        <h4><b> <span class="badge" style="background-color: whitesmoke;">
                                    <img src="{{ asset('gambar/logo-vbook.png') }}" width="30px" alt="">
                                </span> Absen Meeting </b></h4>
                    </span>
                </div>
                <br>
                <div class="col-sm-12 text-center">
                    <video id="preview" class="p-1 border" style="width:600px;"></video>
                </div>
                <script type="text/javascript">
                    var scanner = new Instascan.Scanner({
                        video: document.getElementById('preview'),
                        scanPeriod: 5,
                        mirror: false
                    });
                    scanner.addListener('scan', function(content) {
                        // alert(content);
                        window.location.href = content;
                    });
                    Instascan.Camera.getCameras().then(function(cameras) {
                        if (cameras.length > 0) {
                            scanner.start(cameras[0]);
                            $('[name="options"]').on('change', function() {
                                if ($(this).val() == 1) {
                                    if (cameras[0] != "") {
                                        scanner.start(cameras[0]);
                                    } else {
                                        alert('No Front camera found!');
                                    }
                                } else if ($(this).val() == 2) {
                                    if (cameras[1] != "") {
                                        scanner.start(cameras[1]);
                                    } else {
                                        alert('No Back camera found!');
                                    }
                                }
                            });
                        } else {
                            console.error('Tidak Dapat Menemukan Kamera.');
                            alert('Tidak Dapat Menemukan Kamera.');
                        }
                    }).catch(function(e) {
                        console.error(e);
                        alert(e);
                    });
                </script>
                <br>
                <!-- <div class="text-center">
                    <div class="btn-group btn-group-toggle mb-5" data-toggle="buttons">
                        <label class="btn btn-primary active">
                            <input type="radio" name="options" value="1" autocomplete="off" checked> Front Camera
                        </label>
                        <label class="btn btn-secondary">
                            <input type="radio" name="options" value="2" autocomplete="off"> Back Camera
                        </label>
                    </div>
                </div> -->

                <div class="text-center">
                    <a href="/room">
                        <button class="btn btn-warning"><b> Kembali </b></button>
                    </a>

                </div>
            </div>


        </div>
    </div>

</body>

</html>
