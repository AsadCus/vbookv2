<table style="background-color:white; border-style:double; width:100%;">
    <thead>
        <tr>
            <td colspan="15"> CATATAN : Silahkan isi data sesuai template ini, isi divisi dengan ({{ $division->name }}), isi password dengan default (12345678), Isi Company dengan ({{ $company->name }})
            </td>
        </tr>
        <tr>
            <td style="background-color:light; color:black; text-align:center;"><b> No</b></td>
            <td style="background-color:light; color:black; text-align:center;"><b> Nama</b></td>
            <td style="background-color:light; color:black; text-align:center;"><b> Divisi </b></td>
            <td style="background-color:light; color:black; text-align:center;"><b> Email </b></td>
            <td style="background-color:light; color:black; text-align:center;"><b> Username (isi dengan email) </b></td>
            <td style="background-color:light; color:black; text-align:center;"><b> Password </b></td>
            <td style="background-color:light; color:black; text-align:center;"><b> No hp </b></td>
            <td style="background-color:light; color:black; text-align:center;"><b> Company</b></td>

        </tr>
    </thead>
    <tbody>

        <tr>
            <td style="text-align:center">1</td>
            <td style="text-align:center">Isikan nama</td>
            <td style="text-align:center">{{ $division->name }}</td>
            <td style="text-align:center">isikan email</td>
            <td style="text-align:center">isi sama dengan email</td>
            <td style="text-align:center">12345678</td>
            <td style="text-align:center">isi nomor handpone</td>
            <td style="text-align:center">{{ $company->name }}</td>
        </tr>



    </tbody>
</table>