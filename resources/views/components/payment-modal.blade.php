@props([
    'title' => 'Add Payment',
    'salesOrders' => [], // Pass sales orders from the controller
])

<div class="modal fade" id="paymentModal" tabindex="-1" aria-labelledby="paymentModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form id="paymentForm">
            @csrf
            <input type="hidden" name="id" id="payment_id">

            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="paymentModalLabel">{{ $title }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <!-- Sales Order Select -->
                    <div class="mb-3">
                        <label for="sales_order_id" class="form-label">Sales Order</label>
                        <select name="sales_order_id" id="sales_order_id" class="form-control" required>
                            <option value="">-- Select Sales Order --</option>
                            @foreach($salesOrders as $order)
                                <option value="{{ $order->id }}">
                                    Order #{{ $order->id }} - Date: {{ $order->order_date }} - Amount: {{ $order->total_amount }} - Client: {{ $order->client->name ?? 'N/A' }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Payment Date -->
                    <div class="mb-3">
                        <label for="payment_date" class="form-label">Payment Date</label>
                        <input type="date" name="payment_date" id="payment_date" class="form-control" 
                               value="{{ old('payment_date') }}" max="{{ date('Y-m-d') }}" required>
                    </div>

                    <!-- Payment Amount -->
                    <div class="mb-3">
                        <label for="payment_amount" class="form-label">Amount</label>
                        <input type="number" name="payment_amount" id="payment_amount" class="form-control" 
                               step="0.01" min="0" value="{{ old('payment_amount') }}" required>
                    </div>

                    <!-- Payment Mode -->
                    <div class="mb-3">
                        <label for="payment_mode" class="form-label">Payment Mode</label>
                        <select name="payment_mode" id="payment_mode" class="form-control" required>
                            <option value="cash" {{ old('payment_mode') == 'cash' ? 'selected' : '' }}>Cash</option>
                            <option value="card" {{ old('payment_mode') == 'card' ? 'selected' : '' }}>Card</option>
                            <option value="upi" {{ old('payment_mode') == 'upi' ? 'selected' : '' }}>UPI</option>
                            <option value="bank_transfer" {{ old('payment_mode') == 'bank_transfer' ? 'selected' : '' }}>Bank Transfer</option>
                        </select>
                    </div>

                    <!-- Optional Remarks -->
                    <div class="mb-3">
                        <label for="remarks" class="form-label">Remarks (Optional)</label>
                        <textarea name="remarks" id="remarks" class="form-control" rows="2">{{ old('remarks') }}</textarea>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Save</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </form>
    </div>
</div>
