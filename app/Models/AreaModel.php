<?php 
namespace App\Models;

class AreaModel extends BaseModel{
    protected $table="area";
    protected $primaryKey='id';
    protected $protectFields = false;
    protected $alowedFields=[
        'id',
        'nome',
    ];
    /**
     * Cria um array para o dropdow da area
     *
     * @param array|null $params
     * @return void
     */
    public function formDropDow(){
        $this->Select("
        area.id,
        area.nome,
        ");
        $this->orderBy('nome');
        $areaArray= $this->findAll();  
        $optionSelecione = [
            '' => '...selecione'];
        $optionsarea =  $optionSelecione+ array_column($areaArray,'nome','id');
       
       return $optionsarea;
    }
    public function getArea($area){
        $this->Select("
        area.id,
        area.nome,
        ");
        $this->where('area.id',$area);
        return $this->findAll();
    }
}