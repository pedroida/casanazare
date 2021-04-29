<?php

return [

    'common' => [
        'confirmation' => [
            'destroy' => 'Tem certeza que deseja remover este registro?',
        ],
        'success' => [
            'create' => 'Cadastro realizado com sucesso.',
            'update' => 'Registro alterado com sucesso.',
            'destroy' => 'Registro removido com sucesso.',
        ],
        'error' => [
            'create' => 'Ocorreu um erro ao incluír este registro. Por favor, verifque se os dados foram preenchidos corretamente e tente novamente.',
            'destroy' => 'Ocorreu um erro ao remover este registro. Por favor, tente novamente.',
            'update' => 'Ocorreu um erro ao alterar este registro. Por favor, verifque os dados e tente novamente.',
        ],
    ],

    'admin' => [
        'error' => [
            'self_delete' => 'Não é possível remover o usuário corrente.'
        ]
    ],

    'auth' => [
        'success' => [
            'reset_password' => 'Nova senha cadastrada com sucesso!',
        ]
    ],

    'client' => [
        'error' => [
            'has_stay' => 'O acolhido ainda possui hospedagem em aberto',
        ]
    ],

    'stays' => [
        'import' => [
            'success' => 'A importação está sendo realizada em segundo plano'
        ]
    ]

];
