/**
  * Template Name: Daily Shop
  * Version: 1.0
  * Template Scripts
  * Author: MarkUps
  * Author URI: http://www.markups.io/

  Custom JS


  1. CARTBOX
  2. TOOLTIP
  3. PRODUCT VIEW SLIDER
  4. POPULAR PRODUCT SLIDER (SLICK SLIDER)
  5. FEATURED PRODUCT SLIDER (SLICK SLIDER)
  6. LATEST PRODUCT SLIDER (SLICK SLIDER)
  7. TESTIMONIAL SLIDER (SLICK SLIDER)
  8. CLIENT BRAND SLIDER (SLICK SLIDER)
  9. PRICE SLIDER  (noUiSlider SLIDER)
  10. SCROLL TOP BUTTON
  11. PRELOADER
  12. GRID AND LIST LAYOUT CHANGER
  13. RELATED ITEM SLIDER (SLICK SLIDER)


**/

jQuery(function($){


  /* ----------------------------------------------------------- */
  /*  1. CARTBOX
  /* ----------------------------------------------------------- */

     jQuery(".aa-cartbox").hover(function(){
      jQuery(this).find(".aa-cartbox-summary").fadeIn(500);
    }
      ,function(){
          jQuery(this).find(".aa-cartbox-summary").fadeOut(500);
      }
     );

  /* ----------------------------------------------------------- */
  /*  2. TOOLTIP
  /* ----------------------------------------------------------- */
    jQuery('[data-toggle="tooltip"]').tooltip();
    jQuery('[data-toggle2="tooltip"]').tooltip();

  /* ----------------------------------------------------------- */
  /*  3. PRODUCT VIEW SLIDER
  /* ----------------------------------------------------------- */

    jQuery('#demo-1 .simpleLens-thumbnails-container img').simpleGallery({
        loading_image: 'demo/images/loading.gif'
    });

    jQuery('#demo-1 .simpleLens-big-image').simpleLens({
        loading_image: 'demo/images/loading.gif'
    });

  /* ----------------------------------------------------------- */
  /*  4. POPULAR PRODUCT SLIDER (SLICK SLIDER)
  /* ----------------------------------------------------------- */

    jQuery('.aa-popular-slider').slick({
      dots: false,
      infinite: false,
      speed: 300,
      slidesToShow: 4,
      slidesToScroll: 4,
      responsive: [
        {
          breakpoint: 1024,
          settings: {
            slidesToShow: 3,
            slidesToScroll: 3,
            infinite: true,
            dots: true
          }
        },
        {
          breakpoint: 600,
          settings: {
            slidesToShow: 2,
            slidesToScroll: 2
          }
        },
        {
          breakpoint: 480,
          settings: {
            slidesToShow: 1,
            slidesToScroll: 1
          }
        }
        // You can unslick at a given breakpoint now by adding:
        // settings: "unslick"
        // instead of a settings object
      ]
    });


  /* ----------------------------------------------------------- */
  /*  5. FEATURED PRODUCT SLIDER (SLICK SLIDER)
  /* ----------------------------------------------------------- */

    jQuery('.aa-featured-slider').slick({
        dots: false,
        infinite: false,
        speed: 300,
        slidesToShow: 4,
        slidesToScroll: 4,
        responsive: [
          {
            breakpoint: 1024,
            settings: {
              slidesToShow: 3,
              slidesToScroll: 3,
              infinite: true,
              dots: true
            }
          },
          {
            breakpoint: 600,
            settings: {
              slidesToShow: 2,
              slidesToScroll: 2
            }
          },
          {
            breakpoint: 480,
            settings: {
              slidesToShow: 1,
              slidesToScroll: 1
            }
          }
          // You can unslick at a given breakpoint now by adding:
          // settings: "unslick"
          // instead of a settings object
        ]
    });

  /* ----------------------------------------------------------- */
  /*  6. LATEST PRODUCT SLIDER (SLICK SLIDER)
  /* ----------------------------------------------------------- */
    jQuery('.aa-latest-slider').slick({
        dots: false,
        infinite: false,
        speed: 300,
        slidesToShow: 4,
        slidesToScroll: 4,
        responsive: [
          {
            breakpoint: 1024,
            settings: {
              slidesToShow: 3,
              slidesToScroll: 3,
              infinite: true,
              dots: true
            }
          },
          {
            breakpoint: 600,
            settings: {
              slidesToShow: 2,
              slidesToScroll: 2
            }
          },
          {
            breakpoint: 480,
            settings: {
              slidesToShow: 1,
              slidesToScroll: 1
            }
          }
          // You can unslick at a given breakpoint now by adding:
          // settings: "unslick"
          // instead of a settings object
        ]
    });

  /* ----------------------------------------------------------- */
  /*  7. TESTIMONIAL SLIDER (SLICK SLIDER)
  /* ----------------------------------------------------------- */

    jQuery('.aa-testimonial-slider').slick({
      dots: true,
      infinite: true,
      arrows: false,
      speed: 300,
      slidesToShow: 1,
      adaptiveHeight: true
    });

  /* ----------------------------------------------------------- */
  /*  8. CLIENT BRAND SLIDER (SLICK SLIDER)
  /* ----------------------------------------------------------- */

    jQuery('.aa-client-brand-slider').slick({
        dots: false,
        infinite: false,
        speed: 300,
        autoplay: true,
        autoplaySpeed: 2000,
        slidesToShow: 5,
        slidesToScroll: 1,
        responsive: [
          {
            breakpoint: 1024,
            settings: {
              slidesToShow: 4,
              slidesToScroll: 4,
              infinite: true,
              dots: true
            }
          },
          {
            breakpoint: 600,
            settings: {
              slidesToShow: 2,
              slidesToScroll: 2
            }
          },
          {
            breakpoint: 480,
            settings: {
              slidesToShow: 1,
              slidesToScroll: 1
            }
          }
          // You can unslick at a given breakpoint now by adding:
          // settings: "unslick"
          // instead of a settings object
        ]
    });

  /* ----------------------------------------------------------- */
  /*  9. PRICE SLIDER  (noUiSlider SLIDER)
  /* ----------------------------------------------------------- */

    jQuery(function(){
      if($('body').is('.productPage')){
       var skipSlider = document.getElementById('skipstep');

       var filter_price_start = jQuery('#filter_price_start').val();
       var filter_price_end = jQuery('#filter_price_end').val();

       if (filter_price_start =='' || filter_price_end =='') {
           var filter_price_start = 100;
           var filter_price_end = 1700;
       }
        noUiSlider.create(skipSlider, {
            range: {
                'min': 0,
                '10%': 100,
                '20%': 300,
                '30%': 500,
                '40%': 700,
                '50%': 900,
                '60%': 1100,
                '70%': 1300,
                '80%': 1500,
                '90%': 1700,
                'max': 1900
            },
            snap: true,
            connect: true,
            start: [filter_price_start, filter_price_end]
        });
        // for value print
        var skipValues = [
          document.getElementById('skip-value-lower'),
          document.getElementById('skip-value-upper')
        ];

        skipSlider.noUiSlider.on('update', function( values, handle ) {
          skipValues[handle].innerHTML = values[handle];
        });
      }
    });



  /* ----------------------------------------------------------- */
  /*  10. SCROLL TOP BUTTON
  /* ----------------------------------------------------------- */

  //Check to see if the window is top if not then display button

    jQuery(window).scroll(function(){
      if ($(this).scrollTop() > 300) {
        $('.scrollToTop').fadeIn();
      } else {
        $('.scrollToTop').fadeOut();
      }
    });

    //Click event to scroll to top

    jQuery('.scrollToTop').click(function(){
      $('html, body').animate({scrollTop : 0},800);
      return false;
    });

  /* ----------------------------------------------------------- */
  /*  11. PRELOADER
  /* ----------------------------------------------------------- */

    jQuery(window).load(function() { // makes sure the whole site is loaded
      jQuery('#wpf-loader-two').delay(200).fadeOut('slow'); // will fade out
    })

  /* ----------------------------------------------------------- */
  /*  12. GRID AND LIST LAYOUT CHANGER
  /* ----------------------------------------------------------- */

  jQuery("#list-catg").click(function(e){
    e.preventDefault(e);
    jQuery(".aa-product-catg").addClass("list");
  });
  jQuery("#grid-catg").click(function(e){
    e.preventDefault(e);
    jQuery(".aa-product-catg").removeClass("list");
  });


  /* ----------------------------------------------------------- */
  /*  13. RELATED ITEM SLIDER (SLICK SLIDER)
  /* ----------------------------------------------------------- */

    jQuery('.aa-related-item-slider').slick({
      dots: false,
      infinite: false,
      speed: 300,
      slidesToShow: 4,
      slidesToScroll: 4,
      responsive: [
        {
          breakpoint: 1024,
          settings: {
            slidesToShow: 3,
            slidesToScroll: 3,
            infinite: true,
            dots: true
          }
        },
        {
          breakpoint: 600,
          settings: {
            slidesToShow: 2,
            slidesToScroll: 2
          }
        },
        {
          breakpoint: 480,
          settings: {
            slidesToShow: 1,
            slidesToScroll: 1
          }
        }
        // You can unslick at a given breakpoint now by adding:
        // settings: "unslick"
        // instead of a settings object
      ]
    });

});

function change_product_color_image(img, color){
    jQuery('#color_id').val(color);
    jQuery('.simpleLens-big-image-container').html('<a data-lens-image="'+img+'" class="simpleLens-lens-image"><img src="'+img+'" class="simpleLens-big-image"></a>');
}

function showColor(size){
    jQuery('#size_id').val(size);
    jQuery('#color_id').val('');

    jQuery('.product_color').hide();
    jQuery('.size_'+size).show();

    jQuery('.size_link').css('border','1px solid #ddd');
    jQuery('#size_'+size).css('border','1px solid black');
}


function home_add_to_cart(id,size_str_id,color_str_id){
    jQuery('#size_id').val(size_str_id);
    jQuery('#color_id').val(color_str_id);

    add_to_cart(id,size_str_id,color_str_id);
}

function add_to_cart(id,size_str_id,color_str_id){

    jQuery('#add_to_cart_msg').html('');
    var size_id = jQuery('#size_id').val();
    var color_id = jQuery('#color_id').val();

    if (color_str_id == 0) {
        color_str_id = 'no';
    }
    if (size_str_id == 0) {
        size_str_id = 'no';
    }

    if (size_id == '' && size_str_id != 'no') {
        jQuery('#add_to_cart_msg').html('<div class="alert alert-danger fade in alert-dismissible show"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true" style="font-size:20px">×</span></button>Please select <strong>size</strong>.</div>');
    }else if (color_id == '' && color_str_id != 'no') {
        jQuery('#add_to_cart_msg').html('<div class="alert alert-danger fade in alert-dismissible show"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true" style="font-size:20px">×</span></button>Please select <strong>color</strong>.</div>');
    }else {
        jQuery('#product_id').val(id);
        jQuery('#pqty').val(jQuery('#qty').val());
        jQuery.ajax({

            url:'/add_to_cart',
            type:'POST',
            // method:'POST',
            data:jQuery('#frmAddToCart').serialize(),
            success:function(result){
                var totalPrice = 0;
                alert('Product '+result.msg);
                if (result.totalItem == 0) {
                    jQuery('.aa-cart-notify').html('0');
                    jQuery('.aa-cartbox-summary').remove();
                }else {

                    jQuery('.aa-cart-notify').html(result.totalItem);
                    var html = '<ul>';
                    jQuery.each(result.data, function(arrKey,arrVal){
                        totalPrice = parseInt(totalPrice) + (parseInt(arrVal.qty) * parseInt(arrVal.price));
                        html += '<li><a class="aa-cartbox-img" href="#"><img src="'+PRODUCT_IMAGE+'/'+arrVal.image+'" alt="img"></a><div class="aa-cartbox-info"><h4><a href="#">'+arrVal.name+'</a></h4><p>'+arrVal.qty+' x TK. '+arrVal.price+'</p></div></li>';

                    });

                }
                html += '<li><span class="aa-cartbox-total-title">Total</span><span class="aa-cartbox-total-price">TK. '+totalPrice+'</span></li>';
                html += '</ul><a class="aa-cartbox-checkout aa-primary-btn" href="checkout">Checkout</a>';
                jQuery('.aa-cartbox-summary').html(html);
            }
        });
    }
}

function deleteCartProduct(pid,size,color,attr_id){
    jQuery('#size_id').val(size);
    jQuery('#color_id').val(color);
    jQuery('#qty').val(0);
    add_to_cart(pid,size,color);
    // jQuery('#total_price_'+attr_id).html('TK. '+qty*price);
    jQuery('#cart_box_'+attr_id).remove();
}

function updateQty(pid,size,color,attr_id,price){
    jQuery('#size_id').val(size);
    jQuery('#color_id').val(color);
    var qty = jQuery('#qty'+attr_id).val();
    jQuery('#qty').val(qty);
    add_to_cart(pid,size,color);
    jQuery('#total_price_'+attr_id).html('TK. '+qty*price);
}


function sort_by(){
    var sort_by_value = jQuery('#sort_by_value').val();
    jQuery('#sort').val(sort_by_value);
    jQuery('#categoryFilter').submit();
}


function sort_price_filter(){
    var start = jQuery('#skip-value-lower').html();
    var end = jQuery('#skip-value-upper').html();
    jQuery('#filter_price_start').val(start);
    jQuery('#filter_price_end').val(end);
    jQuery('#categoryFilter').submit();
}

function setColor(color, type){
    var color_str = jQuery('#color_filter').val();
    if (type == 1) {
        var new_color_str = color_str.replace(color+':','');
        jQuery('#color_filter').val(new_color_str);
    }else {
        jQuery('#color_filter').val(color+':'+color_str);
    }

    jQuery('#categoryFilter').submit();
    // alert(color);
}



function funSearch(){
    var search_str = jQuery('#search_str').val();
    if (search_str != '' && search_str.length>3) {
        window.location.href = '/search/'+search_str;
    }
}


jQuery('#frmRegistration').submit(function(e){
    e.preventDefault();
    jQuery('.field_error').html('');
    jQuery.ajax({
        url:'/registration_process',
        data:jQuery('#frmRegistration').serialize(),
        type:'POST',
        success:function(result){
            // console.log(result.status);
            if (result.status=='error') {
                jQuery.each(result.error, function(key,val){
                    jQuery('#'+key+'_error').html(val[0]);
                    console.log(key);
                    console.log(val);
                });
            }
            if (result.status=='success') {
                jQuery('#frmRegistration')[0].reset();
                jQuery('#thank_you_msg').html(result.msg);

            }
        }
    });
});


jQuery('#frmLogin').submit(function(e){
    e.preventDefault();
    jQuery('#login_msg').html('');
    jQuery.ajax({
        url:'/login_process',
        data:jQuery('#frmLogin').serialize(),
        type:'POST',
        success:function(result){
            if (result.status=='error') {
                jQuery('#login_msg').html(result.msg);
            }
            if (result.status=='success') {
                window.location.href = '/';

            }
        }
    });
});


function forgot_password(){
    jQuery('#popup_forgot').show();
    jQuery('#popup_login').hide();
}
function show_login_popup(){
    jQuery('#popup_forgot').hide();
    jQuery('#popup_login').show();
}


jQuery('#frmForgot').submit(function(e){
    e.preventDefault();
    jQuery('#forgot_msg').html('Please wait....');
    // jQuery('#forgot_msg').html('');
    jQuery.ajax({
        url:'/forgot_password',
        data:jQuery('#frmForgot').serialize(),
        type:'POST',
        success:function(result){
            jQuery('#forgot_msg').html(result.msg);

        }
    });
});


jQuery('#frmUpdatePassword').submit(function(e){
    e.preventDefault();
    jQuery('#thank_you_msg').html('Please wait....');
    // jQuery('#thank_you_msg').html('');
    jQuery.ajax({
        url:'/forgot_password_change_process',
        data:jQuery('#frmUpdatePassword').serialize(),
        type:'POST',
        success:function(result){
            jQuery('#thank_you_msg').html(result.msg);

        }
    });
});
