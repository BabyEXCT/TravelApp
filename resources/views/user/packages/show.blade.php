<x-app-layout :assets="$assets ?? []">
    <div>
        {!! Form::model($package, [
            'route' => ['packages.update', $package->id],
            'method' => 'PATCH',
            'enctype' => 'multipart/form-data'
        ]) !!}
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <div class="header-title">
                            <h4 class="card-title">Package</h4>
                        </div>
                        <div class="card-action">
                            <a href="{{ route('packages.index') }}" class="btn btn-sm btn-primary" role="button">Back</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <!-- Package Details -->
                        <div class="form-group">
                            <label class="form-label" for="name">Package Name:</label>
                            {{ Form::text('name', old('name', $package->name), ['class' => 'form-control', 'id' => 'name', 'readonly']) }}
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="description">Description:</label>
                            {{ Form::textarea('description', old('description', $package->description), ['class' => 'form-control', 'id' => 'description', 'readonly']) }}
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="price">Price:</label>
                            {{ Form::number('price', old('price', $package->price), ['class' => 'form-control', 'id' => 'price', 'readonly', 'step' => 'any']) }}
                        </div>

                        <!-- Slot Management -->
                        <div class="form-group mt-4">
                            <h5 class="mb-3">Available Slots</h5>
                            @if(isset($package->slots) && count($package->slots) > 0)
                                @foreach($package->slots as $slot)
                                    <div class="slot-item mb-3">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <label>Available Slots:</label>
                                                {{ Form::number('slots['.$slot->id.'][available_slots]', $slot->available_slots, ['class' => 'form-control', 'readonly']) }}
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <p>No slots available for this package.</p>
                            @endif
                        </div>

                       <!-- Link to the payment form -->
                <a href="{{ route('user.packages.payment.form', $package->id) }}" class="btn btn-primary mt-4">Make Payment</a>

                    </div>
                </div>
            </div>
        </div>
        {!! Form::close() !!}
    </div>
</x-app-layout>
