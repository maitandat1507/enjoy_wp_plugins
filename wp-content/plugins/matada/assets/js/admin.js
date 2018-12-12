/**
 * Matada Plugin Saving process
 */
$(function() {
    $('document').on('submit', '#feedier-admin-form', function(e) {
        e.preventDefault();

        // We inject some extra fields required for the security
        $(this).append('<input type="hidden" name="action" value="store_admin_data" />');
        $(this).append('<input type="hidden" name="security" value="'+ feedier_exchanger._nonce +'" />');

        // We make our call
        $.ajax({
            url: feedier_exchanger.ajax_url,
            type: 'post',
            data: $(this).serialize(),
            success: function (response) {
                alert(response);
            }
        });
    });
});