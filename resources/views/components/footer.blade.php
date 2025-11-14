<footer class="bg-white border-top mt-4">
    <div
        class="container-lg py-3 d-flex flex-column flex-md-row align-items-center justify-content-between">
        <div class="d-flex align-items-center mb-2 mb-md-0">
            <img src="{{ asset('img/logo-uner.png') }}" alt="logo"
                style="height:36px; width:36px; object-fit:cover; margin-right:10px;">
            <div>
                <strong>{{ config('app.name', 'Laravel') }}</strong>
                <div class="small text-muted">Rumah Sakit Pendidikan Hewan Unair</div>
            </div>
        </div>

        <div class="text-center small text-muted mb-2 mb-md-0">
            &copy; {{ date('Y') }} {{ config('app.name', 'Laravel') }}. All rights reserved.
        </div>

        <div class="d-flex gap-3">
            <a href="#" class="text-decoration-none small text-muted">Privacy</a>
            <a href="#" class="text-decoration-none small text-muted">Terms</a>
            <a href="#" class="text-decoration-none small text-muted">Contact</a>
        </div>
    </div>
</footer>
