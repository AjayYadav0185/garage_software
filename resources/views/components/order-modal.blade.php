@props([
'title' => 'Add Order',
'clients' => [],
'inventory' => []
])

<div class="modal fade" id="orderModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <form id="orderForm">
            @csrf
            <input type="hidden" name="_method" id="formMethod" value="POST">

            <input type="hidden" name="id" id="order_id">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="orderModalTitle">{{ $title }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">

                    {{-- Client --}}
                    <div class="mb-3">
                        <label>Client</label>
                        <select name="client_id" class="form-control" required>
                            @foreach($clients as $client)
                            <option value="{{ $client->id }}">{{ $client->name }}</option>
                            @endforeach
                        </select>
                    </div>

             
                    {{-- Order Date --}}
<div class="mb-3">
    <label>Order Date</label>
    <input type="date" name="order_date" class="form-control" required
        value="{{ date('Y-m-d') }}"> {{-- default to today --}}
</div>

                    {{-- Items Table --}}
                    <div class="mb-3">
                        <label>Items</label>
                        <table class="table table-bordered" id="orderItemsTable">
                            <thead>
                                <tr>
                                    <th>Product</th>
                                    <th>Available Stock</th>
                                    <th>Quantity</th>
                                    <th>Unit Price</th>
                                    <th>Total Price</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                {{-- Dynamic rows will be added here --}}
                            </tbody>
                        </table>
                        <button type="button" class="btn btn-sm btn-primary" id="addItemBtn">Add Item</button>
                    </div>

                    {{-- Total & Status --}}
                    <div class="mb-3">
                        <label>Total Amount</label>
                        <input type="number" name="total_amount" class="form-control" step="0.01" readonly>
                    </div>

                    <div class="mb-3">
                        <label>Status</label>
                        <select name="status" class="form-control">
                            <option value="Pending" selected>Pending</option>
                            <option value="Completed">Completed</option>
                            <option value="Cancelled">Cancelled</option>
                        </select>
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Save Order</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
  
</script>