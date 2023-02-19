let files = [],
    form = document.querySelector('form'),
    container = document.querySelector('.container_image'),
    browses = document.querySelector('.select'),
    inputs = document.querySelector('.form_input #file_name');
browses.addEventListener('click', () => inputs.click());
inputs.addEventListener('change', () => {
    let file = inputs.files;
    for (let i = 0; i < file.length; i++) {
        if (files.every(e => e.name !== file[i].name)) {
            files.push(file[i]);
        }
    }
    form.reset();
    showImages();
})
const showImages = () => {
    let images = '';
    files.forEach((e, i) => {
        images += `
        <img style="width:110px; height:110px" style="cursor:pointer" src=" ${URL.createObjectURL(e)}" alt="image">
        <span style="cursor:pointer" onclick="delImage(${i})">&times;</span>`
    })
    container.innerHTML = images;
}
const delImage = index => {
    files.splice(index, 1)
    showImages()
}
function changeImage(element) {
    var main_prodcut_image = document.getElementById('main_product_image');
    main_prodcut_image.src = element.src;
}
///---------------------------------------------------------------------------------------
