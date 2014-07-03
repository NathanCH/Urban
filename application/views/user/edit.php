<?php
/**
 *  edit.php
 *
 *  @author nathancharrois@gmail.com
 *  @param  array   $data['errors']     result of validation.
 */
?>

    <div class="site-container site-container-centered">
        <header class="row">
            <div class="columns">
                <h1>Edit Profile</h1>
            </div>
        </header>
        <form action="<?= URL; ?>users/login/" method="POST">
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
                                    <option>Vancouver</option>
                                    <option>Seattle</option>
                                    <option>Portland</option>
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
                            <input type="text" name="name" id="name" />
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="input-container">
                        <div class="small-12 medium-4 large-3 columns">
                            <label for="email">Email:</label>
                        </div>
                        <div class="small-12 medium-8 large-6 columns end">
                            <input type="text" name="email" id="email" />
                            <div class="row">
                                <div class="small-12 medium-12 large-12 columns">
                                    <div class="checkbox-container mtl">
                                        <input type="hidden" name="make-email-public" data-input="make-email-public" value="0" />
                                        <label class="input-checkbox-label">
                                            <span class="input-checkbox" data-input="make-email-public"></span>
                                            Make Public
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
                                <div class="textarea-editor-body" contenteditable="true">
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum @NathanCH pharetra metus eros, at molestie nisl tincidunt at. Phasellus ac facilisis leo.</p>
                                </div>
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
                        <button id="submit" style="white-space:nowrap;" class="large-12 fill button button-primary">
                            Save Changes
                        </button>
                    </div>
                </div>
            </fieldset>
        </form>
    </div>