<x-layout>
    <!-- Success Message -->
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- Error Message -->
    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <div class="container mt-5">
        <h2 class="mb-4">Order List</h2>

        <!-- Check if there are any orders -->
        @if($order->isEmpty())
            <div class="alert alert-warning" role="alert">
                No Orders available.
            </div>
        @else
            <table class="table table-bordered table-striped">
                <thead class="thead-dark">
                    <tr>
                        <th>Order ID</th>
                        <th>User Name</th>
                        <th>Product Name</th>
                        <th>Product Quantity</th>
                        <th>Product Price</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($order as $order)
                        <tr>
                            <td>{{ $order->id }}</td>
                            <td>{{ $order->user_name }}</td>
                            <td>{{ $order->product_name }}</td>
                            <td>
                                <form action="{{ url('/vieworder'.'/'.$order->product_name.'/'.$order->id) }}" method="POST" class="d-inline">
                                    <div class="input-group">
                                        <!-- Minus Button -->
                                        <button 
                                            type="button" 
                                            class="btn btn-outline-secondary" 
                                            onclick="updateStock(this, -1)" 
                                            data-min="0"
                                        >
                                            −
                                        </button>

                                        <!-- Stock Input -->
                                        <input 
                                            type="number" 
                                            name="updstock" 
                                            class="form-control text-center no-arrow" 
                                            value="{{ $order->product_stock }}" 
                                            min="0"
                                            step="1"
                                        />

                                        <!-- Plus Button -->
                                        <button 
                                            type="button" 
                                            class="btn btn-outline-secondary" 
                                            onclick="updateStock(this, 1)"
                                        >
                                            +
                                        </button>
                                    </div>
                            </td>
                            <td>{{ $order->product_price }}</td>
                            <td>{{ $order->order_status }}</td>

                            <td>
                                <input type="hidden" name="product_id" value="{{ $order->id }}" />
                                <input type="hidden" name="product_price" value="{{ $order->product_price }}" />
                                @csrf
                                <button 
                                    type="submit" 
                                    class="btn btn-success mt-2" 
                                    @if($order->order_status == 'placed') disabled @endif
                                >
                                    Update
                                </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="row mt-4">
                <div class="col-6">
                    <!-- Place Order Button -->
                    <form action="{{ url($order->id.$order->user_name.'/placeOrder') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-primary w-100">Place Order</button>
                    </form>
                </div>
                <div class="col-6">
                    <!-- Download Bill Button -->
                    <form action="{{ url('downloadBill/'. Auth::user()->name) }}" method="GET">
                        @csrf
                        <button type="submit" class="btn btn-info w-100">Download Bill</button>
                    </form>
                </div>
                
            </div>
        @endif
    </div>

    <!-- JavaScript to Handle Increment/Decrement -->
    <script>
        /**
         * Function to increment or decrement product stock.
         * @param {HTMLElement} button - The button clicked (either + or -).
         * @param {number} step - The step value (e.g., +1 or -1).
         */
        function updateStock(button, step) {
            // Locate the input field within the same input-group
            const input = button.closest('.input-group').querySelector('input[name="updstock"]');
            
            // Get the current value and minimum value
            const currentValue = parseInt(input.value, 10) || 0;
            const minValue = parseInt(input.getAttribute('min'), 10) || 0;

            // Calculate the new value
            const newValue = currentValue + step;

            // Ensure the value doesn't go below the minimum value
            if (newValue >= minValue) {
                input.value = newValue;
            }
        }
    </script>

    <!-- CSS to hide the number input arrows -->
    <style>
        /* Remove arrows from number input fields */
        input[type="number"].no-arrow::-webkit-outer-spin-button,
        input[type="number"].no-arrow::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        input[type="number"].no-arrow {
            -moz-appearance: textfield; /* For Firefox */
        }
    </style>
</x-layout>
