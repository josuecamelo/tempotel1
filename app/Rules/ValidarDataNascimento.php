<?php

namespace App\Rules;

use Carbon\Carbon;
use Illuminate\Contracts\Validation\Rule;

class ValidarDataNascimento implements Rule
{
    private $erro = '';
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $saida = true;

        $data = explode('/', $value);

        if(!in_array($data[1], ['01','02', '03', '04', '05', '06', '07', '08', '09','10','11','12'])){
            $this->erro = 'O Mês Informado na Data -> "' . $data[1] . '" é Inválido';
            $saida = false;
        }

        if((int) $data[0] > 31){
            $this->erro = 'O Dia Informado na Data -> "' . $data[0] . '" é Inválido';
            $saida = false;
        }

        $dataNascimento = Carbon::createFromFormat('Y-m-d', \DateTime::createFromFormat('d/m/Y', $value)
            ->format('Y-m-d'))->format('Y-m-d');

        $dataAtual = Carbon::now();
        $diffAnos = $dataAtual->diffInYears($dataNascimento);

        if($diffAnos < 18){
            $this->erro = 'O Cliente em Questão é Menor de Idade e não pode realizar Pedidos.';
            $saida = false;
        }

        return $saida;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return $this->erro;
    }
}
