<?php
/**
 * Created by PhpStorm.
 * User: diego
 * Date: 17/03/16
 * Time: 12:29
 */

namespace Andrade\Sistema\Mapper;
use Andrade\Sistema\Entity\Cliente;
use Doctrine\ORM\EntityManager;
class ClienteMapper
{
    private $em;

    public function __construct(EntityManager $em)
    {
        /**
         * Fazendo uma injeçao de dependencia
         * para poder instaciar o EntityManager
        */
        $this->em = $em;
    }

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
        $this->em->persist($cliente);
        $this->em->flush();
        return [
            'sucess'=> true,
            'id'=>$cliente->getId(),
            'nome'=>$cliente->getNome(),
            'email'=>$cliente->getEmail()
        ];
    }

    public function update($id, array $array)
    {
        return [
            'sucess'=> true
        ];

    }
    public function delete(Cliente $cliente)
    {

        $cliente = $this->em->getReference('Sistema\Entity\Cliente', $cliente->getId());
        exit("pau");
        $this->em->remove($cliente);
        $this->em->flush();
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