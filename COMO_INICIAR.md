# 🚀 Como Iniciar o Servidor IAGUS

Este guia mostra as diferentes formas de iniciar o servidor de desenvolvimento do IAGUS.

---

## ⚡ Método Recomendado (Windows)

### Com Laravel Herd (RECOMENDADO)

Se você tem Laravel Herd instalado:

```bash
# Basta clicar duas vezes ou executar:
start.bat
```

**Vantagens:**
- ✅ Detecção automática do PHP
- ✅ Não precisa de servidor (Herd cuida disso)
- ✅ URL bonita: `http://webcoder.test`
- ✅ Gerenciamento automático de portas

---

## 🐧 Outros Métodos

### 1. Via PowerShell (Windows)

```powershell
# Execute o script PowerShell diretamente:
.\start-powershell.ps1

# Ou com execução forçada:
powershell -ExecutionPolicy Bypass -File .\start-powershell.ps1
```

### 2. Via Batch (Windows)

```cmd
start.bat
```

### 3. Via Bash (Linux/Mac ou Git Bash)

```bash
chmod +x start.sh
./start.sh
```

**Nota:** No Git Bash para Windows, o script vai recomendar usar `start.bat` que funciona melhor.

### 4. Via Docker

```bash
docker-compose up -d
```

### 5. Manual (qualquer sistema)

```bash
# 1. Criar banco
touch database/database.sqlite

# 2. Configurar ambiente
cp .env.example .env
php artisan key:generate

# 3. Migrar banco
php artisan migrate --seed

# 4. Compilar assets
npm run build

# 5. Iniciar servidor
php artisan serve
```

---

## 📋 Qual Método Usar?

| Situação | Método Recomendado |
|----------|-------------------|
| Windows com Herd | `start.bat` |
| Windows sem Herd | `start.bat` (instala Laragon/XAMPP primeiro) |
| PowerShell | `.\start-powershell.ps1` |
| Linux/Mac | `./start.sh` |
| Docker | `docker-compose up` |
| Manual | Comandos artisan + npm |

---

## 🌐 URLs Disponíveis

Após iniciar, acesse:

- **Com Herd:** http://webcoder.test
- **Sem Herd:** http://localhost:3001
- **Vite HMR:** http://localhost:5173 (dev mode)

---

## 👤 Credenciais Padrão

**Admin:**
- Email: `admin@iagus.org.br`
- Senha: `iagus2026`

**Usuário:**
- Email: `joao@example.com`
- Senha: `password`

---

## ❓ Problemas Comuns

### PHP não encontrado

**Solução:** Instale Laravel Herd (recomendado)
```
https://herd.laravel.com/windows
```

### Porta 3001 em uso

Os scripts automaticamente liberam a porta. Ou mate manualmente: 

```bash
# Windows
netstat -ano | findstr :3001
taskkill /F /PID <PID>

# Linux/Mac
lsof -ti:3001 | xargs kill -9
```

### Assets não carregam

```bash
# Remover arquivo hot (se existir)
rm public/hot

# Compilar assets
npm run build
```

### Erro "Target class [files] does not exist"

Isso foi corrigido! Se ainda aparecer:
```bash
php artisan optimize:clear
composer dump-autoload
```

---

## 📚 Mais Informações

- [Guia Completo de Inicialização](INSTRUCOES_INICIAR.md)
- [Quick Start (60 segundos)](QUICK_START.md)
- [Troubleshooting](TROUBLESHOOTING.md)
- [Changelog](CHANGELOG.md)

---

## 💡 Dicas

1. **Para desenvolvimento:** Use `npm run dev` para ter hot reload dos assets
2. **Para produção:** Use `npm run build` para otimizar assets
3. **Com Herd:** Não precisa rodar `php artisan serve`, Herd já serve automaticamente
4. **Logs:** Veja em `storage/logs/laravel.log`

---

**Desenvolvido para IAGUS - Igreja Apostólica Geração Ungida do Senhor**
