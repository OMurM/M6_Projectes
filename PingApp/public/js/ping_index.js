// public/js/ping/ping_index.js

$(document).ready(function() {
    // Set an interval to periodically check the status of all pings
    setInterval(function() {
        $('.check-status').each(function() {
            const id = $(this).data('id');

            $.ajax({
                url: `/pings/check/${id}`, // Adjust the URL to match your Laravel route
                method: 'GET',
                success: function(response) {
                    // Update the status and latency in the table
                    $(`#ping-${id} .ping-status`).text(response.status ? 'Online' : 'Offline');
                    $(`#ping-${id} .ping-latency`).text(response.latency !== null ? response.latency.toFixed(2) + ' ms' : 'N/A');
                },
                error: function(xhr) {
                    console.error('Error checking status', xhr);
                }
            });
        });
    }, 1000);

    // Edit button funcionality 
    $('.edit-btn').on('click', function() {
        const id = $(this).data('id');

        const ip = $(`#ping-${id} .ping-ip`).text().trim();
        const nombre = $(`#ping-${id} .ping-nombre`).text().trim();

        $('#pingId').val(id);
        $('#ip_dominio').val(ip);
        $('#nombre').val(nombre);

        $('#editModal').modal('show');
    });

    // Handle the edit
    $('#editForm').on('submit', function(e) {
        e.preventDefault();

        const id = $('#pingId').val();
        const url = `/pings/${id}`;
        const data = $(this).serialize(); // Serialize form data

        // Send an AJAX request to update the ping entry
        $.ajax({
            url: url,
            method: 'PUT', // Use PUT for updates "Revise this I dont understand it at all"
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

    // Check status logic for manual checks remains unchanged
    $('.check-status').on('click', function() {
        const id = $(this).data('id');

        $.ajax({
            url: `/pings/check/${id}`,
            method: 'GET',
            success: function(response) {
                $(`#ping-${id} .ping-status`).text(response.status ? 'Online' : 'Offline');
                $(`#ping-${id} .ping-latency`).text(response.latency !== null ? response.latency.toFixed(2) + ' ms' : 'N/A');
            },
            error: function(xhr) {
                alert('Error checking status');
            }
        });
    });
});
