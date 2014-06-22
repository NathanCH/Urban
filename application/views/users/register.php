<?php
/**
 *  register.php
 *
 *  @author nathancharrois@gmail.com
 */
?>

<div class="container container-centered">
    <form action="<?= URL; ?>users/register/" method="POST">
        <header class="row">
            <h1>Create Account</h1>
        </header>
        <div class="row">
            <!-- Display errors -->
            <?php
            // Display errors.
            if(isset($data['errors'])) {
            ?>
            <div class="message error">
                <p>
                    Please correct the following errors.
                </p>
                <ul>
                    <?php
                    foreach($data['errors'] as $item => $message) {
                        echo "<li>{$item} is {$message}.</li>";
                    }
                    ?>
                </ul>
            </div>
            <?php
            }
            ?>
            <!-- Email Input -->
            <div class="input-container">
                <label>Email</label>
                <input type="text" name="email" />
            </div>
            <!-- Password Input -->
            <div class="input-container">
                <label>Password</label>
                <input type="password" name="password" />
            </div>
            <!-- Confirm Password Input -->
            <div class="input-container">
                <label>Confirm Password</label>
                <input type="password" name="confirm-password" />
            </div>
            <div class="row">
                <div class="small-12 medium-6 large-6 columns right">
                    <button id="submit" class="large-12 fill button button-primary">
                        Create Account
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>