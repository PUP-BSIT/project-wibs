<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Details</title>
    <link rel="stylesheet" href="order_details.css">
</head>
<body>
    <div class="navbar">
        <div class="arrow-back">&#x3C;</div>
        <div class="menu">
            <div class="menu-item">HOME</div>
            <div class="menu-item">SHOP</div>
            <div class="menu-item active">ORDER DETAILS</div>
        </div>
        <div class="logo">
            WIBS <span class="underline"></span>
        </div>
    </div>

    <div class="container">
      <div class="order-details">
        <h1>Your Order Details</h1>
        <div class="order-info">
          <table class="order-table">
            <tr>
              <th>Item</th>
              <th>Quantity</th>
              <th>Price</th>
              <th>Total</th>
            </tr>
            <!-- Repeat this row for each item in the order -->
            <tr>
              <td>Item Name Here</td>
              <td>1</td>
              <td>$10.00</td>
              <td>$10.00</td>
            </tr>
            <!-- Summary row -->
            <tr class="order-summary">
              <td colspan="3">Total Cost</td>
              <td>$10.00</td>
            </tr>
          </table>
        </div>
      </div>
    </div>
  </body>
</html>
