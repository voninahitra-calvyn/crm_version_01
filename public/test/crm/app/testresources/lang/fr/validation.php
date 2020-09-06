<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted' => 'fr111 fr111 The :attribute must be accepted.',
    'active_url' => 'fr111 The :attribute is not a valid URL.',
    'after' => 'fr111 The :attribute must be a date after :date.',
    'after_or_equal' => 'fr111 The :attribute must be a date after or equal to :date.',
    'alpha' => 'fr111 The :attribute may only contain letters.',
    'alpha_dash' => 'fr111 The :attribute may only contain letters, numbers, dashes and underscores.',
    'alpha_num' => 'fr111 The :attribute may only contain letters and numbers.',
    'array' => 'fr111 The :attribute must be an array.',
    'before' => 'fr111 The :attribute must be a date before :date.',
    'before_or_equal' => 'fr111 The :attribute must be a date before or equal to :date.',
    'between' => [
        'numeric' => 'fr111 The :attribute must be between :min and :max.',
        'file' => 'fr111 The :attribute must be between :min and :max kilobytes.',
        'string' => 'fr111 The :attribute must be between :min and :max characters.',
        'array' => 'fr111 The :attribute must have between :min and :max items.',
    ],
    'boolean' => 'fr111 The :attribute field must be true or false.',
    'confirmed' => 'La confirmation de mot de passe ne correspond pas.',
    'date' => 'fr111 The :attribute is not a valid date.',
    'date_equals' => 'fr111 The :attribute must be a date equal to :date.',
    'date_format' => 'fr111 The :attribute does not match the format :format.',
    'different' => 'fr111 The :attribute and :other must be different.',
    'digits' => 'fr111 The :attribute must be :digits digits.',
    'digits_between' => 'fr111 The :attribute must be between :min and :max digits.',
    'dimensions' => 'fr111 The :attribute has invalid image dimensions.',
    'distinct' => 'fr111 The :attribute field has a duplicate value.',
    'email' => 'fr111 The :attribute must be a valid email address.',
    'ends_with' => 'fr111 The :attribute must end with one of the following: :values',
    'exists' => 'fr111 The selected :attribute is invalid.',
    'file' => 'fr111 The :attribute must be a file.',
    'filled' => 'fr111 The :attribute field must have a value.',
    'gt' => [
        'numeric' => 'fr111 The :attribute must be greater than :value.',
        'file' => 'fr111 The :attribute must be greater than :value kilobytes.',
        'string' => 'fr111 The :attribute must be greater than :value characters.',
        'array' => 'fr111 The :attribute must have more than :value items.',
    ],
    'gte' => [
        'numeric' => 'fr111 The :attribute must be greater than or equal :value.',
        'file' => 'fr111 The :attribute must be greater than or equal :value kilobytes.',
        'string' => 'fr111 The :attribute must be greater than or equal :value characters.',
        'array' => 'fr111 The :attribute must have :value items or more.',
    ],
    'image' => 'fr111 The :attribute must be an image.',
    'in' => 'fr111 The selected :attribute is invalid.',
    'in_array' => 'fr111 The :attribute field does not exist in :other.',
    'integer' => 'fr111 The :attribute must be an integer.',
    'ip' => 'fr111 The :attribute must be a valid IP address.',
    'ipv4' => 'fr111 The :attribute must be a valid IPv4 address.',
    'ipv6' => 'fr111 The :attribute must be a valid IPv6 address.',
    'json' => 'fr111 The :attribute must be a valid JSON string.',
    'lt' => [
        'numeric' => 'fr111 The :attribute must be less than :value.',
        'file' => 'fr111 The :attribute must be less than :value kilobytes.',
        'string' => 'fr111 The :attribute must be less than :value characters.',
        'array' => 'fr111 The :attribute must have less than :value items.',
    ],
    'lte' => [
        'numeric' => 'fr111 The :attribute must be less than or equal :value.',
        'file' => 'fr111 The :attribute must be less than or equal :value kilobytes.',
        'string' => 'fr111 The :attribute must be less than or equal :value characters.',
        'array' => 'fr111 The :attribute must not have more than :value items.',
    ],
    'max' => [
        'numeric' => ':attribute ne peut pas etre superieur :max.',
        'file' => ':attribute ne peut pas etre superieur :max kilooctets.',
        'string' => ':attribute ne peut pas etre superieur :max caracteres.',
        'array' => ':attribute ne peut pas etre superieur :max elements.',
    ],
    'mimes' => 'fr111 The :attribute must be a file of type: :values.',
    'mimetypes' => 'fr111 The :attribute must be a file of type: :values.',
    'min' => [
        'numeric' => ':attribute doit etre au moins :min.',
        'file' => ':attribute doit etre au moins :min kilooctets.',
        'string' => ':attribute doit etre au moins :min caracteres.',
        'array' => ':attribute doit etre au moins :min elements.',
    ],
    'not_in' => 'fr111 The selected :attribute is invalid.',
    'not_regex' => 'fr111 The :attribute format is invalid.',
    'numeric' => 'fr111 The :attribute must be a number.',
    'present' => 'fr111 The :attribute field must be present.',
    'regex' => 'fr111 The :attribute format is invalid.',
    'required' => 'Ce champ est obligatoire.',
    'required_if' => 'fr111 The :attribute field is required when :other is :value.',
    'required_unless' => 'fr111 The :attribute field is required unless :other is in :values.',
    'required_with' => 'fr111 The :attribute field is required when :values is present.',
    'required_with_all' => 'fr111 The :attribute field is required when :values are present.',
    'required_without' => 'fr111 The :attribute field is required when :values is not present.',
    'required_without_all' => 'fr111 The :attribute field is required when none of :values are present.',
    'same' => 'fr111 The :attribute and :other must match.',
    'size' => [
        'numeric' => 'fr111 The :attribute must be :size.',
        'file' => 'fr111 The :attribute must be :size kilobytes.',
        'string' => 'fr111 The :attribute must be :size characters.',
        'array' => 'fr111 The :attribute must contain :size items.',
    ],
    'starts_with' => 'fr111 The :attribute must start with one of the following: :values',
    'string' => 'fr111 The :attribute must be a string.',
    'timezone' => 'fr111 The :attribute must be a valid zone.',
    'unique' => 'Ce champ a deja ete pris.',
    'uploaded' => 'fr111 The :attribute failed to upload.',
    'url' => 'fr111 The :attribute format is invalid.',
    'uuid' => 'fr111 The :attribute must be a valid UUID.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'fr111 custom-message',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap our attribute placeholder
    | with something more reader friendly such as "E-Mail Address" instead
    | of "email". This simply helps us make our message more expressive.
    |
    */

    'attributes' => [],

];
