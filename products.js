const input = document.getElementById('image');
const imagePreview = document.getElementById('imagePreview');

input.addEventListener('change', function () {
    const file = this.files[0];
    if (file) {
        const reader = new FileReader();
        reader.addEventListener('load', function () {
            imagePreview.src = this.result;
            imagePreview.style.display = 'block'; 
        });
        reader.readAsDataURL(file);
    } else {
        imagePreview.src = '#'; 
        imagePreview.style.display = 'none'; 
    }
});