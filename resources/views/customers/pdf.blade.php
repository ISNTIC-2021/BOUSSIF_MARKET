<!DOCTYPE html>
<html>
<head>
    <title>Customers List </title>
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
    <h1 id="t">Customers List </h1>

    <table>
        <thead>
            <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Contact</th>
                    <th>Address</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($customers as $customer)
            <tr>
                <td>{{$customer->id}}</td>
                <td>{{$customer->first_name}} {{$customer->last_name}}</td>
                <td>{{$customer->email}}</td>
                <td>{{$customer->phone}}</td>
                <td>{{$customer->address}}</td>
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
