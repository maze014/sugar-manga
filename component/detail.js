const detailContent = (value) => {
    return (
        $('#detailContent').append(`<div class="absolute cursor-pointer hidden md:block -ml-4 left-0">
        <svg class="p-2 bg-cyan-500 shadow-md transition text-white hover:bg-white hover:text-slate-800 hover:shadow-slate-800/60 shadow-cyan-500/60 rounded-full w-9 h-9" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m15 19-7-7 7-7" />
        </svg>
    </div>`),
        value.forEach((tag) => {
            $('#detailContent').append(`<span class="hover:bg-white transition hover:text-slate-800 hover:shadow-slate-800/60 text-md text-white font-medium bg-cyan-500 shadow-md shadow-cyan-500/60 px-6 rounded-xl py-1">${tag}</span>`);
        }),
        $('#detailContent').append(`<div class="absolute cursor-pointer hidden md:block -mr-4 right-0">
    <svg class="p-2 bg-cyan-500 shadow-md transition text-white hover:bg-white hover:text-slate-800 hover:shadow-slate-800/60 shadow-cyan-500/60 rounded-full w-9 h-9" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
  <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m9 5 7 7-7 7"/>
</svg>
</div>`)
    );
}

let result = localStorage.getItem('waifu');
result = JSON.parse(result);
const inputId = document.querySelector('input').value;
const image = document.querySelector('img');

result.forEach((value) => {
    if (value.id === inputId) {
        document.body.style.backgroundImage = `url('${value.image.compressed.url}')`;
        image.src = value.image.compressed.url;
        image.alt = value.category;
        detailContent(value.tags);

        // artist detail
        const artist = document.querySelector('h1');
        artist.nextElementSibling.innerHTML = `Profile: <a class="text-cyan-500 underline" href="${value.attribution.artist.profile}" target="_blank">Artist Profile</a>`;
        artist.nextElementSibling.nextElementSibling.innerHTML = `Username: ${value.attribution.artist.username}`;
        artist.nextElementSibling.nextElementSibling.nextElementSibling.innerHTML = `Source: <a class="text-cyan-500 underline" href="${value.source.url}" target="_blank">Source image</a>`;
        artist.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.innerHTML = `Category: ${value.category}`;
        $('#copyright').html(`Copyright: ${value.attribution.copyright}`);
    }
})

// mousemove event
const mouseMove = document.getElementById('detailContent');
const arrowIconLeft = mouseMove.firstElementChild;
const arrowIconRight = mouseMove.lastElementChild;

arrowIconLeft.addEventListener('click', () => {
    mouseMove.scrollLeft -= 300;
})

arrowIconRight.addEventListener('click', () => {
    mouseMove.scrollLeft += 300;
})

let isDragging = false;
mouseMove.addEventListener('mousemove', (e) => {
    if (!isDragging) return;
    mouseMove.scrollLeft -= e.movementX;
});

mouseMove.addEventListener('mousedown', () => isDragging = true);
document.addEventListener('mouseup', () => isDragging = false);