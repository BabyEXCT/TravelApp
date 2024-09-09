<x-app-layout :assets="$assets ?? []">
    <div>
        <?php
            $id = $id ?? null;
        ?>
        @if(isset($id))
            {!! Form::model($data, ['route' => ['packages.update', $id], 'method' => 'patch', 'enctype' => 'multipart/form-data']) !!}
        @else
            {!! Form::open(['route' => ['packages.store'], 'method' => 'post', 'enctype' => 'multipart/form-data']) !!}
        @endif
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <div class="header-title">
                            <h4 class="card-title">{{ isset($id) ? 'Update' : 'Add' }} Package</h4>
                        </div>
                        <div class="card-action">
                            <a href="{{ route('packages.index') }}" class="btn btn-sm btn-primary" role="button">Back</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <!-- Package Image Upload -->
                        <div class="form-group">
                            <div class="profile-img-edit position-relative">
                                <!-- Display the image with a default fallback -->
                                <img src="{{ isset($data->package_image) ? asset('storage/' . $data->package_image) : asset('images/default-package.png') }}" alt="Package-Image" class="profile-pic rounded avatar-100">
                                <div class="upload-icone bg-primary">
                                    <svg class="upload-button" width="14" height="14" viewBox="0 0 24 24">
                                        <path fill="#ffffff" d="M14.06,9L15,9.94L5.92,19H5V18.08L14.06,9M17.66,3C17.41,3 17.15,3.1 16.96,3.29L15.13,5.12L18.88,8.87L20.71,7.04C21.1,6.65 21.1,6 20.71,5.63L18.37,3.29C18.17,3.09 17.92,3 17.66,3M14.06,6.19L3,17.25V21H6.75L17.81,9.94L14.06,6.19Z" />
                                    </svg>
                                    <input class="file-upload" type="file" accept="image/*" name="package_image">
                                </div>
                            </div>
                            <div class="img-extension mt-3">
                                <div class="d-inline-block align-items-center">
                                    <span>Only</span>
                                    <a href="javascript:void();">.jpg</a>
                                    <a href="javascript:void();">.png</a>
                                    <a href="javascript:void();">.jpeg</a>
                                    <span>allowed</span>
                                </div>
                            </div>
                        </div>
                        <!-- Package Details -->
                        <div class="form-group">
                            <label class="form-label" for="name">Package Name: <span class="text-danger">*</span></label>
                            {{ Form::text('name', old('name', $data->name ?? ''), ['class' => 'form-control', 'id' => 'name', 'placeholder' => 'Enter Package Name', 'required']) }}
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="description">Description:</label>
                            {{ Form::textarea('description', old('description', $data->description ?? ''), ['class' => 'form-control', 'id' => 'description', 'placeholder' => 'Enter Description']) }}
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="price">Price:</label>
                            {{ Form::number('price', old('price', $data->price ?? ''), ['class' => 'form-control', 'id' => 'price', 'placeholder' => 'Enter Price', 'step' => 'any']) }}
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="duration">Duration:</label>
                            {{ Form::text('duration', old('duration', $data->duration ?? ''), ['class' => 'form-control', 'id' => 'duration', 'placeholder' => 'Enter Duration']) }}
                        </div>
                        <div class="form-group">
                            <label class="form-label">Status:</label>
                            <div class="grid" style="--bs-gap: 1rem">
                                <div class="form-check g-col-6">
                                    {{ Form::radio('status', 'active', old('status', $data->status ?? 'active') === 'active', ['class' => 'form-check-input', 'id' => 'status-active']) }}
                                    <label class="form-check-label" for="status-active">Active</label>
                                </div>
                                <div class="form-check g-col-6">
                                    {{ Form::radio('status', 'inactive', old('status', $data->status ?? 'inactive') === 'inactive', ['class' => 'form-check-input', 'id' => 'status-inactive']) }}
                                    <label class="form-check-label" for="status-inactive">Inactive</label>
                                </div>
                            </div>
                        </div>

                        <!-- Slot Management -->
                        <div class="form-group mt-4">
                            <h5 class="mb-3">Manage Slots</h5>
                            <div id="slots-container">
                                @if(isset($data->slots) && count($data->slots) > 0)
                                    @foreach($data->slots as $slot)
                                        <div class="slot-item mb-3">
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <label>Slot Number:</label>
                                                    {{ Form::number('slots['.$slot->id.'][slot_number]', $slot->slot_number, ['class' => 'form-control', 'placeholder' => 'Slot Number']) }}
                                                </div>
                                                <div class="col-md-3">
                                                    <label>Available Slots:</label>
                                                    {{ Form::number('slots['.$slot->id.'][available_slots]', $slot->available_slots, ['class' => 'form-control', 'placeholder' => 'Available Slots']) }}
                                                </div>
                                                <div class="col-md-3">
                                                    <label>Price:</label>
                                                    {{ Form::number('slots['.$slot->id.'][price]', $slot->price, ['class' => 'form-control', 'placeholder' => 'Price', 'step' => 'any']) }}
                                                </div>
                                                <div class="col-md-3 d-flex align-items-end">
                                                    <button type="button" class="btn btn-danger remove-slot">Remove</button>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                            <button type="button" id="add-slot" class="btn btn-success mt-3">Add Slot</button>
                        </div>

                        <button type="submit" class="btn btn-primary mt-4">{{ isset($id) ? 'Update' : 'Add' }} Package</button>
                    </div>
                </div>
            </div>
        </div>
        {!! Form::close() !!}
    </div>

    <!-- JavaScript to dynamically add/remove slot inputs -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            document.getElementById('add-slot').addEventListener('click', function () {
                const slotContainer = document.getElementById('slots-container');
                const slotIndex = slotContainer.children.length + 1;

                const slotItem = document.createElement('div');
                slotItem.classList.add('slot-item', 'mb-3');
                slotItem.innerHTML = `
                    <div class="row">
                        <div class="col-md-3">
                            <label>Slot Number:</label>
                            <input type="number" name="slots[${slotIndex}][slot_number]" class="form-control" placeholder="Slot Number">
                        </div>
                        <div class="col-md-3">
                            <label>Available Slots:</label>
                            <input type="number" name="slots[${slotIndex}][available_slots]" class="form-control" placeholder="Available Slots">
                        </div>
                        <div class="col-md-3">
                            <label>Price:</label>
                            <input type="number" name="slots[${slotIndex}][price]" class="form-control" placeholder="Price" step="any">
                        </div>
                        <div class="col-md-3 d-flex align-items-end">
                            <button type="button" class="btn btn-danger remove-slot">Remove</button>
                        </div>
                    </div>
                `;
                slotContainer.appendChild(slotItem);
            });

            document.getElementById('slots-container').addEventListener('click', function (e) {
                if (e.target.classList.contains('remove-slot')) {
                    e.target.closest('.slot-item').remove();
                }
            });
        });
    </script>
</x-app-layout>
