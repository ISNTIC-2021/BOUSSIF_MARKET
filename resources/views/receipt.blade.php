<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Receipt</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .contact-info {
            margin-bottom: 10px;
            text-align: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th, td {
            padding: 8px;
            border: 1px solid #ddd;
        }

        .date {
            text-align: right;
        }

        .logo {
            text-align: center;
            margin-bottom: 20px;
        }
        #t {
            text-align: center;
        }

        .logo img {
            max-width: 100px;
        }
        #r1{
            text-align: center;
            width: 100%;
        }
    </style>
</head>
<body>
    <div class="header">
        <div class="logo">
            <img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('images/poslg.png'))) }}" alt="Restaurant Logo">
        </div>
        <div class="contact-info">
            <p>Neighborhood Grocery</p>
            <p><b>Adress: </b> Av Hassan 2 BOUIZAKARNE, GUELMIM</p>
            <p><b>Contact:</b> +212 6 12 34 56 78 | contact@timitar.ma</p>
        </div>
    </div>
    <div class="receipt-header">
        <h2 id="r1">Receipt</h2>
    </div>

    <div class="receipt-info">
        <p><strong>Order ID:</strong> {{ $order->id }}</p>
        <p><strong>Customer:</strong> {{ $order->getCustomerName() }}</p>
        <!-- Add more relevant information about the order or customer as needed -->
    </div>

    <table class="receipt-table">
        <thead>
            <tr>
                <th>Product</th>
                <th>Quantity</th>
                <th>Total Price</th>
                <th>Ordered At</th>
            </tr>
        </thead>
        <tbody>
            <!-- Iterate over the order items and display them in rows -->
            @foreach ($order->items as $item)
                <tr>
                    <td>{{ $item->product->name }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>{{ number_format($item->price, 2, '.', '') }} {{ config('settings.currency_symbol') }}</td>
                    <td>{{ $order->created_at }}</td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th colspan="3">Total:</th>
                <th> {{ $order->total() }} {{ config('settings.currency_symbol') }}</th>
            </tr>
        </tfoot>
    </table>

    <div class="receipt-footer">
        <p>Thank you for your purchase! | Tanmirt </p>
    </div>
</body>
</html>
