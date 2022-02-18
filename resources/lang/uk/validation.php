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

        'accepted'        => 'Ви повинні прийняти :attribute.',
        'active_url'      => 'Поле :attribute містить недійсний URL.',
        'after'           => 'В полі :attribute має бути дата більша :date.',
        'after_or_equal'  => 'В полі :attribute має бути дата більша або дорівнювати :date.',
        'alpha'           => 'Поле :attribute може містити лише літери.',
        'alpha_dash'      => 'Поле :attribute може містити лише літери, цифри, дефіс та нижнє підкреслення.',
        'alpha_num'       => 'Поле :attribute може містити лише літери та цифри.',
        'array'           => 'Поле :attribute має бути масивомм.',
        'before'          => 'В полі :attribute має бути дата раніше :date.',
        'before_or_equal' => 'В полі :attribute має бути дата раніше або дорівнювати :date.',
        'between'         => [
            'numeric' => 'Поле :attribute має бути між :min и :max.',
            'file'    => 'Розмір файла в полі :attribute має бути між :min и :max Кілобайт(а).',
            'string'  => 'Кількість символів в полі :attribute має бути між :min и :max.',
            'array'   => 'Кількість елементів в полі :attribute має бути між :min и :max.',
        ],
        'boolean'        => 'Поле :attribute повинно мати значення логічного типу.',
        'confirmed'      => 'Поле :attribute не збігається з підтвердженням.',
        'date'           => 'Поле :attribute не є датою.',
        'date_equals'    => 'Поле :attribute має бути датою рівною :date.',
        'date_format'    => 'Поле :attribute не відповідає формату :format.',
        'different'      => 'Поля :attribute и :other повинні відрізнятися.',
        'digits'         => 'Довжина цифрового поля :attribute має бути :digits.',
        'digits_between' => 'Довжина цифрового поля :attribute має бути між :min и :max.',
        'dimensions'     => 'Поле :attribute має неприпустимі розміри зображення.',
        'distinct'       => 'Поле :attribute містить значення, що повторюється.',
        'email'          => 'Поле :attribute має бути дійсною електронною адресою.',
        'ends_with'      => 'Поле :attribute має закінчуватися одним із наступних значень: :values',
        'exists'         => 'Вибране значення для :attribute некоректно.',
        'file'           => 'Поле :attribute має бути файлом.',
        'filled'         => "Поле :attribute обов'язкове для заповнення.",
        'gt'             => [
            'numeric' => 'Поле :attribute має бути більше :value.',
            'file'    => 'Розмір файла в полі :attribute має бути більше :value Кілобайт(а).',
            'string'  => 'Кількість символів в полі :attribute має бути більше :value.',
            'array'   => 'Кількість елементів в полі :attribute має бути більше :value.',
        ],
        'gte' => [
            'numeric' => 'Поле :attribute має бути :value або більше.',
            'file'    => 'Розмір файла в полі :attribute має бути :value Кілобайт(а) або більше.',
            'string'  => 'Кількість символів в полі :attribute має бути :value або більше.',
            'array'   => 'Кількість елементів в полі :attribute має бути :value або більше.',
        ],
        'image'    => 'Поле :attribute має бути зображенням.',
        'in'       => 'Вибране значення для :attribute помилково.',
        'in_array' => 'Поле :attribute не існує в :other.',
        'integer'  => 'Поле :attribute має бути цілим числом.',
        'ip'       => 'Поле :attribute має бути дійсною IP-адресою.',
        'ipv4'     => 'Поле :attribute має бути дійсною  IPv4-адресою.',
        'ipv6'     => 'Поле :attribute має бути дійсною  IPv6-адресою.',
        'json'     => 'Поле :attribute має бути JSON рядком.',
        'lt'       => [
            'numeric' => 'Поле :attribute має бути менше :value.',
            'file'    => 'Розмір файла в полі :attribute має бути менше :value Кілобайт(а).',
            'string'  => 'Кількість символів в полі :attribute має бути менше :value.',
            'array'   => 'Кількість елементів в полі :attribute має бути менше :value.',
        ],
        'lte' => [
            'numeric' => 'Поле :attribute має бути :value або менше.',
            'file'    => 'Розмір файла в полі :attribute має бути :value Кілобайт(а) або менше.',
            'string'  => 'Кількість символів в полі :attribute має бути :value або менше.',
            'array'   => 'Кількість елементів в полі :attribute має бути :value або менше.',
        ],
        'max' => [
            'numeric' => 'Поле :attribute не може бути більше :max.',
            'file'    => 'Розмір файла в полі :attribute не може бути більше :max Кілобайт(а).',
            'string'  => 'Кількість символів в полі :attribute не може первищувати :max.',
            'array'   => 'Кількість елементів в полі :attribute не може первищувати :max.',
        ],
        'mimes'     => 'Поле :attribute має бути файлом одного з наступних типів: :values.',
        'mimetypes' => 'Поле :attribute має бути файлом одного з наступних типів: :values.',
        'min'       => [
            'numeric' => 'Поле :attribute має бути не менше :min.',
            'file'    => 'Розмір файла в полі :attribute має бути не менше :min Кілобайт(а).',
            'string'  => 'Кількість символів в полі :attribute має бути не менше :min.',
            'array'   => 'Кількість елементів в полі :attribute має бути не менше :min.',
        ],
        'not_in'               => 'Обране значение для :attribute помилкове.',
        'not_regex'            => 'Обраний формат для :attribute помилковий.',
        'numeric'              => 'Поле :attribute має бути числом.',
        'password'             => 'Невірний пароль.',
        'present'              => 'Поле :attribute має бути присутнім.',
        'regex'                => 'Поле :attribute має помилковий формат.',
        'required'             => "Поле :attribute обов'язкове для заповнення.",
        'required_if'          => "Поле :attribute обов'язкове для заповнення, коли :other равно :value.",
        'required_unless'      => "Поле :attribute обов'язкове для заповнення, коли :other не равно :values.",
        'required_with'        => "Поле :attribute обов'язкове для заповнення, коли :values указано.",
        'required_with_all'    => "Поле :attribute обов'язкове для заповнення, коли :values указано.",
        'required_without'     => "Поле :attribute обов'язкове для заповнення, коли :values не указано.",
        'required_without_all' => "Поле :attribute обов'язкове для заповнення, коли ні одне з :values не вказано.",
        'same'                 => "Значення полів :attribute і :other мають співпадати.",
        'size'                 => [
            'numeric' => 'Поле :attribute має бути рівним :size.',
            'file'    => 'Розмір файла в полі :attribute має бути рівним :size Кілобайт(а).',
            'string'  => 'Кількість символів в полі :attribute має бути рівним :size.',
            'array'   => 'Кількість елементів в полі :attribute має бути рівним :size.',
        ],
        'starts_with' => 'Поле :attribute має починатися з одного з наступних значень: :values',
        'string'      => 'Поле :attribute має бути рядком.',
        'timezone'    => 'Поле :attribute має бути дійсним часовим поясом.',
        'unique'      => 'Таке значення поля :attribute вже існує.',
        'uploaded'    => 'Завантаженння поля :attribute не вдалось.',
        'url'         => 'Поле :attribute має помилковий формат URL.',
        'uuid'        => 'Поле :attribute має бути коректним UUID.',

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

        'recaptcha' => 'Це :attribute поле невірне.',

    ];
