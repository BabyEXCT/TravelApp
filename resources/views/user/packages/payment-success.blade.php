<x-app-layout :assets="$assets ?? []">
    <div>
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <div class="header-title">
                    <h4 class="card-title">Payment Successful for {{ $package->name }}</h4>
                </div>
                <div class="card-action">
                    <a href="{{ route('user.packages.index') }}" class="btn btn-sm btn-primary" role="button">Back to Packages</a>
                </div>
            </div>
            <div class="card-body">
                <p>Your payment has been successfully processed for the package: <strong>{{ $package->name }}</strong>.</p>
                <p>Amount: {{ number_format($package->amount, 2) }}</p>
                <p>Payment Method: {{ $package->payment_method }}</p>
            </div>
        </div>
    </div>
</x-app-layout>
