$(document).ready(function(){
    $('.js-datepicker').datepicker({
        maxViewMode: 1,
        language: "fr",
        daysOfWeekDisabled: "0",
        calendarWeeks: true,
        autoclose: true,
        todayHighlight: true,
        datesDisabled: ['06/06/2019', '06/21/2019'],
        toggleActive: true
    });
});

