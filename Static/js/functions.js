/* functions.js
 * nathancharrois@gmail.com
 */

$(function(){

    /*  Toggle Checkbox
     *
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


    /*  Toggle Select (Combo Box)
     *
     *  <div class="select-container">
     *      <select name="location" id="location">
     *          <option>Vancouver</option>
     *          <option>Seattle</option>
     *          <option>Portland</option>
     *      </select>
     *      <div class="select-text"></div>
     *      <div class="select-caret">
     *          <i class="fa fa-caret-down"></i>
     *      </div>
     *  </div>
     */
        function toggleSelect(){

            // Get the select's string.
            var string = $(this).find(":selected").text();

            // Assign string to empty placeholder div.
            $('.select-container .select-text').text(string);
        }

        $(document).ready(function(){
            $('.select-container select').change(toggleSelect).trigger('change');
        });

    /*  Close Dialogue.
     *
     *  <div data-event="close">Close Me!</div>
     */
        $(document).ready(function(){

            $('[data-event*="close"]').click(function(e){
                // Change the cursor type.
                $(this).css('cursor', 'auto');
                // Fadeout and hide element.
                $(this).animate({
                    'opacity' : 0,
                }, 500, function(){
                    $(this).hide();
                });
            });

        });

    /*  Toggle Container visibility.
     *
     *  <div class="hide" data-event="toggle">Toggle A</div>
     *  <div class="show" data-event="toggle">Toggle B</div>
     *  <button data-event="toggle-button">Toggle</button>
     */
        $(document).ready(function(){
            $('[data-event*="toggle-button"]').click(function(){
                $('[data-event*="toggle"]').toggle();
            });
        });

    /*  Dropdown
     *
     *  <span class="dropdown" data-event="toggle-dropdown">
     *      <a class="button button-text button-text-grey" href="#">Nathan Charrois</a>
     *      <ul class="dropdown-menu hide">
     *          <li>...</li>
     *      </ul>
     *  </span>
     */
        $(document).ready(function(){
            $('[data-event*="toggle-dropdown"]').click(function(e){
                $(this).siblings('.dropdown-menu').toggle();
                return false;
            });

            $('.dropdown-menu').click(function(e){
                e.stopPropagation();
            });

            $(document).click(function(){
                $('.dropdown-menu').hide();
            });
            $(window).resize(function(){
                $('.dropdown-menu').hide();
            });
        });

})