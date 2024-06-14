// script.js
let cart = [];

function addToCart(event) {
    event.preventDefault();

    const productElement = event.target.closest('.el-wrapper');
    const productName = productElement.querySelector('.p-name').innerText;
    const productPrice = productElement.querySelector('.price').innerText;

    const product = {
        name: productName,
        price: productPrice
    };

    cart.push(product);
    displayCart();
}

function displayCart() {
    const cartItemsContainer = document.getElementById('cart-items');
    cartItemsContainer.innerHTML = '';

    cart.forEach((item, index) => {
        const li = document.createElement('li');
        li.innerText = `${item.name} - ${item.price}`;
        cartItemsContainer.appendChild(li);
    });
}
