const addToCartButton = document.querySelectorAll("#addcart");
let cart = JSON.parse(sessionStorage.getItem("cart")) || [];
addToCartButton.forEach((button) => {
    button.addEventListener("click", function (e) {
        const productDiv = this.closest(".mask-icon");
        const productId = productDiv.dataset.id;
        const productName = productDiv.dataset.name;
        const productPrice = parseFloat(productDiv.dataset.price);
        const productImage = productDiv.dataset.image;
        const productRoute = productDiv.dataset.route;
        addToCard(
            productId,
            productName,
            productPrice,
            productImage,
            productRoute
        );
        e.preventDefault();
    });
});

function addToCard(
    productId,
    productName,
    productPrice,
    productImage,
    productRoute
) {
    // const cart = JSON.parse(sessionStorage.getItem("cart")) || [];
    let existingItem = cart.find((item) => item.id === productId);

    if (existingItem) {
        existingItem.quantity += 1;
    } else {
        cart.push({
            id: productId,
            name: productName,
            price: productPrice,
            image: productImage,
            route: productRoute,
            quantity: 1,
        });
    }

    sessionStorage.setItem("cart", JSON.stringify(cart));
    updateCartDisplay();
}

function updateCartDisplay() {
    // const cart = JSON.parse(sessionStorage.getItem("cart")) || [];
    const cartDiv = document.querySelector(".cart-box .cart-list");
    const notifCart = document.getElementById("notifCart");
    if (cart.length === 0) {
        cartDiv.innerHTML = "<p>Your Cart is Empty</p>";
    } else {
        const cartItems = cart
            .map(
                (item) =>
                    `
                    <li>
                    <a href="${item.route}" class="photo"><img src="${item.image}" class="cart-thumb" alt="" /></a>
                    <h6><a href="${item.route}">${item.name} </a></h6>
                    <p>${item.quantity}x - <span class="price">Rp.${item.price}</span></p>
                    </li>
                `
            )
            .join("");
        const allPrice = cart.map((item) => item.price * item.quantity);
        let sumPrice = 0;
        allPrice.forEach((item) => {
            sumPrice += item;
        });
        const htmlTotal = `<li class="total">
                        <a href="/cart" class="btn btn-default hvr-hover btn-cart">VIEW CART</a>
                        <span class="float-right"><strong>Total</strong>: Rp.${sumPrice}</span>
                    </li>`;

        cartDiv.innerHTML = cartItems + htmlTotal;
    }

    let totalNotifCart = 0;
    cart.map((item) => {
        totalNotifCart += item.quantity;
        // totalNotifCart = parseInt(totalNotifCart) + parseInt(item.quantity);
    });
    if (totalNotifCart != 0) {
        notifCart.innerText = totalNotifCart;
    } else {
        notifCart.innerText = "";
    }
}

updateCartDisplay();

// updateCartButton();
