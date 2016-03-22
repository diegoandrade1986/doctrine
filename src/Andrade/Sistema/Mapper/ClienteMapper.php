<?php
/**
 * Created by PhpStorm.
 * User: diego
 * Date: 17/03/16
 * Time: 12:29
 */

namespace Andrade\Sistema\Mapper;
use Andrade\Sistema\Entity\Cliente;

class ClienteMapper
{
    private $dados = [
      0 => [
          'id'=> 0,
          'nome' => 'Cliente XPTO',
          'email' => 'Clientexptoo@email.com'
      ],
        1 => [
            'id'=> 1,
            'nome' => 'Cliente Y',
            'email' => 'Clientey@email.com'
        ]
    ];
    public function insert(Cliente $cliente)
    {
        return [
            'sucess'=> true
        ];
    }

    public function update($id, array $array)
    {
        return [
            'sucess'=> true
        ];

    }
    public function delete($id)
    {
        return [
            'sucess'=> true
        ];

    }
    public function find($id)
    {
        return $this->dados[$id];
    }

    public function fetchAll()
    {
        $dados = $this->dados;
        return $dados;
    }

}