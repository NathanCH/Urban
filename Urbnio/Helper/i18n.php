<?php
namespace Urbnio\Helper;

class i18n {

    private static $_data = array();

    private $_location = null;

    /**
     * @todo get user to set locale.
     */
    public function __construct() {
        $this->_location = APP_LOCALE;
    }

    /**
     * @param  $data   array   the language keys and translations.
     */
    public static function set_language_data($data = array()) {
        self::$_data = $data;
    }

    /**
     * @param  $phrase     the string identifier.
     */
    public static function lang($phrase) {
        $string = self::$_data;

        return $string[$phrase];
    }

    /**
     * Process validation language.
     *
     * @param  $error_type    type of validation error.
     * @param  $field         validation field name.
     * @param  $value         value of validation.
     * @return processed validation response.
     * @todo should be able to remove this later and replace with front-end validation.
     */
    public static function validation_lang($error_type, $field = null, $value = null) {

        // Format field names.
        $sanatized_field_names = array(
            'password' => 'password',
            'confirm-password' => 'confirm password',
            'email' => 'email address',
            'current-password' => 'current password',
            'address' => 'address',
            'file' => 'file',
            'name' => 'name',
            'rating' => 'rating'
        );

        // Assign them as items.
        $field = $sanatized_field_names[$field];

        // Validation Phrases.
        $validation_response = array(
            'required' => $field . ' is required.',
            'min' => $field . ' must be at least ' . $value . ' characters.',
            'max' => $field . ' must be less than ' . $value . ' characters.',
            'matches' => $field . ' does not match ' . $value . '.',
            'unique' => $field . ' already exists.',
            'check_password' => 'Password is incorrect.',
            'login_failed' => 'Email password combination doesn\'t exist.',
            'max_file_size' => $field . ' must be less than ' . $value . ' KB.',
            'file_type' => $field . ' must be an image.',
            'positive_integer' => $field . ' must be a positive integer.'
        );

        return ucfirst($validation_response[$error_type]);
    }
}