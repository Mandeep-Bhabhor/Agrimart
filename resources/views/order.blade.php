<x-layout>
    <!-- Success Message -->
    @if(session('status'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle-fill me-2"></i>{{ session('status') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Error Message -->
    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="bi bi-exclamation-triangle-fill me-2"></i>{{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="container mt-5">
        <h2 class="mb-4 text-primary text-center"><i class="bi bi-cart-check-fill me-2"></i>Your Cart</h2>
      <!-- Place Order Button -->
                      <!-- Place Order Button -->
        <!-- Place Order Button -->
<a 
href="{{ url('/viewplacedorder') }}" 
class="btn btn-primary w-100 mt-3 place-order-btn" class="btn btn-success w-100 mt-3 place-order-btn">
<i class="bi bi-check-circle-fill me-2"></i>
</a>


        <!-- Check if there are any orders -->
        @if($order->isEmpty())
            <div class="alert alert-warning text-center" role="alert">
                <i class="bi bi-info-circle-fill me-2"></i>No Product available.
            </div>
        @else
            <div class="row row-cols-1 row-cols-md-3 g-4">
                @foreach($order as $order)
                    <div class="col">
                        <div class="card h-100 shadow-sm">
                            <div class="card-body">
                                <h5 class="card-title text-primary"><i class="bi bi-box-seam me-2"></i>Order ID: {{ $order->id }}</h5>
                                <p class="card-text"><strong>User:</strong> {{ $order->user_name }}</p>
                                <p class="card-text"><strong>Product:</strong> {{ $order->product_name }}</p>
                                <p class="card-text"><strong>Price:</strong> INR {{ $order->product_price }}</p>
                                <p class="card-text">
                                    <strong>Status:</strong>
                                    <span class="badge 
                                        {{ $order->order_status == 'placed' ? 'bg-success' : 'bg-warning text-dark' }}">
                                        {{ ucfirst($order->order_status) }}
                                    </span>
                                </p>

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
                                            <i class="bi bi-dash"></i>
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
                                            <i class="bi bi-plus"></i>
                                        </button>
                                    </div>

                                    <input type="hidden" name="product_id" value="{{ $order->id }}" />
                                    <input type="hidden" name="product_price" value="{{ $order->product_price }}" />
                                    <button 
                                        type="submit" 
                                        class="btn btn-success w-100 mt-2" 
                                        @if($order->order_status == 'placed') disabled @endif
                                    >
                                        <i class="bi bi-pencil-square me-2"></i>Update
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
                    <form action="{{ url($order->id.$order->user_name.$order->product_name.'/placeOrder') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-primary w-100">
                            <i class="bi bi-check-circle-fill me-2"></i>Place Order
                        </button>
                    </form>
                </div>
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

        .card:hover {
            transform: translateY(-5px);
            transition: 0.3s ease;
        }

        .btn {
            transition: 0.3s ease;
        }

        .btn:hover {
            opacity: 0.9;
        }
    </style>
</x-layout>
