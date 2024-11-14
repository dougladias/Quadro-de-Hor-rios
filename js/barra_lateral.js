const list = document.querySelectorAll('.side-list');

function activeLink() {
    list.forEach((item) => item.classList.remove('active'));
    this.classList.add('active');
}

list.forEach((item) => {
    item.addEventListener('click', activeLink.bind(item));
});

