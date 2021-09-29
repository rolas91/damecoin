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

    'accepted'             => 'Il campo :l\'attributo deve essere accettato.',
    'active_url'           => 'Il campo :l\'attributo non è un URL valido.',
    'after'                => 'Il campo :l\'attributo deve essere una data dopo: data.',
    'after_or_equal'       => 'Il campo :l\'attributo deve essere una data successiva o uguale a: data.',
    'alpha'                => 'Il campo :l\'attributo può contenere solo lettere.',
    'alpha_dash'           => 'Il campo :L\'attributo può contenere solo lettere, numeri, trattini e caratteri di sottolineatura.',
    'alpha_num'            => 'Il campo :l\'attributo può contenere solo lettere e numeri.',
    'array'                => 'Il campo :l\'attributo deve essere un array.',
    'before'               => 'Il campo :L\'attributo deve essere una data prima di: data.',
    'before_or_equal'      => 'Il campo :l\'attributo deve essere una data precedente o uguale a: data.',
    'between'              => [
        'numeric' => 'Il campo :l\'attributo deve essere un valore compreso tra: min e: max.',
        //'file'    => 'l\archivio \\'attributo deve pesare tra: min e: kilobyte max.',
        'string'  => 'Il campo :l\attributo deve contenere tra: min e: max caratteri.',
        'array'   => 'Il campo :l\'attributo deve contenere tra: min e: max elementi.',
    ],
    'boolean'              => 'Il campo :l\'attributo deve essere vero o falso.',
    'confirmed'            => 'Il campo conferma di: l\'attributo non corrisponde.',
    'date'                 => 'Il campo :l\'attributo non corrisponde a una data valida.',
    'date_equals'          => 'Il campo :l\'attributo deve essere una data uguale a: data.',
    'date_format'          => 'Il campo :l\'attributo non corrisponde al formato data: formato.',
    'different'            => 'I campi :attributo y: altro deve essere diverso.',
    'digits'               => 'Il campo :l\'attributo deve essere un numero di: cifre cifre.',
    'digits_between'       => 'Il campo :l\'attributo deve contenere tra: min e: max cifre.',
    'dimensions'           => 'Il campo :l\'attributo ha dimensioni dell\'immagine non valide.',
    'distinct'             => 'Il campo :l\'attributo ha un valore duplicato.',
    'email'                => 'Il campo :l\'attributo deve essere un indirizzo email valido.',
    'exists'               => 'Il campo :l\'attributo selezionato non esiste
.',
    'file'                 => 'Il campo :l\'attributo deve essere un file.',
    'current_password'     => 'Il campo la chiave corrente non è corretta',
    'filled'               => 'Il campo :l\'attributo deve avere un valore.',
    'gt'                   => [
        'numeric' => 'Il campo :l\'attributo deve essere maggiore di: valore.',
        'file'    => 'l\'archivio :l\'attributo deve pesare più di: valore kilobyte.',
        'string'  => 'Il campo :l\'attributo deve contenere più di: caratteri di valore.',
        'array'   => 'Il campo :l\'attributo deve contenere più di: elementi di valore.',
    ],
    'gte'                  => [
        'numeric' => 'Il campo:l\'attributo deve essere maggiore o uguale a: valore.',
        'file'    => 'l\'archivio :l\'attributo deve pesare: valore o più kilobyte.',
        'string'  => 'Il campo :l\'attributo deve contenere: valore o più caratteri.',
        'array'   => 'Il campo :l\'attributo deve contenere: valore o più elementi.',
    ],
    'image'                => 'Il campo :l\'attributo deve essere un\'immagine.',
    'in'                   => 'Il campo :l\'attributo non è valido.',
    'in_array'             => 'Il campo :l\'attributo non esiste in: altro.',
    'integer'              => 'Il campo :l\'attributo deve essere un numero intero.',
    'ip'                   => 'Il campo :l\'attributo deve essere un indirizzo IP valido.',
    'ipv4'                 => 'Il campo :l\'attributo deve essere un indirizzo IPv4 valido.',
    'ipv6'                 => 'Il campo :l\'attributo deve essere un indirizzo IPv6 valido.',
    'json'                 => 'Il campo :l\'attributo deve essere una stringa di testo JSON valida.',
    'lt'                   => [
        'numeric' => 'Il campo :l\'attributo deve essere inferiore a: valore.',
        'file'    => 'l\'archivio :l\'attributo deve pesare meno di: valore kilobyte.',
        'string'  => 'Il campo :l\'attributo deve contenere meno di: valore caratteri.',
        'array'   => 'Il campo :l\'attributo deve contenere elementi inferiori a: value.',
    ],
    'lte'                  => [
        'numeric' => 'Il campo:l\'attributo deve essere minore o uguale a: valore',
        'file'    => 'l\'archivio :l\'attributo deve pesare: valore o meno kilobyte.',
        'string'  => 'Il campo :l\'attributo deve contenere: valore o meno caratteri.',
        'array'   => 'Il campo :l\'attributo deve contenere: valore o meno elementi',
    ],
    'max'                  => [
        'numeric' => 'Il campo :l\'attributo non deve essere maggiore di: max.',
        'file'    => 'l\'archivio :l\'attributo non deve pesare più di: kilobyte max.',
        'string'  => 'Il campo :l\'attributo non deve contenere più di: max caratteri.',
        'array'   => 'Il campo :l\'attributo non deve contenere più di: max elementi.',
    ],
    'mimes'                => 'Il campo :l\'attributo deve essere un file di tipo :: valori.',
    'mimetypes'            => 'Il campo :l\'attributo deve essere un file di tipo :: valori.',
    'min'                  => [
        'numeric' => 'Il campo :l\'attributo deve essere almeno: min.',
        'file'    => 'l\'archivio :l\'attributo deve pesare almeno: kilobyte min.',
        'string'  => 'Il campo :l\'attributo deve contenere almeno: caratteri min.',
        'array'   => 'Il campo :l\'attributo deve contenere almeno: elementi min.',
    ],
    'not_in'               => 'Il campo :l\'attributo selezionato non è valido.',
    'not_regex'            => 'Il formato :campo: l\'attributo non è valido.',
	'numeric'              => 'Il campo :l\'attributo deve essere un numero.',
    'present'              => 'Il campo :l\'attributo deve essere presente',
    'regex'                => 'Il formato campo: l\'attributo non è valido.',
    'required'             => 'Il campo :attribute è obbligatorio.',
    'required_if'          => 'Il campo :l\'attributo è obbligatorio quando il campo: altro è: valore.',
    'required_unless'      => 'Il campo :l\'attributo è obbligatorio a meno che: other sia presente in: valori.',
    'required_with'        => 'Il campo :l\'attributo è obbligatorio quando: valori sono presenti.',
    'required_with_all'    => 'Il campo :l\'attributo è obbligatorio quando: sono presenti valori.',
    'required_without'     => 'Il campo :l\'attributo è obbligatorio quando: valori non sono presenti.',
    'required_without_all' => 'Il campo :l\'attributo è obbligatorio quando nessuno dei campi: valori presenti.',
    'same'                 => 'I campi :attributo y: altro deve corrispondere.',
    'size'                 => [
        'numeric' => 'Il campo :l\'attributo deve essere: dimensione.',
        'file'    => 'l\'archivio :l\'attributo deve pesare: dimensione kilobyte.',
        'string'  => 'Il campo :l\'attributo deve contenere: caratteri di dimensione.',
        'array'   => 'Il campo :l\'attributo deve contenere: elementi size.',
    ],
    'starts_with'          => 'Il campo :l\'attributo deve iniziare con uno dei seguenti valori :: valori',
    'string'               => 'Il campo :l\'attributo deve essere una stringa di caratteri.',
    'timezone'             => 'Il campo:l\'attributo deve essere un fuso orario valido.',
    'unique'               => 'il valore campo: l\'attributo è già in uso.',
    'uploaded'             => 'Il campo :l\'attributo non può essere caricato.',
    'url'                  => 'Il formato campo: l\'attributo non è valido.',
    'uuid'                 => 'Il campo :l\'attributo deve essere un UUID valido.',

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
