import './bootstrap';

// ===== CUSTOM SMOOTH SCROLL FUNCTION =====
function smoothScrollTo(targetPosition, duration = 800) {
    const startPosition = window.pageYOffset;
    const distance = targetPosition - startPosition;
    let startTime = null;
    
    // Easing function - easeInOutCubic
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

// ===== SMOOTH SCROLL FOR ALL ANCHOR LINKS =====
function initSmoothScroll() {
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        // Remove listeners antigos primeiro (se houver)
        anchor.removeEventListener('click', handleAnchorClick);
        // Adiciona novo listener
        anchor.addEventListener('click', handleAnchorClick);
    });
}

function handleAnchorClick(e) {
    const targetId = this.getAttribute('href');
    
    // Só processa se o target existir na página
    const targetElement = document.querySelector(targetId);
    if (targetElement) {
        e.preventDefault();
        e.stopPropagation();
        
        const navbar = document.getElementById('navbar');
        const navbarHeight = navbar ? navbar.offsetHeight : 80;
        const targetPosition = targetElement.getBoundingClientRect().top + window.pageYOffset - navbarHeight;
        
        // Usa animação customizada suave
        smoothScrollTo(targetPosition, 800);
        
        // Fecha menu mobile se estiver aberto
        const mobileMenu = document.getElementById('mobile-menu');
        if (mobileMenu && !mobileMenu.classList.contains('hidden')) {
            mobileMenu.classList.add('hidden');
            const menuIcon = document.getElementById('menu-icon');
            const closeIcon = document.getElementById('close-icon');
            if (menuIcon) menuIcon.classList.remove('hidden');
            if (closeIcon) closeIcon.classList.add('hidden');
        }
        
        // Atualiza URL sem recarregar
        history.pushState(null, null, targetId);
    }
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
                    
                    if (link.getAttribute('href') === `#${id}`) {
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

// ===== INITIALIZE ALL ON DOM READY =====
document.addEventListener('DOMContentLoaded', () => {
    initSmoothScroll();
    initAlerts();
    initScrollSpy();
    initNavbarScroll();
});

// Re-initialize smooth scroll after any content load
window.reinitSmoothScroll = initSmoothScroll;
