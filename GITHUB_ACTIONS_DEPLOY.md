# 🚀 DEPLOY AUTOMÁTICO COM GITHUB ACTIONS

## ✅ Configuração Concluída!

O sistema está configurado para fazer deploy automático para o HostGator sempre que você fizer **push para a branch main/master**.

---

## 📋 CONFIGURAR NO GITHUB (FAÇA APENAS UMA VEZ):

### 1️⃣ Vá no seu repositório no GitHub

### 2️⃣ Clique em **Settings** (Configurações)

### 3️⃣ No menu lateral, clique em **Secrets and variables** → **Actions**

### 4️⃣ Clique em **New repository secret** e adicione os 3 secrets:

#### Secret 1: `FTP_SERVER`
**Nome:** `FTP_SERVER`  
**Valor:** `ftp.iagus.com.br` (ou o servidor FTP que aparece no cPanel)

#### Secret 2: `FTP_USERNAME`  
**Nome:** `FTP_USERNAME`  
**Valor:** `abdonc73` (seu usuário do cPanel)

#### Secret 3: `FTP_PASSWORD`
**Nome:** `FTP_PASSWORD`  
**Valor:** (a senha do cPanel)

---

## 🎯 COMO USAR:

### No Visual Studio Code:

1. **Faça suas alterações** nos arquivos
2. **Commit:**
   - Abra o painel Source Control (Ctrl+Shift+G)
   - Digite a mensagem do commit
   - Clique em ✓ Commit

3. **Push:**
   - Clique nos 3 pontinhos (...) → Push
   - OU use Ctrl+Shift+P → "Git: Push"

4. **Aguarde 2-3 minutos** - O GitHub Actions vai fazer o deploy automaticamente!

5. **Verifique:** Acesse http://iagus.com.br

---

## 📊 ACOMPANHAR O DEPLOY:

1. Vá no GitHub → seu repositório
2. Clique na aba **Actions**
3. Você verá o status do deploy em tempo real:
   - 🟡 Amarelo = Executando
   - ✅ Verde = Sucesso
   - ❌ Vermelho = Erro

---

## 🔧 INFORMAÇÕES DO SERVIDOR FTP:

**Para encontrar suas credenciais FTP no cPanel:**

1. Vá em **cPanel** → **Contas de FTP**
2. O servidor FTP geralmente é:
   - `ftp.seudominio.com.br` 
   - OU `ftp.meusitehostgator.com.br`
   - OU o IP do servidor

3. Use o mesmo usuário e senha do cPanel

---

## ⚠️ IMPORTANTE:

- O `.env` **NÃO** será enviado (por segurança)
- `node_modules` e `vendor` **NÃO** serão enviados (muito grandes)
- Logs e cache **NÃO** serão enviados

Após o primeiro deploy, você precisa:
1. Configurar o `.env` no servidor (via cPanel)
2. Rodar `composer install` no servidor (via SSH se disponível)

---

## 🎉 PRONTO!

Agora é só programar e fazer push que o GitHub cuida do resto!
