// Component Loader - Laadt navbar en footer components
async function loadComponent(elementId, componentPath) {
    try {
        console.log(`Loading component: ${componentPath}`);
        const response = await fetch(componentPath);
        
        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }
        
        const html = await response.text();
        console.log(`Component loaded: ${componentPath} (${html.length} characters)`);
        
        const container = document.getElementById(elementId);
        if (!container) {
            throw new Error(`Container element not found: ${elementId}`);
        }
        
        container.innerHTML = html;
        console.log(`Component injected into: ${elementId}`);
        
    } catch (error) {
        console.error(`Error loading component from ${componentPath}:`, error);
    }
}

// Laad components bij het laden van de pagina
document.addEventListener('DOMContentLoaded', async function() {
    console.log('=== Component Loader Started ===');
    
    // Laad navbar en footer
    await loadComponent('navbar-container', './components/navbar.html');
    await loadComponent('footer-container', './components/footer.html');
    
    console.log('=== Components Loaded, Loading Script ===');
    
    // Wacht een moment zodat de DOM ge-update is
    setTimeout(() => {
        // Laad het main script
        const script = document.createElement('script');
        script.src = './javascript/script.js';
        script.onload = () => console.log('=== Script.js loaded ===');
        script.onerror = () => console.error('=== Script.js failed to load ===');
        document.body.appendChild(script);
    }, 200);
});