<?php

// User is not logged in.
if(!isset($data['logged_in'])){
?>
<div class="user-control right">
    <a class="button button-primary mrm">Sign in</a>
    or <a class="button button-text mls" href="<?= URL ; ?>user/register/">create account</a>
</div>
<?php
}

else{
?>
    <div class="user-control right">
        <ul>
            <li class="site-navigation-item">
                <a href="<?= URL; ?>property/add">Add</a>
            </li>
            <li class="site-navigation-item">
                <a href="<?= URL; ?>user/edit/">Edit</a>
            </li>
            <li class="site-navigation-item">
                <a href="<?= URL; ?>user/change-password">Change Password</a>
            </li>
            <li class="site-navigation-item">
                <a href="<?= URL; ?>user/logout">Logout</a>
            </li>
        </ul>
    </div>
<?php
}
?>