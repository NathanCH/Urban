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

    <div class="container-small container-centered">
        <header class="row">
            <div class="small-12 medium-12 large-12 columns">
                    <h1>Login</h1>
            </div>
        </header>
        <form action="<?= URL; ?>users/login/" method="POST">
            <fieldset>
                <?php
                // Display flash.
                if(Session::exists('success')) {
                ?>
                <div class="row">
                    <div class="small-12 medium-12 large-12 columns">
                        <ul class="message success">
                            <p>
                                <?php echo Session::flash('success'); ?>
                            </p>
                        </ul>
                    </div>
                </div>
                <?php
                }

                // Display errors.
                if(isset($data['errors'])) {
                ?>
                <div class="row">
                    <div class="small-12 medium-12 large-12 columns">
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
                    </div>
                </div>
                <?php
                }
                ?>
                <!-- Input Container -->
                <div class="row">
                    <div class="small-12 medium-12 large-12 columns">
                        <div class="input-container">
                            <label for="email">Email</label>
                            <input type="text" name="email" id="email" />
                        </div>
                    </div>
                </div>
                 <!-- Input Container -->
                <div class="row">
                    <div class="small-12 medium-12 large-12 columns">
                        <div class="input-container">
                            <label for="password">Password</label>
                            <input type="password" name="password" id="password" />
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="small-12 medium-7 large-7 columns">
                        <div class="checkbox-container mtm">
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
            </fieldset>
        </form>
    </div>
