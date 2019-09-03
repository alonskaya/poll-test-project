$(document).ready(function () {
    $('#add-button').on('click', function (e) {
        let list      = $("#answers-fields-list");
        let counter   = list.children().length;
        let newWidget = list.attr('data-prototype');

        newWidget = newWidget.replace(/__name__/g, counter);

        $(list.attr('data-widget-tags')).html(newWidget).appendTo(list);
    });

    $('#add-button').trigger('click');
    $('#add-button').trigger('click');
});