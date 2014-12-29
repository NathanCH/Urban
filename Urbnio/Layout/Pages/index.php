<?php
/**
 *  Pages Layout.
 */
    // Echo header view.
    echo $data['layout']['header'];

    echo $data['layout']['hero'];

    // View Content.
    echo $data['view_content'];

    // Echo footer view.
    echo $data['layout']['footer'];
?>