import './bootstrap';

// ===== CUSTOM SMOOTH SCROLL FUNCTION =====
function smoothScrollTo(targetPosition, duration = 700) {
    const startPosition = window.pageYOffset;
    const distance = targetPosition - startPosition;
    let startTime = null;
    
    function easeInOutCubic(t) {
        return t < 0.5 
            ? 4 * t * t * t 
            : (t - 1) * (2 * t - 2) * (2 * t - 2) + 1;
    }
    
    function animation(currentTime) {
        if (startTime === null) startTime = currentTime;
        const timeElapsed = currentTime - startTime;
        const progress = Math.min(timeElapsed / duration, 1);
        const ease = easeInOutCubic(progress);
        
        window.scrollTo(0, startPosition + (distance * ease));
        
        if (timeElapsed < duration) {
            requestAnimationFrame(animation);
        }
    }
    
    requestAnimationFrame(animation);
}

// ===== HANDLE ANCHOR LINKS =====
function initAnchorLinks() {
    document.querySelectorAll('a[href*="#"]').forEach(link => {
        link.addEventListener('click', function(e) {
            const href = this.getAttribute('href');
            
            // Se o link começa com /# (ex: /#inicio), é navegação para home
            // Deixa o navegador navegar normalmente
            if (href.startsWith('/#')) {
                return true; // Navegação normal
            }
            
            // Se é apenas #algo (mesma página)
            const hashIndex = href.indexOf('#');
            if (hashIndex === -1) return;
            
            const targetId = href.substring(hashIndex);
            const targetElement = document.querySelector(targetId);
            
            // Se o elemento existe na página atual, faz scroll suave
            if (targetElement) {
                e.preventDefault();
                
                const navbar = document.getElementById('navbar');
                const navbarHeight = navbar ? navbar.offsetHeight : 80;
                const targetPosition = targetElement.getBoundingClientRect().top + window.pageYOffset - navbarHeight;
                
                smoothScrollTo(targetPosition, 700);
                
                // Fecha menu mobile
                const mobileMenu = document.getElementById('mobile-menu');
                if (mobileMenu && !mobileMenu.classList.contains('hidden')) {
                    mobileMenu.classList.add('hidden');
                    const menuIcon = document.getElementById('menu-icon');
                    const closeIcon = document.getElementById('close-icon');
                    if (menuIcon) menuIcon.classList.remove('hidden');
                    if (closeIcon) closeIcon.classList.add('hidden');
                }
            }
            // Se não existe, deixa o navegador navegar
        });
    });
}

// ===== HANDLE SCROLL ON PAGE LOAD (when URL has hash) =====
function handleInitialScroll() {
    const hash = window.location.hash;
    if (!hash) return;
    
    // Aguarda para garantir que tudo carregou
    setTimeout(() => {
        const targetElement = document.querySelector(hash);
        if (targetElement) {
            const navbar = document.getElementById('navbar');
            const navbarHeight = navbar ? navbar.offsetHeight : 80;
            const targetPosition = targetElement.getBoundingClientRect().top + window.pageYOffset - navbarHeight;
            smoothScrollTo(targetPosition, 700);
        }
    }, 100);
}

// ===== AUTO-HIDE ALERTS =====
function initAlerts() {
    const alerts = document.querySelectorAll('.alert');
    alerts.forEach(alert => {
        setTimeout(() => {
            alert.classList.add('opacity-0', 'transition-opacity', 'duration-300');
        }, 4500);
        
        setTimeout(() => {
            alert.remove();
        }, 5000);
    });
}

// ===== MOBILE MENU TOGGLE =====
window.toggleMobileMenu = function() {
    const menu = document.getElementById('mobile-menu');
    const menuIcon = document.getElementById('menu-icon');
    const closeIcon = document.getElementById('close-icon');
    
    if (menu) {
        const isHidden = menu.classList.contains('hidden');
        
        if (isHidden) {
            menu.classList.remove('hidden');
            if (menuIcon) menuIcon.classList.add('hidden');
            if (closeIcon) closeIcon.classList.remove('hidden');
        } else {
            menu.classList.add('hidden');
            if (menuIcon) menuIcon.classList.remove('hidden');
            if (closeIcon) closeIcon.classList.add('hidden');
        }
    }
};

// ===== SCROLL SPY - HIGHLIGHT ACTIVE SECTION =====
function initScrollSpy() {
    const sections = document.querySelectorAll('section[id]');
    const navLinks = document.querySelectorAll('.nav-link');
    
    if (sections.length === 0 || navLinks.length === 0) return;
    
    const observerOptions = {
        root: null,
        rootMargin: '-20% 0px -60% 0px',
        threshold: 0
    };
    
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const id = entry.target.getAttribute('id');
                
                navLinks.forEach(link => {
                    link.classList.remove('text-primary-600', 'font-semibold', 'bg-primary-50');
                    
                    const href = link.getAttribute('href') || '';
                    if (href.includes(`#${id}`)) {
                        link.classList.add('text-primary-600', 'font-semibold', 'bg-primary-50');
                    }
                });
            }
        });
    }, observerOptions);
    
    sections.forEach(section => observer.observe(section));
}

// ===== NAVBAR BACKGROUND ON SCROLL =====
function initNavbarScroll() {
    const navbar = document.getElementById('navbar');
    if (!navbar) return;
    
    window.addEventListener('scroll', () => {
        const currentScroll = window.pageYOffset;
        
        if (currentScroll > 10) {
            navbar.classList.add('shadow-lg');
            navbar.classList.remove('shadow-md');
        } else {
            navbar.classList.remove('shadow-lg');
            navbar.classList.add('shadow-md');
        }
    }, { passive: true });
}

// ===== CONFIRM DELETE =====
window.confirmDelete = function(message = 'Tem certeza que deseja excluir?') {
    return confirm(message);
};

// ===== FORMAT CURRENCY =====
window.formatCurrency = function(cents) {
    return new Intl.NumberFormat('pt-BR', {
        style: 'currency',
        currency: 'BRL'
    }).format(cents / 100);
};

// ===== COPY TO CLIPBOARD =====
window.copyToClipboard = function(text) {
    navigator.clipboard.writeText(text).then(() => {
        const toast = document.createElement('div');
        toast.className = 'fixed bottom-4 right-4 bg-green-600 text-white px-6 py-3 rounded-lg shadow-lg z-50 animate-fade-in';
        toast.textContent = 'Copiado para a área de transferência!';
        document.body.appendChild(toast);
        
        setTimeout(() => {
            toast.classList.add('opacity-0', 'transition-opacity');
            setTimeout(() => toast.remove(), 300);
        }, 2000);
    });
};

// ===== INITIALIZE ALL =====
document.addEventListener('DOMContentLoaded', () => {
    handleInitialScroll();
    initAnchorLinks();
    initAlerts();
    initScrollSpy();
    initNavbarScroll();
});
