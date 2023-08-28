function getChange(status) {
    if (status == 1) {
        $("#qrgenerate").attr("src", "{{ asset('images/ceklist.png') }}");
    } else {
        window.location.href = "http://food-shop.test/scan";
    }
}

function getWhatsAppStatus() {
    $.ajax({
        url: "/statuswa",
        type: "GET",
        success: function (response) {
            // Update tampilan dengan status WhatsApp terbaru
            getChange(response.status);
        },
    });
}

setInterval(getWhatsAppStatus, 5000); // Polling setiap 5 detik
