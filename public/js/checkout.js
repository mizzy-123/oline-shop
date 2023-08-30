const order = document.getElementById("placeOrder");
order.addEventListener("click", function (e) {
    const submit = document.getElementById("subU");
    // const checkoutStruk = document.getElementById("strukCheckout");
    const dataOrder = document.getElementById("dataOrder");
    let shiperData = 0;
    const shippingOptions = document.querySelectorAll(
        'input[name="shipping-option"]'
    );

    shippingOptions.forEach((option) => {
        if (option.checked) {
            shiperData = option.value;
        }
    });

    let jumProduct = 0;

    let dataProduct = cart
        .map((item) => {
            jumProduct += 1;
            return `
            <input type="hidden" name="productId${jumProduct}" value="${item.id}">
            <input type="hidden" name="price${jumProduct}" value="${item.price}">
            <input type="hidden" name="quantity${jumProduct}" value="${item.quantity}">`;
        })
        .join("");
    let htmlJumProduct = `<input type="hidden" name="pProduct" value="${jumProduct}">`;
    let htmlShip = `<input type="hidden" name="shipper" value="${shiperData}">`;

    dataOrder.innerHTML = dataProduct + htmlJumProduct + htmlShip;

    e.preventDefault();
    submit.click();
});

function updateCheckout() {
    const checkoutStruk = document.getElementById("strukCheckout");
    if (cart.length !== 0) {
        let totalHargaCheckout = 0;
        cart.map((item) => {
            totalHargaCheckout += item.price * item.quantity;
        });

        checkoutStruk.innerHTML = `
        <div class="order-box">
        <div class="title-left">
            <h3>Your order</h3>
        </div>
        <div class="d-flex">
            <div class="font-weight-bold">Product</div>
            <div class="ml-auto font-weight-bold">Total</div>
        </div>
        <hr class="my-1">
        <div class="d-flex">
            <h4>Sub Total</h4>
            <div class="ml-auto font-weight-bold">Rp.${totalHargaCheckout}</div>
        </div>
        <hr class="my-1">
        <div class="d-flex">
            <h4>Coupon Discount</h4>
            <div class="ml-auto font-weight-bold">Rp.0</div>
        </div>
        <div class="d-flex" id="shipper">
            <h4>Shipping Cost</h4>
            <div class="ml-auto font-weight-bold"> Free </div>
        </div>
        <hr>
        <div class="d-flex gr-total" id="grandT">
            <h5>Grand Total</h5>
            <div class="ml-auto h5">Rp.${totalHargaCheckout}</div>
        </div>
        <hr> 
        </div>
        `;

        shipper();

        order.removeAttribute("hidden");
    } else {
        checkoutStruk.innerText = "";
        order.setAttribute("hidden", "true");
    }
}

function updateCheckoutProduct() {
    const cartCheckout = document.getElementById("cartCheckout");
    if (cart.length === 0) {
        cartCheckout.innerHTML = "<p>Your Cart is Empty</p>";
    } else {
        const cartItems = cart
            .map(
                (item) =>
                    `
            <div class="media mb-2 border-bottom">
                <div class="media-body"> <a href="detail.html">${item.name}</a>
                    <div class="small text-muted">Price: Rp.${
                        item.price
                    } <span class="mx-2">|</span> Qty: ${
                        item.quantity
                    } <span class="mx-2">|</span> Subtotal: Rp.${
                        item.price * item.quantity
                    }</div>
                </div>
            </div>
                `
            )
            .join("");
        cartCheckout.innerHTML = cartItems;
    }
}

function shipper() {
    const shippingOptions = document.querySelectorAll(
        'input[name="shipping-option"]'
    );
    const checkoutStruk = document.getElementById("strukCheckout");
    let shipper = checkoutStruk.querySelector("#shipper div");
    let grandTotal = checkoutStruk.querySelector("#grandT div");
    let totalHarga1 = 0;
    cart.map((item) => {
        totalHarga1 += item.price * item.quantity;
    });
    shippingOptions.forEach(function (option) {
        option.addEventListener("change", (e) => {
            if (e.target.checked) {
                let selectedShippingValue = parseInt(e.target.value);
                if (selectedShippingValue === 0) {
                    shipper.textContent = "Free";
                    grandTotal.textContent = `Rp.${totalHarga1}`;
                } else {
                    shipper.textContent = `Rp.${selectedShippingValue}`;
                    grandTotal.textContent = `Rp.${
                        totalHarga1 + selectedShippingValue
                    }`;
                }
            }
        });
    });
}

updateCheckoutProduct();
updateCheckout();
