// public/js/ping_index.js

$(document).ready(function() {
    $('.edit-btn').on('click', function() {
        const id = $(this).data('id');

        // Get current values
        const ip = $(`#ping-${id} .ping-ip`).text();
        const nombre = $(`#ping-${id} .ping-nombre`).text();

        // Set values in the modal
        $('#pingId').val(id);
        $('#ip_dominio').val(ip);
        $('#nombre').val(nombre);

        $('#editModal').modal('show');
    });

    // Handle the edit form submission
    $('#editForm').on('submit', function(e) {
        e.preventDefault();

        const id = $('#pingId').val();
        const url = `/pings/${id}`;
        const data = $(this).serialize(); // Serialize form data

        $.ajax({
            url: url,
            method: 'PUT', // Use PUT for updates
            data: data,
            success: function(response) {
                // Update the table row with new values
                $(`#ping-${id} .ping-ip`).text($('#ip_dominio').val());
                $(`#ping-${id} .ping-nombre`).text($('#nombre').val());
                $('#editModal').modal('hide'); // Hide the modal
                alert(response.success); // Show success message
            },
            error: function(xhr) {
                alert('Error updating ping');
            }
        });
    });

    // Check status logic
    $('.check-status').on('click', function() {
        const id = $(this).data('id');

        $.ajax({
            url: `/pings/check/${id}`,  // Adjust the URL to the correct route
            method: 'GET',
            success: function(response) {
                // Update the status in the table
                $(`#ping-${id} .ping-status`).text(response.status ? 'Online' : 'Offline');
            },
            error: function(xhr) {
                alert('Error checking status'); // Handle error
            }
        });
    });
});
