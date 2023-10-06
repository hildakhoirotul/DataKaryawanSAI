@php $i=1 @endphp
@foreach($results as $r)
<tr>
    <td>{{ $i++ }}</td>
    <td>{{ $r->nik }}</td>
    <td>
        @if($r->SD == 0 || null)
        -
        @else
        {{ $r->SD }}
        @endif
    </td>
    <td>
        @if($r->S == 0 || null)
        -
        @else
        {{ $r->S }}
        @endif
    </td>
    <td>
        @if($r->I == 0 || null)
        -
        @else
        {{ $r->I }}
        @endif
    </td>
    <td>
        @if($r->A == 0 || null)
        -
        @else
        {{ $r->A }}
        @endif
    </td>
    <td>
        @if($r->ITD == 0 || null)
        -
        @else
        {{ $r->ITD }}
        @endif
    </td>
    <td>
        @if($r->ICP == 0 || null)
        -
        @else
        {{ $r->ICP }}
        @endif
    </td>
    <td>
        @if($r->TD == 0 || null)
        -
        @else
        {{ $r->TD }}
        @endif
    </td>
    <td>
        @if($r->CP == 0 || null)
        -
        @else
        {{ $r->CP }}
        @endif
    </td>
    <td>
        @if($r->OCHI == 0 || null)
        -
        @else
        {{ $r->OCHI }}
        @endif
    </td>
    <td>
        @if($r->QCC == 0 || null)
        -
        @else
        {{ $r->QCC }}
        @endif
    </td>
    <td>
        @if($r->OCHI_leader == 0 || null)
        -
        @else
        {{ $r->OCHI_leader }}
        @endif
    </td>
</tr>
@endforeach