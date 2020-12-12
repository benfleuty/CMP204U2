$(document).ready(function () {
    currentPage = document.currentScript.getAttribute("data-currentPage");

    function setActivePage(currentPage) {
        $("li > a[href='" + currentPage + "']").addClass("active");
    }
});