function aktifkanOpsiDropdown(dropdown) {
    const opsiDropdown = dropdown.closest('.input-group-pendaftaran').querySelector('.opsi-dropdown');
    if(dropdown.value === 'dropdown') {
        opsiDropdown.classList.add('active');
    } else {
        opsiDropdown.classList.remove('active');
    }

    updateTombolHapusIsiDropdown();
}

function tambahOpsi(button, indexOpsi) {
    const pilhanDropdown = button.closest('.opsi-dropdown').querySelector('.input-opsi-dropdown-group');

    const htmlPilihanBaru = `
        <div class="input-opsi-dropdown-item">
            <input type="text" name="opsi[${indexOpsi}][]" value="Opsi lainnya">
            <i class="icon" data-lucide="trash-2" onclick="this.parentElement.remove(); updateTombolHapusIsiDropdown();"></i>
        </div>
    `;

    pilhanDropdown.insertAdjacentHTML('beforeend', htmlPilihanBaru);

    lucide.createIcons();
    updateTombolHapusIsiDropdown();
}


function updateTombolHapus() {
    const daftarPertanyaan = document.querySelectorAll('.input-group-pendaftaran');
    const tombolHapus = document.querySelectorAll('.bottom-menu-form .icon');
    
    if (daftarPertanyaan.length <= 1) {
        tombolHapus.forEach(btn => btn.style.display = 'none');
    } else {
        tombolHapus.forEach(btn => btn.style.display = 'inline-block');
    }
}

function updateTombolHapusIsiDropdown() {
    const semuaGrupOpsi = document.querySelectorAll('.input-opsi-dropdown-group');
    
    semuaGrupOpsi.forEach(grup => {
        const daftarDropdown = grup.querySelectorAll('.input-opsi-dropdown-item');
        const tombolHapus = grup.querySelectorAll('.icon');
        
        if (daftarDropdown.length <= 2) {
            tombolHapus.forEach(btn => btn.style.display = 'none');
        } else {
            tombolHapus.forEach(btn => btn.style.display = 'inline-block');
        }
    });

}

document.addEventListener('DOMContentLoaded', () => {
    const tambahPertanyaan = document.querySelector('.tambah-pertanyaan')
    const jumlahPertanyaan = document.querySelectorAll('.input-group-pendaftaran').length;
    let idPertanyaan = jumlahPertanyaan;

    tambahPertanyaan.addEventListener('click', () => {
        const htmlPertanyaan = `
            <div class="input-group-pendaftaran">
                <div class="row-pertanyaan">
                    <input type="text" name="pertanyaan[${idPertanyaan}]" placeholder="Masukkan Pertanyaan">
                    <select name="tipe_pertanyaan[${idPertanyaan}]" class="dropdown-tipe-pertanyaan" onchange="aktifkanOpsiDropdown(this)">
                        <option value="teks">Jawaban Singkat</option>
                        <option value="paragraf">Paragraf</option>
                        <option value="dropdown">Dropdown</option>
                        <option value="tanggal">Tanggal</option>
                        <option value="angka">Angka</option>
                        <option value="file">File Upload</option>
                    </select>
                </div>
                
                <div class="opsi-dropdown">
                    <span>Masukkan Pilihan:</span>
                    <div class="input-opsi-dropdown-group">
                        <div class="input-opsi-dropdown-item">
                            <input type="text" name="opsi[${idPertanyaan}][]" value="Opsi 1">
                            <i class="icon" data-lucide="trash-2" onclick="this.parentElement.remove()"></i>
                        </div>
                        <div class="input-opsi-dropdown-item">
                            <input type="text" name="opsi[${idPertanyaan}][]" value="Opsi 2">
                            <i class="icon" data-lucide="trash-2" onclick="this.parentElement.remove()"></i>
                        </div>
                    </div>
                    <button type="button" onclick="tambahOpsi(this, ${idPertanyaan})" class="tambah-opsi">+ Tambah Opsi</button>
                </div>

                <div class="bottom-menu-form">
                    <div class="wajib-diisi">
                        <input type="checkbox" name="wajib[${idPertanyaan}]">
                        <label for="wajib">Wajib Diisi</label>
                    </div>
                    <i class="icon" data-lucide="trash-2" onclick="this.parentElement.parentElement.remove(); updateTombolHapus();"></i>
                </div>
            </div>
        `;

        tambahPertanyaan.insertAdjacentHTML('beforebegin', htmlPertanyaan);
        lucide.createIcons();
        updateTombolHapus();
        updateTombolHapusIsiDropdown();
        idPertanyaan++;
    })
})

document.addEventListener('DOMContentLoaded', function() {
    updateTombolHapus();
    updateTombolHapusIsiDropdown();
});