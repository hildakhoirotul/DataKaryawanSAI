@php $i=1 @endphp
@foreach ($qccData as $qcc)
<tr>
    <td>{{ $i++ }}</td>
    <td>{{ $qcc->nik }}</td>
    <td>{{ $qcc->tema }}</td>
    <td>{{ $qcc->nama_qcc }}</td>
    <td>
        @if($qcc->juara == 0 || null)
        -
        @else
        {{ $qcc->juara }}
        @endif
    </td>
</tr>
@endforeach