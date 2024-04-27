<?php
require './include/header.php';
?>
<?php
require './include/product.php';
?>
<?php
require './include/footer.php';
?>
<script>
    $(document).ready(function(){

        var quantitiy=0;
        $('.quantity-right-plus').click(function(e){
            e.preventDefault();
            var quantity = parseInt($('#quantity').val());
            $('#quantity').val(quantity + 1);
        });

        $('.quantity-left-minus').click(function(e){
            e.preventDefault();
            var quantity = parseInt($('#quantity').val());
            if(quantity>0){
                $('#quantity').val(quantity - 1);
            }
        });

    });

    document.addEventListener('DOMContentLoaded', function() {
        var selectElement = document.getElementById('product-option-size');
        var spanElement = document.getElementById('value-price');

        var defaultPrice = selectElement.options[0].getAttribute('data-price');
        spanElement.innerText = defaultPrice;

        selectElement.addEventListener('change', function() {
            var selectedOption = this.options[this.selectedIndex];
            var price = selectedOption.getAttribute('data-price');
            spanElement.innerText = price;
        });
    });
    $(document).ready(function() {
        $('#add-to-cart-form').on('submit', function(e) {
            e.preventDefault();

            var productPrice = $('#product-option-size').val();
            var quantity = $('#quantity').val();
            var id_pe = $('input[name="id_product_entry"]').val();


            $.ajax({
                type: "POST",
                url: "add-to-cart.php",
                data: {
                    'btn-add-to-cart': true,
                    'product-option-size': productPrice,
                    'quantity': quantity,
                    'id_product_entry': id_pe
                },
                success: function(response) {
                    const responseData = JSON.parse(response);

                    if (responseData.error) {
                        alert(responseData.error);
                    } else {
                        alert(responseData.message);
                    }
                },
                error: function(xhr, status, error) {
                    alert('Lỗi');
                }
            });
        });
    });

</script>
</body>
</html>

