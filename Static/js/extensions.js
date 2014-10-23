/*  extentions.js
 *  nathancharrois@gmail.com
 *
 *  custom jquery extensions.
 */

    (function($) {

        /**
         *  Toggle disabled element.
         *
         *  $('input:button').click(function() {
         *      $('input:text').toggleDisabled();
         *  });
         */
            $.fn.toggleDisabled = function() {
                    return this.each(function() {
                        var $this = $(this);

                        // Toggle disabled attribute.
                        if ($this.attr('disabled')) {
                            $this.removeAttr('disabled');
                        }

                        else{
                            $this.attr('disabled', 'disabled');
                        }
                    });
                };
            })(jQuery);