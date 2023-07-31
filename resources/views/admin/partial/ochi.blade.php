@php $i=1 @endphp
@foreach ($ochiData as $ochi)
<tr>
    <td>{{ $i++ }}</td>
    <td>{{ $ochi->nik }}</td>
    <td>{{ $ochi->tema }}</td>
    <td>{{ $ochi->nik_ochi_leader }}</td>
    <td>
        @if($ochi->juara == 0 || null)
        -
        @else
        {{ $ochi->juara }}
        @endif
    </td>
</tr>
@endforeach