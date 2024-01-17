<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Factuur</title>
    <!-- Link to Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            font-family: 'Arial', sans-serif;
        }

        .invoice-container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .invoice-header {
            text-align: center;
            margin-bottom: 20px;
        }

        .invoice-details {
            margin-bottom: 30px;
        }

        .invoice-details p {
            margin: 5px 0;
        }

        .invoice-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .invoice-table th,
        .invoice-table td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }

        .invoice-total {
            text-align: right;
        }

        .invoice-footer {
            margin-top: 30px;
            text-align: center;
        }
    </style>
</head>

<body>

    <div class="invoice-container">
        <div class="invoice-header">
            <h1>Factuur</h1>
        </div>

        <div class="invoice-details">
            <p><strong>Bedrijfsnaam:</strong> AlwaysRentable</p>
            <p><strong>Klantnaam:</strong>Customername</p>
            <p><strong>Factuurnummer:</strong> 2022001</p>
            <p><strong>Factuurdatum:</strong> 2024-01-17</p>
        </div>

        <table class="invoice-table">
            <thead>
                <tr>
                    <th>Auto</th>
                    <th>Aantal dagen</th>
                    <th>Prijs per dag</th>
                    <th>Totaal</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>CarName</td>
                    <td>2</td>
                    <td>€25.00</td>
                    <td>€50.00</td>
                </tr>
                
            </tbody>
        </table>

        <div class="invoice-total">
            <p><strong>Totaal te betalen:</strong> €50.00</p>
        </div>

        <div class="invoice-footer">
            <p>Bedankt voor uw zaken!</p>
        </div>
    </div>

    <!-- Link to Bootstrap JS and Popper.js -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>

</html>
