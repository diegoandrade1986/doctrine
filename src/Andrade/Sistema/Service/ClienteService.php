<?php
/**
 * Created by PhpStorm.
 * User: diego
 * Date: 17/03/16
 * Time: 12:40
 */

namespace Andrade\Sistema\Service;
use Andrade\Sistema\Entity\Cliente as ClienteEntity;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Query;

class ClienteService
{
    private $em;
    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    public function insert(array $data)
    {
        $clienteEntity = new ClienteEntity();
        $clienteEntity->setNome($data['nome']);
        $clienteEntity->setEmail($data['email']);
        // persist -> inserindo no banco de dados passando um objeto
        $this->em->persist($clienteEntity);
        $this->em->flush();
        return $clienteEntity;
    }
    public function update($id,array $array)
    {
        /*
         Modo errado pois teria que realizar uma consulta novamente
         /$repository = $this->em->getRepository("Andrade\Sistema\Entity\Cliente");
        /**
         * Dentro do repository conseguimos trabalhar com varios metodos

        $cliente = $repository->find($id); //com isso ja temos a entidade cliente
        */

        $cliente = $this->em->getReference("Andrade\Sistema\Entity\Cliente",$id);
        // getReference ela Imita como se tivesse buscado o cliente no banco
        // ela eh uma entidade vazia mas para o nosso sistema ela e uma entidade correta para fazermos as nossas alteraçoes
        $cliente->setNome($array['nome']);
        $cliente->setEmail($array['email']);

        $this->em->persist($cliente);
        $this->em->flush();
        return $cliente;
    }

    public function fetchAll()
    {
        $repo = $this->em->getRepository("Andrade\Sistema\Entity\Cliente");
        //$result =  $repo->getClientesOrdenados();
        $result =  $repo->findAll();
        return $result;

        /*
         * Documentaçao
         * http://doctrine-orm.readt    hedocs.org/en/latest/reference/dql-doctrine-query-language.html#array-hydration
        */

    }

    public function find($id)
    {
        $repo = $this->em->getRepository("Andrade\Sistema\Entity\Cliente");
        return $repo->find($id);
    }
    public function delete($id)
    {
        $cliente = $this->em->getReference("Andrade\Sistema\Entity\Cliente",$id);
        // getReference ela Imita como se tivesse buscado o cliente no banco
        // ela eh uma entidade vazia mas para o nosso sistema ela e uma entidade correta para fazermos as nossas alteraçoes
        $this->em->remove($cliente);
        return true;

    }

}