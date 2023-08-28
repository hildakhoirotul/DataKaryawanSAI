@extends('admin.layout.main')

@section('content')
<main class="content p-2 pt-3">
    <div class="row">
        <div class="card p-4">
            <h5 class="ms-1 mb-0">Pengaturan Halaman Karyawan</h5>
        </div>
    </div>
    <div class="row">
        <div class="card mt-2 px-4 py-3">
            <form id="switchForm" action="{{ route('disable.login') }}" method="post">
                @csrf
                <div class="form-check form-switch p-0 px-1 d-flex align-items-center justify-content-between">
                    <label class="form-check-label" for="flexSwitchCheckDefault">Disable Detail OCHI & QCC</label>
                    <input class="form-check-input custom-switch" type="checkbox" role="switch" id="flexSwitchCheckDefault" name="status" {{ $status ? 'checked' : '' }}>
                </div>
            </form>
        </div>
    </div>
    <div class="row">
        <div class="card mt-2 px-4 py-3">
            <span>Informasi Saat Ini: </span>
            @livewire('user-information')
        </div>
    </div>
</main>
@livewireScripts
@endsection