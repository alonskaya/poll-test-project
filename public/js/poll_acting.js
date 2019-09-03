function sendAJAX(url, data, dataType, method = 'POST', onSuccess = function () {
}, onError = function (data, textStatus, errorThrown) {
    console.log(data);
    console.log(textStatus);
    console.log(errorThrown);
}) {
    $.ajax({
        url: url,
        method: method,
        dataType: dataType,
        contentType: "application/json; charset=utf-8",
        data: JSON.stringify(data),
        success: onSuccess,
        error: onError,
    });
}

function refreshList() {
    let pageURL = window.location.href;
    let lastURLSegment = pageURL.substr(pageURL.lastIndexOf('/') + 1);

    sendAJAX(
        '/results/' + lastURLSegment,
        {},
        "html",
        'POST',
        function (data) {
            $('#results-block').html(data);
        });
}

$(document).ready(function () {
    setInterval(function(){
        refreshList();
    }, 750);
});