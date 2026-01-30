@extends('user.dashboard.layout.master')
@section('user-contant')

<div class="main-content">
    <section class="section">
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <h4>{{ translate('All Sales Orders') }}</h4>
                <button class="btn btn-primary" id="addOrderBtn">{{ translate('Add Order') }}</button>
            </div>
            <div class="card-body">
                <div class="table-responsive">

                <table class="table table-bordered" id="ordersTable">
                    <thead>
                        <tr>
                            <th>{{ translate('ID') }}</th>
                            <th>{{ translate('Client') }}</th>
                            <th>{{ translate('Order Date') }}</th>
                            <th>{{ translate('Total Amount') }}</th>
                            <th>{{ translate('Status') }}</th>
                            <th>{{ translate('Actions') }}</th>
                        </tr>
                    </thead>
                </table>
            </div>
            </div>
        </div>
    </section>
</div>

<x-order-modal title="Add Order" :clients="$clients" :inventory="$inventory" />


<script>
$(function () {

    // ===================== DATATABLE =====================
    var table = $('#ordersTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{{ route("orders.ajax") }}',
        columns: [
            { data: 'id', name: 'id' },
            { data: 'client_name', name: 'client_name' },
            { data: 'order_date', name: 'order_date' },
            { data: 'total_amount', name: 'total_amount' },
            { data: 'status', name: 'status' },
            { data: 'actions', name: 'actions', orderable: false, searchable: false }
        ]
    });

    // ===================== ADD ORDER =====================
    $('#addOrderBtn').click(function () {
        $('#orderForm')[0].reset();
        $('#orderItemsTable tbody').empty();
        $('#order_id').val('');
        $('#formMethod').val('POST'); // add mode
        $('#orderModalTitle').text('Add Order');
        $('#orderModal').modal('show');
    });

    // ===================== EDIT ORDER =====================
    $(document).on('click', '.edit-order', function () {
        let id = $(this).data('id');

        $.get('/orders/' + id + '/edit', function (data) {

            $('#orderForm')[0].reset();
            $('#orderItemsTable tbody').empty();

            $('#order_id').val(data.id);
            $('#formMethod').val('PUT'); // edit mode

            $('[name=client_id]').val(data.client_id);
            $('[name=order_date]').val(data.order_date);
            $('[name=status]').val(data.status);

            data.items.forEach(function (item) {
                addRow(item.inventory_id, item.quantity);
            });

            calculateTotal();
            $('#orderModalTitle').text('Edit Order');
            $('#orderModal').modal('show');
        });
    });

    // ===================== DELETE =====================
    $(document).on('click', '.delete-order', function () {
        let id = $(this).data('id');

        if (!confirm('Delete this order?')) return;

        $.ajax({
            url: '/orders/' + id,
            type: 'DELETE',
            data: { _token: '{{ csrf_token() }}' },
            success: function () {
                table.ajax.reload(null, false);
            }
        });
    });

    // ===================== ADD ITEM ROW =====================
    $('#addItemBtn').click(function () {
        addRow();
    });

    function addRow(selectedInventory = null, quantity = 1) {
        let options = '';
        @foreach($inventory as $inv)
            options += `<option value="{{ $inv->id }}"
                data-price="{{ $inv->SalePrice }}"
                data-stock="{{ $inv->Stock }}"
                ${selectedInventory == {{ $inv->id }} ? 'selected' : ''}>
                {{ $inv->Product }} (Stock: {{ $inv->Stock }})
            </option>`;
        @endforeach

        $('#orderItemsTable tbody').append(`
            <tr>
                <td>
                    <select class="form-control inventory-select">${options}</select>
                </td>
                <td class="stock">0</td>
                <td>
                    <input type="number" class="form-control item-quantity" min="1" value="${quantity}">
                </td>
                <td>
                    <input type="text" class="form-control item-price" readonly>
                </td>
                <td class="total-price">0.00</td>
                <td>
                    <button type="button" class="btn btn-danger btn-sm remove-item">Remove</button>
                </td>
            </tr>
        `);

        updateRow($('#orderItemsTable tbody tr:last'));
    }

    // ===================== ROW UPDATES =====================
    $(document).on('change', '.inventory-select', function () {
        updateRow($(this).closest('tr'));
    });

    $(document).on('input', '.item-quantity', function () {
        updateRow($(this).closest('tr'));
    });

    $(document).on('click', '.remove-item', function () {
        $(this).closest('tr').remove();
        calculateTotal();
    });

    function updateRow(row) {
        let option = row.find('.inventory-select option:selected');
        let price = parseFloat(option.data('price'));
        let stock = option.data('stock');
        let qty = parseInt(row.find('.item-quantity').val());

        row.find('.stock').text(stock);
        row.find('.item-price').val(price.toFixed(2));
        row.find('.total-price').text((price * qty).toFixed(2));

        calculateTotal();
    }

    function calculateTotal() {
        let total = 0;
        $('.total-price').each(function () {
            total += parseFloat($(this).text()) || 0;
        });
        $('[name=total_amount]').val(total.toFixed(2));
    }

    // ===================== FORM SUBMIT =====================
    $('#orderForm').submit(function (e) {
        e.preventDefault();

        let items = [];
        $('#orderItemsTable tbody tr').each(function () {
            items.push({
                inventory_id: $(this).find('.inventory-select').val(),
                quantity: $(this).find('.item-quantity').val()
            });
        });

        let formData = new FormData(this);
        formData.set('items', JSON.stringify(items));

        let id = $('#order_id').val();
        let method = id ? 'PUT' : 'POST';
        let url = id ? `/orders/${id}` : `{{ route('orders.store') }}`;

        // For Laravel to accept PUT
        formData.set('_method', method);

        $.ajax({
            url: url,
            type: 'POST', // must remain POST; Laravel uses _method
            data: formData,
            processData: false,
            contentType: false,
            success: function () {
                $('#orderModal').modal('hide');
                table.ajax.reload(null, false);
            },
            error: function(xhr){
                alert(xhr.responseJSON?.error || 'Something went wrong');
            }
        });
    });

});
</script>



@endsection
