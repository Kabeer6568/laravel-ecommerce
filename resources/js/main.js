(function ($) {
    "use strict";
    
    // Dropdown on mouse hover
    $(document).ready(function () {
        function toggleNavbarMethod() {
            if ($(window).width() > 768) {
                $('.navbar .dropdown').on('mouseover', function () {
                    $('.dropdown-toggle', this).trigger('click');
                }).on('mouseout', function () {
                    $('.dropdown-toggle', this).trigger('click').blur();
                });
            } else {
                $('.navbar .dropdown').off('mouseover').off('mouseout');
            }
        }
        toggleNavbarMethod();
        $(window).resize(toggleNavbarMethod);
    });
    
    
    // Back to top button
    $(window).scroll(function () {
        if ($(this).scrollTop() > 100) {
            $('.back-to-top').fadeIn('slow');
        } else {
            $('.back-to-top').fadeOut('slow');
        }
    });
    $('.back-to-top').click(function () {
        $('html, body').animate({scrollTop: 0}, 1500, 'easeInOutExpo');
        return false;
    });
    
    
    // Home page slider
    $('.main-slider').slick({
        autoplay: true,
        dots: true,
        infinite: true,
        slidesToShow: 1,
        slidesToScroll: 1,
        centerMode: true,
        variableWidth: true
    });
    
    
    // Product Slider 4 Column
    $('.product-slider-4').slick({
        autoplay: true,
        infinite: true,
        dots: false,
        slidesToShow: 4,
        slidesToScroll: 1,
        responsive: [
            {
                breakpoint: 1200,
                settings: {
                    slidesToShow: 4,
                }
            },
            {
                breakpoint: 992,
                settings: {
                    slidesToShow: 3,
                }
            },
            {
                breakpoint: 768,
                settings: {
                    slidesToShow: 2,
                }
            },
            {
                breakpoint: 576,
                settings: {
                    slidesToShow: 1,
                }
            },
        ]
    });
    
    
    // Product Slider 3 Column
    $('.product-slider-3').slick({
        autoplay: true,
        infinite: true,
        dots: false,
        slidesToShow: 3,
        slidesToScroll: 1,
        responsive: [
            {
                breakpoint: 992,
                settings: {
                    slidesToShow: 3,
                }
            },
            {
                breakpoint: 768,
                settings: {
                    slidesToShow: 2,
                }
            },
            {
                breakpoint: 576,
                settings: {
                    slidesToShow: 1,
                }
            },
        ]
    });
    
    
    // Single Product Slider
    $('.product-slider-single').slick({
        infinite: true,
        dots: false,
        slidesToShow: 1,
        slidesToScroll: 1
    });
    
    
    // Brand Slider
    $('.brand-slider').slick({
        speed: 1000,
        autoplay: true,
        autoplaySpeed: 1000,
        infinite: true,
        arrows: false,
        dots: false,
        slidesToShow: 5,
        slidesToScroll: 1,
        responsive: [
            {
                breakpoint: 992,
                settings: {
                    slidesToShow: 4,
                }
            },
            {
                breakpoint: 768,
                settings: {
                    slidesToShow: 3,
                }
            },
            {
                breakpoint: 576,
                settings: {
                    slidesToShow: 2,
                }
            },
            {
                breakpoint: 300,
                settings: {
                    slidesToShow: 1,
                }
            }
        ]
    });
    

    function updateCartTotals() {

        let shippingAmount = 200;
        let grandTotal = 0;
        let finalGrandTotal = 0;
        $('tbody tr').each(function() {
            // const rowSubtotal = parseFloat($(this).find('.subtotal').text().replace('$', ''));
            const subtotalText = $(this).find('.subtotal').text().replace('$', '').replace(/,/g, '');
        const rowSubtotal = parseFloat(subtotalText);
            if (!isNaN(rowSubtotal)) {
                grandTotal += rowSubtotal;
            }
        });


        
        if (grandTotal >= 2000) {
            shippingAmount = 0;
            $('.shipping-amount').text('Free');
            
            finalGrandTotal = grandTotal;
            // $('.cart-summary .total-amount').text('$' + finalGrandTotal.toFixed(2));
      
        }else{
        shippingAmount = 200;
        $('.shipping-amount').text('$' + shippingAmount.toFixed(2));
        finalGrandTotal = grandTotal + shippingAmount;
        }

        // Update grand total display
        $('.cart-summary .total-amount').text('$' + grandTotal.toFixed(2));
        // $('.shipping-amount').text(shippingAmount);
        $('.cart-summary .grand-amount').text('$' + finalGrandTotal.toFixed(2));
        // OR if your total is in a different place, adjust the selector
    }

        $(document).ready(function() {
            updateCartTotals();
        });
    
    // Quantity
    $('.qty button').on('click', function () {
        var $button = $(this);
        var oldValue = $button.parent().find('input').val();
        const qtyDiv = $button.closest('.qty');
        const row = $button.closest('tr');
        // const productElement = document.getElementById('product_info');

        const productId = qtyDiv.attr('data-product-id');
        // let productQty = productElement.getElementById('product_qty').getAttribute('data-product-qty');
        let productPrice =  parseFloat(row.find('[data-product-price]').attr('data-product-price')) ;
        let totalPrice

        if ($button.hasClass('btn-plus')) {
            var newVal = parseFloat(oldValue) + 1;
            // productQty = newVal;
            // totalPrice = productPrice*productQty;
            // console.log(totalPrice);
        } else {
            if (oldValue > 0) {
                var newVal = parseFloat(oldValue) - 1;
                // productQty = newVal;
                // totalPrice = productPrice*productQty;
                // console.log(totalPrice);
            } else {
                newVal = 0;
            }
        }

        totalPrice = productPrice * newVal;
        // console.log('Product Id : ' , productId)
        // console.log('Product Price : ' , productPrice)
        // console.log('Product Qty : ' , newVal)
        // console.log('Product Total : ' , totalPrice)
        
        $button.parent().find('input').val(newVal);

        

        fetch('/cart/update' , {
            method: 'POST',
            headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
    },
            body: JSON.stringify({
                product_id: productId,
                quantity: newVal,
            })
            
        })
        .then(response => response.json())
    .then(data => {
        console.log('Success:', data);
        
        // Update the subtotal for this row
        const subtotal = productPrice * newVal;
        row.find('.subtotal').text('$' + subtotal.toFixed(2));
        
        // Recalculate and update grand total
        
        updateCartTotals();

        let totalItems = 0;

        Object.values(data.cart).forEach(item => {

            totalItems += item.quantity;
        
        });

        $('.product-count').text(totalItems);

        
    
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Failed to update cart. Please try again.');
    });
        
    });
    
    


    // Shipping address show hide
    $('.checkout #shipto').change(function () {
        if($(this).is(':checked')) {
            $('.checkout .shipping-address').slideDown();
        } else {
            $('.checkout .shipping-address').slideUp();
        }
    });
    
    
    // Payment methods show hide
    $('.checkout .payment-method .custom-control-input').change(function () {
        if ($(this).prop('checked')) {
            var checkbox_id = $(this).attr('id');
            $('.checkout .payment-method .payment-content').slideUp();
            $('#' + checkbox_id + '-show').slideDown();
        }
    });
})(jQuery);

$(document).ready(function() {
    $('.navbar-toggler').click(function() {
        $('.navbar-collapse').toggleClass('show');
    });
});