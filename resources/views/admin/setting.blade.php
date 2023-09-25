@extends('admin.layout.main')
@section('title', 'Pengaturan')

@section('content')
<main class="content p-3">
    <div class="row">
        <div class="container-fluid">
            <div class="section-title mt-2" data-aos="fade-up">
                <h2 class="mb-0 ms-1">Setting</h2>
                <p>Pengaturan</p>
            </div>
            <div class="card mt-2 px-4 py-3">
                <form id="switchForm" action="{{ route('disable.login') }}" method="post">
                    @csrf
                    <div class="form-check form-switch p-0 ps-1 pe-3 d-flex align-items-center justify-content-between">
                        <label class="form-check-label" style="display: flex;align-items: center;" for="flexSwitchCheckDefault">
                            <i class='bi bi-gear me-2' style="font-size: 2rem;"></i>
                            <span>Disable Tema OCHI & QCC</span>
                        </label>
                        <div style="display: flex; align-items: center;">
                            @if($status)
                            <span style="margin-right: 3.5rem;">On</span>
                            @else
                            <span style="margin-right: 3.5rem;">Off</span>
                            @endif
                            <input class="form-check-input custom-switch" type="checkbox" role="switch" id="flexSwitchCheckDefault" name="status" {{ $status ? 'checked' : '' }}>
                        </div>
                    </div>
                </form>
            </div>
            <div class="card mt-2 px-4 py-3">
                <span>Informasi Saat Ini: </span>
                <span style="font-size: 10px; font-style: italic;">Klik teks untuk edit.</span>
                @livewire('user-information')
            </div>
        </div>
    </div>
</main>
@livewireScripts
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const switchForm = document.getElementById('switchForm');
        const switchInput = document.getElementById('flexSwitchCheckDefault');

        switchInput.addEventListener('change', function() {
            switchForm.submit();
        });
    });
</script>
@endsection