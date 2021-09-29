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

    'accepted'             => 'المجال  :attribute يجب قبوله.',
    'active_url'           => 'المجال  :attribute ليس عنوان URL صالحًا.',
    'after'                => 'المجال  :attribute يجب أن يكون بعد :date.',
    'after_or_equal'       => 'المجال  :attribute يجب أن يكون بعد أو يساوي :date.',
    'alpha'                => 'المجال  :attribute يمكن أن تحتوي على أحرف فقط.',
    'alpha_dash'           => 'المجال  :attribute يمكن أن يحتوي فقط على أحرف وأرقام وواصلات وشرطات سفلية.',
    'alpha_num'            => 'المجال  :attribute يمكن أن تحتوي فقط على أحرف وأرقام.',
    'array'                => 'المجال  :attribute يجب أن يكون مصفوفة.',
    'before'               => 'المجال  :attribute يجب أن يكون تاريخ من قبل :date.',
    'before_or_equal'      => 'المجال  :attribute يجب أن يكون تاريخًا قبل أو يساوي :date.',
    'between'              => [
        'numeric' => 'المجال  :attribute يجب أن تكون قيمة بين  :min ذ :max.',
        'file'    => 'الملف  :attribute يجب أن يزن بين  :min ذ :max كيلوبايت.',
        'string'  => 'المجال  :attribute يجب أن يحتوي على ما بين :min ذ :max الشخصيات.',
        'array'   => 'المجال  :attribute يجب أن يحتوي على ما بين :min ذ :max العناصر.',
    ],
    'boolean'              => 'المجال  :attribute يجب أن تكون صحيحة أو خاطئة.',
    'confirmed'            => 'مجال التأكيد :attribute لا يطابق.',
    'date'                 => 'المجال  :attribute لا يتوافق مع تاريخ صالح.',
    'date_equals'          => 'المجال  :attribute يجب أن يكون تاريخ يساوي :date.',
    'date_format'          => 'المجال  :attribute لا يتوافق مع تنسيق التاريخ :format.',
    'different'            => 'الحقول :attribute ذ :يجب أن يكون الآخر مختلفًا.',
    'digits'               => 'المجال  :attribute يجب أن يكون عددًا من :digits أرقام.',
    'digits_between'       => 'المجال  :attribute يجب أن يحتوي على ما بين :min ذ :max أرقام.',
    'dimensions'           => 'المجال  :attribute أبعاد الصورة غير صالحة.',
    'distinct'             => 'المجال  :attribute له قيمة مكررة.',
    'email'                => 'المجال  :attribute يجب أن يكون عنوان بريد إلكتروني صالح.',
    'exists'               => 'المجال  :attribute المختار غير موجود.',
    'file'                 => 'المجال  :attribute يجب أن يكون ملف.',
    'current_password'     => 'حقل المفتاح الحالي غير صحيح',
    'filled'               => 'المجال  :attribute يجب أن يكون لها قيمة.',
    'gt'                   => [
        'numeric' => 'المجال  :attribute يجب أن يكون أكبر من :value.',
        'file'    => 'الملف  :attribute يجب أن تزن أكثر من :value كيلوبايت.',
        'string'  => 'المجال  :attribute يجب أن يحتوي على أكثر من :value الشخصيات.',
        'array'   => 'المجال  :attribute يجب أن يحتوي على أكثر من :value العناصر.',
    ],
    'gte'                  => [
        'numeric' => 'المجال  :attribute يجب أن يكون أكبر من أو يساوي :value.',
        'file'    => 'الملف  :attribute يجب أن تزن :value أو أكثر كيلوبايت.',
        'string'  => 'المجال  :attribute يجب أن يحتوي على :value أو أكثر الشخصيات.',
        'array'   => 'المجال  :attribute يجب أن يحتوي على :value أو أكثر العناصر.',
    ],
    'image'                => 'المجال  :attribute يجب أن تكون صورة.',
    'in'                   => 'المجال  :attribute غير صالح.',
    'in_array'             => 'المجال  :attribute غير موجود في  :other.',
    'integer'              => 'المجال  :attribute يجب أن يكون عددًا صحيحًا.',
    'ip'                   => 'المجال  :attribute يجب أن يكون عنوان IP صالحًا.',
    'ipv4'                 => 'المجال  :attribute يجب أن يكون عنوان IPv4 صالحًا.',
    'ipv6'                 => 'المجال  :attribute يجب أن يكون عنوان IPv6 صالحًاa.',
    'json'                 => 'المجال  :attribute يجب أن تكون سلسلة نصية JSON صالحة.',
    'lt'                   => [
        'numeric' => 'المجال  :attribute يجب أن يكون أقل من :value.',
        'file'    => 'الملف  :attribute يجب أن تزن أقل من :value كيلوبايت.',
        'string'  => 'المجال  :attribute يجب أن يحتوي على أقل من :value الشخصيات.',
        'array'   => 'المجال  :attribute يجب أن يحتوي على أقل من :value العناصر.',
    ],
    'lte'                  => [
        'numeric' => 'المجال  :attribute يجب أن يكون أقل من أو يساوي :value.',
        'file'    => 'الملف  :attribute يجب أن تزن :value أو أقل كيلوبايت.',
        'string'  => 'المجال  :attribute يجب أن يحتوي على :value أو أقل الشخصيات.',
        'array'   => 'المجال  :attribute يجب أن يحتوي على :value أو أقل العناصر.',
    ],
    'max'                  => [
        'numeric' => 'المجال  :attribute يجب ألا يكون أكبر من :max.',
        'file'    => 'الملف  :attribute لا ينبغي أن تزن أكثر من :max كيلوبايت.',
        'string'  => 'المجال  :attribute يجب ألا يحتوي على أكثر من :max الشخصيات.',
        'array'   => 'المجال  :attribute يجب ألا يحتوي على أكثر من :max العناصر.',
    ],
    'mimes'                => 'المجال  :attribute يجب أن يكون ملف من النوع: :values.',
    'mimetypes'            => 'المجال  :attribute يجب أن يكون ملف من النوع: :values.',
    'min'                  => [
        'numeric' => 'المجال  :attribute يجب أن يكون على الأقل :min.',
        'file'    => 'الملف  :attribute يجب أن تزن على الأقل :min كيلوبايت.',
        'string'  => 'المجال  :attribute يجب أن يحتوي على الأقل :min الشخصيات.',
        'array'   => 'المجال  :attribute يجب أن يحتوي على الأقل:min العناصر.',
    ],
    'not_in'               => 'المجال  :attribute المحدد غير صالح.',
    'not_regex'            => 'تنسيق الحقل :attribute غير صالح.',
	'numeric'              => 'المجال  :attribute يجب أن يكون رقمًا.',
    'present'              => 'المجال  :attribute يجب أن يكون حاضرا.',
    'regex'                => 'تنسيق الحقل :attribute غير صالح.',
    'required'             => 'المجال  :attribute مطلوب.',
    'required_if'          => 'المجال  :attributeمطلوب عندما يكون الحقل :other هو :value.',
    'required_unless'      => 'المجال  :attribute مطلوب إلا إذا :other في  :values.',
    'required_with'        => 'المجال  :attribute إلزامية متى  :values موجود.',
    'required_with_all'    => 'المجال  :attribute إلزامية متى  :values موجودة.',
    'required_without'     => 'المجال :attribute إلزامية متى  :values غير موجود.',
    'required_without_all' => 'المجال  :attribute مطلوب عندما لا يوجد أي من الحقول  :values موجودة.',
    'same'                 => 'الحقول  :attribute ذ  :other يجب أن يتطابقوا.',
    'size'                 => [
        'numeric' => 'المجال  :attribute يجب ان يكون :size.',
        'file'    => 'الملف  :attribute يجب أن تزن :size كيلوبايت.',
        'string'  => 'المجال  :attribute يجب أن يحتوي على  :size الشخصيات.',
        'array'   => 'المجال  :attribute يجب أن يحتوي على  :size العناصر.',
    ],
    'starts_with'          => 'المجال  :attribute يجب أن تبدأ بإحدى القيم التالية: :values',
    'string'               => 'المجال  :attribute يجب أن يكون سلسلة أحرف.',
    'timezone'             => 'المجال  :attribute يجب أن تكون منطقة زمنية صالحة.',
    'unique'               => 'قيمة المجال  :attribute قيد الاستخدام بالفعل.',
    'uploaded'             => 'المجال  :attribute لا يمكن تحميل .',
    'url'                  => 'تنسيق الحقل  :attribute غير صالح .',
    'uuid'                 => 'المجال  :attribute يجب أن يكون UUID صالحًا .',

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
