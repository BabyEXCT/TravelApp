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
                            <h4 class="card-title">Available Postings</h4>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Image</th>
                                    <th>Title</th>
                                    <th>Description</th>
                                    <th>Status</th>
                                    <th>Created On</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($postings as $posting)
                                    <tr>
                                        <td>
                                            <img src="{{ $posting->image_url }}" alt="{{ $posting->title }}" class="img-thumbnail" style="width: 100px; height: 75px; object-fit: cover;">
                                        </td>
                                        <td>{{ $posting->title }}</td>
                                        <td>{{ \Illuminate\Support\Str::limit($posting->description, 50) }}</td>
                                        <td>
                                            <span class="badge bg-{{ $posting->status == 'active' ? 'success' : 'danger' }}">
                                                {{ ucfirst($posting->status) }}
                                            </span>
                                        </td>
                                        <td>{{ $posting->created_at->format('Y/m/d') }}</td>
                                        <td>
                                            <a href="{{ route('postings.edit', $posting->id) }}" class="btn btn-sm btn-primary">Edit</a>
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
