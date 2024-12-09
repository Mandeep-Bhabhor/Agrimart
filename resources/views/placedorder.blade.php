<x-layout>
    <div class="orders-container container mt-5">
        <h2 class="text-center mb-4 text-primary">Placed Orders</h2>
        
        <!-- Check if there are no orders -->
        @if($order->isEmpty())
            <div class="alert alert-info text-center" role="alert">
                <i class="bi bi-info-circle-fill me-2"></i>No orders have been placed yet.
            </div>
        @else
            <!-- Orders Table -->
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover">
                    <thead class="table-light">
                        <tr>
                          
                            <th>Product Name</th>
                            <th>Quantity</th>
                            <th>Total Price</th>
                            <th>Order Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($order as $orders)
                            <tr>
                               
                                <td>{{ $orders->product_name }}</td>
                                <td>{{ $orders->product_stock }}</td>
                                <td>INR {{ number_format($orders->product_price, 2) }}</td>
                                <td>{{ $orders->created_at->format('d-m-Y') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif

        <div class="col-6">
            <!-- Download Bill Button -->
            <form action="{{ url('downloadBill/'. Auth::user()->name) }}" method="GET">
                @csrf
                <button type="submit" class="btn btn-info w-100">
                    <i class="bi bi-file-earmark-arrow-down-fill me-2"></i>Download Bill
                </button>
            </form>
        </div>
    </div>


    <!-- Custom CSS to improve appearance -->
    <style>
        .orders-container {
            padding: 30px;
            border-radius: 8px;
            background-color: #f8f9fa;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        
        h2 {
            font-size: 2rem;
            font-weight: bold;
            color: #007bff;
        }

        .table {
            border-radius: 8px;
        }

        .table th, .table td {
            text-align: center;
        }

        .table th {
            background-color: #e9ecef;
            font-weight: bold;
        }

        .alert-info {
            font-size: 1.1rem;
            padding: 20px;
        }
    </style>
</x-layout>
