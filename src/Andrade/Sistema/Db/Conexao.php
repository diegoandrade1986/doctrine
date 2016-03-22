<?php
/**
 * Created by PhpStorm.
 * User: diego
 * Date: 22/03/16
 * Time: 10:46
 */

namespace Andrade\Sistema\Db;


abstract class Conexao
{
    private static function conexao (){
        try {
            $file_db = new \PDO('sqlite:' . __DIR__ . '/../../../../sqlite/products.db');
            $file_db->setAttribute(\PDO::ATTR_ERRMODE,\PDO::ERRMODE_EXCEPTION);
            return $file_db;
        }catch(\PDOException $e){
            echo "Código: {$e->getCode()} <br> Mensagem: {$e->getMessage()} <br>  Arquivo: {$e->getFile()} <br> linha: {$e->getLine()}";
        }
    }

    public static function  getConexao(){
        return self::conexao();
    }
}