function previewImage(event) {
    let input = event.target;
    let reader = new FileReader();

    reader.onload = function () {
        let previewImg = document.getElementById('previewImage');
        previewImg.src = reader.result;
    }

    reader.readAsDataURL(input.files[0]);
}

let imageInput = document.getElementById('avatar');
imageInput.addEventListener('change', previewImage);

document.querySelector('img[data-bs-toggle="modal"]').addEventListener('click', function () {
    let targetModal = document.querySelector(this.getAttribute('data-bs-target'));
    let modal = bootstrap.Modal.getInstance(targetModal);
    modal.show();
});

document.querySelector('span[id="order_status_id"]').addEventListener('DOMContentLoaded', function () {
    const badgeElement = document.getElementById('order_status_name');
    let orderStatusName = badgeElement.text();
    console.log(orderStatusName);

    if (orderStatusName === 'New') {
        badgeElement.classList.add('bg-primary');
    } else if (orderStatusName === 'Pending Payment') {
        badgeElement.classList.add('bg-yellow');
    } else if (orderStatusName === 'Processing') {
        badgeElement.classList.add('bg-secondary');
    } else if (orderStatusName === 'On hold') {
        badgeElement.classList.add('bg-orange');
    } else if (orderStatusName === 'Shipping') {
        badgeElement.classList.add('bg-purple');
    } else if (orderStatusName === 'Completed') {
        badgeElement.classList.add('bg-success');
    } else if (orderStatusName === 'Cancelled') {
        badgeElement.classList.add('bg-danger');
    } else if (orderStatusName === 'Refunded') {
        badgeElement.classList.add('bg-teal');
    } else if (orderStatusName === 'Failed') {
        badgeElement.classList.add('bg-dark');
    }
});