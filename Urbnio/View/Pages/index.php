<section class="row-white">
    <div class="site-wrap">
        <div class="row">
            <div class="section-heading section-centered">
                <h2 class="heading-page-section">Featured Regions</h2>
            </div>
        </div>
        <div class="row">
            <?php
            foreach ($data['regions_list'] as $region) {
            ?>
            <div class="small-12 large-6 columns">
                <div class="card-container">
                    <div class="card">
                        <div class="card-photo" data-img="/photo/1.jpg">
                            <div class="card-text-continaer">
                                <a class="link-white link-medium" href="<?= URL.$region['link']; ?>"><?= $region['name'] ?></a>
                                No Entries
                            </div>
                        </div>
                        <div class="card-lip clearfix">
                            <div class="star-rating left" data-category="region" data-item="<?= $region['id'] ?>" data-rating="4"></div>
                            <div class="circle-rating right">
                                <div class="rating-value"><?= $region['rating'] ?></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php
            }
            ?>
        </div>
    </div>
</section>
<script>
$(document).ready(function(){
    $('.star-rating').starrating();
});
</script>