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

    'accepted'             => '분야 :속성을 수락해야합니다.',
    'active_url'           => '분야 :속성이 유효한 URL이 아닙니다.',
    'after'                => '분야 :속성은 다음 날짜 여야합니다 :날짜.',
    'after_or_equal'       => '분야 :속성은 최신이어야합니다 또는 같음 :날짜.',
    'alpha'                => '분야 :속성은 문자 만 포함 할 수 있습니다.',
    'alpha_dash'           => '분야 :속성은 문자 만 포함 할 수 있습니다, 숫자, 하이픈과 밑줄.',
    'alpha_num'            => '분야 :속성은 문자와 숫자 만 포함 할 수 있습니다.',
    'array'                => '분야 :속성은 배열이어야합니다.',
    'before'               => '분야 :속성은 날짜 이전이어야합니다 :날짜.',
    'before_or_equal'      => '분야 :속성은 날짜보다 작거나 같아야합니다 :날짜.',
    'between'              => [
        'numeric' => '분야 :속성은 사이의 값이어야합니다 :최소 그리고 : 최대.',
        'file'    => '아카이브 :속성의 무게는 :최소 그리고: 최대 킬로바이트.',
        'string'  => '분야 :속성은 사이에 포함되어야합니다 :최소 그리고 : 최대 문자.',
        'array'   => '분야 :속성은 사이에 포함되어야합니다 :분 그리고 :최대 아이템.',
    ],
    'boolean'              => '분야 :속성은 true 또는 false 여야합니다.',
    'confirmed'            => '분야 확인 :속성이 일치하지 않습니다.',
    'date'                 => '분야 :속성이 유효한 날짜와 일치하지 않습니다.',
    'date_equals'          => '분야 :속성은 다음과 같은 날짜 여야합니다 :날짜.',
    'date_format'          => '분야 :속성이 날짜 형식과 일치하지 않습니다 :체재.',
    'different'            => '필드 :속성과 :다른 것은 달라야합니다.',
    'digits'               => '분야 :속성은 숫자 여야합니다 :자릿수 자릿수.',
    'digits_between'       => '분야 :속성은 사이에 포함되어야합니다 :분 그리고 :최대 자릿수.',
    'dimensions'           => '분야 :속성에 잘못된 이미지 크기가 있습니다.',
    'distinct'             => '분야 :속성에 중복 값이 ​​있습니다.',
    'email'                => '분야 :속성은 유효한 이메일 주소 여야합니다.',
    'exists'               => '분야 :선택된 속성이 존재하지 않습니다.',
    'file'                 => '분야 :속성은 파일이어야합니다.',
    'current_password'     => '분야 현재 키가 잘못되었습니다',
    'filled'               => '분야 :속성은 값을 가져야합니다.',
    'gt'                   => [
        'numeric' => '분야 :속성은보다 커야합니다 :가치.',
        'file'    => '아카이브 :속성은 무게보다 커야합니다 :가치 킬로바이트.',
        'string'  => '분야 :속성은 이상을 포함해야합니다 :가치 문자.',
        'array'   => '분야 :속성은 이상을 포함해야합니다 :가치 요소.',
    ],
    'gte'                  => [
        'numeric' => '분야 :속성은 크거나 같아야합니다 :가치.',
        'file'    => '아카이브 :속성은 무게가 있어야합니다 :가치 킬로바이트 이상.',
        'string'  => '분야 :속성은 다음을 포함해야합니다 :가치 또는 더 많은 문자.',
        'array'   => '분야 :속성은 다음을 포함해야합니다 :가치 또는 더 많은 요소.',
    ],
    'image'                => '분야 :속성은 이미지 여야합니다.',
    'in'                   => '분야 :속성이 유효하지 않습니다.',
    'in_array'             => '분야 :속성이 존재하지 않습니다 :다른.',
    'integer'              => '분야 :속성은 정수 여야합니다.',
    'ip'                   => '분야 :속성은 유효한 IP 주소 여야합니다.',
    'ipv4'                 => '분야 :속성은 유효한 IPv4 주소 여야합니다.',
    'ipv6'                 => '분야 :속성은 주소 여야합니다 IPv6 유효.',
    'json'                 => '분야 :속성은 텍스트 문자열이어야합니다 JSON 유효.',
    'lt'                   => [
        'numeric' => '분야 :속성은보다 작아야합니다:가치.',
        'file'    => '아카이브 :속성은 무게보다 작아야합니다 :가치 킬로바이트.',
        'string'  => '분야 :속성은 미만이어야합니다 :가치 속성은 미만이어야합니다.',
        'array'   => '분야 :속성은 미만이어야합니다 :가치 요소.',
    ],
    'lte'                  => [
        'numeric' => '분야 :속성은 이하 여야합니다 :가치.',
        'file'    => '아카이브 :속성은 무게가 있어야합니다 :가치 이하 킬로바이트.',
        'string'  => '분야 :속성은 다음을 포함해야합니다 :가치 이하의 문자.',
        'array'   => '분야 :속성은 다음을 포함해야합니다 :가치 이하의 요소.',
    ],
    'max'                  => [
        'numeric' => '분야 :속성은보다 크지 않아야합니다 :최대.',
        'file'    => '아카이브 :속성은 무게를 초과해서는 안됩니다 :최대 킬로바이트.',
        'string'  => '분야 :속성은 개를 초과해서는 안됩니다 :최대 문자.',
        'array'   => '분야 :속성은 개를 초과해서는 안됩니다 :최대 요소.',
    ],
    'mimes'                => '분야 :속성은 파일 형식이어야합니다:가치.',
    'mimetypes'            => '분야 :속성은 파일 형식이어야합니다:가치.',
    'min'                  => [
        'numeric' => '분야 :속성은 최소한 :분.',
        'file'    => '아카이브 :속성은 최소한 무게이어야합니다 :최소 킬로바이트.',
        'string'  => '분야 :속성은 최소한 포함해야합니다 :최소 문자.',
        'array'   => '분야 :속성은 최소한 포함해야합니다 :최소 항목.',
    ],
    'not_in'               => '분야 :선택한 속성이 잘못되었습니다.',
    'not_regex'            => '필드 형식 :속성이 유효하지 않습니다.',
	'numeric'              => '분야 :속성은 숫자 여야합니다.',
    'present'              => '분야 :속성이 있어야합니다.',
    'regex'                => '필드 형식 :속성이 유효하지 않습니다.',
    'required'             => '분야 :attribute 필수입니다.',
    'required_if'          => '분야 :필드는 속성이 필수입니다 :다른 :가치.',
    'required_unless'      => '분야 :속성이 필요하지 않으면 :다른 사람은 :가치.',
    'required_with'        => '분야 :다음과 같은 경우 속성이 필수입니다 :가치 존재한다.',
    'required_with_all'    => '분야 :다음과 같은 경우 속성이 필수입니다 :가치 존재한다.',
    'required_without'     => '분야 :다음과 같은 경우 속성이 필수입니다 :가치 존재하지 않음.',
    'required_without_all' => '분야 :필드가 없을 때 속성은 필수입니다 :가치 존재한다.',
    'same'                 => '필드 :속성 그리고 :다른 일치해야합니다.',
    'size'                 => [
        'numeric' => '분야 :속성은 :사이즈.',
        'file'    => '아카이브 :속성은 무게가 있어야합니다 :사이즈 킬로바이트.',
        'string'  => '분야 :속성은 다음을 포함해야합니다 :사이즈 문자.',
        'array'   => '분야 :속성은 다음을 포함해야합니다 :사이즈 요소.',
    ],
    'starts_with'          => '분야 :속성은 다음 값 중 하나로 시작해야합니다.: :가치',
    'string'               => '분야 :속성은 문자열이어야합니다.',
    'timezone'             => '분야 :속성은 유효한 시간대 여야합니다.',
    'unique'               => '필드의 가치 :속성이 이미 사용 중입니다.',
    'uploaded'             => '분야 :속성을 업로드 할 수 없습니다.',
    'url'                  => '필드 형식 :속성이 유효하지 않습니다.',
    'uuid'                 => '분야 :속성은 유효한 UUID 여야합니다.',

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
