const componentWaifu = function (value) {
    return $('#neko').append(`<div class="bg-white group transition duration-300 hover:scale-95 w-[90%] mx-auto overflow-hidden mb-4 rounded-xl">
        <img class="group-hover:scale-110 transition duration-300 group-hover:rotate-3" src="${value.image.compressed.url}" alt="${value.id}" />
        <div class="flex justify-evenly item-center p-4 bg-slate-800 relative z-10">
            <button type="submit">
                <svg class="w-8 h-8 text-rose-600" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12.01 6.001C6.5 1 1 8 5.782 13.001L12.011 20l6.23-7C23 8 17.5 1 12.01 6.002Z"/>
                </svg>
            </button> 
            <span class="rounded-full flex group/item transition duration-300 items-center group hover:underline">
                <a href="detail.php?id=${value.id}" class="text-white transition duration-300 group-hover/item:text-cyan-500 font-light text-lg flex items-center">See detail
                    <svg class="w-8 h-8 text-white transition duration-300 group-hover/item:text-cyan-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m7 16 4-4-4-4m6 8 4-4-4-4" />
                    </svg>
                </a>
            </span>
        </div>
    </div>`);
}

let result = localStorage.getItem('waifu');
result = JSON.parse(result);

const inputImg = document.querySelector('input').value;
const arrayImg = inputImg.split(',');
arrayImg.pop();

result.forEach((value) => {
    if(arrayImg.includes(value.id)) {
        componentWaifu(value);
    }
})