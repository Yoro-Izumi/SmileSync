$(document).ready(function () {
    $(".dropdown-toggle").click(function () {
        $(".dropdown-menu").toggle();
    });

    $(document).click(function (e) {
        if (!$(e.target).closest('.dropdown').length) {
            $(".dropdown-menu").hide();
        }
    });
});


