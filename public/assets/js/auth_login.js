function openModal() {
    const modal = document.getElementById('forgotPasswordModal');
    modal.classList.remove('invisible', 'opacity-0');
    modal.classList.add('opacity-100');
}

function closeModal() {
    const modal = document.getElementById('forgotPasswordModal');
    modal.classList.add('opacity-0');
    modal.classList.remove('opacity-100');

    setTimeout(() => {
    modal.classList.add('invisible');
    }, 300); 
}
