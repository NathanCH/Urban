<div class="file-upload-container" data-event="drop-zone">
    <div class="row">
        <div class="small-12 medium-3 large-3 columns">

            <input type="file" class="hide" id="file-upload" name="profile_photo"/>
            <?php
            // Profile photo is not set.
            if(!$file['set']) {
            ?>
            <div class="file-upload" data-event="select-file">
                <i class="fa fa-upload"></i>
            </div>
            <?php
            }

            // Display profile photo.
            else {
            ?>
            <div class="file-upload hide" data-event="select-file">
                <i class="fa fa-upload"></i>
            </div>
            <div class="file-preview-container">
                <img class="file-preview" src="<?php echo URL; ?>/<?php echo $file['file_name']; ?>" data-event="select-file"/>
            </div>
            <?php
            }
            ?>
        </div>
        <div class="file-upload-controls small-12 medium-9 large-9 columns">
            <button class="button button-form" data-event="select-file">Upload New Picture</button>
            <button class="button button-text hide" data-event="remove-preview">Remove</button>
            <br />
            <p class="mtm">You can also drag and drop a picture.</p>
        </div>
    </div>
</div>

<script>
$(document).ready(function(){
    $('#file-upload').fileupload();
});
</script>