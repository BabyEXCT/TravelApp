<x-app-layout :assets="$assets ?? []">
    <div>
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <div class="header-title">
                    <h4 class="card-title">Payment for {{ $package->name }}</h4>
                </div>
                <div class="card-action">
                    <a href="{{ route('user.packages.show', $package->id) }}" class="btn btn-sm btn-primary" role="button">Back</a>
                </div>
            </div>
            <div class="card-body">
                {!! Form::open(['route' => ['user.packages.payment.store', $package->id], 'method' => 'POST']) !!}

                <div class="form-group">
                    <label for="amount">Amount:</label>
                    {{ Form::number('amount', null, ['class' => 'form-control', 'id' => 'amount', 'placeholder' => 'Enter Amount', 'required', 'step' => 'any']) }}
                </div>

                <div class="form-group">
                    <label for="payment_method">Payment Method:</label>
                    {{ Form::select('payment_method', ['Credit Card' => 'Credit Card', 'PayPal' => 'PayPal', 'Bank Transfer' => 'Bank Transfer'], null, ['class' => 'form-control', 'id' => 'payment_method', 'placeholder' => 'Select Payment Method', 'required']) }}
                </div>

                <!-- Hidden fields for invoice number and payment date -->
                <input type="hidden" name="invoice_number" value="{{ Str::random(10) }}">
                <input type="hidden" name="payment_date" value="{{ now() }}">

                <div class="form-group">
                    <button type="submit" class="btn btn-primary mt-4">Make Payment</button>
                </div>

                {!! Form::close() !!}
            </div>
        </div>
    </div>
</x-app-layout>
