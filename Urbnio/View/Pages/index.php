<section>
    <div class="site-wrap">
        <section class="content-container">
            <div class="row">
                <div class="column">
                    <h1 class="heading-page">Featured Regions</h1>
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
    </div>
</section>