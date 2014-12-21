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

/**
 *  Tiny jQuery pub/sub.
 *  https://github.com/cowboy/jquery-tiny-pubsub
 *
 *  Copyright (c) 2013 "Cowboy" Ben Alman
 */

(function($){

    var object = $({});

    $.each({
        on: 'subscribe',
        trigger: 'publish'
    }, function(key, api){
        $[api] = function() {
            object[key].apply(object, arguments);
        }
    });

    // $.subscribe = function() {
    //     object.on.apply(object, arguments);
    // }

    // $.publish = function() {
    //     object.trigger.apply(object, arguments);
    // }

})(jQuery);