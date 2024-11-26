$(document).ready(function() {
    const $refundButtons = $('[data-refund]');
    const $refundAllButton = $('[data-refund-all]');
    const $refundClearAllButton = $('[data-refund-clear]');
    const $refundInputs = $('[data-refund-input]');

    $refundButtons.on('click', function(e) {
        const $button = $(this);
        const refundValue = $button.attr('data-refund');
        const $refundInput = $button.closest('tr').find('[data-refund-input]');

        $refundInput.val(refundValue);
    });

    $refundAllButton.on('click', function () {
        $refundButtons.not(':disabled').trigger('click');
    });

    $refundClearAllButton.on('click', function () {
        $refundInputs.val('');
    });
});
