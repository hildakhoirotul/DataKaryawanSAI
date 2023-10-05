@php $i=1 @endphp
@foreach ($absensiData as $absen)
<tr>
    <td><input type="checkbox" class="checkbox" data-id="{{$absen->id}}" data-checked="{{ $absen->isChecked ? 'true' : 'false' }}"></td>
    <td>{{ $i++ }}</td>
    <td>{{ $absen->nik }}</td>
    <td>{{ $absen->jenis }}</td>
    <td>{{ $absen->tanggal }}</td>
    <td>
        @if($absen->jam_masuk == '00:00:00')
        @if(in_array($absen->jenis, ['ICP', 'ITD', 'TD', 'CP']))
        Tidak Checklog
        @else
        -
        @endif
        @else
        {{ $absen->jam_masuk }}
        @endif
    </td>
    <td>
        @if($absen->jam_pulang == '00:00:00')
        @if(in_array($absen->jenis, ['ICP', 'ITD', 'TD', 'CP']))
        Tidak Checklog
        @else
        -
        @endif
        @else
        {{ $absen->jam_pulang }}
        @endif
    </td>
</tr>
@endforeach