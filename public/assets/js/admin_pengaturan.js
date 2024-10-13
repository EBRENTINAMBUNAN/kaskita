document.addEventListener('DOMContentLoaded', function () {
    const tabs = document.querySelectorAll('.tab-button');
    const contents = document.querySelectorAll('.tab-content');

    tabs.forEach(tab => {
        tab.addEventListener('click', function () {
            contents.forEach(content => content.classList.add('hidden'));

            const targetId = this.getAttribute('data-target');
            document.getElementById(targetId).classList.remove('hidden');

            tabs.forEach(t => t.classList.remove('bg-indigo-100'));
            this.classList.add('bg-indigo-100');
        });
    });
});
