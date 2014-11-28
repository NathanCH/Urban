<div class="file-upload-container" data-event="drop-zone">
    <div class="row">
        <div class="small-12 medium-3 large-3 columns">

            <input type="file" class="hide" name="profile_photo" data-target="browse-file" />
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
            <img class="file-preview" src="<?php echo USER_UPLOAD_PATH; ?>/<?php echo $file['file_name']; ?>" />
            <div class="close-preview" data-event="remove-preview">
                <i class="fa fa-times"></i>
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