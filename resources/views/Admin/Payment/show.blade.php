<x-app-layout :assets="$assets ?? []">
    <div class="row">
        <div class="col-lg-12">
            <div class="card rounded">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <h4 class="mb-2">Invoice #{{ $invoice->id }}</h4>
                            <h5 class="mb-3">Hello, {{ $invoice->user->name }}</h5>
                            <p>
                                {{ $invoice->description }}
                            </p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 mt-4">
                            <div class="table-responsive-sm">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col">Item</th>
                                            <th class="text-center" scope="col">Quantity</th>
                                            <th class="text-center" scope="col">Price</th>
                                            <th class="text-center" scope="col">Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($invoice->items as $item)
                                            <tr>
                                                <td>
                                                    <h6 class="mb-0">{{ $item->name }}</h6>
                                                    <p class="mb-0">{{ $item->description }}</p>
                                                </td>
                                                <td class="text-center">{{ $item->quantity }}</td>
                                                <td class="text-center">${{ number_format($item->price, 2) }}</td>
                                                <td class="text-center">${{ number_format($item->quantity * $item->price, 2) }}</td>
                                            </tr>
                                        @endforeach
                                        <tr>
                                            <td>
                                                <h6 class="mb-0">Total</h6>
                                            </td>
                                            <td class="text-center"></td>
                                            <td class="text-center"></td>
                                            <td class="text-center">${{ number_format($invoice->total, 2) }}</td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <h6 class="mb-0">Tax</h6>
                                            </td>
                                            <td class="text-center"></td>
                                            <td class="text-center"></td>
                                            <td class="text-center">${{ number_format($invoice->tax, 2) }}</td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <h6 class="mb-0">Discount</h6>
                                            </td>
                                            <td class="text-center"></td>
                                            <td class="text-center"></td>
                                            <td class="text-center">${{ number_format($invoice->discount, 2) }}</td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <h6 class="mb-0">Net Amount</h6>
                                            </td>
                                            <td class="text-center"></td>
                                            <td class="text-center"></td>
                                            <td class="text-center"><b>${{ number_format($invoice->net_amount, 2) }}</b></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <p class="mb-0 mt-4">
                                <svg width="30" class="text-primary mb-3 me-2" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <rect x="-0.757324" y="19.2427" width="28" height="4" rx="2" transform="rotate(-45 -0.757324 19.2427)" fill="currentColor"/>
                                    <rect x="7.72803" y="27.728" width="28" height="4" rx="2" transform="rotate(-45 7.72803 27.728)" fill="currentColor"/>
                                    <rect x="10.5366" y="16.3945" width="16" height="4" rx="2" transform="rotate(45 10.5366 16.3945)" fill="currentColor"/>
                                    <rect x="10.5562" y="-0.556152" width="28" height="4" rx="2" transform="rotate(45 10.5562 -0.556152)" fill="currentColor"/>
                                </svg>
                                {{ $invoice->note }}
                            </p>
                            <div class="d-flex justify-content-center mt-4">
                                <button type="button" class="btn btn-primary" onclick="window.print()">Print</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
