<section class="hero-container">
    <div class="site-wrap">
        <div class="hero-copy">
            <div class="row">
                <div class="small-12 medium-12 large-12">
                    <h1 class="heading-hero">Search Your City</h1>
                    <p class="paragraph-lead">Urbn helps you find what's happening in your city. Let's explore.</p>
                </div>
            </div>
        </div>
        <div class="hero-ui">
            <div class="row">
                <form action="<?= URL; ?>pages" method="POST">
                    <div class="input-container input-white input-stack">
                        <div class="small-12 medium-6 large-6 columns">
                            <input type="text" name="search" id="search" placeholder="Water fountains in London"/>
                            <i class="fa fa-search input-append-inside"></i>
                        </div>
                        <div class="small-12 medium-3 large-3 columns">
                            <div class="select-container">
                                <select name="location" id="location">
                                    <option value="Vancouver">Any Category</option>
                                    <option value="Seattle">Buildings</option>
                                    <option value="Portland">Landmarks</option>
                                    <option value="Portland">Transport</option>
                                </select>
                                <div class="select-text"></div>
                                <div class="select-caret">
                                    <i class="fa fa-caret-down"></i>
                                </div>
                            </div>
                        </div>
                        <div class="small-12 medium-3 large-3 columns">
                            <button id="submit" class="large-12 fill button button-primary mrm">
                                <?= $content['button']; ?>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>