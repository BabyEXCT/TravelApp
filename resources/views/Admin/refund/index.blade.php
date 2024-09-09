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
                            <h4 class="card-title">Refunds List</h4>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Invoice Number</th>
                                    <th>User</th>
                                    <th>Package</th>
                                    <th>Amount</th>
                                    <th>Status</th>
                                    <th>Requested On</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($refunds as $refund)
                                    <tr>
                                        <td>{{ $refund->invoice_number }}</td>
                                        <td>{{ $refund->user->name }}</td>
                                        <td>{{ $refund->package->name }}</td>
                                        <td>RM {{ number_format($refund->amount, 2) }}</td>
                                        <td>
                                            <span class="badge bg-{{ $refund->status == 'approved' ? 'success' : ($refund->status == 'pending' ? 'warning' : 'danger') }}">
                                                {{ ucfirst($refund->status) }}
                                            </span>
                                        </td>
                                        <td>{{ $refund->created_at->format('Y/m/d') }}</td>
                                        <td>
                                            <a href="{{ route('refunds.edit', $refund->id) }}" class="btn btn-sm btn-primary">Edit</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
