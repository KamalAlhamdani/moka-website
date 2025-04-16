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

    'accepted' => ':attribute يجب أن يكون مقبولة.',
    'active_url' => ':attribute ليس عنوان URL صالحًا.',
    'after' => ':attribute يجب أن يكون تاريخ بعد :date.',
    'after_or_equal' => ':attribute يجب أن يكون تاريخ بعد أو يساوي :date.',
    'alpha' => ':attribute قد تحتوي فقط على أحرف.',
    'alpha_dash' => ':attribute قد يحتوي فقط على أحرف وأرقام وشرطات وشرطات سفلية.',
    'alpha_num' => ':attribute قد تحتوي فقط على حروف وأرقام.',
    'array' => ':attribute يجب أن يكون مصفوفة.',
    'before' => ':attribute يجب أن يكون تاريخ من قبل :date.',
    'before_or_equal' => ':attribute يجب أن يكون تاريخ قبل أو يساوي :date.',
    'between' => [
        'numeric' => ':attribute يجب ان يكون بين :min و :max.',
        'file' => ':attribute يجب ان يكون بين :min و :max كيلوبايت.',
        'string' => ':attribute يجب ان يكون بين :min and :max حرف.',
        'array' => ':attribute يجب ان يكون بين :min و :max عنصر.',
    ],
    'boolean' => ':attribute يجب أن يكون الحقل صواب أو خطأ.',
    'confirmed' => ':attribute التأكيد غير متطابق.',
    'date' => ':attribute ليس تاريخ صحيح.',
    'date_equals' => ':attribute يجب أن يكون تاريخ يساوي :date.',
    'date_format' => ':attribute لا يطابق التنسيق :format.',
    'different' => ':attribute و :other يجب أن تكون مختلفة.',
    'digits' => ':attribute لابد أن تكون :digits خانة.',
    'digits_between' => ':attribute لابد أن تكون between :min و :max خانة.',
    'dimensions' => ':attribute له أبعاد صورة غير صالحة.',
    'distinct' => ':attribute الحقل له قيمة مكررة.',
    'email' => ':attribute يجب أن يكون عنوان بريد إلكتروني صالح.',
    'ends_with' => ':attribute يجب أن ينتهي بواحد مما يلي: :values',
    'exists' => 'المحدد :attribute غير صالح.',
    'file' => ':attribute يجب أن يكون ملف.',
    'filled' => ':attribute يجب أن يكون الحقل قيمة.',
    'gt' => [
        'numeric' => ':attribute يجب أن يكون أكبر من :value.',
        'file' => ':attribute يجب أن يكون أكبر من :value كيلوبايت.',
        'string' => ':attribute يجب أن يكون أكبر من :value حرف.',
        'array' => ':attribute يجب أن يكون أكبر من :value عنصر.',
    ],
    'gte' => [
        'numeric' => ':attribute يجب أن يكون أكبر من أو يساوي :value.',
        'file' => ':attribute يجب أن يكون أكبر من أو يساوي :value كيلوبايت.',
        'string' => ':attribute يجب أن يكون أكبر من أو يساوي :value حرف.',
        'array' => ':attribute يجب ان يملك :value عنصر أو أكثر.',
    ],
    'image' => ':attribute يجب أن تكون صورة.',
    'in' => 'المحدد :attribute غير صالح.',
    'in_array' => ':attribute الحقل غير موجود في :other.',
    'integer' => ':attribute يجب أن يكون صحيحا بلا علامات عشرية.',
    'ip' => ':attribute يجب أن يكون عنوان IP صالحًا.',
    'ipv4' => ':attribute يجب أن يكون عنوان IPv4 صالحًا.',
    'ipv6' => ':attribute يجب أن يكون عنوان IPv6 صالحًا.',
    'json' => ':attribute يجب أن تكون سلسلة JSON صالحة.',
    'lt' => [
        'numeric' => ':attribute يجب أن يكون أقل من :value.',
        'file' => ':attribute يجب أن يكون أقل من :value كيلوبايت.',
        'string' => ':attribute يجب أن يكون أقل من :value حرف.',
        'array' => ':attribute يجب أن يكون أقل من :value عنصر.',
    ],
    'lte' => [
        'numeric' => ':attribute يجب أن يكون أقل من أو يساوي :value.',
        'file' => ':attribute يجب أن يكون أقل من أو يساوي :value كيلوبايت.',
        'string' => ':attribute يجب أن يكون أقل من أو يساوي :value حرف.',
        'array' => ':attribute يجب ألا يكون أكثر من :value عنصر.',
    ],
    'max' => [
        'numeric' => ':attribute قد لا يكون أكبر من :max.',
        'file' => ':attribute قد لا يكون أكبر من :max كيلوبايت.',
        'string' => ':attribute قد لا يكون أكبر من :max حرف.',
        'array' => ':attribute قد لا يكون أكثر من :max عنصر.',
    ],
    'mimes' => ':attribute يجب أن يكون ملفًا من النوع: :values.',
    'mimetypes' => ':attribute يجب أن يكون ملفًا من النوع: :values.',
    'min' => [
        'numeric' => ':attribute لا بد أن يكون على الأقل :min.',
        'file' => ':attribute لا بد أن يكون على الأقل :min kilobytes.',
        'string' => ':attribute لا بد أن يكون على الأقل :min characters.',
        'array' => ':attribute لا بد أن يكون على الأقل :min items.',
    ],
    'not_in' => 'المحدد :attribute غير صالح.',
    'not_regex' => ':attribute التنسيق غير صالح.',
    'numeric' => ':attribute يجب أن يكون رقما.',
    'present' => ':attribute يجب أن يكون الحقل حاضرا.',
    'regex' => ':attribute التنسيق غير صالح.',
    'required' => ':attribute الحقل مطلوب.',
    'required_if' => ':attribute حقل مطلوب عندما :other يكون :value.',
    'required_unless' => ':attribute الحقل مطلوب ما لم :other يكون في :values.',
    'required_with' => ':attribute حقل مطلوب عندما :values يكون موجود.',
    'required_with_all' => ':attribute حقل مطلوب عندما :values تكن موجود.',
    'required_without' => ':attribute حقل مطلوب عندما :values لا يكون موجود.',
    'required_without_all' => ':attribute حقل مطلوب عندما لا شيء من :values موجودات',
    'same' => ':attribute و :other يجب التوافق',
    'size' => [
        'numeric' => ':attribute يجب أن يكون :size.',
        'file' => ':attribute يجب أن يكون :size كيلوبايت.',
        'string' => ':attribute يجب أن يكون :size حرف.',
        'array' => ':attribute يجب أن يحتوي على :size عنصر.',
    ],
    'starts_with' => ':attribute يجب أن تبدأ بأحد الإجراءات التالية: :values',
    'string' => ':attribute يجب أن يكون سلسلة نص.',
    'timezone' => ':attribute يجب أن تكون منطقة صالحة.',
    'unique' => ':attribute لقد اخذت بالفعل.',
    'uploaded' => ':attribute فشل في التحميل.',
    'url' => ':attribute التنسيق غير صالح.',
    'uuid' => ':attribute يجب أن يكون UUID صالح.',

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
    | The following language lines are used to swap our attribute placeholder
    | with something more reader friendly such as "E-Mail Address" instead
    | of "email". This simply helps us make our message more expressive.
    |
    */

    'attributes' => [],

];
