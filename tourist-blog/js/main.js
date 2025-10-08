// Инициализация приложения
document.addEventListener('DOMContentLoaded', function() {
    // Проверка аутентификации
    const storedUser = localStorage.getItem('currentUser');
    if (storedUser) {
        currentUser = JSON.parse(storedUser);
    }
    
    // Обновление UI
    updateUI();
    
    // Обработчик выхода
    const logoutBtn = document.getElementById('logoutBtn');
    if (logoutBtn) {
        logoutBtn.addEventListener('click', function() {
            logout();
            window.location.href = 'index.html';
        });
    }
});

// Функция для отображения/скрытия элементов в зависимости от роли
function updateUI() {
    const loginLink = document.querySelector('a[href="profile.html"]');
    const registerLink = document.querySelector('a[href="register.html"]');
    const createPostLink = document.querySelector('a[href="create-post.html"]');
    const adminLink = document.querySelector('a[href="admin.html"]');
    
    if (currentUser) {
        // Показываем имя пользователя и кнопку выхода
        if (loginLink) loginLink.textContent = currentUser.username;
        if (registerLink) registerLink.style.display = 'none';
        
        // Показываем ссылки в зависимости от роли
        if (createPostLink) {
            createPostLink.style.display = (currentUser.role === 'admin' || currentUser.role === 'author') ? 'inline' : 'none';
        }
        
        if (adminLink) {
    adminLink.style.display = currentUser.role === 'admin' ? 'inline' : 'none';
}
    } else {
        // Показываем стандартные ссылки для неавторизованных
        if (loginLink) loginLink.textContent = 'Войти';
        if (registerLink) registerLink.style.display = 'inline';
        if (createPostLink) createPostLink.style.display = 'none';
        if (adminLink) adminLink.style.display = 'none';
    }
}