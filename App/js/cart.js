function confirmRemove() {
    return confirm('Are you sure you want to remove this item from the cart?');
}

function showNotification(message) {
    var notification = document.getElementById('notification');
    if (notification) {
        notification.textContent = message; // Set the message
        notification.style.display = 'block';
        setTimeout(function() {
            notification.style.display = 'none';
        }, 3000);
    }
}

window.onload = function() {
    hideNotification();
    showNotification();

    var itemRemoved = '<?php echo $itemRemoved ? "true" : "false"; ?>';
    if (itemRemoved === "true") {
        showNotification("Item removed from cart successfully");
    }
};


