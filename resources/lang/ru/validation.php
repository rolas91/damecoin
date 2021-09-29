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

    'accepted'             => 'Поле :attribute Это должно быть принято.',
    'active_url'           => 'Поле :attribute Это не правильный URL.',
    'after'                => 'Поле :attribute должна быть дата после :date.',
    'after_or_equal'       => 'Поле :attribute должна быть дата позже или равна :date.',
    'alpha'                => 'Поле :attribute Он может содержать только буквы.',
    'alpha_dash'           => 'Поле :attribute Он может содержать только буквы, цифры, дефисы и подчеркивания.',
    'alpha_num'            => 'Поле :attribute Он может содержать только буквы и цифры.',
    'array'                => 'Поле :attribute должен быть array.',
    'before'               => 'Поле :attribute должно быть дата до :date.',
    'before_or_equal'      => 'Поле :attribute должна быть дата до или равна :date.',
    'between'              => [
        'numeric' => 'Поле :attribute должно быть значение между :min и :max.',
        'file'    => 'Архив :attribute должен весить между :min и :max kilobytes.',
        'string'  => 'Поле :attribute должен содержать между :min и :max символы.',
        'array'   => 'Поле :attribute debe contener entre :min и :max элементы.',
    ],
    'boolean'              => 'Поле :attribute Это должно быть правдой или ложью.',
    'confirmed'            => 'Поле подтверждение :attribute не совпадает',
    'date'                 => 'Поле :attribute Это не соответствует действительной дате.',
    'date_equals'          => 'Поле :attribute это должна быть дата, равная :date.',
    'date_format'          => 'Поле :attribute не соответствует формату даты :format.',
    'different'            => 'Поля :attribute и :other Они должны быть разными.',
    'digits'               => 'Поле :attribute должно быть количество :digits цифры.',
    'digits_between'       => 'Поле :attribute должен содержать между :min и :max цифры.',
    'dimensions'           => 'Поле :attribute У него недопустимые размеры изображения.',
    'distinct'             => 'Поле :attribute Это имеет дублирующее значение.',
    'email'                => 'Поле :attribute Это должен быть действующий адрес электронной почты.',
    'exists'               => 'Поле :attribute Выбранный не существует.',
    'file'                 => 'Поле :attribute Это должен быть файл.',
    'current_password'     => 'Поле текущий ключ неверен',
    'filled'               => 'Поле :attribute Это должно иметь значение.',
    'gt'                   => [
        'numeric' => 'Поле :attribute должно быть больше чем :value.',
        'file'    => 'Архив :attribute должен весить больше, чем :value kilobytes.',
        'string'  => 'Поле :attribute должен содержать более :value символы.',
        'array'   => 'Поле :attribute должен содержать более :value элементы.',
    ],
    'gte'                  => [
        'numeric' => 'Поле :attribute должно быть больше или равно :value.',
        'file'    => 'Архив :attribute должен весить :value или больше kilobytes.',
        'string'  => 'Поле :attribute должен содержать :value или больше персонажей.',
        'array'   => 'Поле :attribute должен содержать :value или больше элементов.',
    ],
    'image'                => 'Поле :attribute Это должно быть изображение.',
    'in'                   => 'Поле :attribute Это недействительно.',
    'in_array'             => 'Поле :attribute не существует в :other.',
    'integer'              => 'Поле :attribute Это должно быть целое число.',
    'ip'                   => 'Поле :attribute Это должен быть действительный IP-адрес.',
    'ipv4'                 => 'Поле :attribute Это должен быть действительный адрес IPv4.',
    'ipv6'                 => 'Поле :attribute Это должен быть действительный адрес IPv6.',
    'json'                 => 'Поле :attribute Это должна быть допустимая текстовая строка JSON.',
    'lt'                   => [
        'numeric' => 'Поле :attribute должно быть меньше чем :value.',
        'file'    => 'Архив :attribute должен весить меньше чем :value kilobytes.',
        'string'  => 'Поле :attribute должен содержать меньше чем :value символы.',
        'array'   => 'Поле :attribute должен содержать меньше чем :value элементы.',
    ],
    'lte'                  => [
        'numeric' => 'Поле :attribute должно быть меньше или равно :value.',
        'file'    => 'Архив :attribute должен весить :value или меньше kilobytes.',
        'string'  => 'Поле :attribute должен содержать :value или меньше символов.',
        'array'   => 'Поле :attribute должен содержать :value или меньше элементов.',
    ],
    'max'                  => [
        'numeric' => 'Поле :attribute не должно быть больше чем :max.',
        'file'    => 'Архив :attribute не должен весить больше, чем :max kilobytes.',
        'string'  => 'Поле :attribute не должен содержать более :max символы.',
        'array'   => 'Поле :attribute не должен содержать более :max элементы.',
    ],
    'mimes'                => 'Поле :attribute это должен быть файл типа: :values.',
    'mimetypes'            => 'Поле :attribute это должен быть файл типа: :values.',
    'min'                  => [
        'numeric' => 'Поле :attribute должно быть как минимум :min.',
        'file'    => 'Архив :attribute должен весить хотя бы :min kilobytes.',
        'string'  => 'Поле :attribute должен содержать как минимум :min символы.',
        'array'   => 'Поле :attribute должен содержать как минимум :min элементы.',
    ],
    'not_in'               => 'Поле :attribute выбрано неверно.',
    'not_regex'            => 'Формат поля :attribute Это недействительно.',
	'numeric'              => 'Поле :attribute Это должен быть номер.',
    'present'              => 'Поле :attribute Это должно присутствовать.',
    'regex'                => 'Формат поля:attribute Это недействительно.',
    'required'             => 'Поле :attribute Это обязательно.',
    'required_if'          => 'Поле :attribute это обязательно, когда поле :other это :value.',
    'required_unless'      => 'Поле :attribute требуется, если :other находится в :values.',
    'required_with'        => 'Поле :attribute Это обязательно, когда :values Это присутствует.',
    'required_with_all'    => 'Поле :attribute Это обязательно, когда :values Они присутствуют.',
    'required_without'     => 'Поле :attribute Это обязательно, когда :values Этого нет.',
    'required_without_all' => 'Поле :attribute Обязательно, когда ни одно из полей :values Они присутствуют.',
    'same'                 => 'Поля :attribute и :other должен соответствовать.',
    'size'                 => [
        'numeric' => 'Поле :attribute должен быть :size.',
        'file'    => 'Архив :attribute должен весить :size kilobytes.',
        'string'  => 'Поле :attribute должен содержать :size символы.',
        'array'   => 'Поле :attribute должен содержать :size элементы.',
    ],
    'starts_with'          => 'Поле :attribute Вы должны начать с одного из следующих значений: :values',
    'string'               => 'Поле :attribute Это должна быть строка символов.',
    'timezone'             => 'Поле :attribute Это должен быть действительный часовой пояс.',
    'unique'               => 'Значение поля :attribute Он уже используется.',
    'uploaded'             => 'Поле :attribute Не удалось загрузить',
    'url'                  => 'Формат поля :attribute Это недействительно.',
    'uuid'                 => 'Поле :attribute Это должен быть действительный UUID.',

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
    | The following language lines are used to swap attribute place-holders
    | with something more reader friendly such as E-Mail Address instead
    | of "email". This simply helps us make messages a little cleaner.
    |
    */

    'attributes' => [],

];
