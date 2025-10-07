// Global variables to store cart items and total price
let cartItems = [];
let totalPrice = 0;

// Function to add items to the cart
function addToCart(itemName, itemPrice) {
    // Create an object for the item
    let item = { name: itemName, price: itemPrice };
    cartItems.push(item);  // Add item to cart
    totalPrice += itemPrice;  // Update total price
    updateCart();  // Update the cart display
}

// Function to update the cart display
function updateCart() {
    const cartItemsElement = document.getElementById("cart-items");
    cartItemsElement.innerHTML = "";  // Clear the cart display

    // Loop through each item in the cart and append to the cart display
    cartItems.forEach(item => {
        const li = document.createElement("li");
        li.textContent = `${item.name} - $${item.price.toFixed(2)}`;
        cartItemsElement.appendChild(li);
    });

    // Update the total price display
    document.getElementById("total-price").textContent = `Total: $${totalPrice.toFixed(2)}`;
}

// Function to proceed to checkout
function proceedToCheckout() {
    if (cartItems.length === 0) {
        alert("Your cart is empty. Please add items to the cart before proceeding to checkout.");
    } else {
        // You can add any logic needed here when proceeding to checkout
        alert("Proceeding to Checkout...");
        // Optionally redirect to another page
        window.location.href = "orderdetails.php";
    }
}