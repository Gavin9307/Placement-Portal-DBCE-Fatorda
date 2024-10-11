// Get elements
const hamburger = document.querySelector('.hamburger');
const sidebar = document.querySelector('.side-bar-container');
const closeBtn = document.querySelector('.close-btn');

// Toggle sidebar when hamburger is clicked
hamburger.addEventListener('click', () => {
    sidebar.classList.toggle('active');
});

// Close sidebar when close button is clicked
closeBtn.addEventListener('click', () => {
    sidebar.classList.remove('active');
});

