function updateCart() {
    // let cart2 = JSON.parse(sessionStorage.getItem("cart")) || [];
    const tableB = document.getElementById("cartT");

    if (cart.length !== 0) {
        const cartItems = cart
            .map(
                (item) =>
                    `
            <tr>
                <input type="hidden" class="productId" value="${item.id}">
                  <td class="thumbnail-img">
                    <a href="${item.route}">
                      <img class="img-fluid" src="${item.image}" alt="" />
                    </a>
                  </td>
                  <td class="name-pr">
                    <a href="${item.route}">${item.name}</a>
                  </td>
                  <td class="price-pr">
                    <p>Rp.${item.price}</p>
                  </td>
                  <td class="quantity-box"><input type="number" size="4" value="${
                      item.quantity
                  }" min="1" step="1" class="c-input-text qty text" /></td>
                  <td class="total-pr">
                    <p>Rp.${item.price * item.quantity}</p>
                  </td>
                  <td class="remove-pr">
                    <a href="#">
                      <i class="fas fa-times"></i>
                    </a>
                  </td>
            </tr>
            `
            )
            .join("");
        tableB.innerHTML = cartItems;
        const changeCart = tableB.getElementsByTagName("tr");
        Array.from(changeCart).forEach((i) => {
            // const harga = i.querySelector(".price-pr p");
            const qty = i.querySelector(".quantity-box input");
            const total = i.querySelector(".total-pr p");
            const id = i.querySelector(".productId");
            const remove = i.querySelector(".remove-pr a");
            let nameP = cart.find((item) => item.id === id.value);
            qty.addEventListener("change", function (e) {
                total.textContent = "Rp." + nameP.price * e.target.value;
            });

            remove.addEventListener("click", function (e) {
                let deleteP = cart.filter((e) => e.id != id.value);
                cart = deleteP;
                sessionStorage.setItem("cart", JSON.stringify(cart));
                i.remove();
                updateCartDisplay();
                e.preventDefault();
            });
        });

        updateCartButton();
    }
}

function updateCartButton() {
    // const cart3 = JSON.parse(sessionStorage.getItem("cart")) || [];
    const tableB = document.getElementById("cartT");
    const changeCart = tableB.getElementsByTagName("tr");
    const updateButton = document.querySelector(".update-box input");
    updateButton.addEventListener("click", function () {
        Array.from(changeCart).forEach((i) => {
            const qty = i.querySelector(".quantity-box input");
            const name = i.querySelector(".name-pr a");
            let nameP = cart.find((item) => item.name === name.textContent);
            nameP.quantity = parseInt(qty.value);
            sessionStorage.setItem("cart", JSON.stringify(cart));
            updateCartDisplay();
        });
        updateStruk();
    });
}

function updateStruk() {
    // const cart4 = JSON.parse(sessionStorage.getItem("cart")) || [];
    const itemStruk = document.getElementById("itemStruk");

    if (cart.length !== 0) {
        let totalHarga = 0;
        cart.map((item) => {
            totalHarga += item.price * item.quantity;
        });

        itemStruk.innerHTML = `
        <div class="order-box">
        <h3>Order summary</h3>
        <div class="d-flex">
          <h4>Sub Total</h4>
          <div class="ml-auto font-weight-bold">Rp.${totalHarga}</div>
        </div>
        <hr class="my-1" />
        <div class="d-flex">
          <h4>Coupon Discount</h4>
          <div class="ml-auto font-weight-bold">Rp.0</div>
        </div>
        <div class="d-flex">
          <h4>Shipping Cost</h4>
          <div class="ml-auto font-weight-bold">Free</div>
        </div>
        <hr />
        <div class="d-flex gr-total">
          <h5>Grand Total</h5>
          <div class="ml-auto h5">Rp.${totalHarga}</div>
        </div>
        <hr />
      </div>
        `;
    } else {
        itemStruk.innerText = "";
    }
}

updateCart();
updateStruk();
