<?php

namespace Alura\BuscadorCursos;

class TesteClassmap
{

    public static function metodo()
    {
        echo "teste" . PHP_EOL;
    }
}
//Neste arquivo foram incluídas duas classes, apenas para teste do uso do autoload do Composer
//A boa prática requer que cada classe tenha seu próprio arquivo

//Para testar basta apenas descomentar o código abaixo

/*class TesteClassmap2
{
    public static function metodo()
    {
        echo "teste" . PHP_EOL;
    }
}*/
