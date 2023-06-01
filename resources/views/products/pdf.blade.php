<!DOCTYPE html>
<html>
<head>
    <title>Product List - PDF</title>
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
    <h1 id="t">Products List </h1>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Barcode</th>
                <th>Price</th>
                <th>Status</th>
                <th>Quantity</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $product)
                <tr>
                    <td>{{ $product->id }}</td>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->barcode }}</td>
                    <td>{{ $product->price }}</td>
                    <td>{{$product->status ? 'Active' : 'Inactive'}}</td>
                    <td>{{ $product->quantity }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="date">
        Date: {{ date('Y-m-d') }}
        <br>
        Time: {{ date('H:i:s') }}
    </div>
</body>
</html>
