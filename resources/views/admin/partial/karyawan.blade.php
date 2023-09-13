@php $i=1 @endphp
@foreach($user as $r)
<tr>
    <td><input type="checkbox" class="checkbox" data-id="{{$r->id}}"></td>
    <td>{{ $i++ }}</td>
    <td>{{ $r->nik }}</td>
    <td>{{ $r->nama }}</td>
    <td>
        <div class="password-container">
            <input type="password" class="password-text" value="{{ $r->chain }}" readonly>
            <i class="toggle-password-icon fa fa-eye-slash" onclick="togglePasswordVisibility(this)"></i>
        </div>
    </td>
    <!-- <td>{{ $r->password }}</td> -->
    <td>{{ $r->updated_at ? $r->updated_at : '-' }}</td>
    <td>
        <form action="{{ route('karyawan.destroy', ['id' => $r->id]) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger px-2 show_confirm" style="font-size: 12px;" onclick="showDeleteConfirmation(event, this)">Delete</button>
        </form>
    </td>
</tr>
@endforeach