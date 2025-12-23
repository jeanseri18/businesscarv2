// Navigation and interaction handling for Africa Business Card

// Mobile menu toggle
function toggleMenu() {
    const menu = document.getElementById('mobile-menu');
    if (menu) {
        menu.classList.toggle('hidden');
    }
}

// Smooth scrolling for anchor links (only for same-page anchors)
function initSmoothScrolling() {
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            // Only prevent default for same-page anchor links
            if (this.hostname === window.location.hostname && this.pathname === window.location.pathname) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            }
        });
    });
}

// Add scroll effect to navigation
function initScrollEffects() {
    window.addEventListener('scroll', function() {
        const nav = document.querySelector('nav');
        if (nav) {
            if (window.scrollY > 100) {
                nav.classList.add('shadow-xl');
            } else {
                nav.classList.remove('shadow-xl');
            }
        }
    });
}

// Check if Font Awesome loaded successfully
function checkFontAwesome() {
    // Test if Font Awesome is available by checking for a Font Awesome element
    const testIcon = document.createElement('i');
    testIcon.className = 'fas fa-test';
    document.body.appendChild(testIcon);
    
    // Check if the icon has the expected Font Awesome styles
    const computedStyle = window.getComputedStyle(testIcon);
    const fontFamily = computedStyle.fontFamily;
    
    document.body.removeChild(testIcon);
    
    if (!fontFamily.includes('Font Awesome') && !fontFamily.includes('"Font Awesome"')) {
        console.warn('Font Awesome failed to load from CDN. Using fallback styles.');
        document.body.classList.add('fa-fallback');
        return false;
    } else {
        console.log('Font Awesome loaded successfully');
        return true;
    }
}

// Initialize all functionality when DOM is loaded
document.addEventListener('DOMContentLoaded', function() {
    // Make toggleMenu available globally
    window.toggleMenu = toggleMenu;
    
    // Initialize smooth scrolling
    initSmoothScrolling();
    
    // Initialize scroll effects
    initScrollEffects();
    
    // Check Font Awesome loading
    setTimeout(checkFontAwesome, 1000); // Check after 1 second to allow CDN to load
});

// Export functions for use in other scripts
export { toggleMenu, initSmoothScrolling, initScrollEffects, checkFontAwesome };