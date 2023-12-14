// main.js

document.addEventListener('DOMContentLoaded', function () {
    // Add event listener for details button
    document.addEventListener('click', function (event) {
        if (event.target.classList.contains('details-btn')) {
            // Toggle details box visibility
            const detailsBox = event.target.closest('.card-body').querySelector('.details-box');
            detailsBox.classList.toggle('d-none');
        }
    });

    // Add event listener for rent button
    document.addEventListener('click', function (event) {
        if (event.target.classList.contains('rent-btn')) {
            const carId = event.target.getAttribute('data-car-id');
            // Redirect to rent.php with carId as a query parameter
            window.location.href = 'rent.php?carId=' + carId;
        }
    });
});
