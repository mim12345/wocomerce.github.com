
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>

        <h2 style="background-color: goldenrod; text-align: center; text-transform: uppercase;  width:50% ; font-family: Arial, Helvetica, sans-serif; ">Wo-Comerce</h2>


        <table class="table table-bordered" style="width:50%">
            <thead >
                <tr>
                    <th style="border: 1px solid red; text-align:center;">Name</th>
                    <th style="border: 1px solid red; text-align:center;">Price</th>
                    <th style="border: 1px solid red; text-align:center;">Quantity</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orders as $order)

                    <tr>
                        <td style="border: 1px solid red; text-align:center;">{{ $order->product->product_name }}</td>
                        <td style="border: 1px solid red; text-align:center;">{{ $order->product_price }}</td>
                        <td style="border: 1px solid red; text-align:center;">{{ $order->product_quantity }}</td>
                    </tr>
                @endforeach

            </tbody>
        </table>
    </body>
    </html>
