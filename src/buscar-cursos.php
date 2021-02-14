<?php

//============================Criação do buscador de cursos sem usar orientação a objetos==============================

/*require 'vendor/autoload.php';

use GuzzleHttp\Client;

use Symfony\Component\DomCrawler\Crawler;*/

//O pacote guzzlehttp/guzzle fornce um cliente PHP HTTP que facilita o envio de solicitações HTTP e integração com serviços web.
//Conforme documentação da dependência/pacote guzzlehttp/guzzle devemos instanciar a classe Client e armazenar o retorno da requisição
//ao site que desejamos trabalhar em uma varíavel. Note que este retorno é o DOM, ou seja, o DOM é armazenado em uma variável que
//chamamos de $html.
//Depois, ainda na documentação do pacote, é apresentada formas de trabalhar com o DOM
//No nosso caso, iremos usar a função getBody(), para pegar o corpo do DOM, conforme abaixo

/*$client = new Client(['verify' => false]); //Se declararmos somente $client = new Client(); ocorrerá erro de certificação do site

$resposta = $client->request('GET','https://www.alura.com.br/cursos-online-programacao/php');

$html = $resposta->getBody();*/


//Já o pacote symfony/dom-crawler fornece uma classe com métodos para consultar e manipular documentos HTML e XML
//Conforme documentação desta dependência devemos instanciar a classe Crawler cujo construtor recebe um documento HTML ou XML
//como parâmentro. No nosso caso, enviamos a variável $html criada e inicializada anteriormente contendo o corpo do DOM
//Depois usamos a função filter para selecionar os elementos do DOM conforme o parâmetro passado, no nosso caso 'span.card-curso__nome',
//e armazenar em uma variável ($cursos). Esta variável será um espécie de array contendo os elementos selecionados do DOM
//Portanto, usando o forech podemos buscar o conteúdo de todos os elementos deste "array" e imprimi-los.

/*$crawler = new Crawler();

$crawler->addHtmlContent($html);

$cursos = $crawler->filter('span.card-curso__nome');

foreach($cursos as $curso)
{
    echo '<pre>';
    echo $curso->textContent .PHP_EOL;
    echo '</pre>';
}*/
//============================Criação do buscador de cursos usando a orientação a objetos============================================

//Usando orientação a objetos, criamos o arquivo buscador.php contendo uma classe buscador cujo construtor recebe como parâmetros
//um client e um crawler e, possui um função buscar para buscar o cursos.

require 'vendor/autoload.php';  //autoload do Composer para carragamento das classes das dependências importadas do Packagist

//O Grupo PhP Framework Interop mais comumente denominado PHP-FIG recomenda padrões para aproveitamento de códigos entre projetos
//Por exemplo, ele recomenda o padrão do autoload (psr-4)
//Se fossemos incluir uma "require" em nosso projeto a cada classe usada seria muito trabalhoso, portanto, podemos usar o autolaod do
//Composer.
//Para isto, incluímos no arquivo .json o código abaixo e depois digitamos na linha de comando do prompt composer dumpautoload para que
//o autoload do composer seja atualizado.
/*
,
    "autoload": {
        "psr-4": {
            "Alura\\BuscadorCursos\\": "src/"       //Aqui incluimos o namespace padrão do projeto e o diretório do projeto
        }                                           //Lembrando que o nome da classe deve ser igual ao nome o arquivo
    }                                               //O Composer atualiza o arquivo autoload_psr4.php dentro da pasta composer
                                                    //incluindo 'Alura\\BuscadorCursos\\' => array($baseDir . '/src')

Podemos usar ainda o autoload do Composer para carregar classes que não usam o padrão PSR-4, ou seja, cujos os namespaces não seguem
o padrão PSR-4. Para isto, incluimos no arquivo .json o código abaixo e depois executamos composer dumpautoload no prompt. Com isto,
inclusive podemos incluir arquivos que possuem 2 classe, no entanto, isto não é uma boa prática de programção orientada a objetos visto
que cada classe deverá estar em um arquuivo.
,
    "autoload": {
        "classmap": ['./teste.php']                 //O arquivo ou pasta onde a(s) classe(s) está(ão) se encontra(m) deve estar dentro do diretório
    }                                               //do programa principal
                                                    //Note que podemos ter várias classes no arquivo e todas elas serão carregadas
                                                    //O Composer atualiza o arquivo autoload_classemap.phc dentro da pasta composer
                                                    //incluindo 'TesteClassmap2' => $baseDir . '/teste.php' dentro um array
                                                    //Podemos ainda incluir os caminhos de vários arquivos dentro  do "classmap" do .json
                                                    //Por exemplo,... "classmap": ['./teste.php','./novotest2.php']...

Se quisermos inlcuir no nosso projeto um arquivo contendo funções e não classes, podemos carregá-los automaticamente usando o autoload
do Composer assim como fizemos com os arquivos contendo classes.
Para isto incluímos no arquivo .jscon o código abaixo e depois atualizamos o autoload do Composer executando no prompt dumpautoload
,
"autoload": {
        "files": ["./funcoes.php"]      //O Composer atualiza o arquivo autoload_files.phc dentro da pasta composer
    }                                   //incluido '4ea1b742bb2e5c7af5c77cb8e6863699' => $baseDir . '/src/funcoes.php' dentro de um
                                        //array
                                        //Podemos ainda incluir os caminhos de vários arquivos dentro  do "files" do .json
                                        //Por exemplo,..."files": ["./src/funcoes.php", ".src/novasfuncoes.php"]...
*/

//CÓDIGO PARA TESTE DE USO DO AUTOLOAD DO COMPOSER
/*TesteClassmap::metodo();
TesteClassmap2::metodo();
exibemensagem("FELIZ 2021!!!!!!!");
exit();*/



use Alura\BuscadorCursos\buscador;
use GuzzleHttp\Client;
use Symfony\Component\DomCrawler\Crawler;

//Podemos passar uma URL base como parâmetro do contrutor da classe client, assim quando o objeto criado for chamar a função request
//usamos apenas o resto da URL
//Lembrando que incluimos 'verify'=>false para que obtemos a página desconsiderando a verificação de autenticidade/segurança do site buscado
$client = new Client(['verify' => false,'base_uri' => 'https://www.alura.com.br']);


$crawler = new Crawler();
$buscador = new Buscador($client, $crawler);

$cursos = $buscador->buscarCursos('/cursos-online-programacao/php');

foreach ($cursos as $curso) {
    echo $curso . PHP_EOL;
}
