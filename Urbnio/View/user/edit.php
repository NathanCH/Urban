<?php
/**
 *  edit.php
 *
 *  @author nathancharrois@gmail.com
 *  @param  array   $data['errors']     result of validation.
 *  @param  array   $data['input']      the user's profile information.
 *  @param  array   $data['section']    edit sub pages.
 *
 *  @todo   remove sections and make every section its own view.
 */
    // Get view section.
    $section = $data['section'];
?>

    <div class="site-container site-container-centered">
        <header class="row">
            <div class="columns">
                <h1><?= $content['label']; ?></h1>
            </div>
        </header>

        <?php

        // Section of the edit page to render.
        switch ($section) {

            // Change password section.
            case 'change-password':
        ?>

            <form action="<?= URL; ?>user/edit/change-password" method="POST">

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
                        <div class="columns">
                            <h3>Change Password</h3>
                        </div>
                    </div>
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

        <?php
            break;

            // Default edit profile page.
            default:
        ?>

            <form action="<?= URL; ?>user/edit" method="POST">

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

                <fieldset>
                    <div class="row">
                        <div class="columns">
                            <h3>Location</h3>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-container">
                            <div class="small-12 medium-4 large-3 columns">
                                <label for="email">Your City:</label>
                            </div>
                            <div class="small-12 medium-8 large-6 columns end">
                                <div class="select-container">
                                    <select name="location" id="location">
                                        <option value="Vancouver" <?php echo ($data['input']['location'] == 'Vancouver' ? 'selected' : 'd'); ?>>Vancouver</option>
                                        <option value="Seattle" <?php echo ($data['input']['location'] == 'Seattle' ? 'selected' : 'd'); ?>>Seattle</option>
                                        <option value="Portland" <?php echo ($data['input']['location'] == 'Portland' ? 'selected' : 'g'); ?>>Portland</option>
                                    </select>
                                    <div class="select-text"></div>
                                    <div class="select-caret">
                                        <i class="fa fa-caret-down"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </fieldset>

                <fieldset>
                    <div class="row">
                        <div class="columns">
                            <h3>Details</h3>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-container">
                            <div class="small-8 medium-4 large-3 columns">
                                <label for="name">Profile Photo:</label>
                                <span class="label-subtext">.jpg .gif .png</span>
                            </div>
                            <div class="small-4 medium-8 large-6 columns end">
                                <input type="file" class="hide" name="profile_photo" id="profile-photo" />
                                <div class="file_upload">
                                    <i class="fa fa-upload"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-container">
                            <div class="small-12 medium-4 large-3 columns">
                                <label for="name">Name:</label>
                            </div>
                            <div class="small-12 medium-8 large-6 columns end">
                                <input type="text" name="name" id="name" value="<?php echo $data['input']['name']; ?>" />
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-container">
                            <div class="small-12 medium-4 large-3 columns">
                                <label for="email">Email:</label>
                            </div>
                            <div class="small-12 medium-8 large-6 columns end">
                                <input type="text" name="email" id="email" value="<?php echo $data['input']['email']; ?>" />
                                <div class="row">
                                    <div class="small-12 medium-12 large-12 columns">
                                        <div class="checkbox-container mtl">
                                            <input type="hidden" name="make-email-public" data-input="make-email-public" value="0" />
                                            <label class="input-checkbox-label">
                                                <span class="input-checkbox" data-input="make-email-public"></span>
                                                <?= $content['form.email-public']; ?>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </fieldset>

                <fieldset>
                    <div class="row">
                        <div class="columns">
                            <h3>About Me</h3>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-container">
                            <div class="small-12 medium-12 large-12 columns">
                                <div class="textarea-editor">
                                    <textarea class="textarea-editor-body" name="about" rows="5"><?php echo $data['input']['about']; ?></textarea>
                                    <div class="textarea-editor-tools">
                                        <ul class="tools clearfix">
                                            <li class="tool active">
                                                <i class="fa fa-bold"></i>
                                            </li>
                                            <li class="tool">
                                                <i class="fa fa-italic"></i>
                                            </li>
                                            <li class="tool">
                                                <i class="fa fa-list-ul"></i>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </fieldset>

                <fieldset>
                    <div class="row">
                        <div class="small-12 medium-offset-8 medium-4 large-offset-10 large-2 columns">
                            <button id="submit" class="large-12 fill button button-primary">
                                <?= $content['button']; ?>
                            </button>
                        </div>
                    </div>
                </fieldset>
            </form>

        <?php
            break;
        }
        ?>

    </div>