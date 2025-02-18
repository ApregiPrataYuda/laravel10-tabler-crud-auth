<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Produk</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
    </style>
</head>
<body>

    <h1>Laporan Produk</h1>
    <table>
        <thead>
            <tr>
                <th style="width: 5%">No.</th>
                <th>Name Product</th>
                <th>Category Product</th>
                <th>Price</th>
                <th>Price start date</th>
                <th>Price end date</th>
                <th>Product Description</th>
            </tr>
        </thead>
        <tbody>
            @php $no = 1; @endphp
            @foreach ($reportsAll as $product)
                <tr>
                    <td>{{ $no++ }}</td>
                    <td>{{ $product->name_product }}</td>
                    <td>{{ $product->name_category }}</td>
                    <td>{{ $product->price }}</td>
                    <td>{{ $product->start_date }}</td>
                    <td>{{ $product->end_date }}</td>
                    <td>{{ $product->description_product }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    

</body>
</html>