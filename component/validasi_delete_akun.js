const deleteAkun = document.getElementById('delete');
const mengecek = document.getElementById('mengecek');
const close = document.getElementById('close');
const edit = document.getElementById('edit');
const mengedit = document.getElementById('mengedit');
const closeEdit = document.getElementById('closeEdit');

//menampilkan peringatan
deleteAkun.addEventListener('click', ()=>{
    mengecek.classList.remove('scale-0');
    mengecek.classList.add('transition', 'duration-300');    
})

//menutup peringatan
close.addEventListener('click', ()=>{
    mengecek.classList.remove('transition', 'duration-300');
    mengecek.classList.add('scale-0');
})

//menampilkan form edit
edit.addEventListener('click', ()=>{
    mengedit.classList.remove('scale-0');
    mengedit.classList.add('transition', 'duration-300');
})

//menutup form edit
closeEdit.addEventListener('click', ()=>{
    mengedit.classList.remove('transition', 'duration-300');
    mengedit.classList.add('scale-0');
})