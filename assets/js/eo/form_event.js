function aktifkanOpsiDropdown(dropdown) {
    const opsiDropdown = dropdown.closest('.input-group-pendaftaran').querySelector('.opsi-dropdown');
    if(dropdown.value === 'dropdown') {
        opsiDropdown.classList.add('active');
    } else {
        opsiDropdown.classList.remove('active');
    }
}

function tambahOpsi(button, indexOpsi) {
    const pilhanDropdown = button.closest('.opsi-dropdown').querySelector('.input-opsi-dropdown-group');

    const htmlPilihanBaru = `
        <div class="input-opsi-dropdown-item">
            <input type="text" name="opsi[${indexOpsi}][]" value="Opsi lainnya">
            <i class="icon" data-lucide="trash-2" onclick="this.parentElement.remove()"></i>
        </div>
    `;

    pilhanDropdown.insertAdjacentHTML('beforeend', htmlPilihanBaru);

    lucide.createIcons();
}

document.addEventListener('DOMContentLoaded', () => {
    const tambahPertanyaan = document.querySelector('.tambah-pertanyaan')
    let idPertanyaan = 1;

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
                    <i class="icon" data-lucide="trash-2" onclick="this.parentElement.parentElement.remove()"></i>
                </div>
            </div>
        `;

        tambahPertanyaan.insertAdjacentHTML('beforebegin', htmlPertanyaan);
        lucide.createIcons();
        idPertanyaan++;
    })
})