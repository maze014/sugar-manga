const deleteAkun = document.getElementById('delete');
const mengecek = document.getElementById('mengecek');
const close = document.getElementById('close');
const edit = document.getElementById('edit');
const mengedit = document.getElementById('mengedit');
const closeEdit = document.getElementById('closeEdit');
const body = document.body;

//menampilkan peringatan
deleteAkun.addEventListener('click', () => {
    mengecek.classList.remove('scale-0');
    mengecek.classList.add('transition', 'duration-300');
    body.classList.add('bg-slate-800/50');
})

//menutup peringatan
close.addEventListener('click', () => {
    mengecek.classList.remove('transition', 'duration-300');
    mengecek.classList.add('scale-0');
    body.classList.remove('bg-slate-800/50');
})

//menampilkan form edit
edit.addEventListener('click', () => {
    mengedit.classList.remove('scale-0');
    mengedit.classList.add('transition', 'duration-300');
    body.classList.add('bg-slate-800/50');
})

//menutup form edit
closeEdit.addEventListener('click', () => {
    mengedit.classList.remove('transition', 'duration-300');
    mengedit.classList.add('scale-0');
    body.classList.remove('bg-slate-800/50');
})