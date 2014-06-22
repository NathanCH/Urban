<?php
/**
 *  login.php
 *
 *  @author nathancharrois@gmail.com
 *  @param array  $data['errors']    result of validation.
 *
 *  @todo create front-end validation.
 */
?>

<div class="container container-centered">
    <form action="<?= URL; ?>users/login/" method="POST">
        <header class="row">
            <h1>Login</h1>
        </header>
        <div class="row">
            <!-- Display flash -->
            <?php
            // Display errors.
            if(Session::exists('success')) {
            ?>
            <ul class="message success">
                <p>
                    <?php echo Session::flash('success'); ?>
                </p>
            </ul>
            <?php
            }
            ?>
            <!-- Email Input -->
            <div class="input-container">
                <label>Email</label>
                <input type="text" name="email" autocomplete="off" />
            </div>
            <!-- Password Input -->
            <div class="input-container">
                <label>Password</label>
                <input type="password" name="password" />
            </div>
            <div class="row">
                <div class="small-12 medium-7 large-7 columns">
                    <div class="checkbox-container">
                        <input type="hidden" name="remember_login" data-input="remember_login" value="0" />
                        <label class="input-checkbox-label">
                            <span class="input-checkbox" data-input="remember_login"></span>
                            Remember Me?
                        </label>
                    </div>
                </div>
                <div class="small-12 medium-5 large-5 columns">
                    <button id="submit" class="large-12 fill button button-primary">
                        Login
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>
