function tambahKeranjang(ob, e) {
    e.preventDefault();

    const qtyProduct = document.getElementById("qtyProductDetail");
    const qtyPilih = parseInt(qtyProduct.value);
    console.log(qtyPilih);
    const productDiv = ob.closest(".itemProduct");
    const productId = productDiv.dataset.id;
    const productName = productDiv.dataset.name;
    const productPrice = parseFloat(productDiv.dataset.price);
    const productImage = productDiv.dataset.image;
    const productRoute = productDiv.dataset.route;
    addToCardDetail(
        productId,
        productName,
        productPrice,
        productImage,
        productRoute,
        qtyPilih
    );
}

function addToCardDetail(
    productId,
    productName,
    productPrice,
    productImage,
    productRoute,
    qtyPilih
) {
    // const cart = JSON.parse(sessionStorage.getItem("cart")) || [];
    let existingItem = cart.find((item) => item.id === productId);

    if (existingItem) {
        existingItem.quantity += qtyPilih;
    } else {
        cart.push({
            id: productId,
            name: productName,
            price: productPrice,
            image: productImage,
            route: productRoute,
            quantity: qtyPilih,
        });
    }

    sessionStorage.setItem("cart", JSON.stringify(cart));
    updateCartDisplay();
}
