<?php
/**
 * Não é a forma ideal ainda!
 *
 * Arquivos com funções úteis aqui e ali. O ideal seria
 * ser ao menos uma classe estática, para ser usado tipo
 * Helper::meuMetodo()
 */

// Verifica se a pasta é "gravável", se existe permissão de escrita
function isWritablePath($xpath)
{
    $isOK = false;
    $path = trim($xpath);
    if (($path != "") && is_dir($path) && is_writable($path)) {
        $tmpfile = "mPC_" . uniqid(mt_rand()) . '.writable';
        $fullpathname = str_replace('//', '/', $path . "/" . $tmpfile);
        $fp = @fopen($fullpathname, "w");
        if ($fp !== false) {
            $isOK = true;
        }
        @fclose($fp);
        @unlink($fullpathname);
    }
    return $isOK;
}
