/* functions.js
 * nathancharrois@gmail.com
 */


    $(function(){

        function toggleCheckBox(){
            // Toggle hidden input value.
            var dataLabel = $(this).children('span').attr("data-input");
            var dataInput = $('input[data-input="'+dataLabel+'"]');
            var toggleValue = ( dataInput.val() == 0 ) ? 1 : 0;

            // Update hidden input value.
            dataInput.val(toggleValue);

            // Add active class to checkbox.
            $(this).children('.input-checkbox').toggleClass('active');
        }

        $(document).ready(function(){
            $('.input-checkbox-label').click(toggleCheckBox);
        });

    })