// Хранение пользователей
let users = [
    { id: 1, username: 'admin', password: '1234', role: 'admin', email: 'admin@example.com' },
    { id: 2, username: 'author1', password: 'author123', role: 'author', email: 'author@example.com' },
    { id: 3, username: 'user', password: 'A123', role: 'user', email: 'user@example.com' }
];

// Текущий пользователь
let currentUser = null;

// Функция входа
function login(username, password) {
    const user = users.find(u => u.username === username && u.password === password);
    if (user) {
        currentUser = user;
        localStorage.setItem('currentUser', JSON.stringify(user));
        updateUI();
        return true;
    }
    return false;
}

// Функция выхода
function logout() {
    currentUser = null;
    localStorage.removeItem('currentUser');
    updateUI();
    window.location.href = 'index.html';
}

// Функция регистрации
function register(username, password, email, role = 'user') {
    if (users.some(u => u.username === username)) {
        return false;
    }
    
    const newUser = {
        id: users.length + 1,
        username,
        password,
        email,
        role
    };
    
    users.push(newUser);
    return true;
}

// Проверка роли
function hasRole(role) {
    return currentUser && currentUser.role === role;
}

// Обновление интерфейса
function updateUI() {
    const loginLink = document.getElementById('loginLink');
    const registerLink = document.getElementById('registerLink');
    const createPostLink = document.getElementById('createPostLink');
    const adminLink = document.getElementById('adminLink');
    const logoutLink = document.getElementById('logoutLink');
    const profileLink = document.getElementById('profileLink');
    
    if (currentUser) {
        if (loginLink) {
            loginLink.textContent = currentUser.username;
            loginLink.href = 'profile.html';
        }
        if (registerLink) registerLink.style.display = 'none';
        if (logoutLink) logoutLink.style.display = 'inline';
        if (profileLink) profileLink.style.display = 'inline';
        if (createPostLink) createPostLink.style.display = 'inline';
        if (adminLink) adminLink.style.display = hasRole('admin') ? 'inline' : 'none';
    } else {
        if (loginLink) {
            loginLink.textContent = 'Войти';
            loginLink.href = 'login.html';
        }
        if (registerLink) registerLink.style.display = 'inline';
        if (logoutLink) logoutLink.style.display = 'none';
        if (profileLink) profileLink.style.display = 'none';
        if (createPostLink) createPostLink.style.display = 'none';
        if (adminLink) adminLink.style.display = 'none';
    }
}

// Инициализация
window.onload = function() {
    const storedUser = localStorage.getItem('currentUser');
    if (storedUser) {
        currentUser = JSON.parse(storedUser);
    }
    updateUI();
};