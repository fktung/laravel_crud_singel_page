let item = document.querySelectorAll('.nav-sidebar li a');
item.forEach(link => {
    if (link.querySelector('p').innerHTML.toLowerCase() === link.getAttribute('data-nav').toLowerCase()) {
        link.classList.toggle('active');
    }
});
