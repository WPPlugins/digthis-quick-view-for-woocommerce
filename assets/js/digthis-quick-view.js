jQuery(function ($) {
    admin_url = digthis.admin_url;
    $('.digthis-quick-view').on('click', function (e) {
        e.preventDefault();
        var product_id = $(this).data('product_id');
        $that = $(this);
        $.ajax({
            type: 'POST',
            url: admin_url,
            data: {action: 'dqvfwc_product_quick_view', product_id: product_id},
            beforeSend: function () {
                $that.addClass('loading');
            },
            success: function (result) {
                $('#product-display').html(result);
                $.magnificPopup.open({
                    items: {
                        src: '<div class="white-popup">' + result + '</div>',
                        type: 'inline'
                    },
                    removalDelay: 300,
                    callbacks: {
                        beforeOpen: function () {
                            this.st.mainClass = 'mfp-fade';
                        },
                        open: function () {
                            /*Require For Variations To Be Correctly Selected*/
                            // Variation Form
                            var dqvfw_content = $(document).find('#digthis-quick-view-container');
                            var form_variation = dqvfw_content.find('.variations_form');
                            form_variation.wc_variation_form();
                            form_variation.trigger('check_variations');


                            if ($(window).width() < 768) {
                                $('.variations select').each(function () {
                                    centerSelect($(this));
                                });
                            }
                        }
                    }
                    // You may add options here, they're exactly the same as for $.fn.magnificPopup call
                    // Note that some settings that rely on click event (like disableOn or midClick) will not work here
                }, 0);
                $that.removeClass('loading');
            },
            error: function (MLHttpRequest, textStatus, errorThrown) {
                console.log(errorThrown);
            }
        });
    });

});
