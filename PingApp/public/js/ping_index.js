$(document).ready(function() {
    $('.edit-btn').on('click', function() {
        const id = $(this).data('id');

        const ip = $(`#ping-${id} .ping-ip`).text().trim();
        const nombre = $(`#ping-${id} .ping-nombre`).text().trim();

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

        // Send an AJAX request to update the ping entry
        $.ajax({
            url: url,
            method: 'PUT', // Use PUT for updates
            data: data,
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }, // CSRF token for security
            success: function(response) {
                $(`#ping-${id} .ping-ip`).text($('#ip_dominio').val());
                $(`#ping-${id} .ping-nombre`).text($('#nombre').val());
                
                $('#editModal').modal('hide');

                alert(response.success);
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
            url: `/pings/check/${id}`,  // Adjust the URL to match your Laravel route
            method: 'GET',
            success: function(response) {
                $(`#ping-${id} .ping-status`).text(response.status ? 'Online' : 'Offline');
            },
            error: function(xhr) {
                alert('Error checking status');
            }
        });
    });
});
