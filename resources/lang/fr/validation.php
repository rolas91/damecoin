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

    'accepted'             => 'Le champ: attribut doit être accepté.',
    'active_url'           => 'La campagne :attribut n\'est pas une URL valide.',
    'after'                => 'La campagne :attribut doit être une date après: date.',
    'after_or_equal'       => 'La Campagne :attribut doit être une date ultérieure ou égale à: date.',
    'alpha'                => 'La Campagne :attribut ne peut contenir que des lettres.',
    'alpha_dash'           => 'La campagne :attribut ne peut contenir que des lettres, des chiffres, des traits d\'union et des traits de soulignement.',
    'alpha_num'            => 'La Campagne :attribut ne peut contenir que des lettres et des chiffres.',
    'array'                => 'La Campagne :attribut doit être un tableau.',
    'before'               => 'La campagne :attribut doit être une date antérieure à: date.',
    'before_or_equal'      => 'la Campagne :attribut doit être une date antérieure ou égale à: date.',
    'between'              => [
        'numeric' => 'La campagne :attribut doit être une valeur comprise entre: min et: max.',
        'file'    => 'L\'archive :l\'attribut doit peser entre: min et: max kilo-octets.',
        'string'  => 'La campagne :l\'attribut doit contenir entre: min et: max caractères.',
        'array'   => 'La campagne:l\'attribut doit contenir entre: min et: max éléments.',
    ],
    'boolean'              => 'La campagne :l\'attribut doit être vrai ou faux.',
    'confirmed'            => 'La campagne confirmation de: l\'attribut ne correspond pas.',
    'date'                 => 'La campagne :attribut ne correspond pas à une date valide.',
    'date_equals'          => 'La campagne :attribut doit être une date égale à: date.',
    'date_format'          => 'La campagne :attribut ne correspond pas au format de date: format.',
    'different'            => 'Champs :attribut y: autre doit être différent.',
    'digits'               => 'La campagne :attribut doit être un nombre de: digits digits.',
    'digits_between'       => 'La campagne :attribut doit contenir entre: min et: max digits.',
    'dimensions'           => 'La campagne :l\'attribut a des dimensions d\'image non valides.',
    'distinct'             => 'La campagne :attribut a une valeur en double.',
    'email'                => 'La campagne :attribut doit être une adresse email valide.',
    'exists'               => 'La campagne :L\'attribut sélectionné n\'existe pas.',
    'file'                 => 'La campagne :attribut doit être un fichier.',
    'current_password'     => 'La campagne la clé actuelle est incorrecte',
    'filled'               => 'La campagne :attribut doit avoir une valeur.',
    'gt'                   => [
        'numeric' => 'La campagne :l\'attribut doit être supérieur à: valeur.',
        'file'    => 'L\'archive :attribut doit peser plus de: valeur kilo-octets.',
        'string'  => 'La campagne :l\'attribut doit contenir plus de: caractères de valeur.',
        'array'   => 'La campagne :attribut doit contenir plus de: éléments de valeur.',
    ],
    'gte'                  => [
        'numeric' => 'La campagne :attribut doit être supérieur ou égal à: valeur.',
        'file'    => 'L\'archive :attribut doit peser: valeur ou plusieurs kilo-octets.',
        'string'  => 'La campagne :attribut doit contenir: valeur ou plus de caractères.',
        'array'   => 'La campagne :l\'attribut doit contenir: valeur ou plusieurs éléments.',
    ],
    'image'                => 'La campagne :attribut doit être une image.',
    'in'                   => 'La campagne :attribut est invalide',
    'in_array'             => 'La campagne:l\'attribut n\'existe pas dans: autre.',
    'integer'              => 'La campagne :attribut doit être un entier.',
    'ip'                   => 'La campagne :attribut doit être une adresse IP valide.',
    'ipv4'                 => 'La campagne :attribut doit être une adresse IPv4 valide.',
    'ipv6'                 => 'La campagne :attribut doit être une adresse IPv6 valide.',
    'json'                 => 'La Campagne :attribut doit être une chaîne de texte JSON valide.',
    'lt'                   => [
        'numeric' => 'La campagne :l\'attribut doit être inférieur à: valeur.',
        'file'    => 'L\'archive :attribut doit peser moins de: valeur kilo-octets.',
        'string'  => 'La campagne :l\'attribut doit contenir moins de: caractères de valeur.',
        'array'   => 'La campagne :attribut doit contenir moins de: éléments de valeur.',
    ],
    'lte'                  => [
        'numeric' => 'La campagne :attribut doit être inférieur ou égal à: valeur.',
        'file'    => 'L\'archive :attribut doit peser: valeur ou moins kilo-octets.',
        'string'  => 'La campagne :attribut doit contenir: valeur ou moins de caractères.',
        'array'   => 'La campagne :l\'attribut doit contenir: valeur ou moins d\'éléments.',
    ],
    'max'                  => [
        'numeric' => 'La campagne:l\'attribut ne doit pas être supérieur à: max',
        'file'    => 'L\'archive :attribut ne doit pas peser plus de: max kilo-octets.',
        'string'  => 'La campagne :l\'attribut ne doit pas contenir plus de: max caractères.',
        'array'   => 'La campagne :L\'attribut ne doit pas contenir plus de: max éléments.',
    ],
    'mimes'                => 'La campagne :attribut doit être un fichier de type :: values.',
    'mimetypes'            => 'La campagne :attribut doit être un fichier de type :: values.',
    'min'                  => [
        'numeric' => 'La campagne :attribut doit être au moins: min.',
        'file'    => 'L\'archive :attribut doit peser au moins: min kilo-octets.',
        'string'  => 'La campagne :attribut doit contenir au moins: min caractères.',
        'array'   => 'La campagne :attribut doit contenir au moins: éléments min.',
    ],
    'not_in'               => 'La campagne :l\'attribut sélectionné est invalide.',
    'not_regex'            => 'Le format champ: attribut invalide.',
	'numeric'              => 'La campagne :attribut doit être un nombre.',
    'present'              => 'La campagne :attribut doit être présent.',
    'regex'                => 'Format de champ :l\'attribut est invalide.',
    'required'             => 'La campagne :attribute est obligatoire.',
    'required_if'          => 'La campagne :attribut est obligatoire lorsque le champ: autre est: valeur.',
    'required_unless'      => 'La campagne :attribut est requis sauf si: autre est dans: valeurs.',
    'required_with'        => 'La campagne :l\'attribut est obligatoire quand: values ​​est présent.',
    'required_with_all'    => 'La campagne :attribut est obligatoire quand: les valeurs sont présentes.',
    'required_without'     => 'La campagne :l\'attribut est obligatoire lorsque: les valeurs sont absentes.',
    'required_without_all' => 'La campagne:l\'attribut est obligatoire quand aucun des champs: les valeurs sont présentes.',
    'same'                 => 'Champs :attribut y: les autres doivent correspondre.',
    'size'                 => [
        'numeric' => 'La campagne :l\'attribut doit être: taille.',
        'file'    => 'L\'archive:l\'attribut doit peser: taille kilo-octets.',
        'string'  => 'La campagne :l\'attribut doit contenir: caractères de taille',
        'array'   => 'La campagne :attribute debe contener :size elementos.',
    ],
    'starts_with'          => 'La campagne :l\'attribut doit commencer par l\'une des valeurs suivantes :: valeurs',
    'string'               => 'La campagne :attribut doit être une chaîne de caractères. ',
    'timezone'             => 'La campagne :attribut doit être un fuseau horaire valide.',
    'unique'               => 'La valeur del campo :Cet attribut est déjà utilisé.',
    'uploaded'             => 'La campagne:attribute Impossible de télécharger',
    'url'                  => 'Le format del campo :attribut est invalide.',
    'uuid'                 => 'La campagne :attribut doit être un UUID valide.',

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
