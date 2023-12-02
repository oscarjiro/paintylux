<?php

function error_message($attribute, $error = "required")
{
    switch ($error) {
        case "required":
            $message = "Mohon mengisi $attribute Anda.";
            break;
        case "max":
            $message = ucfirst($attribute) . " yang diisi terlalu panjang.";
            break;
        case "unique":
            $message = ucfirst($attribute) . " sudah terpakai.";
            break;
        case "lowercase":
            $message = ucfirst($attribute) . " tidak boleh ada huruf kapital.";
            break;
        case "same":
            $message = ucfirst($attribute) . " yang diisi belum sama.";
            break;
        default:
            $message = "Mohon mengisi $attribute yang valid.";
    }
    return trans($message);
}
