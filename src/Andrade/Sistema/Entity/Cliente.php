<?php
/**
 * Created by PhpStorm.
 * User: diego
 * Date: 17/03/16
 * Time: 12:27
 */

namespace Andrade\Sistema\Entity;
/** Para fazer o mapeamento do Doctrine */
use Doctrine\ORM\Mapping as ORM;

//Trabalhando com as anotations do doctrine
//Criado a entidade(tabela) para o doctrine
/**
 * @ORM\Entity
 * @ORM\Table(name="clientes")
 */
//------------------------------------------
// Precisamos tbm mapear os campos
class Cliente
{
    /**
     * Falando para o doctrine que a chave primaria e do tipo inteiro e auto_increment
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    private $id;
    /**
     * tipo da coluna + tamanho
     * @ORM\Column(type="string", length=255)
     */
    private $nome;
    /**
     * tipo da coluna + tamanho
     * @ORM\Column(type="string", length=255)
     */
    private $email;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getNome()
    {
        return $this->nome;
    }

    /**
     * @param mixed $nome
     */
    public function setNome($nome)
    {
        $this->nome = $nome;
    }

}