<?php
/**
 *  change-password.php
 *
 *  @author nathancharrois@gmail.com
 *  @param  array   $data['errors']     result of validation.
 *  @param  array   $data['input']      the user's profile information.
 */
?>
    <div class="site-container site-container-centered">
        <header class="row">
            <div class="columns">
                <h1><?= $content['page-title']; ?></h1>
            </div>
        </header>

        <form action="<?= URL; ?>user/change_password" method="POST">
            <?php
            // Display errors.
            if(isset($data['errors'])) {
            ?>
            <div class="row">
                <div class="small-12 medium-12 large-12 columns">
                    <div class="message error">
                        <p>
                            <?= $content['error.list']; ?>
                        </p>
                        <ul>
                            <?php
                            foreach($data['errors'] as $item => $message) {
                                echo "<li>{$message}</li>";
                            }
                            ?>
                        </ul>
                    </div>
                </div>
            </div>
            <?php
            }
            ?>

            <fieldset>
                <div class="row">
                    <div class="input-container">
                        <div class="small-12 medium-4 large-3 columns">
                            <label for="email">Current Password:</label>
                        </div>
                        <div class="small-12 medium-8 large-6 columns end">
                            <input type="password" name="current-password" id="current-password" autocomplete="off" />
                            <div class="row">
                                <div class="small-12 medium-12 large-12 columns">
                                    <button class="button button-text mtl"><?= $content['button.forgot-password']; ?></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="input-container">
                        <div class="small-12 medium-4 large-3 columns">
                            <label for="email">New Password:</label>
                        </div>
                        <div class="small-12 medium-8 large-6 columns end">
                            <input type="password" name="password" id="password" placeholder="Password" autocomplete="off" />
                            <div class="row">
                                <div class="small-12 medium-12 large-12 columns">
                                    <input type="password" name="confirm-password" id="confirm-password" placeholder="Password Again" class="mtl" autocomplete="off" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </fieldset>

            <fieldset>
                <div class="row">
                    <div class="small-12 medium-offset-4 medium-4 large-offset-3 large-2 columns">
                        <button id="submit" class="large-12 fill button button-primary">
                            <?= $content['button']; ?>
                        </button>
                    </div>
                </div>
            </fieldset>
        </form>
    </div>