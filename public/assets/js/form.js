$(document).ready(function(){
    // Add the following code if you want the name of the file appear on select
    $(".custom-file-input").on("change", function() {
        var fileName = $(this).val().split("\\").pop();
        $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
    });
    $('.js-datepicker').datepicker({
        format: "dd-mm-yyyy",
        maxViewMode: 1,
        language: "fr",
        daysOfWeekDisabled: "0",
        calendarWeeks: true,
        autoclose: true,
        todayHighlight: true,
        toggleActive: true
    });
})