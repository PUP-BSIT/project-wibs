document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.remove-item-btn').forEach(button => {
        button.addEventListener('click', function() {
            const cartId = this.getAttribute('data-cart-id');
            if (confirm('Are you sure you want to remove this item from your cart?')) {
                fetch('cart.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                    },
                    body: 'cart_id=' + cartId
                })
                .then(response => response.text())
                .then(data => {
                    alert(data);
                    // Optionally, refresh the page or remove the item from the DOM
                    // location.reload(); // Uncomment to refresh the page
                })
                .catch(error => console.error('Error:', error));
            }
        });
    });
});
