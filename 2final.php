<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Management</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            display: grid;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .all {
            display: flex;
            flex-direction: column;
            align-items: center;
            background-color: #d6d6d6;
            border-radius: 8px;
            border: 2px solid #b4acac;
            /*margin-bottom: 200px;*/
            padding: 5px 5px;
            margin-left: 2px;
            margin-top: 5px;
        }

        .container {
            max-width: 700px;
            padding: 40px;
            border: 2px solid #b4acac;
            border-radius: 5px;
            background-color: #d6d6d6;
            text-align: center;
            margin-top: 3px;
        }

        h1 {
            text-align: center;
        }

        .barcode-scanner,
        .product-details,
        .product-list,
        .other-page-link {
            text-align: center;
        }

        button {
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            border: none;
            cursor: pointer;
            margin-top: 10px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        .error-message {
            color: rgb(224, 72, 72);
        }
    </style>
</head>

<body>
    <span class="all">
        <?php
        session_start();
        if (isset($_SESSION['user'])) {
            $user = $_SESSION['user'];
            echo "<div class='profile-info'>";
            echo "<p><strong>Company Name:</strong> " . $user['company_name'] . "</p>";
            echo "<p><strong>Address:</strong> " . $user['address'] . "</p>";
            echo "<p><strong>GST Number:</strong> " . $user['gst_number'] . "</p>";
            echo "</div>";
        } else {
            echo 'You are not logged in';
        }
        ?>
    </span>
    <div class="container">
        <h1>Add Product</h1>
        <div class="barcode-scanner">
            <label for="barcode-input">Scan Barcode:</label>
            <input type="number" id="barcode-input" min="0" max="9999999999999">
            <button id="scan-button">Scan</button>
        </div>
        <div class="product-details">
            <label for="product-name">Product Name:</label>
            <input type="text" id="product-name">
            <label for="product-price">Product Price:</label>
            <input type="number" id="product-price">
            <button id="add-button">Add Product</button>
        </div>
        <div class="product-list">
            <h2>Product List</h2>
            <table id="product-list-table">
                <thead>
                    <tr>
                        <th>Serial Number</th>
                        <th>Barcode</th>
                        <th>Name</th>
                        <th>Price</th>
                      <!--  <th>Action</th>-->
                    </tr>
                </thead>
                <tbody>
                    <!-- Product list will be displayed here -->
                </tbody>
            </table>
            <p class="error-message" id="error-message"></p>
        </div>
        <div class="other-page-link">
            <a href="3final.php">
                <button>Go to Customer page</button>
            </a>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            let products = [];

            const barcodeInput = document.getElementById('barcode-input');
            const productNameInput = document.getElementById('product-name');
            const productPriceInput = document.getElementById('product-price');
            const scanButton = document.getElementById('scan-button');
            const addButton = document.getElementById('add-button');
            const productListTable = document.getElementById('product-list-table').getElementsByTagName('tbody')[0];
            const errorMessage = document.getElementById('error-message');

            scanButton.addEventListener('click', () => {
                const scannedBarcode = barcodeInput.value;
                const productDetails = {
                    barcode: scannedBarcode,
                    name: 'Sample Product',
                    price: ''
                };
                productNameInput.value = productDetails.name;
                productPriceInput.value = productDetails.price;
            });

            addButton.addEventListener('click', () => {
                const productName = productNameInput.value.trim();
                const productPrice = parseFloat(productPriceInput.value);
                const scannedBarcode = barcodeInput.value.trim();

                if (productName === '' || isNaN(productPrice) || scannedBarcode === '') {
                    errorMessage.textContent = 'Please enter all product details.';
                    return;
                }

                if (scannedBarcode.length !== 13) {
                    errorMessage.textContent = 'Barcode must be exactly 13 digits.';
                    return;
                }

                const product = {
                    id: generateUniqueId(),
                    barcode: scannedBarcode,
                    name: productName,
                    price: productPrice
                };

                products.push(product);

                productNameInput.value = '';
                productPriceInput.value = '';
                barcodeInput.value = '';
                errorMessage.textContent = '';

                displayProductList();

                fetch('2.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                        },
                        body: JSON.stringify(product),
                    })
                    .then(response => response.json())
                    .then(data => {
                        console.log(data);
                    })
                    .catch(error => {
                        console.error('Error:', error);
                    });
            });

            function displayProductList() {
                productListTable.innerHTML = '';
                products.forEach((product, index) => {
                    const row = productListTable.insertRow();
                    const cell1 = row.insertCell(0);
                    const cell2 = row.insertCell(1);
                    const cell3 = row.insertCell(2);
                    const cell4 = row.insertCell(3);
                    const cell5 = row.insertCell(4);

                    cell1.textContent = index + 1;
                    cell2.textContent = product.barcode;
                    cell3.textContent = product.name;
                    cell4.textContent = product.price.toFixed(2);
                 /*   cell5.innerHTML = `<button onclick="deleteProduct('${product.id}')">Delete</button>`;
                */ });
            }

            function deleteProduct(productId) {
                const index = products.findIndex(product => product.id === productId);
                if (index !== -1) {
                    products.splice(index, 1);
                    displayProductList();
                    fetch(`2.php?id=${productId}`, {
                            method: 'GET',
                        })
                        .then(response => response.json())
                        .then(data => {
                            console.log(data);
                        })
                        .catch(error => {
                            console.error('Error:', error);
                        });
                }
            }

            function generateUniqueId() {
                return '_' + Math.random().toString(36).substr(2, 9);
            }
        });
    </script>
</body>
</html>
