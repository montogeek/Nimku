<?php 

return array(

	/*
	|--------------------------------------------------------------------------
	| Validation Language Lines
	|--------------------------------------------------------------------------
	|
	| The following language lines contain the default error messages used
	| by the validator class. Some of the rules contain multiple versions,
	| such as the size (max, min, between) rules. These versions are used
	| for different input types such as strings and files.
	|
	| These language lines may be easily changed to provide custom error
	| messages in your application. Error messages for custom validation
	| rules may also be added to this file.
	|
	*/

	"accepted"       => "El :attribute debe ser aceptado.",
	"active_url"     => "El :attribute no es una URL válida.",
	"after"          => "El :attribute debe ser después de :date.",
	"alpha"          => "El :attribute solo puede tener letras.",
	"alpha_dash"     => "El :attribute solo puede tener letras, números, y guiones.",
	"alpha_num"      => "El :attribute solo puede tener letras y números.",
	"array"          => "El :attribute debe tener elementos seleccionados.",
	"before"         => "El :attribute debe ser antes de :date.",
	"between"        => array(
		"numeric" => "El :attribute debe estar entre :min - :max.",
		"file"    => "El :attribute debe estar entre :min - :max kilobytes.",
		"string"  => "El :attribute debe estar entre :min - :max caracteres.",
	),
	"confirmed"      => "El :attribute confirmación no se ha seleccionado.",
	"count"          => "El :attribute debe tener exactamente :count elementos seleccionados.",
	"countbetween"   => "El :attribute debe estar entre :min y :max elementos seleccionados.",
	"countmax"       => "El :attribute debe tener menos de :max elementos seleccionados.",
	"countmin"       => "El :attribute debe tener al menos :min elementos seleccionados.",
	"different"      => "El :attribute y :other deben ser diferentes.",
	"email"          => "El :attribute tiene un formato inválido.",
	"exists"         => "El :attribute seleccionado es inválido.",
	"image"          => "El :attribute dede ser una imagen.",
	"in"             => "El :attribute seleccionado es inválido.",
	"integer"        => "El :attribute debe ser un entero.",
	"ip"             => "El :attribute debe ser una IP válida.",
	"match"          => "El :attribute tiene un formato inválido.",
	"max"            => array(
		"numeric" => "El :attribute debe ser menos de :max.",
		"file"    => "El :attribute debe ser menos de :max kilobytes.",
		"string"  => "El :attribute debe ser menos de :max caracteres.",
	),
	"mimes"          => "El :attribute debe ser del tipo: :values.",
	"min"            => array(
		"numeric" => "El :attribute debe ser mínimo de :min.",
		"file"    => "El :attribute debe ser mínimo de :min kilobytes.",
		"string"  => "El :attribute debe ser mínimo de :min caracteres.",
	),
	"not_in"         => "El :attribute seleccionado es inválido.",
	"numeric"        => "El :attribute debe ser un nombre.",
	"required"       => "El :attribute es requerido.",
	"same"           => "El :attribute y :other deben ser iguales.",
	"size"           => array(
		"numeric" => "El :attribute debe ser :size.",
		"file"    => "El :attribute debe ser :size kilobyte.",
		"string"  => "El :attribute debe ser :size caracteres.",
	),
	"unique"         => "El :attribute ya ha sido tomado.",
	"url"            => "El :attribute tiene un formato inválido.",

	/*
	|--------------------------------------------------------------------------
	| Custom Validation Language Lines
	|--------------------------------------------------------------------------
	|
	| Here you may specify custom validation messages for attributes using the
	| convention "attribute_rule" to name the lines. This helps keep your
	| custom validation clean and tidy.
	|
	| So, say you want to use a custom validation message when validating that
	| the "email" attribute is unique. Just add "email_unique" to this array
	| with your custom message. The Validator will handle the rest!
	|
	*/

	'custom' => array(),

	/*
	|--------------------------------------------------------------------------
	| Validation Attributes
	|--------------------------------------------------------------------------
	|
	| The following language lines are used to swap attribute place-holders
	| with something more reader friendly such as "E-Mail Address" instead
	| of "email". Your users will thank you.
	|
	| The Validator class will automatically search this array of lines it
	| is attempting to replace the :attribute place-holder in messages.
	| It's pretty slick. We think you'll like it.
	|
	*/

	'attributes' => array(),

);