<?php

function lang($phrase, $field = null, $value = null) {

    // Format field names.
    $format_fields = array(
        'password' => 'password',
        'confirm-password' => 'confirm password',
        'email' => 'email address',
        'current-password' => 'current password'
    );

    // Assign them as items.
    $field = $format_fields[$field];

    // Build language phrases.
    $lang = array(

        // Validation.
        'required' => $field . ' is required.',
        'min' => $field . ' must be at least ' . $value . ' characters',
        'max' => $field . ' must be less than ' . $value . ' characters',
        'matches' => $field . ' does not match ' . $value,
        'unique' => $field . ' already exists.'
    );

    return $lang[$phrase];
}