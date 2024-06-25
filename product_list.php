<!DOCTYPE html>
<html>
<head>
    <title>Product List</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
    </style>
</head>
<body>
    <table id="productTable">
        <tr>
            <th>Barcode</th>
            <th>Name</th>
            <th>Price</th>
            <th>Actions</th>
        </tr>
        <!-- Product data will be inserted here -->
    </table>

    <script>
        window.onload = function() {
            fetch('get_products.php')
            .then(response => response.json())
            .then(data => {
                let table = document.getElementById('productTable');
                data.forEach(product => {
                    let row = table.insertRow();
                    row.innerHTML = `<td>${product.barcode}</td><td>${product.name}</td><td>${product.price}</td><td><button onclick="editProduct('${product.barcode}')">Edit</button> <button onclick="deleteProduct('${product.barcode}')">Delete</button></td>`;
                });
            });
        };

        function editProduct(barcode) {
            let name = prompt("Enter new product name");
            let price = prompt("Enter new product price");
            fetch(`edit_product.php?barcode=${barcode}&name=${encodeURIComponent(name)}&price=${encodeURIComponent(price)}`)
            .then(response => location.reload());
        }

        function deleteProduct(barcode) {
            if (confirm('Are you sure you want to delete this product?')) {
                fetch(`delete_product.php?barcode=${barcode}`)
                .then(response => location.reload());
            }
        }
    </script>
</body>
</html>
