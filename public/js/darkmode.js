// Check for saved dark mode preference
if (localStorage.getItem('darkMode') === 'enabled') {
    document.documentElement.setAttribute('data-theme', 'dark');
}

// Function to toggle dark mode
function toggleDarkMode() {
    const currentTheme = document.documentElement.getAttribute('data-theme');
    
    if (currentTheme === 'dark') {
        document.documentElement.removeAttribute('data-theme');
        localStorage.setItem('darkMode', 'disabled');
    } else {
        document.documentElement.setAttribute('data-theme', 'dark');
        localStorage.setItem('darkMode', 'enabled');
    }
}

// Add event listener to toggle button when DOM is loaded
document.addEventListener('DOMContentLoaded', function() {
    const toggleButton = document.getElementById('darkModeToggle');
    if (toggleButton) {
        toggleButton.addEventListener('click', toggleDarkMode);
    }
}); 