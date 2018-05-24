<?php
/**
 * Created by PhpStorm.
 * User: leonardo
 * Date: 19/05/18
 * Time: 15:59
 */

    class Nome {
        static function incluir($nome) {
            $_SESSION['nomes'][] = $nome;
        }

        static function getAll() {
            return $_SESSION['nomes'];
        }
    }