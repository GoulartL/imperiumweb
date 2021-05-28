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

    'accepted'             => 'Este campo deve ser aceito.',
    'active_url'           => 'Este campo não é uma URL válida.',
    'after'                => 'Este campo deve ser uma data posterior a :date.',
    'after_or_equal'       => 'Este campo deve ser uma data posterior ou igual a :date.',
    'alpha'                => 'Este campo só pode conter letras.',
    'alpha_dash'           => 'Este campo só pode conter letras, números e traços.',
    'alpha_num'            => 'Este campo só pode conter letras e números.',
    'array'                => 'Este campo deve ser uma matriz.',
    'before'               => 'Este campo deve ser uma data anterior :date.',
    'before_or_equal'      => 'Este campo deve ser uma data anterior ou igual a :date.',
    'between'              => [
        'numeric' => 'Este campo deve ser entre :min e :max.',
        'file'    => 'Este campo deve ser entre :min e :max kilobytes.',
        'string'  => 'Este campo deve ser entre :min e :max caracteres.',
        'array'   => 'Este campo deve ter entre :min e :max itens.',
    ],
    'boolean'              => 'Este campo deve ser verdadeiro ou falso.',
    'confirmed'            => 'Este campo de confirmação não confere.',
    'date'                 => 'Este campo não é uma data válida.',
    'date_equals'          => 'Este campo deve ser uma data igual a :date.',
    'date_format'          => 'Este campo não corresponde ao formato :format.',
    'different'            => 'Os campos e :other devem ser diferentes.',
    'digits'               => 'Este campo deve ter :digits dígitos.',
    'digits_between'       => 'Este campo deve ter entre :min e :max dígitos.',
    'dimensions'           => 'Este campo tem dimensões de imagem inválidas.',
    'distinct'             => 'Este campo tem um valor duplicado.',
    'email'                => 'Este campo deve ser um endereço de e-mail válido.',
    'ends_with'            => 'Este campo deve terminar com um dos seguintes: :values',
    'exists'               => 'Este campo selecionado é inválido.',
    'file'                 => 'Este campo deve ser um arquivo.',
    'filled'               => 'Este campo deve ter um valor.',
    'gt' => [
        'numeric' => 'Este campo deve ser maior que :value.',
        'file'    => 'Este campo deve ser maior que :value kilobytes.',
        'string'  => 'Este campo deve ser maior que :value caracteres.',
        'array'   => 'Este campo deve conter mais de :value itens.',
    ],
    'gte' => [
        'numeric' => 'Este campo deve ser maior ou igual a :value.',
        'file'    => 'Este campo deve ser maior ou igual a :value kilobytes.',
        'string'  => 'Este campo deve ser maior ou igual a :value caracteres.',
        'array'   => 'Este campo deve conter :value itens ou mais.',
    ],
    'image'                => 'Este campo deve ser uma imagem.',
    'in'                   => 'Este campo selecionado é inválido.',
    'in_array'             => 'Este campo não existe em :other.',
    'integer'              => 'Este campo deve ser um número inteiro.',
    'ip'                   => 'Este campo deve ser um endereço de IP válido.',
    'ipv4'                 => 'Este campo deve ser um endereço IPv4 válido.',
    'ipv6'                 => 'Este campo deve ser um endereço IPv6 válido.',
    'json'                 => 'Este campo deve ser uma string JSON válida.',
    'lt' => [
        'numeric' => 'Este campo deve ser menor que :value.',
        'file'    => 'Este campo deve ser menor que :value kilobytes.',
        'string'  => 'Este campo deve ser menor que :value caracteres.',
        'array'   => 'Este campo deve conter menos de :value itens.',
    ],
    'lte' => [
        'numeric' => 'Este campo deve ser menor ou igual a :value.',
        'file'    => 'Este campo deve ser menor ou igual a :value kilobytes.',
        'string'  => 'Este campo deve ser menor ou igual a :value caracteres.',
        'array'   => 'Este campo não deve conter mais que :value itens.',
    ],
    'max' => [
        'numeric' => 'Este campo não pode ser superior a :max.',
        'file'    => 'Este campo não pode ser superior a :max kilobytes.',
        'string'  => 'Este campo não pode ser superior a :max caracteres.',
        'array'   => 'Este campo não pode ter mais do que :max itens.',
    ],
    'mimes'                => 'Este campo deve ser um arquivo do tipo: :values.',
    'mimetypes'            => 'Este campo deve ser um arquivo do tipo: :values.',
    'min' => [
        'numeric' => 'Este campo deve ser pelo menos :min.',
        'file'    => 'Este campo deve ter pelo menos :min kilobytes.',
        'string'  => 'Este campo deve ter pelo menos :min caracteres.',
        'array'   => 'Este campo deve ter pelo menos :min itens.',
    ],
    'not_in'               => 'Este campo selecionado é inválido.',
    'not_regex'            => 'Este campo possui um formato inválido.',
    'numeric'              => 'Este campo deve ser um número.',
    'password'             => 'A senha está incorreta.',
    'present'              => 'Este campo deve estar presente.',
    'regex'                => 'Este campo tem um formato inválido.',
    'required'             => 'Este campo é obrigatório.',
    'required_if'          => 'Este campo é obrigatório quando :other for :value.',
    'required_unless'      => 'Este campo é obrigatório exceto quando :other for :values.',
    'required_with'        => 'Este campo é obrigatório quando :values está presente.',
    'required_with_all'    => 'Este campo é obrigatório quando :values está presente.',
    'required_without'     => 'Este campo é obrigatório quando :values não está presente.',
    'required_without_all' => 'Este campo é obrigatório quando nenhum dos :values estão presentes.',
    'same'                 => 'Os campos e :other devem corresponder.',
    'size'                 => [
        'numeric' => 'Este campo deve ser :size.',
        'file'    => 'Este campo deve ser :size kilobytes.',
        'string'  => 'Este campo deve ser :size caracteres.',
        'array'   => 'Este campo deve conter :size itens.',
    ],
    'starts_with'          => 'Este campo deve começar com um dos seguintes valores: :values',
    'string'               => 'Este campo deve ser uma string.',
    'timezone'             => 'Este campo deve ser uma zona válida.',
    'unique'               => 'Este campo já está sendo utilizado.',
    'uploaded'             => 'Ocorreu uma falha no upload dEste campo :attribute.',
    'url'                  => 'Este campo tem um formato inválido.',
    'uuid' => 'Este campo deve ser um UUID válido.',

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

    'attributes' => [
        'address'   => 'endereço',
        'age'       => 'idade',
        'body'      => 'conteúdo',
        'cell'      => 'celular',
        'city'      => 'cidade',
        'country'   => 'país',
        'date'      => 'data',
        'day'       => 'dia',
        'excerpt'   => 'resumo',
        'first_name'=> 'primeiro nome',
        'gender'    => 'gênero',
        'hour'      => 'hora',
        'last_name' => 'sobrenome',
        'message'   => 'mensagem',
        'minute'    => 'minuto',
        'mobile'    => 'celular',
        'month'     => 'mês',
        'name'      => 'nome',
        'neighborhood' => 'bairro',
        'number'    => 'número',
        'password'  => 'senha',
        'phone'     => 'telefone',
        'second'    => 'segundo',
        'sex'       => 'sexo',
        'state'     => 'estado',
        'street'    => 'rua',
        'subject'   => 'assunto',
        'text'      => 'texto',
        'time'      => 'hora',
        'title'     => 'título',
        'username'  => 'usuário',
        'year'      => 'ano',
        'description' => 'descrição',
        'password_confirmation' => 'confirmação da senha',
    ],

];
