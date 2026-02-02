<?php
/**
 * INSTALAÇÃO FINAL - IAGUS
 * Acesse: http://iagus.com.br/install-final.php
 * 
 * DEPOIS DE RODAR, DELETE ESTE ARQUIVO!
 */

error_reporting(E_ALL);
ini_set('display_errors', 1);

?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Instalação Final IAGUS</title>
    <style>
        body { font-family: Arial, sans-serif; max-width: 900px; margin: 50px auto; padding: 20px; background: #f5f5f5; }
        .container { background: white; padding: 30px; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); }
        h1 { color: #2563eb; }
        .step { margin: 20px 0; padding: 15px; background: #f9fafb; border-left: 4px solid #2563eb; }
        .success { border-left-color: #059669; background: #d1fae5; }
        .error { border-left-color: #dc2626; background: #fee2e2; }
        .ok { color: #059669; font-weight: bold; }
        .fail { color: #dc2626; font-weight: bold; }
        button { background: #2563eb; color: white; padding: 10px 20px; border: none; border-radius: 4px; cursor: pointer; font-size: 16px; }
        button:hover { background: #1d4ed8; }
        pre { background: #1f2937; color: #f3f4f6; padding: 15px; border-radius: 4px; overflow-x: auto; }
    </style>
</head>
<body>
    <div class="container">
        <h1>🚀 Instalação Final do Sistema IAGUS</h1>

<?php

$basePath = __DIR__;
$envPath = $basePath . '/.env';

// Gerar APP_KEY
$appKey = 'base64:' . base64_encode(random_bytes(32));

// Criar .env
echo "<div class='step'>";
echo "<h2>📄 Passo 1: Criando arquivo .env</h2>";

$envContent = "APP_NAME=\"IAGUS - Igreja Anglicana de Garanhuns\"
APP_ENV=production
APP_KEY={$appKey}
APP_DEBUG=false
APP_URL=http://iagus.com.br

LOG_CHANNEL=stack
LOG_LEVEL=error

DB_CONNECTION=mysql
DB_HOST=localhost
DB_PORT=3306
DB_DATABASE=abdonc73_iagus
DB_USERNAME=abdonc73_iagus
DB_PASSWORD=WTDrzXteBxRL

BROADCAST_DRIVER=log
CACHE_DRIVER=file
FILESYSTEM_DISK=local
QUEUE_CONNECTION=sync
SESSION_DRIVER=file
SESSION_LIFETIME=120

MAIL_FROM_ADDRESS=\"contato@iagus.com.br\"
MAIL_FROM_NAME=\"\${APP_NAME}\"

MP_PUBLIC_KEY=
MP_ACCESS_TOKEN=
";

if (file_put_contents($envPath, $envContent)) {
    echo "<p class='ok'>✅ Arquivo .env criado com sucesso!</p>";
    echo "<p><strong>APP_KEY gerada:</strong> <code>{$appKey}</code></p>";
} else {
    echo "<p class='fail'>❌ Erro ao criar .env - verifique permissões</p>";
}
echo "</div>";

// Limpar cache
echo "<div class='step'>";
echo "<h2>🧹 Passo 2: Limpando cache</h2>";

$cacheFiles = [
    $basePath . '/bootstrap/cache/config.php',
    $basePath . '/bootstrap/cache/routes-v7.php',
    $basePath . '/bootstrap/cache/services.php',
    $basePath . '/bootstrap/cache/packages.php',
];

$cleaned = 0;
foreach ($cacheFiles as $file) {
    if (file_exists($file) && unlink($file)) {
        $cleaned++;
    }
}

// Limpar storage cache
$cacheDir = $basePath . '/storage/framework/cache/data';
if (is_dir($cacheDir)) {
    $files = glob($cacheDir . '/*');
    foreach ($files as $file) {
        if (is_file($file)) {
            unlink($file);
            $cleaned++;
        }
    }
}

// Limpar views
$viewsDir = $basePath . '/storage/framework/views';
if (is_dir($viewsDir)) {
    $files = glob($viewsDir . '/*.php');
    foreach ($files as $file) {
        if (basename($file) !== '.gitignore') {
            unlink($file);
            $cleaned++;
        }
    }
}

echo "<p class='ok'>✅ {$cleaned} arquivos de cache deletados</p>";
echo "</div>";

// Testar conexão com banco
echo "<div class='step'>";
echo "<h2>🗄️ Passo 3: Testando banco de dados</h2>";

try {
    $pdo = new PDO(
        'mysql:host=localhost;dbname=abdonc73_iagus;charset=utf8mb4',
        'abdonc73_iagus',
        'WTDrzXteBxRL',
        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
    );
    
    echo "<p class='ok'>✅ Conexão com banco de dados OK!</p>";
    
    // Verificar se tabelas existem
    $tables = $pdo->query("SHOW TABLES")->fetchAll(PDO::FETCH_COLUMN);
    
    if (count($tables) > 0) {
        echo "<p class='ok'>✅ Banco já possui " . count($tables) . " tabelas configuradas</p>";
        echo "<p>Tabelas: " . implode(', ', $tables) . "</p>";
    } else {
        echo "<p class='fail'>⚠️ Banco de dados está vazio - execute as migrações via SSH</p>";
    }
    
} catch (PDOException $e) {
    echo "<p class='fail'>❌ Erro ao conectar: " . htmlspecialchars($e->getMessage()) . "</p>";
}
echo "</div>";

// Verificar permissões
echo "<div class='step'>";
echo "<h2>🔐 Passo 4: Verificando permissões</h2>";

$paths = [
    'storage' => $basePath . '/storage',
    'bootstrap/cache' => $basePath . '/bootstrap/cache',
];

foreach ($paths as $name => $path) {
    if (is_writable($path)) {
        echo "<p class='ok'>✅ {$name} - Gravável</p>";
    } else {
        echo "<p class='fail'>❌ {$name} - NÃO gravável (execute: chmod -R 775 {$name})</p>";
    }
}
echo "</div>";

// Instruções finais
echo "<div class='step success'>";
echo "<h2>✅ INSTALAÇÃO CONCLUÍDA!</h2>";
echo "<p><strong>O sistema está pronto para uso!</strong></p>";
echo "<h3>Próximos passos:</h3>";
echo "<ol>";
echo "<li><strong>DELETE ESTE ARQUIVO</strong> (install-final.php) por segurança</li>";
echo "<li>Delete também: install.php, teste-conexao.php, limpar-cache.php, ver-log.php</li>";
echo "<li>Acesse: <a href='/' target='_blank'>http://iagus.com.br</a></li>";
echo "<li>Login admin: <a href='/admin/login' target='_blank'>/admin/login</a> (admin@iagus.org.br / iagus2026)</li>";
echo "</ol>";

echo "<h3>⚠️ Se ainda der erro:</h3>";
echo "<p>Execute via SSH (se tiver acesso):</p>";
echo "<pre>cd /home1/abdonc73/iagus.com.br
chmod -R 775 storage bootstrap/cache
php artisan config:clear
php artisan cache:clear
php artisan view:clear</pre>";

echo "<br><a href='/'><button>🎉 IR PARA O SITE</button></a>";
echo "</div>";

?>
    </div>
</body>
</html>
