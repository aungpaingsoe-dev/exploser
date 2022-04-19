require('./bootstrap');

let cover = document.querySelector('#cover');
let coverPreview = document.querySelector('#coverPreview');

coverPreview.addEventListener("click",function(){
    cover.click();
});

cover.addEventListener("change",function(){
    let reader = new FileReader();
    reader.readAsDataURL(cover.files[0]);
    reader.onload = function(){
        coverPreview.src = reader.result;
    }
});
