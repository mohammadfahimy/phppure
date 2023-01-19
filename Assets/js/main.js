(function ($) {
    "use strict";
    
    // Dropdown on mouse hover
    $(document).ready(function () {
        function toggleNavbarMethod() {
            if ($(window).width() > 992) {
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


    // Vendor carousel
    // $('.vendor-carousel').owlCarousel({
    //     loop: true,
    //     margin: 29,
    //     nav: false,
    //     autoplay: true,
    //     smartSpeed: 1000,
    //     responsive: {
    //         0:{
    //             items:2
    //         },
    //         576:{
    //             items:3
    //         },
    //         768:{
    //             items:4
    //         },
    //         992:{
    //             items:5
    //         },
    //         1200:{
    //             items:6
    //         }
    //     }
    // });


    // Related carousel
    // $('.related-carousel').owlCarousel({
    //     loop: true,
    //     margin: 29,
    //     nav: false,
    //     autoplay: true,
    //     smartSpeed: 1000,
    //     responsive: {
    //         0:{
    //             items:1
    //         },
    //         576:{
    //             items:2
    //         },
    //         768:{
    //             items:3
    //         },
    //         992:{
    //             items:4
    //         }
    //     }
    // });


    // Product Quantity
    $('.quantity button').on('click', function (e) {
        e.preventDefault();
        var button = $(this);
        var oldValue = button.parent().parent().find('input').val   ();
        if (button.hasClass('btn-plus')) {
            var newVal = parseFloat(oldValue) + 1;
        } else {
            if (oldValue > 0) {
                var newVal = parseFloat(oldValue) - 1;
            } else {
                newVal = 0;
            }
        }
        button.parent().parent().find('input').val(newVal);
    });


    jQuery(document).ready(function(){
        // This button will increment the value
        $('[data-quantity="plus"]').click(function(e){
            // Stop acting like a button
            e.preventDefault();
            // Get the field name
            fieldName = $(this).attr('data-field');
            // Get its current value
            var currentVal = parseInt($('input[name='+fieldName+']').val());
            // If is not undefined
            if (!isNaN(currentVal)) {
                // Increment
                $('input[name='+fieldName+']').val(currentVal + 1);
            } else {
                // Otherwise put a 0 there
                $('input[name='+fieldName+']').val(0);
            }
        });
        // This button will decrement the value till 0
        $('[data-quantity="minus"]').click(function(e) {
            // Stop acting like a button
            e.preventDefault();
            // Get the field name
            fieldName = $(this).attr('data-field');
            // Get its current value
            var currentVal = parseInt($('input[name='+fieldName+']').val());
            // If it isn't undefined or its greater than 0
            if (!isNaN(currentVal) && currentVal > 0) {
                // Decrement one
                $('input[name='+fieldName+']').val(currentVal - 1);
            } else {
                // Otherwise put a 0 there
                $('input[name='+fieldName+']').val(0);
            }
        });
    });
    
        $('body').on('click', '.cart .btn-minus,.cart .btn-plus',function (e) {


            var $this = $(this);
            var inputvalue = $this.parent().parent().find('input').val();
            var idproduct = $this.parent().parent().find('input').data('product_id');
            var loading = $('.compare_loading');
            var parentS = $this.parent().parent();
            var parenttr =parentS.parent().parent()
            var totaltr = parenttr.find('.total_price_product');
            var parentdiv = $('.row.px-xl-5');
            parentdiv.css('filter', 'blur(2px)');
            // filter: blur(2px);
            loading.show();
            $.ajax({
                type: 'POST',
                datatype: 'json',
                url: 'http://localhost/proje/cart/',
                data: {
                    idproduct : idproduct,
                    inputvalue : inputvalue,
                },
                success: function(response){
                    var obj = jQuery.parseJSON(response);

                    totaltr.html(obj.newPrice);
                    var newtotaldiv = '<h5>Total</h5> <h5>تومان '+obj.totalPrice+'</h5>';
                    var newsubtotaldiv = '<h6>subtotal</h6> <h6>تومان '+obj.totalPrice+'</h6>';

                    $('.total_cart').html(newtotaldiv);
                    $('.sub-total').html(newsubtotaldiv);
                    loading.hide();
                    parentdiv.css('filter', 'blur(0)');
                    // $('.total_price_product').html(response);
                }
            });
            
        });


        $('body').on('submit','#biling_form',function(e){
            e.preventDefault();
            var $this = $(this),
            alertError = $('.alert'),
            $all_filed = $this.serializeArray(),
            $country  =  $this.find(":selected").val(),
            required = [],
            pay = $this.find('input[name="payonhome"]').val(),
            $product_name = [],
            allLabel = $this.find('label');
            allLabel.each(function(index, val){
                if($(this).children().length > 0){
                    required [index] = $(this).attr('for');
                    if($all_filed[index]['value']){
                         required.splice($.inArray($all_filed[index]['name'], required), 1);
                    }
                }
            });
            $('.product_item').each(function(index, val){
                var child = $(this).children();
                var pn = $(child[0]).text();
                var pt = $(child[1]).text();
                $product_name[index] = {'name':pn ,'value': pt};

                
            });
            $.ajax({
                type: 'POST',
                datatype: 'json',
                url: 'http://localhost/proje/checkoute/',
                data: {
                    fieldsValue : $all_filed,
                    country : $country,
                    productName : $product_name,
                    required : required,
                    payonhome : pay,
                },
                success: function(response){
                    var obj = jQuery.parseJSON(response);
                    if(obj.status == 'payonhome'){
                        window.location.href = obj.route;
                    }
                    
                },
                error: function(error){
                    // console.log();
                    var obj = jQuery.parseJSON(error.responseText);
                    if(obj.status == false){
                        var msg = obj.msg;
                        var arr = Object.keys(msg).map(function (key) { return msg[key]; });

                        $(arr).each(function(index, val){
                            alertError.addClass('alert-error');
                            alertError.append(val+'<br>');
                            setTimeout(function(){
                                alertError.empty();
                                alertError.removeClass('alert-error');
                            },2000);
                        })
                    }
                }
            });
            
        });
    
})(jQuery);

