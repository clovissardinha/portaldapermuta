<?php 
namespace App\Models;


use CodeIgniter\Model;


class BaseModel extends Model {
    
        
    /**
     * Converte a data para o formato americano
     *
     * @param [type] $data
     * @return void
     */
    protected function converteData($data)
    {

        helper('funcoes');

        if (!isset($data['data']['data'])) {
            return $data;
        }

        $data['data']['data'] = toDataEUA($data['data']['data']);
        return $data;
    }

    /**
     * Função para trocar a virgula por ponto e vice versa em valores que vão para o bd
     *
     * @return void
     */
            protected function corrigeValor($data){
                if(!isset($data['data']['valor'])){
                    return $data;
                }
                $data['data']['valor']=str_replace('.','',$data['data']['valor']);
                $data['data']['valor']=str_replace(',','.',$data['data']['valor']);
                return $data;
            }
 
   ###########################################################################
   #############   METODOS PÚBLICOS
   ###########################################################################
   
   /**
    * injeta a busca por data na query
    *
    * @param [type] $dataInicial
    * @param [type] $dataFinal
    * @return object
    */
  
     
  
  
   /**
    * injeta o campo mês na query
    *
    * @param [type] $mes
    * @return object
    */
   public function addMes($mes):object{
        if(!is_null($mes)){
            $this->where('MONTH(data)',$mes);
        }
        return $this;       
   }
   /**
    * injeta o campo ano na query
    *
    * @param [type] $ano
    * @return object
    */
    public function addAno($ano):object{
        if(!is_null($ano)){
            $this->where('YEAR(data)',$ano);
        }
        return $this;       
   }
     
        
   
   /**
    * retorna todos os registros
    *
    * @return void
    */
   public function getAll(){
    return $this->findAll();
   }
   /**
    * injeta a busca por ativo na query
    *
    * @param [type] $tipo
    * @return object
    */
   public function addAtivo($ativo =null):object{
    if(!is_null($ativo)){
        $this->where('ativo',$ativo);           
    }
    return $this;
}
   
   


   
    
    
    //injeta a função de ordenar na query
    
    public function addOrder(array $order=null){
        if (!is_null($order)){
            if (key_exists('order',$order)){
                foreach ($order['order'] as $ordem){
                    $this->orderBy($ordem['campo'],$ordem['sentido']);
                }
            }
            else {
                $this->orderBy($order['campo'],$order['sentido']);
            }
            
            return $this;
        }
    }
  
    /**
     * injeta a busca por like na query
     * se o parametro or for true faz a busca por orlike
     *
     * @param string|null $search
     * @param string|null $campo
     * @param string $or
     * @return object
     */
    public function addSearch(string $search=null, string $campo=null,string $or='null'):object {
        if (!is_null($search) && !is_null($campo)) {
            if(!is_null($or)){
               $this->orlike($campo,$search) ; 
            }
            else {
                $this->like($campo,$search) ; 
            }
            
        }
        return $this;
    }
}