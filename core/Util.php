<?php

/**
 * Classe responável por manipular e validade dados do sistema.
 */
class Util {

    private static $dado;
    private static $formato;

    /**
     * <b>Verifica E-mail:</b> Executa validação de formato de e-mail. Se for um email válido retorna true, ou retorna false.
     * @param string $email = Uma conta de e-mail
     * @return boolean = true para um email válido, ou false
     */
    public static function validaEmail($email) 
	{
        self::$dado = (string) $email;
        self::$formato = '/[a-z0-9_\.\-]+@[a-z0-9_\.\-]*[a-z0-9_\.\-]+\.[a-z]{2,4}$/';

        if (preg_match(self::$formato, self::$dado)) {
            return true;
        }

        return false;
    }

    /**
     * <b>Tranforma Data:</b> Transforma uma data no formato DD/MM/YY em uma data no formato TIMESTAMP!
     * @param string $name = Data em (d/m/Y) ou (d/m/Y H:i:s)
     * @return string = $data = Data no formato timestamp!
     */
    public static function formataData($data) {
        self::$formato = explode(' ', $data);
        self::$dado = explode('/', self::$formato[0]);

        if (empty(self::$formato[1])) {
            self::$formato[1] = date('H:i:s');
        }

		if (count(self::$dado) > 2) {
        	self::$dado = self::$dado[2] . '-' . self::$dado[1] . '-' . self::$dado[0] . ' ' . self::$formato[1];
		}

        return self::$dado;
    }

	public static function isNumero($numero)
	{
		if (is_numeric($numero) && $numero > 0) {
			return true;
		}
		return false;
	}

	public static function normaliza($texto)
	{
		return trim(addslashes($texto));
	}
}
