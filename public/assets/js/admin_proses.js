const modalData = {
    username: '',
    pekan: ''
};

function setButtonListener(buttonId, callback) {
    const button = document.getElementById(buttonId);
    button.removeEventListener('click', callback);
    button.addEventListener('click', callback);
}

function updateModalData() {
    modalData.username = document.getElementById('modalUsername').textContent.trim();
    modalData.pekan = document.getElementById('modalPekan').textContent.trim();
}

function handleAccept() {
    disableButton('confirmAcceptButton', true, 'Processing...');
    postData('/admin/proses-kas', modalData)
        .then(() => location.reload())
        .catch(error => openErrorModal(`An error occurred: ${error.message}`));
}

function disableButton(buttonId, disable, text) {
    const button = document.getElementById(buttonId);
    button.disabled = disable;
    button.innerHTML = text;
}

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

function toggleModal(modalId, isOpen) {
    const modal = document.getElementById(modalId);
    modal.classList.toggle('opacity-0', !isOpen);
    modal.classList.toggle('invisible', !isOpen);
    modal.classList.toggle('opacity-100', isOpen);
    modal.classList.toggle('visible', isOpen);
}

function formatRupiah(amount) {
    return 'Rp ' + parseInt(amount).toLocaleString('id-ID');
}

function openDetailModal(id, username, pekan, amount, image) {
    document.getElementById('modalUsername').textContent = username;
    document.getElementById('modalPekan').textContent = pekan;
    document.getElementById('modalAmount').textContent = formatRupiah(amount);
    document.getElementById('modalImagePreview').src = `/assets/img/uploads/${image}`;

    toggleModal('detailModal', true);
}

function openErrorModal(errorMessage) {
    document.getElementById('errorMessage').textContent = errorMessage;
    toggleModal('errorModal', true);
}

function closeErrorModalFunction() {
    toggleModal('errorModal', false);
}

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

document.getElementById('confirmRejectButton').addEventListener('click', () => {
    updateModalData(); 
    disableButton('confirmRejectButton', true, 'Processing...');
    postData('/admin/tolak/proses-kas', modalData)
        .then(() => location.reload())
        .catch(error => openErrorModal(`An error occurred: ${error.message}`));
});
