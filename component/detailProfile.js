const detailProfile = document.getElementById('detailProfile');
if (detailProfile) {
    detailProfile.addEventListener('click', function () {
        const parentDetailProfile = detailProfile.parentElement;
        const result = parentDetailProfile.classList.toggle('mb-4');
        detailProfile.classList.toggle('rotate-180');

        const saudaraDetailProfile = detailProfile.nextElementSibling;
        if (result) {
            saudaraDetailProfile.classList.remove('hidden');
            saudaraDetailProfile.classList.replace('-bottom-4', '-bottom-5');
            parentDetailProfile.classList.remove('lg:text-xl');
        } else {
            saudaraDetailProfile.classList.add('hidden');
            saudaraDetailProfile.classList.replace('-bottom-5', '-bottom-4');
            parentDetailProfile.classList.add('lg:text-xl');
        }
    })
}

const flashMessage = document.querySelector('p');
const categories = document.getElementById('categories');
if(flashMessage) {
    categories.classList.replace('mt-24', 'mt-4');
} else {
    categories.classList.replace('mt-4', 'mt-24');
}