@php $i=1 @endphp
@foreach ($ochiData as $ochi)
<tr>
    <td>{{ $i++ }}</td>
    <td>{{ $ochi->nik }}</td>
    <td>{{ $ochi->tema }}</td>
    <td style="width: 80px;">{{ $ochi->kontes }}</td>
    <td>{{ $ochi->nik_ochi_leader }}</td>
    <td style="width: 80px;" class="text-center">
        @if($ochi->juara == 0 || null)
        -
        @else
        {{ $ochi->juara }}
        @endif
    </td>
</tr>
@endforeach