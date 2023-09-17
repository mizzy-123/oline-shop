function formatCurrency(input) {
    var value = input.value.replace(/[^\d]/g, "");
    var formatted = new Intl.NumberFormat("id-ID", {
        style: "decimal",
    }).format(value);
    input.value = "Rp " + formatted;
}
