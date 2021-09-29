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

    'accepted'             => 'สนาม :ต้องยอมรับแอตทริบิวต์.',
    'active_url'           => 'สนาม :คุณลักษณะไม่ได้เป็น URL ถูกต้อง.',
    'after'                => 'สนาม :แอตทริบิวต์ต้องเป็นวันที่หลังจากนั้น :วันที่.',
    'after_or_equal'       => 'สนาม :แอตทริบิวต์ต้องเป็นวันที่หลังจากหรือเท่ากับ :วันที่.',
    'alpha'                => 'สนาม :คุณลักษณะต้องมีตัวอักษรเท่านั้น',
    'alpha_dash'           => 'สนาม :แอตทริบิวต์สามารถมีได้เฉพาะตัวอักษรตัวเลขเครื่องหมายขีดกลางและเครื่องหมายขีดล่าง.',
    'alpha_num'            => 'สนาม :คุณลักษณะต้องมีตัวอักษรและตัวเลขเท่านั้น.',
    'array'                => 'สนาม :คุณลักษณะต้องเป็นอาร์เรย์.',
    'before'               => 'สนาม :คุณลักษณะต้องเป็นวันที่ก่อน:วันที่.',
    'before_or_equal'      => 'สนาม :คุณลักษณะต้องเป็นวันที่ก่อนหน้าหรือเท่ากับ: วันที่.',
    'between'              => [
        'numeric' => 'สนาม :คุณลักษณะต้องเป็นค่าระหว่าง :นาทีและ :สูงสุด.',
        'file'    => 'ที่เก็บถาวร :คุณลักษณะต้องมีน้ำหนักระหว่าง:นาทีและ :กิโลไบต์สูงสุด.',
        'string'  => 'สนาม :คุณลักษณะต้องมีระหว่าง :นาทีและ :จำนวนอักขระสูงสุด.',
        'array'   => 'สนาม :คุณลักษณะต้องมีระหว่าง :นาทีและ :องค์ประกอบสูงสุด',
    ],
    'boolean'              => 'สนาม :คุณลักษณะต้องเป็นจริงหรือเท็จ.',
    'confirmed'            => 'สนาม การยืนยันของ :แอตทริบิวต์ไม่ตรงกัน.',
    'date'                 => 'สนาม :แอตทริบิวต์ไม่ตรงกับวันที่ที่ถูกต้อง.',
    'date_equals'          => 'สนาม :คุณลักษณะต้องเป็นวันที่เท่ากับ :วันที่.',
    'date_format'          => 'สนาม :คุณลักษณะที่ไม่สอดคล้องกับการจัดรูปแบบ วันที่ :รูป.',
    'different'            => 'ลอสโปส :คุณลักษณะ และ :คนอื่น ๆ แตกต่างกัน.',
    'digits'               => 'สนาม :คุณลักษณะ น่า เป็นจำนวน :ตัวเลขหลัก.',
    'digits_between'       => 'สนาม :คุณลักษณะต้องมีระหว่าง :นาที และ :ตัวเลขสูงสุด.',
    'dimensions'           => 'สนาม :คุณลักษณะมีขนาดภาพที่ไม่ถูกต้อง.',
    'distinct'             => 'สนาม :คุณลักษณะมีค่าซ้ำกัน.',
    'email'                => 'สนาม :แอตทริบิวต์ต้องเป็นที่อยู่อีเมลที่ถูกต้อง.',
    'exists'               => 'สนาม :ไม่มีแอตทริบิวต์ที่เลือก.',
    'file'                 => 'สนาม :คุณลักษณะต้องเป็นไฟล์.',
    'current_password'     => 'สนาม รหัสปัจจุบันไม่ถูกต้อง',
    'filled'               => 'สนาม :คุณลักษณะต้องมีค่า.',
    'gt'                   => [
        'numeric' => 'สนาม :คุณลักษณะต้องมากกว่า :ความคุ้มค่า.',
        'file'    => 'ที่เก็บถาวร :คุณลักษณะต้องมีน้ำหนักมากกว่า :กิโลไบต์มูลค่า.',
        'string'  => 'สนาม :คุณลักษณะต้องมีมากกว่า:อักขระค่า.',
        'array'   => 'สนาม :คุณลักษณะต้องมีมากกว่า:องค์ประกอบคุณค่า.',
    ],
    'gte'                  => [
        'numeric' => 'สนาม :attribute ต้องมากกว่าหรือเท่ากับ :value.',
        'file'    => 'ที่เก็บถาวร :attribute ต้องชั่งน้ำหนัก :value หรือมากกว่ากิโลไบต์',
        'string'  => 'สนาม :attribute จะต้องมี :value หรือมากกว่าตัวละคร',
        'array'   => 'สนาม :attribute จะต้องมี :value หรือมากกว่าองค์ประกอบ',
    ],
    'image'                => 'สนาม :attribute มันจะต้องเป็นภาพ',
    'in'                   => 'สนาม :attribute มันไม่ถูกต้อง',
    'in_array'             => 'สนาม :attribute ไม่มีอยู่ใน :other.',
    'integer'              => 'สนาม :attribute ต้องเป็นจำนวนเต็ม',
    'ip'                   => 'สนาม :attribute ต้องเป็นที่อยู่ IP ที่ถูกต้อง',
    'ipv4'                 => 'สนาม :attribute ต้องเป็นที่อยู่ IPv4 ที่ถูกต้อง',
    'ipv6'                 => 'สนาม :attribute ต้องเป็นที่อยู่ IPv6 ที่ถูกต้อง',
    'json'                 => 'สนาม :attribute ต้องเป็นสตริงข้อความ JSON ที่ถูกต้อง',
    'lt'                   => [
        'numeric' => 'สนาม :attribute จะต้องน้อยกว่า :value.',
        'file'    => 'ที่เก็บถาวร :attribute จะต้องมีน้ำหนักน้อยกว่า :value กิโลไบต์',
        'string'  => 'สนาม :attribute ต้องมีน้อยกว่า :value ตัวละคร',
        'array'   => 'สนาม :attribute ต้องมีน้อยกว่า :value องค์ประกอบ',
    ],
    'lte'                  => [
        'numeric' => 'สนาม :attribute ต้องน้อยกว่าหรือเท่ากับ :value.',
        'file'    => 'ที่เก็บถาวร :attribute ต้องชั่งน้ำหนัก :value หรือน้อยกว่ากิโลไบต์',
        'string'  => 'สนาม :attribute จะต้องมี :value หรือน้อยกว่าตัวอักษร',
        'array'   => 'สนาม :attribute จะต้องมี :value หรือน้อยกว่าองค์ประกอบ',
    ],
    'max'                  => [
        'numeric' => 'สนาม :attribute ไม่ควรมากกว่า :max.',
        'file'    => 'ที่เก็บถาวร :attribute ไม่ควรหนักเกิน :max กิโลไบต์',
        'string'  => 'สนาม :attribute ต้องมีมากกว่า :max ตัวละคร.',
        'array'   => 'สนาม :attribute ต้องมีมากกว่า :max องค์ประกอบ',
    ],
    'mimes'                => 'สนาม :attribute มันจะต้องเป็นไฟล์ประเภท: :values.',
    'mimetypes'            => 'สนาม :attribute มันจะต้องเป็นไฟล์ประเภท: :values.',
    'min'                  => [
        'numeric' => 'สนาม :attribute ต้องมีอย่างน้อย :min.',
        'file'    => 'ที่เก็บถาวร :attribute ต้องมีน้ำหนักอย่างน้อย :min กิโลไบต์',
        'string'  => 'สนาม :attribute ต้องมีอย่างน้อย :min ตัวละคร',
        'array'   => 'สนาม :attribute ต้องมีอย่างน้อย :min องค์ประกอบ',
    ],
    'not_in'               => 'สนาม :attribute ที่เลือกไม่ถูกต้อง',
    'not_regex'            => 'รูปแบบฟิลด์ :attribute มันไม่ถูกต้อง',
	'numeric'              => 'สนาม :attribute มันจะต้องเป็นตัวเลข',
    'present'              => 'สนาม :attribute มันจะต้องมีอยู่',
    'regex'                => 'รูปแบบฟิลด์ :attribute มันไม่ถูกต้อง',
    'required'             => 'สนาม :attribute มันเป็นข้อบังคับ',
    'required_if'          => 'สนาม :attribute มันเป็นข้อบังคับเมื่อสนาม :other นี้คือ :value.',
    'required_unless'      => 'สนาม :attribute เป็นสิ่งจำเป็นเว้นแต่ :other อยู่ใน :values.',
    'required_with'        => 'สนาม :attribute มันเป็นสิ่งจำเป็นเมื่อ :values เป็นปัจจุบัน',
    'required_with_all'    => 'สนาม :attribute มันเป็นสิ่งจำเป็นเมื่อ :values พวกเขาเป็นปัจจุบัน',
    'required_without'     => 'สนาม :attribute มันเป็นสิ่งจำเป็นเมื่อ :values มันไม่เป็นปัจจุบัน',
    'required_without_all' => 'สนาม :attribute มันเป็นสิ่งจำเป็นเมื่อไม่มีฟิลด์ใด ๆ :values พวกเขาเป็นปัจจุบัน',
    'same'                 => 'สาขาที่ :attribute y :other พวกเขาจะต้องตรงกัน',
    'size'                 => [
        'numeric' => 'สนาม :attribute จะต้องเป็น :size.',
        'file'    => 'ที่เก็บถาวร :attribute ต้องชั่งน้ำหนัก :size กิโลไบต์',
        'string'  => 'สนาม :attribute จะต้องมี :size ตัวละคร',
        'array'   => 'สนาม :attribute จะต้องมี :size องค์ประกอบ',
    ],
    'starts_with'          => 'สนาม :attribute คุณต้องเริ่มต้นด้วยหนึ่งในค่าต่อไปนี้: :values',
    'string'               => 'สนาม :attribute ต้องเป็นสตริงของอักขระ',
    'timezone'             => 'สนาม :attribute ต้องเป็นเขตเวลาที่ถูกต้อง',
    'unique'               => 'มูลค่าของสนาม :attribute มันถูกใช้งานแล้ว',
    'uploaded'             => 'สนาม :attribute ไม่สามารถอัปโหลด',
    'url'                  => 'รูปแบบฟิลด์ :attribute มันไม่ถูกต้อง',
    'uuid'                 => 'สนาม :attribute ต้องเป็น UUID ที่ถูกต้อง',

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
