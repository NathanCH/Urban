<?php
/**
 *  add.php
 *
 *  @author nathancharrois@gmail.com
 *  @param  array   $data['errors']     result of validation.
  */
?>

    <div class="site-wrap">
        <header class="row">
            <div class="columns">
                <h1><?= $content['page-title']; ?></h1>
            </div>
        </header>

        <form action="<?= URL; ?>property/add" method="POST">

            <?php
            // Display errors.
            if(isset($data['errors'])) {
            ?>
            <div class="row">
                <div class="small-12 medium-12 large-12 columns">
                    <div class="message error">
                        <p>
                            <?= $content['error.list']; ?>
                        </p>
                        <ul>
                            <?php
                            foreach($data['errors'] as $item => $message) {
                                echo "<li>{$message}</li>";
                            }
                            ?>
                        </ul>
                    </div>
                </div>
            </div>
            <?php
            }
            ?>

            <fieldset>
                <div class="row">
                    <div class="columns">
                        <h3>Location</h3>
                    </div>
                </div>
                <div class="row">
                    <div class="input-container">
                        <div class="small-12 medium-4 large-3 columns">
                            <label for="name">Address:</label>
                        </div>
                        <div class="input-append-icon mtm hide loader">
                            <span class="fa fa-spin fa-spinner"></span>
                        </div>
                        <div class="small-12 medium-8 large-9 columns end">
                            <input type="text" name="location" id="search-location" data-map-component="search-location" placeholder="Enter a location" />
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="input-container">
                        <div class="small-12 medium-4 large-3 columns">
                            <label for="name">Coordinates:</label>
                            <span class="label-subtext">Drag marker to spot.</span>
                        </div>
                        <div class="small-12 medium-8 large-9 columns end">
                            <input type="hidden" name="coordinate-x" id="coordinate-x" />
                            <input type="hidden" name="coordinate-y" id="coordinate-y" />
                            <input type="hidden" name="address" id="address" />
                            <div class="map-container">
                                <div id="map" data-map-type="basic" data-map-event="create-marker"></div>
                                <div id="map-tools">
                                    <button type="button" class="button create-marker">
                                        <i class="fa fa-plus mrs"></i>
                                        Place Marker
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </fieldset>
            <fieldset>
                <div class="row">
                    <div class="small-12 medium-offset-8 medium-4 large-offset-10 large-2 columns">
                        <button id="submit" type="submit" class="large-12 fill button button-primary">
                            <?= $content['button']; ?>
                        </button>
                    </div>
                </div>
            </fieldset>
        </form>
    </div>