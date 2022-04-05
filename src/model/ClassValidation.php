<?php

namespace crud\model;

class ClassValidation
{
     /**
     * Pegando as variaveis de cadastro para limpeza
     */
    protected function cleanData()
    {
        $this->id          = $this->cleanVar($this->id);
        $this->name        = $this->cleanVar($this->name);
        $this->password    = $this->cleanVar($this->password);
    }
    
    /**
     * Limpando as variaveis de cadastro
     * @param  string $values
     * @return string
     */
    protected function cleanVar($values)
    {
        $values           = filter_var($values, FILTER_SANITIZE_STRING);
        $character        = array("<", ">", "@", ";", "[", "]", "(", ")", "{", "}", "/", "\\", "--", "`", "´");
        $values           = str_replace($character, "", $values);
        return trim($values);
    }

    /**
     * Pegando e-mail para verificação
     */
    protected function verifyEmail()
    {
        return $this->verifyEmailVar($this->email);
    }

    /**
     * Verificando se o e-mail é válido
     * @param  string $value
     * @return string||false
     */
    protected function verifyEmailVar($value)
    {
        $value = filter_var($value, FILTER_VALIDATE_EMAIL);
        return $value; 
    }

}