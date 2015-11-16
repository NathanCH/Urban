<?php
/**
 *  register.php
 *  @author nathancharrois@gmail.com
 */
?>
<section class="content-container">
    <div class="site-wrap-small">
        <header class="row">
            <div class="column">
                <h1 class="heading-page"><?= $content['page-title']; ?></h1>
            </div>
        </header>
        <form action="<?= URL; ?>user/register/" method="POST">
            <fieldset>
                <?php
                if(isset($data['errors'])) {
                ?>
                <div class="row">
                    <div class="column">
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
                <div class="row">
                    <div class="column">
                        <div class="input-container">
                            <label for="email">Email</label>
                            <input type="text" name="email" id="email" />
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="column">
                        <div class="input-container">
                            <label for="password">Password</label>
                            <input type="password" name="password" id="password" />
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="column">
                        <div class="input-container">
                            <label for="confirm-password">Confirm Password</label>
                            <input type="password" name="confirm-password" id="confirm-password" />
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="small-12 medium-6 large-6 columns right">
                        <button id="submit" class="large-12 fill button button-primary">
                            <?= $content['button']; ?>
                        </button>
                    </div>
                </div>
                </div>
            </fieldset>
        </form>
    </div>
</section>