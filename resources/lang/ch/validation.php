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

    'accepted'             => '领域 :attribute 必须接受。',
    'active_url'           => '领域 :attribute 这不是有效的网址。',
    'after'                => '领域 :attribute 必须是之后的日期 :date.',
    'after_or_equal'       => '领域 :attribute 日期必须晚于或等于 :date.',
    'alpha'                => '领域 :attribute 只能包含字母.',
    'alpha_dash'           => '领域 :attribute 它只能包含字母，数字，连字符和下划线。',
    'alpha_num'            => '领域 :attribute 它只能包含字母和数字。',
    'array'                => '领域 :attribute 它必须是一个数组。',
    'before'               => '领域 :attribute 必须是一个日期之前 :date.',
    'before_or_equal'      => '领域 :attribute 必须是早于或等于的日期 :date.',
    'between'              => [
        'numeric' => '领域 :attribute 必须是介于 :min 和 :max.',
        'file'    => '档案馆 :attribute 必须权衡 :min 和 :max kilobytes.',
        'string'  => '领域 :attribute 必须包含 :min 和 :max 人物.',
        'array'   => '领域 :attribute 必须包含 :min 和 :max 元素.',
    ],
    'boolean'              => '领域 :attribute 它必须是对还是错。',
    'confirmed'            => '领域 确认 :attribute 不匹配。',
    'date'                 => '领域 :attribute 它与有效日期不符。',
    'date_equals'          => '领域 :attribute 日期必须等于 :date.',
    'date_format'          => '领域 :attribute 与日期格式不匹配 :format.',
    'different'            => '领域 :attribute 和 :other 它们必须不同。',
    'digits'               => '领域 :attribute 必须是多个 :digits 数字',
    'digits_between'       => '领域 :attribute 必须包含 :min 和 :max 数字',
    'dimensions'           => '领域 :attribute 图片尺寸无效。',
    'distinct'             => '领域 :attribute 它具有重复值。',
    'email'                => '领域 :attribute 它必须是一个有效的电子邮件地址。',
    'exists'               => '领域 :attribute 所选不存在。',
    'file'                 => '领域 :attribute 它必须是一个文件。',
    'current_password'     => '领域 当前密钥不正确',
    'filled'               => '领域 :attribute 它必须有一个值。',
    'gt'                   => [
        'numeric' => '领域 :attribute 必须大于 :value.',
        'file'    => '档案馆 :attribute 必须比 :value kilobytes.',
        'string'  => '领域 :attribute 必须包含多个 :value 字符。',
        'array'   => '领域 :attribute 必须包含多个 :value 元素。',
    ],
    'gte'                  => [
        'numeric' => '领域 :attribute 必须大于或等于 :value.',
        'file'    => '档案馆 :attribute 必须称重 :value 或更多 kilobytes.',
        'string'  => '领域 :attribute 必须包含 :value 或更多字符',
        'array'   => '领域 :attribute 必须包含 :value 或更多元素',
    ],
    'image'                => '领域 :attribute 它必须是图像。',
    'in'                   => '领域 :attribute 无效。',
    'in_array'             => '领域 :attribute 在中不存在 :other.',
    'integer'              => '领域 :attribute 必须是整数。',
    'ip'                   => '领域 :attribute 它必须是有效的IP地址。',
    'ipv4'                 => '领域 :attribute 它必须是有效的IPv4地址。',
    'ipv6'                 => '领域 :attribute 它必须是有效的IPv6地址。',
    'json'                 => '领域 :attribute 它必须是有效的JSON文本字符串。',
    'lt'                   => [
        'numeric' => '领域 :attribute 必须小于 :value.',
        'file'    => '档案馆 :attribute 重量必须小于 :value kilobytes.',
        'string'  => '领域 :attribute 必须包含少于 :value 人物.',
        'array'   => '领域 :attribute 必须包含少于 :value 元素。',
    ],
    'lte'                  => [
        'numeric' => '领域 :attribute 必须小于或等于 :value.',
        'file'    => '档案馆 :attribute 必须称重 :value 或更少 kilobytes.',
        'string'  => '领域 :attribute 必须包含 :value 或更少的字符',
        'array'   => '领域 :attribute 必须包含 :value 或更少的元素。',
    ],
    'max'                  => [
        'numeric' => '领域 :attribute 不应大于 :max.',
        'file'    => '档案馆 :attribute 不应超过 :max kilobytes.',
        'string'  => '领域 :attribute 不得包含超过 :max 字符。',
        'array'   => '领域 :attribute 不得包含超过 :max 元素。',
    ],
    'mimes'                => '领域 :attribute 它必须是类型的文件: :values.',
    'mimetypes'            => '领域 :attribute 它必须是类型的文件: :values.',
    'min'                  => [
        'numeric' => '领域 :attribute 必须至少 :min.',
        'file'    => '档案馆 :attribute 必须至少重 :min kilobytes.',
        'string'  => '领域 :attribute 必须至少包含 :min 人物.',
        'array'   => '领域 :attribute 必须至少包含 :min 元素。',
    ],
    'not_in'               => '领域 :attribute 所选的无效。',
    'not_regex'            => '栏位格式 :attribute 无效。',
	'numeric'              => '领域 :attribute 必须是数字。',
    'present'              => '领域 :attribute 它必须存在。',
    'regex'                => '栏位格式 :attribute 无效。',
    'required'             => '领域 :attribute 这是强制性的。',
    'required_if'          => '领域 :attribute 这是必填字段 :other 是 :value.',
    'required_unless'      => '领域 :attribute 是必需的，除非 :other 在 :values.',
    'required_with'        => '领域 :attribute 何时必须 :values 它存在。',
    'required_with_all'    => '领域 :attribute 何时必须 :values 他们在场。',
    'required_without'     => '领域 :attribute 何时必须 :values 它不存在。',
    'required_without_all' => '领域 :attribute 没有任何字段时是必填项 :values 他们在场。',
    'same'                 => '领域 :attribute 和 :other 他们必须匹配。',
    'size'                 => [
        'numeric' => '领域 :attribute 必须是 :size.',
        'file'    => '档案馆 :attribute 必须称重 :size kilobytes.',
        'string'  => '领域 :attribute 必须包含 :size 字符。',
        'array'   => '领域 :attribute 必须包含 :size 元素。',
    ],
    'starts_with'          => '领域 :attribute 您必须以以下值之一开头: :values',
    'string'               => '领域 :attribute 它必须是一个字符串。',
    'timezone'             => '领域 :attribute 必须是一个有效的时区。',
    'unique'               => '领域的价值 :attribute 它已经在使用中。',
    'uploaded'             => '领域 :attribute 无法上传',
    'url'                  => '栏位格式 :attribute 无效。',
    'uuid'                 => '领域 :attribute 它必须是有效的UUID。',

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
