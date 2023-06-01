<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Orders List </title>
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
        <h2 id="r1">Orders List</h2>
    </div>


<p>Interval Dates: {{ $startDate }} - {{ $endDate }}</p>

<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Customer</th>
            <th>Total</th>
            <th>Ordered At</th>
            <!-- ... Other table headers ... -->
        </tr>
    </thead>
    <tbody>
        @foreach ($orders as $order)
            <tr>
                <td>{{ $order->id }}</td>
                <td>{{ $order->getCustomerName() }}</td>
                <td>{{ $order->formattedTotal() }}</td>
                <td>{{ $order->created_at }}</td>
                <!-- ... Other table cells ... -->
            </tr>
        @endforeach
    </tbody>
</table>
