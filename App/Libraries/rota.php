<?php

//CLASSE RESPONSAVEL PELAS ROTAS E ORGANIZACAO DAS URLs
class rota{
    
    //.......ATRIBUTOS NECESSÁRIOS RECEBENDO VALORES PADRÃO
    private $Control='paginasController';
    private $metodo='index';
    private $parametros=[];

    //>>>>>>>>>>>CONTRUTOR<<<<<<<<<<<<<<<<<<<
    
    public function __construct(){
       
        //PEGAR A URL ORGANIZADA 
       $url= $this->way() ? $this->way(): [0];

         // VERIFICAR SE ARQUIVO COM O NOME URL[0] EXISTE
        if (file_exists('../App/Controllers/'.ucwords($url[0]).'.php')) {

            //SE EXISTE, A variavel $control recebe o caminho[0] com a inicial maiuscula
             $this->Control=ucwords($url[0]);

             //e em seguida o caminho[0] e retirado
             unset($url[0]);
        }
        
        //O ARQUIVO REQUERIDO DEPENDE DA VARIAVEL $Control
        require_once '../App/Controllers/'.$this->Control.'.php';

        //E LOGO DE SEGUIDA E INSTACIADA A CLASSE DESTE ARQUIVO
        $this->Control = new $this->Control;
        
        //VERIFICAR SE FOI PASSADO UM METODO  NA URL E SE O METODO EXISTE
        if (isset($url[1])) {

            //VERIFICAR SE O METODO EXISTE
            if (method_exists($this->Control, $url[1])) {

                //SE EXISTE,   A VARIAVEL $metodo recebe a url[1]
                $this->metodo=$url[1];

                //E E RETIRADO O caminho[1]
                unset($url[1]);
            }
        }
        
        //PEGAR OS PARAMETROS DA URL
        $this->parametros= $url ? array_values($url): [];
        
        //PASSAR OS ELEMENTOS OBTIDOS DA URL COMO PARAMETROS DO METODO QUE ETORNA     
        //A CLASSE, O MÉTODO E PASSANDO OS PARAMETROS DO MÉTODO EM CASO DE QUE SEJAM PRECISOS.
        call_user_func_array([$this->Control, $this->metodo], $this->parametros);


    }
    
    //FUNCAO QUE PEGA A URL E ORGANIZA 
    public function way(){

        //VARIAVEL QUE PEGA A URL PASSADA EM FILTRO
        $url= filter_input(INPUT_GET,'url',FILTER_SANITIZE_URL);

        //VERIFICAR SE A URL FOI REALMENTE PASSADA 
        if (isset($url)) {

            //SE FOI PASSADA, ELIMIJNAR CARECTERES ESPECIAIS DEIXANDO APENAS BARRAS '/'
            $url=trim(rtrim($url,'/'));

            //TRANSFOR A URL EM UM ARRAY DE FORMA A QUE TUDO, DELIMITADO POR BARRA, ESTEJA EM UMA POSICAO DO ARRAY
            $url=explode('/',$url);

            //RETORNAR A URL EM  ARRAY 
            return $url;
        }
          
    }
}