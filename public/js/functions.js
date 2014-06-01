/* functions.js
 * nathancharrois@gmail.com
 */


    $(function(){

        /**
         *  <input type="hidden" name="my-checkbox" data-input="unique_name" value="0" />
         *  <label class="input-checkbox-label">
         *      <span class="input-checkbox" data-input="unique_name"></span>
         *      Remember Me?
         *  </label>
         */
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