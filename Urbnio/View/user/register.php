<?php
/**
 *  register.php
 *
 *  @author nathancharrois@gmail.com
 */

?>

    <div class="site-container-small site-container-centered">
        <header class="row">
            <div class="small-12 medium-12 large-12 columns">
                <h1>Create Account</h1>
            </div>
        </header>
        <form action="<?= URL; ?>user/register/" method="POST">
            <fieldset>
                <?php
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
                <!-- Email Input -->
                <div class="row">
                    <div class="small-12 medium-12 large-12 columns">
                        <div class="input-container">
                            <label for="email">Email</label>
                            <input type="text" name="email" id="email" />
                        </div>
                    </div>
                </div>
                <!-- Password Input -->
                <div class="row">
                    <div class="small-12 medium-12 large-12 columns">
                        <div class="input-container">
                            <label for="password">Password</label>
                            <input type="password" name="password" id="password" />
                        </div>
                    </div>
                </div>
                <!-- Confirm Password Input -->
                <div class="row">
                    <div class="small-12 medium-12 large-12 columns">
                        <div class="input-container">
                            <label for="confirm-password">Confirm Password</label>
                            <input type="password" name="confirm-password" id="confirm-password" />
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="small-12 medium-6 large-6 columns right">
                        <button id="submit" class="large-12 fill button button-primary">
                            Create Account
                        </button>
                    </div>
                </div>
                </div>
            </fieldset>
        </form>
    </div>