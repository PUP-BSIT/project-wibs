<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Details</title>
    <link rel="stylesheet" href="../css/product_list.css">
</head>

<body>
    <div class="navbar">
        <div class="logo">WIBS</div>
        <div class="nav-links">
            <a href="#home">Home</a>
            <a href="#orderstatus">Order Status</a>
            <a href="#mycart">My Cart</a>
        </div>
        <div class="profile-name"><strong>AJ Alejandro</strong></div>
    </div>

    <div class="details-text">
      <h1>Your Product Details</h1>
    </div>

    <div class="container">
        <main class="product-details">
            <div class="image-container">
                <img src="../ASSETS/object_3.png" alt="Wooden Accent Chair">
            </div>
            <div class="details-container">
                <h1>Wooden Accent Chair (Anjing Variant)</h1>
                <p class="price">$200.00</p>
                <p class="description">Introduce timeless charm to your space 
                    with our wooden accent chair. Crafted with precision, the 
                    chair boasts a sturdy wooden frame, providing both 
                    durability and style. The cushioned seat ensures comfort, 
                    making it an ideal addition to your home. Elevate your 
                    decor with this chic and inviting accent piece, perfect 
                    for creating a cozy and sophisticated atmosphere in any 
                    room. Immerse yourself in relaxation with this timeless 
                    piece that effortlessly complements various decor styles.
                </p>
                <!-- Color Selector -->
            <div class="color-selector">
                <span>Select Color:</span>
                <div class="color-options">
                    <input type="radio" id="colorWhite" name="color" value="white" checked>
                    <label for="colorWhite" class="color-dot" style="background-color: #ffffff;"></label>
                    
                    <input type="radio" id="colorBlack" name="color" value="black">
                    <label for="colorBlack" class="color-dot" style="background-color: #000000;"></label>
                    
                    <input type="radio" id="colorBlue" name="color" value="blue">
                    <label for="colorBlue" class="color-dot" style="background-color: #0000ff;"></label>
                </div>
            </div>

            <!-- Quantity Selector -->
            <div class="quantity-selector">
                <span>Select Quantity:</span>
                <button class="quantity-btn" onclick="decrementValue()">-</button>
                <input type="number" id="quantity" name="quantity" min="1" value="1" readonly>
                <button class="quantity-btn" onclick="incrementValue()">+</button>
            </div>
                
                <button class="add-to-cart">Add to Cart</button>
            </div>
        </main>
    </div>

    <footer class="site-footer">
        <p>&copy; 2023 WIBS. All rights reserved.</p>
    </footer>
</body>
</html>
