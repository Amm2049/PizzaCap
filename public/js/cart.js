$(document).ready(function() {
    // Plus Total
    $('.btn-plus').click(function() {
        $parentNode = $(this).parents("tr");
        $price = Number($parentNode.find('#price').text().replace("Kyats", ""));
        $quantity = Number($parentNode.find('#quantity').val());
        $total = $price * $quantity;
        console.log($quantity);
        $parentNode.find('#total').html($total + " Kyats");

        summaryCalculation()
    })

    // Minus Total
    $('.btn-minus').click(function() {
        $parentNode = $(this).parents("tr");
        $price = Number($parentNode.find('#price').text().replace("Kyats", ""));
        $quantity = Number($parentNode.find('#quantity').val());
        $total = $price * $quantity;
        $parentNode.find('#total').html($total + " Kyats");

        summaryCalculation()
    })

    // Summary Total
    function summaryCalculation() {
        $totalPrice = 0;
        $('#dataTable tbody tr').each(function(index, row) {
            $totalPrice += Number($(row).find('#total').text().replace("Kyats",""));
        })

        $('#subTotal').html(`${$totalPrice} Kyats`);
        $('#finalTotal').html(`${$totalPrice + 3000} Kyats`);
    }
})
