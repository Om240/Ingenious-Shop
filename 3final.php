<!DOCTYPE html>
<html>
<head>
  <title>Barcode Scanner</title>
  <style>
    /* Add your CSS style here */
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
      background-color: #f4f4f4;
    }
    .all{
      background-color:#d6d6d6 ;
      border-radius: 8px;
    }
    .container {
      max-width: 800px;
      margin: 0 auto;
      padding: 20px;
      background-color: #fff;
      box-shadow: 0px 0px 20px 0px rgba(0,0,0,0.1);
      border-radius: 5px;
    }

    h1 {
      color: #333;
      text-align: center;
      margin-bottom: 30px;
    }

    .input-group {
      display: flex;
      align-items: center;
      margin-bottom: 20px;
    }

    .input-group input {
      flex: 1;
      padding: 10px;
      border: 1px solid #ccc;
      border-radius: 5px;
      margin-right: 10px;
    }

    .input-group button {
      padding: 10px 20px;
      background-color: #333d35;
      color: white;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      transition: background-color 0.3s ease;
    }

    .input-group button:hover {
      background-color: #218838;
    }

    .table {
      width: 100%;
      border-collapse: collapse;
    }

    .table th, .table td {
      padding: 10px;
      border: 1px solid #ccc;
      text-align: center;
    }

    .table th {
      background-color: #eee;
    }

    .table tfoot {
      font-weight: bold;
    }

    .table tfoot td {
      text-align: right;
    }
   

    #finalTotal {
      margin-top: 20px;
      text-align: right;
    }

    /* Styling for the "Go to Next Page" button */
    #goToNextPage {
      padding: 10px 20px;
      background-color: #333d35;
      color: white;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      transition: background-color 0.3s ease;
      display: block;
      margin: 20px auto;
    }

    #goToNextPage:hover {
      background-color: #0056b3;
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
    <h1>CHECKOUT SUMMARY</h1>
    <div class="input-group">
      <input type="text" id="barcode" placeholder="Enter barcode here">
      <button id="process">Process</button>
    </div>
    <table class="table" id="result">
      <thead>
        <tr>
          <th class="sn">Serial Number</th>
          <th>Name</th>
          <th>Price</th>
          <th>Quantity</th>
          <th>Final Price</th>
        </tr>
      </thead>
      <tbody>
        <!-- The table body will be populated by JavaScript -->
      </tbody>
    </table>
    <div id="finalTotal">Final Total: <span id="finalTotalValue">0</span></div>
    <!-- Button for navigating to the next page -->
    <button id="goToNextPage">Process To Payment</button>
  </div>

  <script>
    // Get the elements from the HTML page
    var barcode = document.getElementById("barcode");
    var process = document.getElementById("process");
    var result = document.getElementById("result");
    var finalTotalValue = document.getElementById("finalTotalValue");

    // Dictionary to store products and their quantities
    var products = {};
    var serialNumber = 1; // Initialize serial number

    // Function to calculate and update the final total
    function updateFinalTotal() {
      var finalTotal = 0;
      for (var barcodeValue in products) {
        finalTotal += products[barcodeValue].quantity * products[barcodeValue].price;
      }
      finalTotalValue.textContent = finalTotal.toFixed(2);
    }

    // Function to process the barcode input
    function processBarcode() {
      // Get the barcode value from the input field
      var barcodeValue = barcode.value;

      // Validate the input
      if (barcodeValue.length != 13) {
        alert("Please enter a valid 13-digit barcode");
        return;
      }

      // Check if the product already exists
      if (products.hasOwnProperty(barcodeValue)) {
        // Increase the quantity
        products[barcodeValue].quantity++;
        // Update the quantity cell
        var existingRow = products[barcodeValue].row;
        existingRow.cells[3].textContent = products[barcodeValue].quantity;
        // Update the final price
        var finalPrice = products[barcodeValue].quantity * products[barcodeValue].price;
        existingRow.cells[4].textContent = finalPrice.toFixed(2);
        
        // Update the final total
        updateFinalTotal();
      } else {
        // Create an AJAX request object
        var xhr = new XMLHttpRequest();

        // Set the request method and URL
        xhr.open("GET", "3.php?barcode=" + barcodeValue);

        // Set the response type
        xhr.responseType = "json";

        // Set the callback function for when the request is done
        xhr.onload = function() {
          // Check the status code
          if (xhr.status == 200) {
            // Get the response data as a JSON object
            var data = xhr.response;

            // Check if the data is not null
            if (data) {
              // Create a table row element
              var row = document.createElement("tr");

              // Create a serial number cell element
              var serial = document.createElement("td");
              // Set the serial number value as the serial number counter
              serial.textContent = serialNumber++;
              // Append the serial number cell to the row
              row.appendChild(serial);

              // Create a name cell element
              var name = document.createElement("td");
              // Set the name value as the data name
              name.textContent = data.name;
              // Append the name cell to the row
              row.appendChild(name);

              // Create a price cell element
              var price = document.createElement("td");
              // Set the price value as the data price
              price.textContent = data.price;
              // Append the price cell to the row
              row.appendChild(price);

              // Create a quantity cell element
              var quantity = document.createElement("td");
              // Set the quantity value as 1 by default
              quantity.textContent = 1;
              // Append the quantity cell to the row
              row.appendChild(quantity);

              // Create a final price cell element
              var finalPrice = document.createElement("td");
              // Set the final price value as the price value by default
              finalPrice.textContent = data.price;
              // Append the final price cell to the row
              row.appendChild(finalPrice);

              // Append the row to the table body
              result.tBodies[0].appendChild(row);

              // Store product details
              products[barcodeValue] = {
                name: data.name,
                price: data.price,
                quantity: 1,
                row: row
              };

              // Update the final total
              updateFinalTotal();
            } else {
              // If the data is null, alert the user
              alert("No product found with this barcode");
            }
          } else {
            // If the status code is not 200, alert the user
            alert("Something went wrong");
          }
        };

        // Send the request
        xhr.send();
      }

      // Clear the input field after processing
      barcode.value = "";
    }

    // Add an event listener to the "Process" button
    process.addEventListener("click", processBarcode);

    // Add an event listener for the "input" event on the barcode input field
    barcode.addEventListener("input", function() {
      // Check if the barcode input length is 13 characters
      if (barcode.value.length === 13) {
        // Trigger the processing action
        processBarcode();
      }
    });

    // Function to handle navigation to the next page
    function goToNextPage() {
      // Define the URL of the next page
      var nextPageURL = "gateway.php"; // Replace "next-page.html" with the actual URL of the next page
      
      // Navigate to the next page
      window.location.href = nextPageURL;
    }

    // Get the button element for navigating to the next page
    var goToNextPageButton = document.getElementById("goToNextPage");

    // Add an event listener to the button for the click event
    goToNextPageButton.addEventListener("click", goToNextPage);
  </script>
</body>
</html>
