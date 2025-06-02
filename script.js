document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('uploadForm');

    form.addEventListener('submit', function (e) {
        e.preventDefault();

        const formData = new FormData(form);
        const xhr = new XMLHttpRequest();

        xhr.open('POST', 'upload.php', true);

        xhr.onload = function () {
            if (xhr.status === 200) {
                location.reload(); // Show uploaded image
            } else {
                alert(xhr.responseText || 'Upload failed.');
            }
        };

        xhr.send(formData);
    });
});
