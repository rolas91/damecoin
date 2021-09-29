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

    'accepted'             => 'मैदान :attribute स्वीकार किया जाना चाहिए.',
    'active_url'           => 'मैदान :attribute एक मान्य URL नहीं है.',
    'after'                => 'मैदान :attribute से बाद में होना चाहिए :date.',
    'after_or_equal'       => 'मैदान :attribute बाद में से या इसके बराबर होना चाहिए :date.',
    'alpha'                => 'मैदान :attribute केवल पत्र हो सकते हैं.',
    'alpha_dash'           => 'मैदान :attribute केवल अक्षर, संख्या, हाइफ़न और अंडरस्कोर हो सकते हैं.',
    'alpha_num'            => 'मैदान :attribute केवल अक्षरों और संख्याओं को शामिल कर सकते हैं.',
    'array'                => 'मैदान :attribute एक सरणी होनी चाहिए.',
    'before'               => 'मैदान :attribute पहले एक तारीख होनी चाहिए :date.',
    'before_or_equal'      => 'मैदान :attribute इससे पहले या उसके बराबर की तारीख होनी चाहिए :date.',
    'between'              => [
        'numeric' => 'मैदान :attribute के बीच एक मान होना चाहिए :min और :max.',
        'file'    => 'फ़ाइल :attribute के बीच तौलना चाहिए :min और :max किलोबाइट.',
        'string'  => 'मैदान :attribute के बीच होना चाहिए :min और :max वर्ण.',
        'array'   => 'मैदान :attribute के बीच होना चाहिए :min और :max तत्वों.',
    ],
    'boolean'              => 'मैदान :attribute सही या गलत होना चाहिए.',
    'confirmed'            => 'मैदान की पुष्टि :attribute मेल नहीं खाता.',
    'date'                 => 'मैदान :attribute मान्य दिनांक के अनुरूप नहीं है.',
    'date_equals'          => 'मैदान :attribute के बराबर तारीख होनी चाहिए :date.',
    'date_format'          => 'मैदान :attribute दिनांक प्रारूप के अनुरूप नहीं है :format.',
    'different'            => 'खेत :attribute और :other उन्हें अलग होना चाहिए.',
    'digits'               => 'मैदान :attribute की संख्या होनी चाहिए :digits अंक.',
    'digits_between'       => 'मैदान :attribute के बीच होना चाहिए :min और :max अंक.',
    'dimensions'           => 'मैदान :attribute अमान्य छवि आयाम हैं.',
    'distinct'             => 'मैदान :attribute एक डुप्लिकेट मान है.',
    'email'                => 'मैदान :attribute एक मान्य ईमेल पता होना चाहिए.',
    'exists'               => 'मैदान :attribute चयनित मौजूद नहीं है.',
    'file'                 => 'मैदान :attribute यह एक फ़ाइल होनी चाहिए.',
    'current_password'     => 'मैदान वर्तमान कुंजी गलत है',
    'filled'               => 'मैदान :attribute मान होना चाहिए.',
    'gt'                   => [
        'numeric' => 'मैदान :attribute से अधिक होना चाहिए :value.',
        'file'    => 'फ़ाइल :attribute से अधिक वजन होना चाहिए :value किलोबाइट.',
        'string'  => 'मैदान :attribute से अधिक होना चाहिए :value वर्ण.',
        'array'   => 'मैदान :attribute से अधिक होना चाहिए :value तत्वों.',
    ],
    'gte'                  => [
        'numeric' => 'मैदान :attribute से अधिक या उसके बराबर होना चाहिए :value.',
        'file'    => 'फ़ाइल :attribute तौलना चाहिए :value या अधिक किलोबाइट.',
        'string'  => 'मैदान :attribute होना चाहिए :value या अधिक वर्ण.',
        'array'   => 'मैदान :attribute होना चाहिए :value या अधिक आइटम.',
    ],
    'image'                => 'मैदान :attribute यह एक छवि होनी चाहिए.',
    'in'                   => 'मैदान :attribute अमान्य है.',
    'in_array'             => 'मैदान :attribute में मौजूद नहीं है :other.',
    'integer'              => 'मैदान :attribute पूर्णांक होना चाहिए.',
    'ip'                   => 'मैदान :attribute यह एक पता होना चाहिए IP वैध.',
    'ipv4'                 => 'मैदान :attribute यह एक पता होना चाहिए IPv4 वैध.',
    'ipv6'                 => 'मैदान :attribute यह एक पता होना चाहिए IPv6 वैध.',
    'json'                 => 'मैदान :attribute एक पाठ स्ट्रिंग होना चाहिए JSON वैध.',
    'lt'                   => [
        'numeric' => 'मैदान :attribute से कम होना चाहिए :value.',
        'file'    => 'फ़ाइल :attribute से कम वजन होना चाहिए:value किलोबाइट.',
        'string'  => 'मैदान :attribute से कम होना चाहिए :value वर्ण.',
        'array'   => 'मैदान :attribute से कम होना चाहिए :value तत्वों.',
    ],
    'lte'                  => [
        'numeric' => 'मैदान :attribute से कम या इसके बराबर होना चाहिए :value.',
        'file'    => 'फ़ाइल :attribute तौलना चाहिए :value या कम किलोबाइट.',
        'string'  => 'मैदान :attribute होना चाहिए :value या कम वर्ण.',
        'array'   => 'मैदान :attribute होना चाहिए :value या कम तत्व.',
    ],
    'max'                  => [
        'numeric' => 'मैदान :attribute से अधिक नहीं होना चाहिए :max.',
        'file'    => 'फ़ाइल :attribute से अधिक वजन नहीं होना चाहिए :max किलोबाइट.',
        'string'  => 'मैदान :attribute से अधिक नहीं होना चाहिए :max वर्ण.',
        'array'   => 'मैदान :attribute से अधिक नहीं होना चाहिए :max तत्वों.',
    ],
    'mimes'                => 'मैदान :attribute एक प्रकार की फ़ाइल होनी चाहिए: :values.',
    'mimetypes'            => 'मैदान :attribute एक प्रकार की फ़ाइल होनी चाहिए: :values.',
    'min'                  => [
        'numeric' => 'मैदान :attribute कम से कम होना चाहिए :min.',
        'file'    => 'फ़ाइल :attribute कम से कम तौलना चाहिए :min किलोबाइट.',
        'string'  => 'मैदान :attribute कम से कम होना चाहिए :min वर्ण.',
        'array'   => 'मैदान :attribute कम से कम होना चाहिए :min तत्वों.',
    ],
    'not_in'               => 'मैदान :attribute चयनित अमान्य है.',
    'not_regex'            => 'क्षेत्र प्रारूप :attribute अमान्य है.',
	'numeric'              => 'मैदान :attribute एक नंबर होना चाहिए.',
    'present'              => 'मैदान :attribute उपस्थित होना चाहिए.',
    'regex'                => 'क्षेत्र प्रारूप :attribute अमान्य है.',
    'required'             => 'मैदान :attribute की आवश्यकता है.',
    'required_if'          => 'मैदान :attribute आवश्यक है जब क्षेत्र :other यह वह जगह है :value.',
    'required_unless'      => 'मैदान :attribute जब तक आवश्यक हो :other में है :values.',
    'required_with'        => 'मैदान :attribute यह अनिवार्य है जब :values मौजूद है.',
    'required_with_all'    => 'मैदान :attribute यह अनिवार्य है जब :values मौजूद हैं.',
    'required_without'     => 'मैदान :attribute यह अनिवार्य है जब :values मौजूद नहीं है.',
    'required_without_all' => 'मैदान :attribute यह अनिवार्य है जब खेतों में से कोई नहीं :values मौजूद हैं.',
    'same'                 => 'खेत :attribute और :other उन्हें मेल खाना चाहिए.',
    'size'                 => [
        'numeric' => 'मैदान :attribute यह होना चाहिए :size.',
        'file'    => 'फ़ाइल :attribute तौलना चाहिए :size किलोबाइट.',
        'string'  => 'मैदान :attribute होना चाहिए :size वर्ण.',
        'array'   => 'मैदान :attribute होना चाहिए :size तत्वों.',
    ],
    'starts_with'          => 'मैदान :attribute निम्न मानों में से किसी एक से प्रारंभ करना चाहिए: :values',
    'string'               => 'मैदान :attribute एक तार होना चाहिए वर्ण.',
    'timezone'             => 'मैदान :attribute एक वैध समय क्षेत्र होना चाहिए.',
    'unique'               => 'क्षेत्र मान :attribute पहले से ही उपयोग में है.',
    'uploaded'             => 'मैदान :attribute अपलोड नहीं किया जा सका.',
    'url'                  => 'क्षेत्र प्रारूप :attribute अमान्य है.',
    'uuid'                 => 'मैदान :attribute होना चाहिए एक UUID वैध.',

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
