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

    'accepted'             => 'Pole :attribute Musí být přijato.',
    'active_url'           => 'Pole :attribute Nejedná se o platnou adresu URL.',
    'after'                => 'Pole :attribute musí být datum po :date.',
    'after_or_equal'       => 'Pole :attribute musí být datum pozdější nebo rovné :date.',
    'alpha'                => 'Pole :attribute Může obsahovat pouze písmena.',
    'alpha_dash'           => 'Pole :attribute Může obsahovat pouze písmena, čísla, spojovníky a podtržítka.',
    'alpha_num'            => 'Pole :attribute Může obsahovat pouze písmena a čísla.',
    'array'                => 'Pole :attribute Musí to být pole.',
    'before'               => 'Pole :attribute musí to být datum dříve :date.',
    'before_or_equal'      => 'Pole :attribute musí být datum před nebo rovno :date.',
    'between'              => [
        'numeric' => 'Pole :attribute musí být hodnota mezi :min a :max.',
        'file'    => 'Archiv :attribute musí vážit mezi :min a :max kilobytes.',
        'string'  => 'Pole :attribute musí obsahovat mezi :min a :max postavy.',
        'array'   => 'Pole :attribute musí obsahovat mezi :min a :max prvky.',
    ],
    'boolean'              => 'Pole :attribute Musí to být pravda nebo nepravda.',
    'confirmed'            => 'Pole pro potvrzení :attribute neodpovídá.',
    'date'                 => 'Pole :attribute Odpovídá platnému datu.',
    'date_equals'          => 'Pole :attribute musí to být datum rovné :date.',
    'date_format'          => 'Pole :attribute neodpovídá formátu data :format.',
    'different'            => 'Pole :attribute a :other Musí se lišit.',
    'digits'               => 'Pole :attribute musí být číslo :digits číslice',
    'digits_between'       => 'Pole :attribute musí obsahovat mezi :min a :max číslice',
    'dimensions'           => 'Pole :attribute Má neplatné rozměry obrázku.',
    'distinct'             => 'Pole :attribute Má duplicitní hodnotu.',
    'email'                => 'Pole :attribute Musí to být platná e-mailová adresa.',
    'exists'               => 'Pole :attribute Vybrané neexistuje.',
    'file'                 => 'Pole :attribute Musí to být soubor.',
    'current_password'     => 'Aktuální pole klíče je nesprávné',
    'filled'               => 'Pole :attribute Musí mít hodnotu.',
    'gt'                   => [
        'numeric' => 'Pole :attribute musí být větší než :value.',
        'file'    => 'Archiv :attribute musí vážit více než :value kilobytes.',
        'string'  => 'Pole :attribute musí obsahovat více než :value postavy.',
        'array'   => 'Pole :attribute musí obsahovat více než :value prvky.',
    ],
    'gte'                  => [
        'numeric' => 'Pole :attribute musí být větší nebo rovno :value.',
        'file'    => 'Archiv :attribute musí vážit :value nebo více kilobajtů.',
        'string'  => 'Pole :attribute musí obsahovat :value nebo více znaků',
        'array'   => 'Pole :attribute musí obsahovat :value nebo více prvků',
    ],
    'image'                => 'Pole :attribute Musí to být obrázek.',
    'in'                   => 'Pole :attribute Je neplatný.',
    'in_array'             => 'Pole :attribute neexistuje v :other.',
    'integer'              => 'Pole :attribute Musí to být celé číslo',
    'ip'                   => 'Pole :attribute Musí to být platná adresa IP.',
    'ipv4'                 => 'Pole :attribute Musí to být platná adresa IPv4.',
    'ipv6'                 => 'Pole :attribute Musí to být platná adresa IPv6.',
    'json'                 => 'Pole :attribute Musí to být platný textový řetězec JSON.',
    'lt'                   => [
        'numeric' => 'Pole :attribute musí být menší než :value.',
        'file'    => 'Archiv :attribute musí vážit méně než :value kilobajtů',
        'string'  => 'Pole :attribute musí obsahovat méně než :value postavy.',
        'array'   => 'Pole :attribute musí obsahovat méně než :value prvky.',
    ],
    'lte'                  => [
        'numeric' => 'Pole :attribute musí být menší nebo rovno :value.',
        'file'    => 'Archiv :attribute musí vážit:value nebo méně kilobajtů.',
        'string'  => 'Pole :attribute musí obsahovat :value nebo méně znaků',
        'array'   => 'Pole :attribute musí obsahovat :value nebo méně prvků.',
    ],
    'max'                  => [
        'numeric' => 'Pole :attribute neměla by být větší než :max.',
        'file'    => 'Archiv :attribute neměl by vážit více než :max kilobajtů',
        'string'  => 'Pole :attribute nesmí obsahovat více než :max postavy.',
        'array'   => 'Pole :attribute nesmí obsahovat více než :max prvky.',
    ],
    'mimes'                => 'Pole :attribute musí to být soubor typu: :values.',
    'mimetypes'            => 'Pole :attribute musí to být soubor typu: :values.',
    'min'                  => [
        'numeric' => 'Pole :attribute musí být alespoň :min.',
        'file'    => 'Archiv :attribute musí vážit alespoň :min kilobajtů',
        'string'  => 'Pole :attribute musí obsahovat alespoň :min postavy.',
        'array'   => 'Pole :attribute musí obsahovat alespoň :min prvky.',
    ],
    'not_in'               => 'Pole :attribute vybrané je neplatné.',
    'not_regex'            => 'Formát pole :attribute Je neplatný.',
	'numeric'              => 'Pole :attribute Musí to být číslo.',
    'present'              => 'Pole :attribute Musí být přítomen.',
    'regex'                => 'Formát pole :attribute Je neplatný.',
    'required'             => 'Pole :attribute Je to povinné.',
    'required_if'          => 'Pole :attribute je povinné, když pole :other je :value.',
    'required_unless'      => 'Pole :attribute je vyžadováno, pokud :other je v:values.',
    'required_with'        => 'Pole :attribute Je povinné, když :values Je přítomen.',
    'required_with_all'    => 'Pole :attribute Je povinné, když :values Jsou přítomni.',
    'required_without'     => 'Pole :attribute Je povinné, když :values Není přítomen.',
    'required_without_all' => 'Pole :attribute Je povinné, pokud žádné z polí není :values Jsou přítomni.',
    'same'                 => 'Pole :attribute a :other Musí se shodovat.',
    'size'                 => [
        'numeric' => 'Pole :attribute musí být :size.',
        'file'    => 'Archiv :attribute musí vážit :size kilobajtů',
        'string'  => 'Pole :attribute musí obsahovat :size postavy.',
        'array'   => 'Pole :attribute musí obsahovat :size prvky.',
    ],
    'starts_with'          => 'Pole :attribute musíte začít s jednou z následujících hodnot: :values',
    'string'               => 'Pole :attribute Musí to být řetězec znaků.',
    'timezone'             => 'Pole :attribute Musí to být platné časové pásmo.',
    'unique'               => 'Hodnota pole :attribute Již se používá.',
    'uploaded'             => 'Pole :attribute Nelze nahrát',
    'url'                  => 'Formát pole :attribute Je neplatný.',
    'uuid'                 => 'Pole :attribute Musí to být platné UUID.',

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
