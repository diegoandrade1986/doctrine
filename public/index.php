<?php
/**
 * Created by PhpStorm.
 * User: diego
 * Date: 17/03/16
 * Time: 10:38
 */

/*arquivo de inicializaçao
do autoload e do silex*/
require_once __DIR__."/../bootstrap.php";
use Andrade\Sistema\Service\ClienteService;
use Andrade\Sistema\Entity\Cliente;
use Andrade\Sistema\Mapper\ClienteMapper;
use Symfony\Component\HttpFoundation\Request;

//Use no $em que é passando o entityManager do doctrine
$app['clienteService'] = function () use ($em){
    $clienteEntity = new Cliente();
    $clienteMapper = new ClienteMapper($em);
    $clienteService = new ClienteService($clienteEntity,$clienteMapper);
    return $clienteService;
};

/*
GET /api/clientes - listar todos os clientes
GET /api/clientes/3 - listar apenas 1 cliente passando o id como parametro
POST /api/clientes - Insere novo cliente
PUT /api/clientes/2 - Altera um cliente passando o id como parametro
DELETE /apli/clientes/3 - Deleta um cliente passando o id como parametro
*/

#-------------------------------------------------------Cliente
/*Listando todos os clientes*/
$app->get("/api/clientes",function() use ($app) {
    $dados = $app['clienteService']->fetchAll();
    return $app->json($dados);
});

/*Listando todos os clientes*/
$app->get("/api/clientes/{id}",function($id) use ($app) {
    $dados = $app['clienteService']->find($id);
    return $app->json($dados);
});

/*Inserido um cliente com o post */
/*Usando o request para pegar os dados enviados via post*/
$app->post("/api/clientes",function(Request $request) use ($app) {
    $dados['nome'] = $request->get('nome');
    $dados['email'] = $request->get('email');
    $result = $app['clienteService']->insert($dados);

    return $app->json($result);
});

/*Alterando um cliente com o put */
/*Usando o request para pegar os dados enviados via put*/
$app->put("/api/clientes/{id}",function($id, Request $request) use ($app) {
    $data['nome'] = $request->request->get('nome');
    $data['email'] = $request->request->get('email');
    $result = $app['clienteService']->update($id,$data);

    return $app->json($result);
});
/*Deletando um cliente com o delete */
$app->delete("/api/clientes/{id}",function($id) use ($app) {
    $dados = $app['clienteService']->delete($id);
    return $app->json($dados);
});

/*aplicaçao do silex rodar*/
$app->run();