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

    'accepted'             => 'Das Feld :Attribut muss akzeptiert werden.',
    'active_url'           => 'Das Feld  Attribut ist kein URL gültig.',
    'after'                => 'Das Feld :Attribut muss ein Datum nach sein :Datum.',
    'after_or_equal'       => 'Das Feld :Attribut muss ein Datum nach oder gleich sein:Datum.',
    'alpha'                => 'Das Feld :Attribut kann nur Buchstaben enthalten.',
    'alpha_dash'           => 'Das Feld :Das Attribut darf nur Buchstaben, Zahlen, Bindestriche und Unterstriche enthalten.',
    'alpha_num'            => 'Das Feld :Das Attribut darf nur Buchstaben und Zahlen enthalten.',
    'array'                => 'Das Feld :Attribut muss ein Array sein.',
    'before'               => 'Das Feld :Attribut muss ein Datum vor sein :Datum.',
    'before_or_equal'      => 'Das Feld :Attribut muss ein Datum vor oder gleich sein :Datum.',
    'between'              => [
        'numeric' => 'Das Feld :Attribut muss ein Wert zwischen: min und: max sein.',
        'file'    => 'Das Archiv :Das Attribut muss zwischen: min und: max Kilobyte wiegen.',
        'string'  => 'Das Feld :Das Attribut muss zwischen: min und: max Zeichen enthalten.',
        'array'   => 'Das Feld :Das Attribut muss zwischen: min und: max Elementen enthalten.',
    ],
    'boolean'              => 'Das Feld :Attribut muss wahr oder falsch sein.',
    'confirmed'            => 'Das Feld Bestätigung von :Attribut stimmt nicht überein.',
    'date'                 => 'Das Feld :Attribut entspricht keinem gültigen Datum.',
    'date_equals'          => 'Das Feld :Attribut muss ein Datum gleich sein :Datum.',
    'date_format'          => 'Das Feld :Attribut stimmt nicht mit dem Datumsformat überein:formatieren.',
    'different'            => 'Die Felder :Attribut und :andere müssen anders sein.',
    'digits'               => 'Das Feld :Attribut muss eine Zahl von sein :Ziffern Ziffern.',
    'digits_between'       => 'Das Feld :Attribut muss enthalten zwischen:min y: max ziffern.',
    'dimensions'           => 'Das Feld :Attribut hat ungültige Bildabmessungen.',
    'distinct'             => 'Das Feld :Attribut hat einen doppelten Wert.',
    'email'                => 'Das Feld :Attribut muss eine gültige E-Mail-Adresse sein.',
    'exists'               => 'Das Feld :Das ausgewählte Attribut existiert nicht.',
    'file'                 => 'Das Feld :Attribut muss eine Datei sein.',
    'current_password'     => 'Das Feld Aktueller Schlüssel ist falsch',
    'filled'               => 'Das Feld :Attribut muss einen Wert haben.',
    'gt'                   => [
        'numeric' => 'Das Feld :Attribut muss größer sein als :Wert.',
        'file'    => 'Das Archiv :Attribut muss mehr wiegen als :Wert Kilobyte.',
        'string'  => 'Das Feld :Attribut muss mehr als enthalten :Wert Zeichen.',
        'array'   => 'Das Feld :Attribut muss mehr als enthalten:Wert Elemente.',
    ],
    'gte'                  => [
        'numeric' => 'Das Feld :Attribut muss größer oder gleich sein:Wert.',
        'file'    => 'Das Archiv :Attribut muss wiegen :Wert oder mehr Kilobyte.',
        'string'  => 'Das Feld :Attribut muss enthalten :Wert oder mehr Zeichen.',
        'array'   => 'Das Feld:Attribut muss enthalten :Wert o mehr Elemente.',
    ],
    'image'                => 'Das Feld :Attribut muss ein Bild sein.',
    'in'                   => 'Das Feld :Attribut ist ungültig.',
    'in_array'             => 'Das Feld :Attribut existiert nicht in :andere.',
    'integer'              => 'Das Feld :Attribut muss eine Ganzzahl sein.',
    'ip'                   => 'Das Feld :Attribut muss eine Adresse sein IP gültig.',
    'ipv4'                 => 'Das Feld :Attribut muss eine Adresse sein IPv4 gültig.',
    'ipv6'                 => 'Das Feld :Attribut muss eine Adresse sein IPv6 gültig.',
    'json'                 => 'Das Feld :Attribut muss eine Textzeichenfolge seinJSON gültig.',
    'lt'                   => [
        'numeric' => 'Das Feld :Attribut muss kleiner sein als :Wert.',
        'file'    => 'El archivo :Attribut muss kleiner sein als :Wert Kilobyte.',
        'string'  => 'Das Feld :Attribut muss kleiner sein als :Wert Zeichen.',
        'array'   => 'Das Feld :Attribut muss kleiner sein als :Wert Elemente.',
    ],
    'lte'                  => [
        'numeric' => 'Das Feld :Attribut muss kleiner oder gleich sein :Wert.',
        'file'    => 'Das Archiv :Attribut muss wiegen :Wert oder weniger Kilobyte.',
        'string'  => 'Das Feld :Attribut muss enthalten:Wert oder weniger Zeichen.',
        'array'   => 'Das Feld :Attribut muss enthalten :Wert oder weniger Elemente.',
    ],
    'max'                  => [
        'numeric' => 'Das Feld :Attribut sollte nicht größer sein als :max.',
        'file'    => 'Das Archiv :Attribut sollte nicht mehr als wiegen :max Kilobyte.',
        'string'  => 'Das Feld :Attribut darf nicht mehr als enthalten :max Zeichen.',
        'array'   => 'Das Feld :Attribut darf nicht mehr als enthalten :max Elemente.',
    ],
    'mimes'                => 'Das Feld :Attribut muss eine Datei vom Typ sein: :werte.',
    'mimetypes'            => 'Das Feld :Attribut muss eine Datei vom Typ sein: :werte.',
    'min'                  => [
        'numeric' => 'Das Feld :Attribut muss mindestens sein :min.',
        'file'    => 'Das Archiv :Attribut muss mindestens wiegen :min Kilobyte.',
        'string'  => 'Das Feld :Attribut muss mindestens enthalten :min Zeichen.',
        'array'   => 'Das Feld :Attribut muss mindestens enthalten :min Elemente.',
    ],
    'not_in'               => 'Das Feld :Das ausgewählte Attribut ist ungültig.',
    'not_regex'            => 'Feldformat :Attribut ist ungültig.',
	'numeric'              => 'Das Feld :Attribut muss eine Zahl sein.',
    'present'              => 'Das Feld :Attribut muss vorhanden sein.',
    'regex'                => 'Feldformat :Attribut ist ungültig.',
    'required'             => 'Das Feld :attribute ist obligatorisch.',
    'required_if'          => 'Das Feld :Attribut ist obligatorisch, wenn das Feld:andere ist :Wert.',
    'required_unless'      => 'Das Feld :Attribut ist erforderlich, sofern nicht :andere ist in :werte.',
    'required_with'        => 'Das Feld :Attribut ist obligatorisch, wenn :werte vorhanden ist.',
    'required_with_all'    => 'Das Feld :Attribut ist obligatorisch, wenn:werte vorhanden sind.',
    'required_without'     => 'Das Feld :Attribut ist obligatorisch, wenn :werte nicht anwesend.',
    'required_without_all' => 'Das Feld :Attribut ist obligatorisch, wenn keines der Felder vorhanden ist :werte vorhanden sind.',
    'same'                 => 'Los campos :Attribut und :andere müssen zusammenpassen.',
    'size'                 => [
        'numeric' => 'Das Feld :Attribut muss sein :Größe.',
        'file'    => 'El archivo :Attribut muss wiegen :Größe Kilobyte.',
        'string'  => 'Das Feld :Attribut muss enthalten :Größe Zeichen.',
        'array'   => 'Das Feld :Attribut muss enthalten :Größe Elemente.',
    ],
    'starts_with'          => 'Das Feld :Das Attribut muss mit einem der folgenden Werte beginnen: :werte',
    'string'               => 'Das Feld :Attribut muss eine Zeichenkette sein.',
    'timezone'             => 'Das Feld :Attribut muss eine gültige Zeitzone sein.',
    'unique'               => 'Der Wert des Feldes :Attribut wird bereits verwendet.',
    'uploaded'             => 'Das Feld :Attribut konnte nicht hochgeladen werden.',
    'url'                  => 'Feldformat:Attribut ist ungültig.',
    'uuid'                 => 'Das Feld :Attribut muss ein sein UUID gültig.',

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
