<x-adminlayout>
    @if($history->isEmpty())
    <div class="alert alert-warning text-center" role="alert">
        No order available.
    </div>
    @else
    <div class="table-responsive">
        <table class="table table-bordered table-hover align-middle">
            <thead class="table-dark text-center">
                <tr>
                    <th>ID</th>
                    <th>Order Id</th>
                    <th>User Name</th>
                    <th>Order Date and Time</th>
                    <th>Product Name</th>
                    <th>Product Stock</th>
                </tr>
            </thead>
            <tbody>
                @foreach($history as $histories)
                    <tr>
                        <td class="text-center">{{ $histories->id }}</td>
                        <td>{{ $histories->order_id }}</td>
                        <td>{{ $histories->order->user_name }}</td>
                        <td class="text-center">{{ $histories->order->created_at }}</td>
                        <td class="text-center">{{ $histories->order->product_name }}</td>
                        <td class="text-center">{{ $histories->order->product_stock }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @endif
</x-adminlayout>
