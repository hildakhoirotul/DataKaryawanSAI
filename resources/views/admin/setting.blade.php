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
                <div class="form-check form-switch p-0 ps-1 pe-3 d-flex align-items-center justify-content-between">
                    <label class="form-check-label" style="display: flex;align-items: center;" for="flexSwitchCheckDefault">
                        <i class='bx bx-cog me-2' style="font-size: 2rem;"></i>
                        <span>Disable Detail OCHI & QCC</span>
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
    </div>
    <div class="row">
        <div class="card mt-2 px-4 py-3">
            <span>Informasi Saat Ini: </span>
            <span style="font-size: 10px; font-style: italic;">Klik teks untuk edit.</span>
            @livewire('user-information')
        </div>
    </div>
</main>
<script src="{{ asset('/vendor/livewire/livewire.js?id=90730a3b0e7144480175') }}" data-turbo-eval="false" data-turbolinks-eval="false"></script>
<script data-turbo-eval="false" data-turbolinks-eval="false">
    if (window.livewire) {
        console.warn('Livewire: It looks like Livewire\'s @livewireScripts JavaScript assets have already been loaded. Make sure you aren\'t loading them twice.')
    }

    window.livewire = new Livewire();
    window.livewire.devTools(true);
    window.Livewire = window.livewire;
    window.livewire_app_url = '';
    window.livewire_token = 'I7GMyZCgLdBcgIbb9jvtdQFSelwM23r6DrzUIqck';

    /* Make sure Livewire loads first. */
    if (window.Alpine) {
        /* Defer showing the warning so it doesn't get buried under downstream errors. */
        document.addEventListener("DOMContentLoaded", function() {
            setTimeout(function() {
                console.warn("Livewire: It looks like AlpineJS has already been loaded. Make sure Livewire\'s scripts are loaded before Alpine.\\n\\n Reference docs for more info: http://laravel-livewire.com/docs/alpine-js")
            })
        });
    }

    /* Make Alpine wait until Livewire is finished rendering to do its thing. */
    window.deferLoadingAlpine = function(callback) {
        window.addEventListener('livewire:load', function() {
            callback();
        });
    };

    let started = false;

    window.addEventListener('alpine:initializing', function() {
        if (!started) {
            window.livewire.start();

            started = true;
        }
    });

    document.addEventListener("DOMContentLoaded", function() {
        if (!started) {
            window.livewire.start();

            started = true;
        }
    });
</script>
@endsection