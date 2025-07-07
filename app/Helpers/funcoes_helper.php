<?php

use CodeIgniter\I18n\Time;



/**
 * Converte uma data em formato EUA para formato Brasileiro
 * Se o segundo parâmetro for true, retorna também com a hora
 *
 * @param [type] $data
 * @param boolean $mostrar_hora
 * @return void
 */
function toDataBR($data, $mostrar_hora = false)
{
    return $mostrar_hora ? date('d/m/Y H:i:s', strtotime($data)) :  date('d/m/Y', strtotime($data));
}

/**
 * Converte uma data no formatd d/m/Y para EUA: Y-m-d
 *
 * @param [type] $data
 * @return void
 */
function toDataEUA($data)
{
    return Time::createFromFormat('d/m/Y', $data)->toDateString();
}



