<!DOCTYPE html>
<html>
<head>
    <title>Order Bill</title>
    <style>
        body { font-family: Arial, sans-serif; }
        .bill-container { margin: 20px; }
        h1, h2 { text-align: center; }
        table { width: 100%; border-collapse: collapse; margin: 20px 0; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f4f4f4; }
        .total { font-weight: bold; text-align: right; }
    </style>
</head>
<body>
    <div class="bill-container">
        <h1>Order Bill</h1>
        <h2>User: {{ $user_name }}</h2>
        <table>
            <thead>
                <tr>
                    <th>Product Name</th>
                    <th>Quantity</th>
                    <th>Price</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orders as $order)
                    <tr>
                        <td>{{ $order->product_name }}</td>
                        <td>{{ $order->product_stock }}</td>
                        <td>{{ $order->product_price }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <p class="total">Total Amount: {{ $totalSum }}</p>
        <p>Thank you for your orders!</p>
    </div>
</body>
</html>
