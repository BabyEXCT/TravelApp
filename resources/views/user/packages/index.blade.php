@push('scripts')
    <!-- Include any necessary scripts here -->
@endpush

<x-app-layout :assets="$assets ?? []">
    <div>
        <div class="row">
          <!-- Inside your user.packages.index view -->
@foreach ($packages as $package)
<div class="col-md-4 mb-4">
    <div class="card">
        <img src="{{ $package->image_url }}" class="card-img-top" alt="{{ $package->name }}">
        <div class="card-body">
            <h5 class="card-title">{{ $package->name }}</h5>
            <p class="card-text">
                <strong>Price:</strong> ${{ number_format($package->price, 2) }}<br>
                <strong>Status:</strong>
                <span class="badge bg-{{ $package->status == 'available' ? 'success' : ($package->status == 'unavailable' ? 'danger' : 'info') }}">
                    {{ ucfirst($package->status) }}
                </span><br>
                <strong>Slots Available:</strong> {{ $package->slots->sum('available_slots') }}<br>
                <strong>Created On:</strong> {{ $package->created_at->format('Y/m/d') }}
            </p>
            <a href="{{ route('user.packages.show', $package->id) }}" class="btn btn-primary">View Details</a>
        </div>
    </div>
</div>
@endforeach

        </div>
    </div>
</x-app-layout>
