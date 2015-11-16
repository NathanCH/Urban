<section class="content-container">
    <div class="site-wrap">
        <section>
            <div class="row">
                <div class="column">
                    <?php
                    //echo $this->element('breadcrumbs', array(
                    //    'breadcrumbs' => $data['breadcrumbs']
                    //));
                    ?>
                </div>
            </div>
        </section>
        <header class="row">
            <div class="column">
                <h1 class="heading-page"><?= $content['page-title']; ?></h1>
            </div>
        </header>
        <section>
            <div class="row">
                <div class="column">
                    <h3 class="heading-section">Items</h3>
                </div>
            </div>
            <?php
            foreach ($data['items'] as $item => $value) {
            ?>
                <div class="row">
                    <div class="column">
                        <a href="<?= URL.$value['path']; ?>"><?= $value['name']; ?></a>
                    </div>
                </div>
            <?php
            }
            ?>
        </section>
    </div>
</section>