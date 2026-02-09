#!/bin/bash

echo "=========================================="
echo "🚀 IAGUS - Iniciando com Laravel Herd"
echo "=========================================="
echo ""

# Cores
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
RED='\033[0;31m'
BLUE='\033[0;34m'
NC='\033[0m'

# Verificar se o Herd está instalado
if ! command -v php &> /dev/null; then
    echo -e "${RED}❌ PHP não encontrado no PATH!${NC}"
    echo ""
    echo -e "${YELLOW}Laravel Herd deve estar instalado e no PATH do sistema.${NC}"
    echo ""
    echo "Soluções:"
    echo "1. ${GREEN}Instale Laravel Herd:${NC} https://herd.laravel.com/windows"
    echo "2. ${GREEN}Após instalar, reabra o terminal${NC}"
    echo "3. ${GREEN}Execute: herd link${NC} nesta pasta"
    echo ""
    exit 1
fi

echo -e "${GREEN}✓ PHP encontrado!${NC}"
php -v | head -1
echo ""

# Verificar se já está linked com Herd
LINKED=$(herd links 2>/dev/null | grep "webcoder" || echo "")

if [ -z "$LINKED" ]; then
    echo -e "${YELLOW}📍 Linkando projeto com Herd...${NC}"
    herd link webcoder
    echo -e "${GREEN}✓ Projeto linkado!${NC}"
    echo ""
fi

# Criar banco SQLite se não existir
if [ ! -f "database/database.sqlite" ]; then
    echo -e "${YELLOW}💾 Criando banco SQLite...${NC}"
    touch database/database.sqlite
    echo -e "${GREEN}✓ Banco criado!${NC}"
    echo ""
fi

# Verificar .env
if [ ! -f .env ]; then
    echo -e "${YELLOW}⚙️  Criando .env...${NC}"
    cp .env.example .env
    php artisan key:generate
    echo -e "${GREEN}✓ .env configurado!${NC}"
    echo ""
fi

# Limpar cache
echo -e "${YELLOW}🧹 Limpando cache...${NC}"
php artisan optimize:clear > /dev/null 2>&1
echo -e "${GREEN}✓ Cache limpo!${NC}"
echo ""

# Verificar banco de dados
echo -e "${YELLOW}📊 Verificando banco de dados...${NC}"
php artisan migrate:status > /dev/null 2>&1
if [ $? -ne 0 ]; then
    echo -e "${YELLOW}⚠️  Executando migrations...${NC}"
    php artisan migrate --seed --force
    echo -e "${GREEN}✓ Banco configurado!${NC}"
    echo ""
else
    echo -e "${GREEN}✓ Banco já configurado!${NC}"
    echo ""
fi

# Compilar assets (produção)
echo -e "${YELLOW}🎨 Compilando assets...${NC}"
npm run build > /dev/null 2>&1
echo -e "${GREEN}✓ Assets compilados!${NC}"
echo ""

# URLs disponíveis
echo "=========================================="
echo -e "${GREEN}✅ SERVIDOR PRONTO!${NC}"
echo "=========================================="
echo ""
echo -e "🌐 URL principal:   ${GREEN}http://webcoder.test${NC}"
echo -e "🌐 URL alternativa: ${GREEN}http://localhost:8000${NC}"
echo ""
echo -e "👤 Admin: ${YELLOW}admin@iagus.org.br${NC} / ${YELLOW}iagus2026${NC}"
echo -e "👤 User:  ${YELLOW}joao@example.com${NC} / ${YELLOW}password${NC}"
echo ""
echo "=========================================="
echo ""
echo -e "${BLUE}💡 Dicas:${NC}"
echo -e "  • O Herd já está servindo em ${GREEN}http://webcoder.test${NC}"
echo -e "  • Para desenvolvimento: ${YELLOW}npm run dev${NC} (assets com HMR)"
echo -e "  • Para produção: ${YELLOW}npm run build${NC} (assets otimizados)"
echo -e "  • Ver logs: ${YELLOW}herd log${NC}"
echo -e "  • Parar servidor: ${YELLOW}herd stop${NC}"
echo ""
