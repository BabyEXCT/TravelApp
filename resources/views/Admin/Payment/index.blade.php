@push('scripts')
    <!-- Include any necessary scripts here -->
@endpush

<x-app-layout :assets="$assets ?? []">
    <div>
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <div class="header-title">
                            <h4 class="card-title">Available Packages</h4>
                        </div>
                    </div>
                    <div class="card-body px-0">
                        <div class="row">
                            @foreach ($packages as $package)
                                <div class="col-md-4 mb-4">
                                    <div class="card border-0 shadow-sm rounded">
                                        <img src="{{ $package->image_url }}" class="card-img-top rounded-top" alt="{{ $package->name }}" style="object-fit: cover; height: 200px;">
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
                                            <a href="{{ route('packages.show', $package->id) }}" class="btn btn-primary">View Details</a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
