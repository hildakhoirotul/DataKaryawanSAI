@php $i=1 @endphp
@foreach ($absensiData as $absen)
<tr>
    <td>{{ $i++ }}</td>
    <td>{{ $absen->nik }}</td>
    <td>{{ $absen->jenis }}</td>
    <td>{{ $absen->tanggal }}</td>
    <td>
        @if($absen->jam_masuk == '00:00:00')
        -
        @else
        {{ $absen->jam_masuk }}
        @endif
    </td>
    <td>
        @if($absen->jam_pulang == '00:00:00')
        -
        @else
        {{ $absen->jam_pulang }}
        @endif
    </td>
</tr>
@endforeach