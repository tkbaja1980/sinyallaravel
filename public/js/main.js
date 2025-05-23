// Main JavaScript for SinyalTrading

// Wait for DOM to be fully loaded
document.addEventListener('DOMContentLoaded', function() {
    // Toggle sidebar on mobile
    const toggleSidebarBtn = document.querySelector('.header-toggle-sidebar');
    const sidebar = document.querySelector('.sidebar');
    
    if (toggleSidebarBtn && sidebar) {
        toggleSidebarBtn.addEventListener('click', function() {
            sidebar.classList.toggle('show');
        });
    }
    
    // Close sidebar when clicking outside on mobile
    document.addEventListener('click', function(event) {
        if (sidebar && !sidebar.contains(event.target) && !toggleSidebarBtn.contains(event.target)) {
            if (window.innerWidth < 993 && sidebar.classList.contains('show')) {
                sidebar.classList.remove('show');
            }
        }
    });
    
    // Toggle dropdown menus in sidebar
    const dropdownToggles = document.querySelectorAll('.sidebar-dropdown-toggle');
    
    dropdownToggles.forEach(function(toggle) {
        toggle.addEventListener('click', function(e) {
            e.preventDefault();
            const parent = this.parentElement;
            const submenu = parent.querySelector('.sidebar-submenu');
            
            if (submenu) {
                submenu.classList.toggle('show');
                this.querySelector('i.dropdown-icon').classList.toggle('fa-chevron-down');
                this.querySelector('i.dropdown-icon').classList.toggle('fa-chevron-up');
            }
        });
    });
    
    // Initialize tooltips
    const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    tooltipTriggerList.map(function(tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });
    
    // Initialize popovers
    const popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'));
    popoverTriggerList.map(function(popoverTriggerEl) {
        return new bootstrap.Popover(popoverTriggerEl);
    });
    
    // Handle theme switching
    const themeRadios = document.querySelectorAll('input[name="theme"]');
    
    if (themeRadios.length > 0) {
        themeRadios.forEach(function(radio) {
            radio.addEventListener('change', function() {
                if (this.checked) {
                    const theme = this.id.replace('theme', '').toLowerCase();
                    setTheme(theme);
                }
            });
        });
    }
    
    // Load saved theme
    const savedTheme = localStorage.getItem('theme');
    if (savedTheme) {
        setTheme(savedTheme);
        const themeRadio = document.getElementById('theme' + savedTheme.charAt(0).toUpperCase() + savedTheme.slice(1));
        if (themeRadio) {
            themeRadio.checked = true;
        }
    }
    
    // Copy referral link
    const copyReferralBtn = document.getElementById('copyButton');
    const referralLink = document.getElementById('referralLink');
    
    if (copyReferralBtn && referralLink) {
        copyReferralBtn.addEventListener('click', function() {
            referralLink.select();
            document.execCommand('copy');
            
            const originalText = this.innerHTML;
            this.innerHTML = '<i class="fas fa-check me-1"></i> Tersalin!';
            
            setTimeout(function() {
                copyReferralBtn.innerHTML = originalText;
            }, 2000);
        });
    }
    
    // Toggle password visibility
    const togglePasswordBtns = document.querySelectorAll('.toggle-password');
    
    togglePasswordBtns.forEach(function(btn) {
        btn.addEventListener('click', function() {
            const passwordField = document.getElementById(this.getAttribute('data-target'));
            
            if (passwordField) {
                const type = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
                passwordField.setAttribute('type', type);
                
                this.querySelector('i').classList.toggle('fa-eye');
                this.querySelector('i').classList.toggle('fa-eye-slash');
            }
        });
    });
    
    // Handle API key form
    const exchangeSelect = document.getElementById('exchange');
    const apiPassphraseField = document.getElementById('apiPassphrase');
    
    if (exchangeSelect && apiPassphraseField) {
        exchangeSelect.addEventListener('change', function() {
            const selectedExchange = this.value;
            
            if (selectedExchange === 'kucoin') {
                apiPassphraseField.parentElement.style.display = 'block';
            } else {
                apiPassphraseField.parentElement.style.display = 'none';
            }
        });
    }
});

// Theme switching function
function setTheme(theme) {
    const body = document.body;
    
    // Remove existing theme classes
    body.classList.remove('theme-light', 'theme-dark');
    
    if (theme === 'system') {
        // Check system preference
        if (window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches) {
            body.classList.add('theme-dark');
        } else {
            body.classList.add('theme-light');
        }
    } else {
        // Apply selected theme
        body.classList.add('theme-' + theme);
    }
    
    // Save theme preference
    localStorage.setItem('theme', theme);
}

// Social media sharing functions
function shareOnFacebook() {
    const referralLink = document.getElementById('referralLink').value;
    const shareUrl = `https://www.facebook.com/sharer/sharer.php?u=${encodeURIComponent(referralLink)}`;
    window.open(shareUrl, '_blank', 'width=600,height=400');
}

function shareOnTwitter() {
    const referralLink = document.getElementById('referralLink').value;
    const shareText = 'Dapatkan sinyal trading dan bot trading terbaik di SinyalTrading! Gunakan link referral saya untuk mendaftar:';
    const shareUrl = `https://twitter.com/intent/tweet?text=${encodeURIComponent(shareText)}&url=${encodeURIComponent(referralLink)}`;
    window.open(shareUrl, '_blank', 'width=600,height=400');
}

function shareOnWhatsApp() {
    const referralLink = document.getElementById('referralLink').value;
    const shareText = 'Dapatkan sinyal trading dan bot trading terbaik di SinyalTrading! Gunakan link referral saya untuk mendaftar: ' + referralLink;
    const shareUrl = `https://wa.me/?text=${encodeURIComponent(shareText)}`;
    window.open(shareUrl, '_blank');
}

function shareOnTelegram() {
    const referralLink = document.getElementById('referralLink').value;
    const shareText = 'Dapatkan sinyal trading dan bot trading terbaik di SinyalTrading! Gunakan link referral saya untuk mendaftar:';
    const shareUrl = `https://t.me/share/url?url=${encodeURIComponent(referralLink)}&text=${encodeURIComponent(shareText)}`;
    window.open(shareUrl, '_blank');
}

function shareOnEmail() {
    const referralLink = document.getElementById('referralLink').value;
    const subject = 'Rekomendasi SinyalTrading - Platform Sinyal dan Bot Trading';
    const body = `Halo,\n\nSaya ingin merekomendasikan SinyalTrading, platform sinyal trading dan bot trading terbaik yang pernah saya gunakan.\n\nGunakan link referral saya untuk mendaftar: ${referralLink}\n\nSalam,`;
    const mailtoUrl = `mailto:?subject=${encodeURIComponent(subject)}&body=${encodeURIComponent(body)}`;
    window.location.href = mailtoUrl;
}

// Toggle bot status
function toggleBotStatus(botId) {
    // This would be an AJAX call to your backend
    console.log(`Toggling status for bot ID: ${botId}`);
    // After successful toggle, you would update the UI accordingly
}
