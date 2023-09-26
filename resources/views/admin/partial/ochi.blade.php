@php $i=1 @endphp
@foreach ($ochiData as $ochi)
<tr>
    <td style="width: 40px;" class="text-center"><input type="checkbox" class="checkbox" data-id="{{$ochi->id}}" data-checked="{{ $ochi->isChecked ? 'true' : 'false' }}"></td>
    <td>{{ $i++ }}</td>
    <td>{{ $ochi->nik }}</td>
    <td>{{ $ochi->tema }}</td>
    <td style="width: 80px;" class="text-center">{{ $ochi->kontes }}</td>
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