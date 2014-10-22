<?php
/**
 *  Static Layout.
 */
    //var_dump($data);

    // Echo header view.
    //echo $this->view('_templates/header', $data);
    echo $data['header'];

    // View Content.
    echo $data['view_content'];

    // Echo footer view.
    echo $data['footer'];
?>