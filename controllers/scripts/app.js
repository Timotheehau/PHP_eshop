const menu = document.querySelector('.menu');
const burger = document.querySelector('.burger-menu');
const close_btn = document.querySelector('.close-menu');
burger.addEventListener('click', () => {
    menu.classList.toggle('open');
});
close_btn.addEventListener('click', () => {
    menu.classList.remove('open');
});

console.log('JS is working!');