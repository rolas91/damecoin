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

    'accepted'             => 'O campo :atributo deve ser aceito.',
    'active_url'           => 'O campo :atributo não é um URL válido.',
    'after'                => 'O campo :atributo deve ser uma data após :data.',
    'after_or_equal'       => 'O campo :atributo deve ser uma data posterior ou igual a :data.',
    'alpha'                => 'O campo :atributo pode conter apenas letras.',
    'alpha_dash'           => 'O campo :O atributo pode conter apenas letras, números, hífens e sublinhados.',
    'alpha_num'            => 'O campo :atributo pode conter apenas letras e números.',
    'array'                => 'O campo :atributo deve ser uma matriz.',
    'before'               => 'O campo :atributo deve ser uma data antes :data.',
    'before_or_equal'      => 'O campo :O atributo deve ser uma data anterior ou igual a :data.',
    'between'              => [
        'numeric' => 'O campo :atributo deve ser um valor entre :min e :max.',
        'file'    => 'O arquivo :atributo deve pesar entre :min e :max kilobytes.',
        'string'  => 'O campo :atributo deve conter entre :min e :max caracteres.',
        'array'   => 'O campo :atributo deve conter entre :min e :max elementos.',
    ],
    'boolean'              => 'O campo :attribute deve ser verdadeiro ou falso.',
    'confirmed'            => 'O campo confirmação de :atributo não corresponde.',
    'date'                 => 'O campo :atributo não corresponde a uma data válida.',
    'date_equals'          => 'O campo :atributo deve ser uma data igual a :date.',
    'date_format'          => 'O campo :atributo não corresponde ao formato da data :formato.',
    'different'            => 'Os campos :atributo e :outro deve ser diferente.',
    'digits'               => 'O campo :atributo deve ser um número de :digits dígitos.',
    'digits_between'       => 'O campo :atributo deve conter entre :min e :max dígitos.',
    'dimensions'           => 'O campo :atributo tem dimensões de imagem inválidas.',
    'distinct'             => 'O campo :atributo tem um valor duplicado.',
    'email'                => 'O campo :O atributo deve ser um endereço de email válido.',
    'exists'               => 'O campo :atributo selecionado não existe.',
    'file'                 => 'O campo :atributo deve ser um arquivo.',
    'current_password'     => 'O campo chave atual está incorreta',
    'filled'               => 'O campo :atributo deve ter um valor.',
    'gt'                   => [
        'numeric' => 'O campo :atributo deve ser maior que :valor.',
        'file'    => 'O arquivo :atributo deve pesar mais de :valor em kilobytes.',
        'string'  => 'O campo :atributo deve conter mais de :caracteres de valor.',
        'array'   => 'O campo :atributo deve conter mais de :itens de valor.',
    ],
    'gte'                  => [
        'numeric' => 'O campo :atributo deve ser maior ou igual a :valor.',
        'file'    => 'O arquivo :atributo deve pesar :valor ou mais kilobytes.',
        'string'  => 'O campo :atributo deve conter :valor ou mais caracteres.',
        'array'   => 'O campo :atributo deve conter :valor ou mais elementos.',
    ],
    'image'                => 'O campo :atributo deve ser uma imagem.',
    'in'                   => 'O campo :atributo é inválido.',
    'in_array'             => 'O campo :atributo não existe em :other.',
    'integer'              => 'O campo :atributo deve ser um número inteiro.',
    'ip'                   => 'O campo :atributo deve ser um endereço IP válido.',
    'ipv4'                 => 'O campo :atributo deve ser um endereço IPv4 válido.',
    'ipv6'                 => 'O campo :atributo deve ser um endereço IPv6 válido.',
    'json'                 => 'O campo :atributo deve ser uma sequência de texto JSON válido.',
    'lt'                   => [
        'numeric' => 'O campo :atributo deve ser menor que:value.',
        'file'    => 'O arquivo :atributo deve pesar menos de :value kilobytes.',
        'string'  => 'O campo :atributo deve conter menos de :value caracteres.',
        'array'   => 'O campo :atributo deve conter menos de :value elementos.',
    ],
    'lte'                  => [
        'numeric' => 'O campo :atributo deve ser menor ou igual a :value.',
        'file'    => 'O arquivo :atributo deve pesar:valor ou menos kilobytes.',
        'string'  => 'O campo :atributo deve conter :valor ou menos caracteres.',
        'array'   => 'O campo :atributo deve conter:value ou menos elementos.',
    ],
    'max'                  => [
        'numeric' => 'O campo :atributo não deve ser maior que :max.',
        'file'    => 'O arquivo :atributo não deve pesar mais do que :max kilobytes.',
        'string'  => 'O campo :atributo não deve conter mais de :max caracteres.',
        'array'   => 'O campo :atributo não deve conter mais de:max elementos.',
    ],
    'mimes'                => 'O campo :O atributo deve ser um arquivo do tipo: :values.',
    'mimetypes'            => 'O campo :O atributo deve ser um arquivo do tipo: :values.',
    'min'                  => [
        'numeric' => 'O campo :atributo deve ser pelo menos :min.',
        'file'    => 'O arquivo :atributo deve pesar pelo menos :min kilobytes.',
        'string'  => 'O campo :atributo deve conter pelo menos :min caracteres.',
        'array'   => 'O campo :atributo deve conter pelo menos :min elementos.',
    ],
    'not_in'               => 'O campo :atributo selecionado é inválido.',
    'not_regex'            => 'Formato de campo :atributo é inválido.',
	'numeric'              => 'O campo :atributo deve ser um número.',
    'present'              => 'O campo :atributo deve estar presente.',
    'regex'                => 'El formato del campo :attribute es inválido.',
    'required'             => 'O campo :attribute é obrigatório.',
    'required_if'          => 'O campo :atributo é obrigatório quando o campo :outro é :value.',
    'required_unless'      => 'O campo :é necessário, a menos que :outro está em :values.',
    'required_with'        => 'O campo :atributo é obrigatório quando :valores está presente.',
    'required_with_all'    => 'O campo :atributo é obrigatório quando :valores estão presentes.',
    'required_without'     => 'O campo :atributo é obrigatório quando:valores não está presente.',
    'required_without_all' => 'O campo :O atributo é obrigatório quando nenhum dos campos :valores estão presentes.',
    'same'                 => 'Os campos :atributo e:outro deve corresponder.',
    'size'                 => [
        'numeric' => 'O campo :atributo deve ser :size.',
        'file'    => 'O arquivo :atributo deve pesar :size kilobytes.',
        'string'  => 'O campo :atributo deve conter :size caracteres.',
        'array'   => 'O campo :atributo deve conter :size elementos.',
    ],
    'starts_with'          => 'O campo :O atributo deve começar com um dos seguintes valores: :values',
    'string'               => 'O campo :atributo deve ser uma cadeia de caracteres.',
    'timezone'             => 'O campo :atributo deve ser um fuso horário válido.',
    'unique'               => 'O valor do campo :atributo já está em uso.',
    'uploaded'             => 'O campo :Não foi possível carregar o atributo.',
    'url'                  => 'Formato de campo :atributo é inválido.',
    'uuid'                 => 'O campo:atributo deve ser um UUID válido.',

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
