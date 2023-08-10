@php $i=1 @endphp
@foreach ($qccData as $qcc)
<tr>
    <td>{{ $i++ }}</td>
    <td>{{ $qcc->nik }}</td>
    <td>{{ $qcc->tema }}</td>
    <td>{{ $qcc->kontes }}</td>
    <td>{{ $qcc->nama_qcc }}</td>
    <td>
        @if($qcc->juara_sai == 0 || null)
        -
        @else
        {{ $qcc->juara_sai }}
        @endif
    </td>
    <td>
        @if($qcc->juara_pasi == 0 || null)
        -
        @else
        {{ $qcc->juara_pasi }}
        @endif
    </td>
</tr>
@endforeach