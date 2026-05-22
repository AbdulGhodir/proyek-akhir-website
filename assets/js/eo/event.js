document.addEventListener('DOMContentLoaded', () => {
    const btnHapus = document.querySelectorAll('.btn-delete');
    const modal = document.getElementById('modal');
    const idEvent = document.getElementById('idEvent');
    const namaEvent = document.getElementById('namaEvent');
    const btnBatalHapus = document.getElementById('btnBatal');

    btnHapus.forEach(btn => {
        btn.addEventListener('click', () => {
            const id = btn.getAttribute('data-id');
            const nama = btn.getAttribute('data-nama');

            idEvent.value = id;
            namaEvent.innerText = nama;

            modal.classList.add('active');
        })
    })

    btnBatalHapus.addEventListener('click', () => {
        modal.classList.remove('active');
    })
    
})