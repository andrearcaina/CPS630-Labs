function updateCart(add, itemId) {
    console.log(`updateCart called with add=${add} and itemId=${itemId}`);
    fetch(`../api/updatecart.php?add=${add ? "true" : "false"}&id=${itemId}`, {
        method: "GET",
    })
    .then(response => response.json())
    .then(data => {
        console.log("Cart updated:", data);

        // Update the quantity on the page without refreshing
        const quantityElement = $(`#cartitem-list .card[id="${itemId}"] .quantity-container p`);

        // Find the current quantity value and update it
        let currentQuantity = parseInt(quantityElement.text().replace('Quantity: ', ''), 10);
        currentQuantity = add ? currentQuantity + 1 : currentQuantity - 1;
        
        // Update the quantity in the DOM
        quantityElement.text(`Quantity: ${currentQuantity}`);
    })
    .catch(error => console.error("Error updating cart:", error));
}