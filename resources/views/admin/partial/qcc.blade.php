@php $i=1 @endphp
@foreach ($qccData as $qcc)
<tr>
    <td style="width: 40px;" class="text-center"><input type="checkbox" class="checkbox" data-id="{{$qcc->id}}" data-checked="{{ $qcc->isChecked ? 'true' : 'false' }}"></td>
    <td>{{ $i++ }}</td>
    <td>{{ $qcc->nik }}</td>
    <td>{{ $qcc->tema }}</td>
    <td style="width: 80px;" class="text-center">{{ $qcc->kontes }}</td>
    <td>{{ $qcc->nama_qcc }}</td>
    <td style="width: 80px;" class="text-center">
        @if($qcc->juara_sai == 0 || null)
        -
        @else
        {{ $qcc->juara_sai }}
        @endif
    </td>
    <td style="width: 80px;" class="text-center">
        @if($qcc->juara_pasi == 0 || null)
        -
        @else
        {{ $qcc->juara_pasi }}
        @endif
    </td>
</tr>
@endforeach