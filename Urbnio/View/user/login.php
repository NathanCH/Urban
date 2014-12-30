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
<section class="content-container">
    <div class="site-wrap-small">
        <header class="row">
            <div class="small-12 medium-12 large-12 columns">
                <h1 class="heading-page"><?= $content['page-title']; ?></h1>
            </div>
        </header>
        <form action="<?= URL; ?>user/login/" method="POST">
            <fieldset>
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
                        <div class="checkbox-container mtm mbl">
                            <input type="hidden" name="remember_login" data-input="remember_login" value="0" />
                            <label class="input-checkbox-label">
                                <span class="input-checkbox" data-input="remember_login"></span>
                                <?= $content['form.remember-me']; ?>
                            </label>
                        </div>
                    </div>
                    <div class="small-12 medium-5 large-5 columns">
                        <button id="submit" class="large-12 fill button button-primary">
                            <?= $content['button']; ?>
                        </button>
                    </div>
                </div>
            </fieldset>
        </form>
    </div>
</section>