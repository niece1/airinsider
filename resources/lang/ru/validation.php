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

    'accepted' => 'The :attribute must be accepted.',
    'active_url' => 'The :attribute is not a valid URL.',
    'after' => 'The :attribute must be a date after :date.',
    'after_or_equal' => 'The :attribute must be a date after or equal to :date.',
    'alpha' => 'The :attribute may only contain letters.',
    'alpha_dash' => 'The :attribute may only contain letters, numbers, dashes and underscores.',
    'alpha_num' => 'The :attribute may only contain letters and numbers.',
    'array' => 'The :attribute must be an array.',
    'before' => 'The :attribute must be a date before :date.',
    'before_or_equal' => 'The :attribute must be a date before or equal to :date.',
    'between' => [
        'numeric' => 'Значение должно быть от :min до :max.',
        'file' => 'Файл должен быть от :min до :max килобайт.',
        'string' => 'Поле должно быть от :min до :max символа(ов).',
        'array' => 'The :attribute must have between :min and :max items.',
    ],
    'boolean' => 'The :attribute field must be true or false.',
    'confirmed' => 'The :attribute confirmation does not match.',
    'date' => 'The :attribute is not a valid date.',
    'date_equals' => 'The :attribute must be a date equal to :date.',
    'date_format' => 'The :attribute does not match the format :format.',
    'different' => 'The :attribute and :other must be different.',
    'digits' => 'The :attribute must be :digits digits.',
    'digits_between' => 'The :attribute must be between :min and :max digits.',
    'dimensions' => 'The :attribute has invalid image dimensions.',
    'distinct' => 'The :attribute field has a duplicate value.',
    'email' => 'Поле должно быть корректным.',
    'ends_with' => 'The :attribute must end with one of the following: :values',
    'exists' => 'The selected :attribute is invalid.',
    'file' => 'Поле должно быть файлом.',
    'filled' => 'Поле должно иметь значение.',
    'gt' => [
        'numeric' => 'Значение должно быть больше :value.',
        'file' => 'Файл должен быть больше :value килобайт.',
        'string' => 'Поле должно быть больше :value символа(ов).',
        'array' => 'The :attribute must have more than :value items.',
    ],
    'gte' => [
        'numeric' => 'Значение должно быть больше или равным :value.',
        'file' => 'Файл должен быть больше или равным :value килобайт.',
        'string' => 'Поле должно быть больше или равным :value символу(ам).',
        'array' => 'The :attribute must have :value items or more.',
    ],
    'image' => 'Файл должен быть изображением.',
    'in' => 'The selected :attribute is invalid.',
    'in_array' => 'The :attribute field does not exist in :other.',
    'integer' => 'Данное поле должно быть числом.',
    'ip' => 'The :attribute must be a valid IP address.',
    'ipv4' => 'The :attribute must be a valid IPv4 address.',
    'ipv6' => 'The :attribute must be a valid IPv6 address.',
    'json' => 'The :attribute must be a valid JSON string.',
    'lt' => [
        'numeric' => 'Значение должно быть меньше :value.',
        'file' => 'Файл должен быть меньше :value килобайт.',
        'string' => 'Поле должно быть меньше :value символа(ов).',
        'array' => 'The :attribute must have less than :value items.',
    ],
    'lte' => [
        'numeric' => 'Значение должно быть меньше или равным :value.',
        'file' => 'Файл должен быть меньше или равным :value килобайт.',
        'string' => 'Поле должно быть меньше или равным :value символу(ам).',
        'array' => 'The :attribute must not have more than :value items.',
    ],
    'max' => [
        'numeric' => 'Значение не должно быть больше :max.',
        'file' => 'Файл не должен быть больше :max килобайт.',
        'string' => 'Поле не должно быть больше :max символа(ов).',
        'array' => 'The :attribute may not have more than :max items.',
    ],
    'mimes' => 'Файл должен иметь расширение :values.',
    'mimetypes' => 'Файл должен иметь расширение :values.',
    'min' => [
        'numeric' => 'Значение должно быть мин :min.',
        'file' => 'Файл должен быть мин :min килобайт.',
        'string' => 'Поле должно быть мин :min символа(ов).',
        'array' => 'The :attribute must have at least :min items.',
    ],
    'not_in' => 'The selected :attribute is invalid.',
    'not_regex' => 'Данный формат недействителен.',
    'numeric' => 'Значение должно быть числом.',
    'present' => 'The :attribute field must be present.',
    'regex' => 'Данный формат недействителен.',
    'required' => 'Данное поле обязательно.',
    'required_if' => 'The :attribute field is required when :other is :value.',
    'required_unless' => 'The :attribute field is required unless :other is in :values.',
    'required_with' => 'The :attribute field is required when :values is present.',
    'required_with_all' => 'The :attribute field is required when :values are present.',
    'required_without' => 'The :attribute field is required when :values is not present.',
    'required_without_all' => 'The :attribute field is required when none of :values are present.',
    'same' => 'The :attribute and :other must match.',
    'size' => [
        'numeric' => 'Файл должен быть :size.',
        'file' => 'Файл должен быть :size килобайт.',
        'string' => 'Поле должно быть :size символов.',
        'array' => 'The :attribute must contain :size items.',
    ],
    'starts_with' => 'The :attribute must start with one of the following: :values',
    'string' => 'Поле должно быть строкой.',
    'timezone' => 'The :attribute must be a valid zone.',
    'unique' => 'Это значение уже занято.',
    'uploaded' => 'Поле :attribute не загрузилось.',
    'url' => 'The :attribute format is invalid.',
    'uuid' => 'The :attribute must be a valid UUID.',

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
            'rule-name' => 'custom-message',
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
