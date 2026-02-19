<?php

/**
 * Fallback: se o mod_rewrite não funcionar, este arquivo
 * carrega o Laravel diretamente da raiz.
 */

// Muda o diretório para public/ para que o Laravel encontre seus assets
chdir(__DIR__ . '/public');

// Carrega o index.php do Laravel
require __DIR__ . '/public/index.php';
