<table style="background-color:white; border-style:double; width:100%;">
    <thead>
        <tr>
            <td colspan="8" style="text-align:center; font-family: 'Times New Roman', 'Times', 'serif'; font-size:17px">Report Booking Room</td>
        </tr>
        <tr>
            <td colspan="8" style="text-align:center; font-family: 'Times New Roman', 'Times', 'serif'; font-size:13px">{{ $company_name->name }}</td>
        </tr>
        <hr>
        <tr>
            <td colspan="8"></td>
        </tr>
        <tr>
            <td style="background-color:light; color:black; text-align:center;"><b> Agenda Meeting</b></td>
            <td style="background-color:light; color:black; text-align:center;"><b> Organizer </b></td>
            <td style="background-color:light; color:black; text-align:center;"><b> Partisipan </b></td>
            <td style="background-color:light; color:black; text-align:center;"><b> Start Date </b></td>
            <td style="background-color:light; color:black; text-align:center;"><b> End Date </b></td>
            <td style="background-color:light; color:black; text-align:center;"><b> Nama Ruangan </b></td>
            <td style="background-color:light; color:black; text-align:center;"><b> Division </b></td>
            <td style="background-color:light; color:black; text-align:center;"><b> Status </b></td>
        </tr>
    </thead>
    <tbody>

        @foreach ($booking_rooms as $booking_room)
        <tr>
            <td style="text-align:center">{{ $booking_room->title }}</td>
            <td style="text-align:center">{{ $booking_room->user->name }}</td>
            <td style="text-align:center">
                @foreach ($booking_room->participant as $participant )
                <span>( {{ $participant->email }} -
                    @if ($participant->participant_confirmation == 1)

                    Belum Absen
                    @elseif ($participant->participant_confirmation == 2)
                    Hadir
                    @else
                    Tidak Hadir
                    @endif )<br></span>
                @endforeach
            </td>
            <td style="text-align:center">{{ $booking_room->start_date }}</td>
            <td style="text-align:center">{{ $booking_room->end_date }}</td>
            <td style="text-align:center">{{ $booking_room->room->name ?? 'removed*' }}</td>
            <td style="text-align:center">{{ $booking_room->division->name }}</td>
            <td style="text-align:center">{{ $booking_room->status_booking }}</td>
        </tr>
        @endforeach
    </tbody>
</table>