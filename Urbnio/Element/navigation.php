<?php

// Logged in navigation.
if(isset($data['logged_in'])){
?>
<nav class="site-navigation right">
    <ul>
        <li class="site-navigation-item">
            <a href="<?= URL; ?>property/add">Add</a>
        </li>
        <li class="site-navigation-item">
            <a href="<?= URL; ?>user/edit/">Edit</a>
        </li>
        <li class="site-navigation-item">
            <a href="<?= URL; ?>user/edit/change-password">Change Password</a>
        </li>
        <li class="site-navigation-item">
            <a href="<?= URL; ?>user/logout">Logout</a>
        </li>
    </ul>
</nav>
<?php
}

// Loggedout navigation.
else {
?>
<nav class="site-navigation right">
    <ul>
        <li class="site-navigation-item">
            <a href="<?= URL; ?>user/login">Login</a>
        </li>
        <li class="site-navigation-item">
            <a href="<?= URL; ?>user/register">Register</a>
        </li>
        <li class="site-navigation-item">
            <a href="<?= URL; ?>user/logout">Logout</a>
        </li>
    </ul>
</nav>
<?php
}
?>