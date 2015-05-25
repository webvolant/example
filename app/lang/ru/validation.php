<?php

return array(

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

	"accepted"             => "The :attribute must be accepted.",
	"active_url"           => "The :attribute is not a valid URL.",
	"after"                => "The :attribute must be a date after :date.",
	"alpha"                => "The :attribute may only contain letters.",
	"alpha_dash"           => "The :attribute may only contain letters, numbers, and dashes.",
	"alpha_num"            => "The :attribute may only contain letters and numbers.",
	"array"                => "The :attribute must be an array.",
	"before"               => "The :attribute must be a date before :date.",
	"between"              => array(
		"numeric" => "The :attribute must be between :min and :max.",
		"file"    => "The :attribute must be between :min and :max kilobytes.",
		"string"  => "The :attribute must be between :min and :max characters.",
		"array"   => "The :attribute must have between :min and :max items.",
	),
	"boolean"              => "Атрибут :attribute field must be true or false.",
	"confirmed"            => "Атрибут :attribute confirmation does not match.",
	"date"                 => "Атрибут :attribute is not a valid date.",
	"date_format"          => "Атрибут :attribute does not match the format :format.",
	"different"            => "Атрибут :attribute and :other must be different.",
	"digits"               => "Атрибут :attribute must be :digits digits.",
	"digits_between"       => "Атрибут :attribute must be between :min and :max digits.",
	"email"                => "Атрибут :attribute должен быть почтовым адресом.",
	"exists"               => "Атрибут :attribute не верный, или его не существует в нашей базе данных. Возможно вы не записывались на прием?",
	"image"                => "Атрибут :attribute должен быть изображением.",
	"in"                   => "Атрибут selected :attribute is invalid.",
	"integer"              => "Атрибут :attribute must be an integer.",
	"ip"                   => "Атрибут :attribute must be a valid IP address.",
	"max"                  => array(
		"numeric" => "Атрибут - :attribute may not be greater than :max.",
		"file"    => "Атрибут - :attribute may not be greater than :max kilobytes.",
		"string"  => "Атрибут - :attribute may not be greater than :max characters.",
		"array"   => "Атрибут - :attribute may not have more than :max items.",
	),
	"mimes"                => "The :attribute must be a file of type: :values.",
	"min"                  => array(
		"numeric" => "The :attribute must be at least :min.",
		"file"    => "The :attribute must be at least :min kilobytes.",
		"string"  => "The :attribute must be at least :min characters.",
		"array"   => "The :attribute must have at least :min items.",
	),
	"not_in"               => "The selected :attribute is invalid.",
	"numeric"              => "The :attribute must be a number.",
	"regex"                => "The :attribute format is invalid.",
	"required"             => "Атрибут :attribute обязателен.",
	"required_if"          => "Атрибут :attribute field is required when :other is :value.",
	"required_with"        => "Атрибут :attribute field is required when :values is present.",
	"required_with_all"    => "Атрибут :attribute field is required when :values is present.",
	"required_without"     => "Атрибут :attribute field is required when :values is not present.",
	"required_without_all" => "Атрибут :attribute field is required when none of :values are present.",
	"same"                 => "Атрибут :attribute and :other must match.",
	"size"                 => array(
		"numeric" => "The :attribute must be :size.",
		"file"    => "The :attribute must be :size kilobytes.",
		"string"  => "The :attribute must be :size characters.",
		"array"   => "The :attribute must contain :size items.",
	),
	"unique"               => " :attribute уже существует, должен быть уникальным.",
	"url"                  => "The :attribute format is invalid.",
	"timezone"             => "The :attribute must be a valid zone.",

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

	'custom' => array(
		'attribute-name' => array(
			'rule-name' => 'custom-message',
		),
	),

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

	'attributes' => array(
        'phone'=>'Телефон',
        'reviewStars'=>'Квалификация',
        'reviewStars2'=>'Внимание',
        'reviewStars3'=>'Цена-качество',
        'comment'=>'Комментарий',
        'name'=>'Имя',
        'email'=>'email',
    ),

);
