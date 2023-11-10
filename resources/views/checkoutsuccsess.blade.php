<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Successful</title>
    <!-- Add Tailwind CSS CDN link -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100">
    <div class="container mx-auto px-4 py-8">
        <div class="max-w-md mx-auto bg-white p-8 border border-gray-300 shadow-md rounded-md">
            <h1 class="text-2xl font-semibold mb-4">Payment Successful</h1>
            <p class="mb-4">Thank you for your purchase! Your order details are as follows:</p>

            <div class="mb-4">
                <strong>Order ID:</strong> {{ $order->id }}
            </div>

            <div class="mb-4">
                <strong>Customer Name:</strong> {{ $customer->name }}
            </div>

            <div class="mb-4">
                <strong>Total Amount:</strong> ${{ $order->total_price / 100 }}
            </div>

            <p class="mb-4">Thank you for shopping with us!</p>


            <a href="{{ route('store') }}"
                class="py-4 px-4 bg-blue-500 text-white font-bold rounded mt-4 mx-28 align-middle "> back to shop</a>
        </div>
    </div>
</body>

</html>
