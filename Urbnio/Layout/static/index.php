<?php
/**
 *  Static Layout.
 *
 *  associated views: User/index, User/login, User/register, User/edit, User/edit/change-password
 */

    // Echo header view.
    echo $this->view('_templates/header', $data);

    // View Content.
    echo $data['view_content'];

    // Echo footer view.
    echo $this->view('_templates/footer', $data);
?>