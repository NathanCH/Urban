<?php
use Urbnio\Helper\Session;

// Display flash.
if(Session::exists('success') && !$_POST) {
?>
<div class="row">
    <div class="small-12 medium-12 large-12 columns">
        <ul>
            <li class="message success" data-event="close fade">
                <p>
                    <i class="fa fa-check-circle mrs"></i> <?php echo Urbnio\Helper\Session::flash('success'); ?>
                </p>
            </li>
        </ul>
    </div>
</div>
<?php
}
?>