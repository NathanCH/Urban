<div class="breadcrumbs-container">
    <ul class="breadcrumbs">
        <?php foreach ($breadcrumbs as $key => $breadcrumb) { ?>
            <li class="breadcrumb-item">
                <a href="<?php echo $breadcrumb['path']; ?>"><?php echo $breadcrumb['name']; ?></a>
            </li>
        <?php }?>
    </ul>
</div>