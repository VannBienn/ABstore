
    document.addEventListener('DOMContentLoaded', function() {
        const toggleBtn = document.getElementById('toggle-search');
        const form = document.getElementById('search-form');

        toggleBtn.addEventListener('click', function(e) {
            e.preventDefault();
            form.style.display = form.style.display === 'none' ? 'flex' : 'none';
        });
    });
