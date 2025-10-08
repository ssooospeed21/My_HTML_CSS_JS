// Хранение постов (в реальном проекте это было бы на сервере)
let posts = [
    {
        id: 1,
        title: "Путешествие в Париж",
        content: "Париж - это город мечты...",
        author: "author1",
        date: "2023-05-15",
        image: "images/paris.jpg",
        comments: [
            { id: 1, author: "user1", text: "Отличный пост!", date: "2023-05-16" },
            { id: 2, author: "user2", text: "Мечтаю там побывать!", date: "2023-05-17" }
        ]
    },
    {
        id: 2,
        title: "Горы Швейцарии",
        content: "Швейцарские Альпы поражают...",
        author: "admin",
        date: "2023-06-01",
        image: "images/swiss.jpg",
        comments: []
    }
];

// Получить все посты
function getAllPosts() {
    return posts;
}

// Получить пост по ID
function getPostById(id) {
    return posts.find(post => post.id === id);
}

// Создать новый пост
function createPost(title, content, image) {
    if (!currentUser || (!hasRole('admin') && !hasRole('author'))) {
        return false;
    }
    
    const newPost = {
        id: posts.length + 1,
        title,
        content,
        author: currentUser.username,
        date: new Date().toISOString().split('T')[0],
        image,
        comments: []
    };
    
    posts.push(newPost);
    return true;
}

// Добавить комментарий
function addComment(postId, text) {
    if (!currentUser) return false;
    
    const post = getPostById(postId);
    if (!post) return false;
    
    const newComment = {
        id: post.comments.length + 1,
        author: currentUser.username,
        text,
        date: new Date().toISOString().split('T')[0]
    };
    
    post.comments.push(newComment);
    return true;
}

// Удалить пост (только для админа или автора поста)
function deletePost(postId) {
    const post = getPostById(postId);
    if (!post) return false;
    
    if (!hasRole('admin') && post.author !== currentUser.username) {
        return false;
    }
    
    posts = posts.filter(post => post.id !== postId);
    return true;
}

// Обновить пост (только для админа или автора поста)
function updatePost(postId, title, content, image) {
    const post = getPostById(postId);
    if (!post) return false;
    
    if (!hasRole('admin') && post.author !== currentUser.username) {
        return false;
    }
    
    post.title = title;
    post.content = content;
    if (image) post.image = image;
    return true;
}