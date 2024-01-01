
// TOGGLE SIDEBAR
const menuBar = document.querySelector('#content-halaman nav .bx.bx-menu');
const sidebar = document.getElementById('sidebar');

menuBar.addEventListener('click', function () {
	sidebar.classList.toggle('hide');
})


const switchMode = document.getElementById('switch-mode');
const body = document.body;

// Memeriksa status mode yang tersimpan dalam localStorage saat halaman dimuat
window.addEventListener('load', function () {
    const savedMode = localStorage.getItem('mode');
    
    if (savedMode === 'dark') {
        body.classList.add('dark');
        switchMode.checked = true;
    }
    else {
        body.classList.remove('dark');
        switchMode.checked = false;
    }
});

// Mengubah status mode saat kotak centang diubah
switchMode.addEventListener('change', function () {
    if (this.checked) {
        body.classList.add('dark');
        localStorage.setItem('mode', 'dark');
    } else {
        body.classList.remove('dark');
        localStorage.setItem('mode', 'light');
    }
});
