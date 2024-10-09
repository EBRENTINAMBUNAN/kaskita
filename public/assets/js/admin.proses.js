// Objek untuk data modal
const modalData = {
    username: '',
    pekan: ''
};

// Fungsi untuk mengatur event listener tombol
function setButtonListener(buttonId, callback) {
    const button = document.getElementById(buttonId);
    button.removeEventListener('click', callback);
    button.addEventListener('click', callback);
}

// Fungsi untuk mengupdate data modal dari konten HTML
function updateModalData() {
    modalData.username = document.getElementById('modalUsername').textContent.trim();
    modalData.pekan = document.getElementById('modalPekan').textContent.trim();
}

// Fungsi untuk memproses permintaan penerimaan
function handleAccept() {
    disableButton('confirmAcceptButton', true, 'Processing...');
    postData('/admin/proses-kas', modalData)
        .then(() => location.reload())
        .catch(error => openErrorModal(`An error occurred: ${error.message}`));
}

// Fungsi untuk menonaktifkan tombol saat proses berjalan
function disableButton(buttonId, disable, text) {
    const button = document.getElementById(buttonId);
    button.disabled = disable;
    button.innerHTML = text;
}

// Fungsi untuk mengirim data ke server
function postData(url, data) {
    return fetch(url, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify(data)
    })
    .then(response => response.ok 
        ? response.json() 
        : response.json().then(err => {
            const errorMessage = Array.isArray(err.error) ? err.error.join(', ') : err.error || 'Unknown error';
            throw new Error(errorMessage);
        })
    );
}

// Fungsi untuk menampilkan/menghilangkan modal
function toggleModal(modalId, isOpen) {
    const modal = document.getElementById(modalId);
    modal.classList.toggle('opacity-0', !isOpen);
    modal.classList.toggle('invisible', !isOpen);
    modal.classList.toggle('opacity-100', isOpen);
    modal.classList.toggle('visible', isOpen);
}

// Fungsi untuk memformat angka menjadi Rupiah
function formatRupiah(amount) {
    return 'Rp ' + parseInt(amount).toLocaleString('id-ID');
}

// Fungsi untuk membuka modal detail
function openDetailModal(id, username, pekan, amount, image) {
    document.getElementById('modalUsername').textContent = username;
    document.getElementById('modalPekan').textContent = pekan;
    document.getElementById('modalAmount').textContent = formatRupiah(amount);
    document.getElementById('modalImagePreview').src = `/assets/img/uploads/${image}`;

    toggleModal('detailModal', true);
}

// Fungsi untuk membuka modal error
function openErrorModal(errorMessage) {
    document.getElementById('errorMessage').textContent = errorMessage;
    toggleModal('errorModal', true);
}

// Fungsi untuk menutup modal error
function closeErrorModalFunction() {
    toggleModal('errorModal', false);
}

// Event listeners
document.getElementById('acceptButton').addEventListener('click', () => {
    updateModalData();
    toggleModal('detailModal', false);
    toggleModal('modalTerima', true);
    setButtonListener('confirmAcceptButton', handleAccept);
    setButtonListener('cancelAcceptButton', () => toggleModal('modalTerima', false));
});

document.getElementById('rejectButton').addEventListener('click', () => {
    toggleModal('detailModal', false);
    toggleModal('modalTolak', true);
});

document.getElementById('cancelRejectButton').addEventListener('click', () => {
    toggleModal('modalTolak', false);
});

document.querySelectorAll('#closeModalBtn, #closeModalBtnFooter').forEach(btn => {
    btn.addEventListener('click', () => toggleModal('detailModal', false));
});

document.getElementById('closeErrorModalBtn').addEventListener('click', closeErrorModalFunction);
document.getElementById('closeErrorModal').addEventListener('click', () => location.reload());

window.openDetailModal = openDetailModal;

// Event listener untuk tombol "Lanjutkan" di modal Tolak
document.getElementById('confirmRejectButton').addEventListener('click', () => {
    updateModalData(); 
    disableButton('confirmRejectButton', true, 'Processing...');
    postData('/admin/tolak/proses-kas', modalData)
        .then(() => location.reload())
        .catch(error => openErrorModal(`An error occurred: ${error.message}`));
});
