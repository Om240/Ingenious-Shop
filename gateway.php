<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Payment Gateway</title>
<style>
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
        background-color: #f4f4f4;
        transition: background-color 0.5s ease;
    }

    .container {
        max-width: 600px;
        margin: 50px auto;
        padding: 20px;
        background-color: #fff;
        box-shadow: 0px 0px 20px 0px rgba(0,0,0,0.1);
        border-radius: 5px;
        transition: box-shadow 0.5s ease;
    }

    h1 {
        text-align: center;
        margin-bottom: 30px;
    }

    .payment-options {
        display: flex;
        justify-content: center;
        margin-bottom: 20px;
    }

    .payment-options button {
        padding: 10px 20px;
        margin: 0 10px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.5s ease;
    }

    #card-payment {
        background-color: #007bff;
        color: #fff;
    }

    #upi-payment {
        background-color: #28a745;
        color: #fff;
    }

    #payment-details {
        display: none;
        margin-top: 20px;
    }

    #payment-details p {
        margin: 5px 0;
    }

    #payment-details input[type="text"] {
        display: block;
        margin-bottom: 10px;
        padding: 10px;
        border: 1px solid #ddd;
        border-radius: 5px;
    }

    #payment-details button {
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        background-color: #007bff;
        color: #fff;
        cursor: pointer;
    }
</style>
</head>
<body>
<div class="container">
    <h1>Select Payment Method</h1>
    <div class="payment-options">
        <button id="card-payment">Card Payment</button>
        <button id="upi-payment">UPI Payment</button>
    </div>
    <div id="payment-details">
        <p>Please enter your payment details:</p>
        <input type="text" id="card-number" placeholder="Card Number" required>
        <input type="text" id="expiry-date" placeholder="Expiry Date" required>
        <input type="text" id="cvv" placeholder="CVV" required>
        <button id="submit-payment">Submit Payment</button>
    </div>
</div>

<script>
    document.getElementById('card-payment').addEventListener('click', function() {
        document.getElementById('payment-details').style.display = 'block';
        document.getElementById('upi-payment').style.display = 'none';
    });

    document.getElementById('upi-payment').addEventListener('click', function() {
        document.getElementById('payment-details').style.display = 'none';
        document.getElementById('upi-payment').style.display = 'block';
    });

    document.getElementById('submit-payment').addEventListener('click', function() {
        var cardNumber = document.getElementById('card-number').value;
        var expiryDate = document.getElementById('expiry-date').value;
        var cvv = document.getElementById('cvv').value;

        if (!cardNumber || !expiryDate || !cvv) {
            alert('Please fill in all fields.');
        } else {
            // Here you can add logic to handle the payment submission
            console.log('Card Number: ' + cardNumber);
            console.log('Expiry Date: ' + expiryDate);
            console.log('CVV: ' + cvv);
            alert('Payment submitted successfully!');
        }
    });
</script>
</body>
</html>
