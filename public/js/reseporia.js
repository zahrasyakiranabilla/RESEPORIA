// Global functions
function goToDetail(url) {
    window.location.href = url;
}

// CSRF Token setup
document.addEventListener('DOMContentLoaded', function() {
    // Set CSRF token for all AJAX requests
    const token = document.querySelector('meta[name="csrf-token"]');
    if (token) {
        window.csrfToken = token.getAttribute('content');
    }
});

// Like functionality
function likeRecipe(recipeId) {
    fetch(`/recipe/${recipeId}/like`, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': window.csrfToken,
            'Content-Type': 'application/json',
        }
    })
    .then(response => response.json())
    .then(data => {
        // Show success animation
        showLikeAnimation();
        console.log('Recipe liked!', data.likes);
    })
    .catch(error => {
        console.error('Error:', error);
    });
}

// Favorite functionality
function toggleFavorite(recipeId) {
    fetch(`/recipe/${recipeId}/favorite`, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': window.csrfToken,
            'Content-Type': 'application/json',
        }
    })
    .then(response => response.json())
    .then(data => {
        const btn = document.querySelector('.favorite-btn');
        if (data.favorited) {
            btn.classList.add('favorited');
            showNotification('Ditambahkan ke favorit!');
        } else {
            btn.classList.remove('favorited');
            showNotification('Dihapus dari favorit!');
        }
    })
    .catch(error => {
        console.error('Error:', error);
    });
}

// Show like animation
function showLikeAnimation() {
    const btn = document.querySelector('.like-btn');
    if (btn) {
        btn.style.transform = 'scale(1.3)';
        setTimeout(() => {
            btn.style.transform = 'scale(1)';
        }, 200);
    }
}

// Show notification
function showNotification(message) {
    // Create notification element
    const notification = document.createElement('div');
    notification.style.cssText = `
        position: fixed;
        top: 100px;
        left: 50%;
        transform: translateX(-50%);
        background: #7A8471;
        color: white;
        padding: 1rem 2rem;
        border-radius: 25px;
        z-index: 1000;
        animation: slideDown 0.3s ease;
    `;
    notification.textContent = message;
    
    // Add CSS animation
    if (!document.getElementById('notification-style')) {
        const style = document.createElement('style');
        style.id = 'notification-style';
        style.textContent = `
            @keyframes slideDown {
                from {
                    opacity: 0;
                    transform: translateX(-50%) translateY(-20px);
                }
                to {
                    opacity: 1;
                    transform: translateX(-50%) translateY(0);
                }
            }
        `;
        document.head.appendChild(style);
    }
    
    document.body.appendChild(notification);
    
    // Remove after 2 seconds
    setTimeout(() => {
        notification.remove();
    }, 2000);
}

// Sort functionality for category page
document.addEventListener('DOMContentLoaded', function() {
    const sortDropdown = document.querySelector('.sort-dropdown');
    if (sortDropdown) {
        sortDropdown.addEventListener('change', function() {
            const sortBy = this.value;
            const cards = Array.from(document.querySelectorAll('.recipe-card'));
            const container = document.querySelector('.card-container');
            
            // Simple client-side sorting (you can implement server-side sorting instead)
            cards.sort((a, b) => {
                switch(sortBy) {
                    case 'rating':
                        return parseFloat(b.querySelector('.rating').textContent) - 
                               parseFloat(a.querySelector('.rating').textContent);
                    case 'likes':
                        return parseInt(b.querySelector('.likes').textContent) - 
                               parseInt(a.querySelector('.likes').textContent);
                    case 'time':
                        return parseInt(a.querySelector('.time').textContent) - 
                               parseInt(b.querySelector('.time').textContent);
                    default:
                        return 0; // newest (keep original order)
                }
            });
            
            // Re-append sorted cards
            cards.forEach(card => container.appendChild(card));
        });
    }
});