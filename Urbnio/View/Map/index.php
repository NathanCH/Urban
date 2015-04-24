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


<script src="<?= JS_PATH; ?>/functions.js"></script>
<script src="<?= JS_PATH; ?>/components.js"></script>