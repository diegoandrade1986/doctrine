<?php
/**
 * Created by PhpStorm.
 * User: diego
 * Date: 18/03/16
 * Time: 15:57
 */

require_once 'vendor/autoload.php';

/**
 *
 * Realizando as Configuraçoes do Doctrine
 * Sempre será utilizada dessa mesma forma ctrl + c e ctrl + v
 *
 */
use Doctrine\ORM\Tools\Setup,
    Doctrine\ORM\EntityManager,
    Doctrine\Common\EventManager as EventManager,
    Doctrine\ORM\Events,
    Doctrine\ORM\Configuration,
    Doctrine\Common\Cache\ArrayCache as Cache,
    Doctrine\Common\Annotations\AnnotationRegistry,
    Doctrine\Common\Annotations\AnnotationReader,
    Doctrine\Common\ClassLoader;

$cache = new Doctrine\Common\Cache\ArrayCache;
$annotationReader = new Doctrine\Common\Annotations\AnnotationReader;

$cachedAnnotationReader = new \Doctrine\Common\Annotations\CachedReader(
  $annotationReader, // use reader
  $cache // drive de cache
);
// Buscando a nossa pasta de codigo Fonte
$annotationDriver = new \Doctrine\ORM\Mapping\Driver\AnnotationDriver(
    $cachedAnnotationReader, // nossa anotaçao do cache
    array(__DIR__ . DIRECTORY_SEPARATOR . 'src')
);
/* para registrar o nome da nossa aplicaçao principal o namespace principal*/
$driverChain = new \Doctrine\ORM\Mapping\Driver\DriverChain();
$driverChain->addDriver($annotationDriver,"Andrade");

/**
 *
 * Configuraçoes Gerais
 *
 */

$config = new Doctrine\ORM\Configuration;
/**
 * Simulando diretorio do proxy
 */
$config->setProxyDir('/tmp');
$config->setProxyNamespace('Proxy');
$config->setAutoGenerateProxyClasses(true);
// registrando metadata driver
$config->setMetadataDriverImpl($driverChain);
//use our allready initialized cache driver
$config->setMetadataCacheImpl($cache);
$config->setQueryCacheImpl($cache);

//Onde ficara as nossas anotations onde ficara tudo que o doctrine vai ler
AnnotationRegistry::registerFile(__DIR__. DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'doctrine' . DIRECTORY_SEPARATOR . 'orm' . DIRECTORY_SEPARATOR . 'lib' . DIRECTORY_SEPARATOR . 'Doctrine' . DIRECTORY_SEPARATOR . 'ORM' . DIRECTORY_SEPARATOR . 'Mapping' . DIRECTORY_SEPARATOR . 'Driver' . DIRECTORY_SEPARATOR . 'DoctrineAnnotations.php');

//Event Mannager do Doctrine
$evm = new Doctrine\Common\EventManager();

/**
 * Entity Manager
 * Ele vai gerenciar todas as entidades criadas no sistema
 * Ele que vai dizer quando pode inserir alterar e etc
 * Toda configuraçao feita anteriormente basicamente foi feita pra o EntityManger
 */

$em = EntityManager::create(
    array(
        'driver' => 'pdo_mysql',
        'host' => 'localhost',
        'port' => '3306',
        'user' => 'root',
        'password' => 'criasoft',
        'dbname' => 'aula_doctrine'
    ),
    $config,
    $evm
);

/**
 *
 * Finalizado configuraçoes do doctrine
 *
 */


//instaciando a classe silex
$app = new \Silex\Application();

// para mostrar os erros que estao acontecendo
$app['debug'] = true;


// REGISTRANDO O TWIG NO SILEX PARA ELE FAZER AS CONFIGURAÇÔES
$app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => __DIR__.'/views',
));

//REGISTRANDO O SERVICO DE URL
$app->register(new Silex\Provider\UrlGeneratorServiceProvider());