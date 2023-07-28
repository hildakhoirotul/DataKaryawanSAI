@php $i=1 @endphp
@foreach ($ochiData as $ochi)
<tr>
    <td>{{ $i++ }}</td>
    <td>{{ $ochi->nik }}</td>
    <td>{{ $ochi->tema }}</td>
    <td>{{ $ochi->nik_ochi_leader }}</td>
    <td>{{ $ochi->juara }}</td>
</tr>
@endforeach