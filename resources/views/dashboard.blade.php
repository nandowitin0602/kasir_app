<x-app-layout>
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title fw-semibold mb-4">Welcome</h5>
                <p class="mb-0">{{ Auth::user()->name }}</p>
            </div>
        </div>
    </div>
</x-app-layout>
