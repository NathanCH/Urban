<?php
/**
 *  Static Layout.
 */

    // Echo header view.
    echo $this->view('_templates/header', $data);

    // View Content.
    echo $data['view_content'];

    // Echo footer view.
    echo $this->view('_templates/footer', $data);
?>