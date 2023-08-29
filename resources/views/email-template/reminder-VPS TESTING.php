<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8"> <!-- utf-8 works for most cases -->
    <meta name="viewport" content="width=device-width"> <!-- Forcing initial-scale shouldn't be necessary -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge"> <!-- Use the latest (edge) version of IE rendering engine -->
    <meta name="x-apple-disable-message-reformatting"> <!-- Disable auto-scale in iOS 10 Mail entirely -->
    <title></title> <!-- The title tag shows in email notifications, like Android 4.4. -->


    <link href="https://fonts.googleapis.com/css?family=Playfair+Display:400,400i,700,700i" rel="stylesheet">


</head>



<body width="100%" style="margin: 0; padding: 0 !important; mso-line-height-rule: exactly; background-color: #222222;">
    <center style="width: 100%; background-color: #f1f1f1;">
        <div style="display: none; font-size: 1px;max-height: 0px; max-width: 0px; opacity: 0; overflow: hidden; mso-hide: all; font-family: sans-serif;">
            &zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;
        </div>
        <div style="max-width: 600px; margin: 0 auto; min-width: 320px !important;">
            <!-- BEGIN BODY -->
            <table align="center" role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%" style="margin: auto;">
                <tr>
                    <td style="padding: 1em 2.5em; text-align: center; background: #ffffff; color: #000; font-size: 20px; font-weight: 700; text-transform: uppercase; font-family: 'Montserrat', sans-serif;  margin: 0;">
                        <img src="https://testing.vbooksystem.com/gambar/logo-vbook.png" alt="" style="width: 30px; max-width: 600px; height: auto; margin: auto; display: block;">
                        <h1 style="color: #000;font-size: 20px; font-weight: 700; text-transform: uppercase; font-family: 'Montserrat', sans-serif;"><span>VBOOK</span></h1>

                    </td>
                </tr><!-- end tr -->
                <tr>
                    <td valign="middle">
                        <table>
                            <tr>
                                <td>

                                </td>
                            </tr>
                        </table>
                    </td>
                </tr><!-- end tr -->
                <tr>
                    <td style="background: #ffffff;">
                        <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%">
                            <tr>
                                <td style="text-align:center; background: rgba(0, 0, 0, .8); padding: 2.5em;">
                                    <div style="font-size: 18px;margin-top: 0;line-height: 1.4; color: rgba(255,255,255,.8);">
                                        <img src="	https://testing.vbooksystem.com/gambar/waktu.png" alt="" style="width: 50px; max-width: 600px; height: auto; margin: auto; display: block;">
                                        <h2>Reminder Meeting</h2>
                                        <p style="font-size: 14px;margin-top: 0;line-height: 1.4; color: rgba(255,255,255,.8);">Meeting <strong>{{$data['title']}}</strong>  Akan segera dimulai 10 menit lagi.</p>
                                        <p style="font-size: 10px;margin-top: 0;line-height: 1.4; color: rgba(255,255,255,.8);"><strong>Catatan :&nbsp;</strong>Anda tidak bisa konfirmasi kehadiran dibawah jika Meeting sudah dimulai atau selesai.</p>

                                    </div>
                                </td>
                            </tr><!-- end: tr -->
                            <tr>
                                <td style="background: #ffffff; padding: 2.5em;">
                                    <div style="text-align: center; padding: 0 30px;">
                                        <span class="subheading" style="margin-bottom: 20px !important;display: inline-block;font-size: 10px;text-transform: uppercase;letter-spacing: 2px;color: rgba(0, 0, 0, .4);position: relative;">
                                            SILAHKAN KONFIRMASI KEHADIRAN ANDA DIBAWAH :
                                        </span>


                                    </div>
                                    <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%">
                                        <tr>
                                            <td valign="top" width="50%" style="padding-top: 20px;">
                                                <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%">
                                                    <tr>
                                                        <td style="text-align: center;">

                                                            <img src="https://testing.vbooksystem.com/gambar/selesai.png" alt="" style="width: 60px; max-width: 600px; height: auto; margin: auto; display: block;">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td style="padding: 10px 10px 0;text-align: center;">
                                                            <h4><a href="https://testing.vbooksystem.com/confirmation/present?bookingId={{$data['booking_id']}}&email={{$data['email']}}"><button style="padding: 10px 15px; border-radius: 30px; background: #f3a333; color: #ffffff;">Hadir</button> </a></h4>

                                                        </td>
                                                    </tr>
                                                </table>
                                            </td>
                                            <td valign="top" width="50%" style="padding-top: 20px;">
                                                <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%">
                                                    <tr>
                                                        <td style="text-align: center;">
                                                            <img src="https://testing.vbooksystem.com/gambar/batal.png" alt="" style="width: 60px; max-width: 600px; height: auto; margin: auto; display: block;">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td style="padding: 10px 10px 0;text-align: center;">

                                                            <h4><a href="https://testing.vbooksystem.com/confirmation/not-present?bookingId={{$data['booking_id']}}&email={{$data['email']}}"><button style="padding: 10px 15px; border-radius: 30px; background: #f3a333; color: #ffffff;">Tidak</button> </a></h4>

                                                        </td>
                                                    </tr>
                                                </table>
                                            </td>


                                        </tr>

                                    </table>
                                </td>
                            </tr><!-- end: tr -->

                            <tr>

                            </tr><!-- end: tr -->




                        </table>

                    </td>
                </tr><!-- end:tr -->
                <!-- 1 Column Text + Button : END -->
            </table>


        </div>
    </center>
</body>

</html>