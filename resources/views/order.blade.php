<x-layout>
    <!-- Success Message -->
    @if(session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
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
            <div class="row row-cols-1 row-cols-md-3 g-4">
                @foreach($order as $order)
                    <div class="col">
                        <div class="card h-100">
                            <div class="card-body">
                                <h5 class="card-title">Order ID: {{ $order->id }}</h5>
                                <p class="card-text"><strong>User:</strong> {{ $order->user_name }}</p>
                                <p class="card-text"><strong>Product:</strong> {{ $order->product_name }}</p>
                                <p class="card-text"><strong>Price:</strong> ${{ $order->product_price }}</p>
                                <p class="card-text"><strong>Status:</strong> {{ $order->order_status }}</p>
                                
                                <form action="{{ url('/vieworder'.'/'.$order->product_name.'/'.$order->id) }}" method="POST">
                                    @csrf
                                    <div class="input-group mb-3">
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

                                    <input type="hidden" name="product_id" value="{{ $order->id }}" />
                                    <input type="hidden" name="product_price" value="{{ $order->product_price }}" />
                                    <button 
                                        type="submit" 
                                        class="btn btn-success w-100 mt-2" 
                                        @if($order->order_status == 'placed') disabled @endif
                                    >
                                        Update
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

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
        function updateStock(button, step) {
            const input = button.closest('.input-group').querySelector('input[name="updstock"]');
            const currentValue = parseInt(input.value, 10) || 0;
            const minValue = parseInt(input.getAttribute('min'), 10) || 0;
            const newValue = currentValue + step;
            if (newValue >= minValue) {
                input.value = newValue;
            }
        }
    </script>

    <!-- CSS to hide the number input arrows -->
    <style>
        input[type="number"].no-arrow::-webkit-outer-spin-button,
        input[type="number"].no-arrow::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        input[type="number"].no-arrow {
            -moz-appearance: textfield;
        }
    </style>
</x-layout>
