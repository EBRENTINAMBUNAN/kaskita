// Objek untuk data modal
let modalData = {
    username: '',
    pekan: ''
};

// Event listener untuk tombol "Terima"
document.getElementById('acceptButton').addEventListener('click', function() {
    updateModalData();
    closeModal('detailModal');
    openModal('modalTerima');
    setModalEventListeners('confirmAcceptButton', handleAccept);
    setModalEventListeners('cancelAcceptButton', closeModalTerima);
});

// Update data modal dari konten HTML
function updateModalData() {
    modalData.username = document.getElementById('modalUsername').textContent.trim();
    modalData.pekan = document.getElementById('modalPekan').textContent.trim();
}

// Fungsi untuk menambahkan event listener ke tombol modal
function setModalEventListeners(buttonId, callback) {
    const button = document.getElementById(buttonId);
    button.removeEventListener('click', callback); // Hapus event listener sebelumnya
    button.addEventListener('click', callback); // Tambahkan event listener baru
}

// Fungsi untuk memproses terima
function handleAccept() {
    disableButton('confirmAcceptButton', true, 'Processing...');
    postProsesKas()
        .then(() => location.reload())
        .catch((error) => openErrorModal(`An error occurred: ${error.message}`));
}

// Fungsi untuk mematikan tombol saat proses berjalan
function disableButton(buttonId, disable, text) {
    const button = document.getElementById(buttonId);
    button.disabled = disable;
    button.innerHTML = text;
}

// Post data ke server
function postProsesKas() {
    return fetch('/admin/proses-kas', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify(modalData)
    })
    .then(response => {
        if (!response.ok) {
            return response.json().then(err => {
                let errorMessage = Array.isArray(err.error) ? err.error.join(', ') : err.error || 'Unknown error';
                throw new Error(errorMessage);
            });
        }
        return response.json();
    });
}

// Fungsi untuk menutup modal
function closeModal(modalId) {
    const modal = document.getElementById(modalId);
    modal.classList.add('opacity-0', 'invisible');
    modal.classList.remove('opacity-100', 'visible');
}

// Fungsi untuk menutup modal konfirmasi "Terima"
function closeModalTerima() {
    closeModal('modalTerima');
}

// Fungsi untuk membuka modal konfirmasi (Terima atau Tolak)
function openModal(modalId) {
    const modal = document.getElementById(modalId);
    modal.classList.remove('opacity-0', 'invisible');
    modal.classList.add('opacity-100', 'visible');
}

// Event untuk tombol "Tolak"
document.getElementById('rejectButton').addEventListener('click', function() {
    closeModal('detailModal');
    openModal('modalTolak');
});

// Event untuk tombol "Batal" di modal Tolak
document.getElementById('cancelRejectButton').addEventListener('click', function() {
    closeModal('modalTolak');  // Tutup modal Tolak saat tombol Batal ditekan
});

// Event listener untuk tombol close modal
document.querySelectorAll('#closeModalBtn, #closeModalBtnFooter').forEach(btn => {
    btn.addEventListener('click', function() {
        closeModal('detailModal');
    });
});

// Fungsi untuk memformat Rupiah
function formatRupiah(amount) {
    return 'Rp ' + parseInt(amount).toLocaleString('id-ID');
}

// Fungsi untuk membuka modal detail
function openDetailModal(id, username, pekan, amount, image) {
    document.getElementById('modalUsername').textContent = username;
    document.getElementById('modalPekan').textContent = pekan;
    document.getElementById('modalAmount').textContent = formatRupiah(amount);
    document.getElementById('modalImagePreview').src = '/assets/img/uploads/' + image;

    openModal('detailModal');
}

// Fungsi untuk membuka modal error
function openErrorModal(errorMessage) {
    const errorText = document.getElementById('errorMessage');
    errorText.textContent = errorMessage;
    openModal('errorModal');
}

// Fungsi untuk menutup modal error
function closeErrorModalFunction() {
    closeModal('errorModal');
}

function closeModal(modalId) {
    const modal = document.getElementById(modalId);
    modal.classList.remove('opacity-100', 'visible');
    modal.classList.add('opacity-0', 'invisible');
}

// Event listener untuk modal error
document.getElementById('closeErrorModalBtn').addEventListener('click', closeErrorModalFunction);
document.getElementById('closeErrorModal').addEventListener('click', function() {
    location.reload();
});

// Expose fungsi openDetailModal ke window agar bisa diakses dari luar
window.openDetailModal = openDetailModal;


// Event listener untuk tombol "Lanjutkan" di modal Tolak
document.getElementById('confirmRejectButton').addEventListener('click', function() {
    disableButton('confirmRejectButton', true, 'Processing...');
    postRejectData()
        .then(() => location.reload())
        .catch((error) => openErrorModal(`An error occurred: ${error.message}`));
});

// Fungsi untuk mengirim data ke server (reject)
function postRejectData(modalData) {
    return fetch('/admin/tolak/proses-kas', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify(modalData)  // modalData berisi username dan pekan yang akan diproses
    })
    .then(response => {
        // Jika response tidak OK, lempar error
        if (!response.ok) {
            return response.json().then(err => {
                throw new Error(err.error || 'Unknown error');
            });
        }
        // Jika statusnya OK atau parsial, kembalikan response JSON
        return response.json();
    })
    .then(data => {
        // Tampilkan pesan sukses
        alert(data.message || 'All specified pekan(s) rejected successfully.');
        return data;
    })
    .catch(error => {
        // Tangani error, tampilkan pesan kesalahan
        alert(`Error: ${error.message}`);
        console.error('Error:', error);
    });
}


// Fungsi untuk mematikan tombol saat proses berjalan
function disableButton(buttonId, disable, text) {
    const button = document.getElementById(buttonId);
    button.disabled = disable;
    button.innerHTML = text;
}
