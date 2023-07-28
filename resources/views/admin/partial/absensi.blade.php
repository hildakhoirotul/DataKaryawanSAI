@php $i=1 @endphp
@foreach ($absensiData as $absen)
<tr>
    <td>{{ $i++ }}</td>
    <td>{{ $absen->nik }}</td>
    <td>{{ $absen->jenis }}</td>
    <td>{{ $absen->tanggal }}</td>
    <td>{{ $absen->jam_masuk }}</td>
    <td>{{ $absen->jam_pulang }}</td>
</tr>
@endforeach