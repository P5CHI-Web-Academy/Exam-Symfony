function markAsDone(itemId, state) {
    $.ajax({
        url: '/item/' + itemId + '/done',
        method: 'POST',
        data: {state: state}
    }).done(function (data) {
        alert('Updated');
    }).fail(function (xhr) {
        alert('Error. Try again later.');
    });
}
