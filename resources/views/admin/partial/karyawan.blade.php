@php $i=1 @endphp
@foreach($user as $r)
<tr>
    <td>{{ $i++ }}</td>
    <td>{{ $r->nik }}</td>
    <td>
        <div class="password-container">
            <input type="password" class="password-text" value="{{ $r->chain }}" readonly>
            <i class="toggle-password-icon fa fa-eye-slash" onclick="togglePasswordVisibility(this)"></i>
        </div>
    </td>
    <!-- <td>{{ $r->password }}</td> -->
    <td>{{ $r->updated_at ? $r->updated_at : '-' }}</td>
</tr>
@endforeach