document.addEventListener('DOMContentLoaded', function () {
    var calendarEl = document.getElementById('calendar');

    var calendar = new FullCalendar.Calendar(calendarEl, {
        plugins: ['interaction', 'dayGrid'],
        locale: 'fr',
        selectable: true,
        dateClick: function (info) {
            const el = info.dayEl;
            if ($(el).hasClass("working-day")) {
                $(el).removeClass("working-day")
            }else{
                addWorkingClass(el);
            }
        },
        events: [
            {
                id: 1,
                title: '1',
                start: '2019-06-05',
                classNames: ["available"]
            },
            {
                id: 23,
                title: '23',
                start: '2019-06-05',
                classNames: ["available"]
            },
            {
                id: 12,
                title: '12',
                start: '2019-06-05',
                classNames: ["reserved"]
            },
            {
                id: 45,
                title: '45',
                start: '2019-06-05',
                classNames: ["available"]
            }
        ]
    });

    calendar.render();
});
function appendDayCheckboxes(workingDays) {
    const checkboxes = '<tr class="workingDaysCheckboxes">\n' +
        '        <td style="text-align: center"><input type="checkbox" value="1"/></td>\n' +
        '        <td style="text-align: center"><input type="checkbox" value="2"/></td>\n' +
        '        <td style="text-align: center"><input type="checkbox" value="3"/></td>\n' +
        '        <td style="text-align: center"><input type="checkbox" value="4"/></td>\n' +
        '        <td style="text-align: center"><input type="checkbox" value="5"/></td>\n' +
        '        <td style="text-align: center"><input type="checkbox" value="6"/></td>\n' +
        '        <td style="text-align: center"><input type="checkbox" value="0"/></td>\n' +
        '    </tr>';
    $(".fc-row.fc-widget-header table thead").prepend(checkboxes);
    $(".workingDaysCheckboxes td input").off().change(function(){
        const checked = $(this).prop("checked");
        const val = $(this).val();
        saveCheckboxState(checked, val);
        changeColomnState(checked, val);
    });
    populateWorkingDays(workingDays);
}

function saveCheckboxState(checked, val) {
    if (checked) {
        saveLocalStorageChecked(val);
    } else {
        removeLocalStorageChecked(val);
    }
}

function autoChecked(val) {
    $('.workingDaysCheckboxes td input[value="' + val + '"]').prop("checked", true);
}

function addWorkingClass(htmlEl) {
    if ($(htmlEl).hasClass("fc-future")) {
        if (!$(htmlEl).hasClass("fc-other-month")) {
            $(htmlEl).addClass("working-day");
        }
    }
}

function removeWorkingClass(htmlEl) {
    $(htmlEl).removeClass("working-day");
}

function getColumnEls(val) {
    switch (val) {
        case "0": case 0:
            return $(".fc-sun");
        case "1": case 1:
            return $(".fc-mon");
        case "2": case 2:
            return $(".fc-tue");
        case "3": case 3:
            return $(".fc-wed");
        case "4": case 4:
            return $(".fc-thu");
        case "5": case 5:
            return $(".fc-fri");
        case "6": case 6:
            return $(".fc-sat");
    }
}

function changeColomnState(checked, val) {

    const els = getColumnEls(val);
    if (checked) {
        els.each(function(index, el){
            addWorkingClass(el);
        });
    }else{
        els.each(function(index, el){
            removeWorkingClass(el);
        });
    }
}

function saveLocalStorageChecked(val) {
    let workingDays = getWorkingDays();
    if (!workingDays.includes(val)) {
        workingDays.push(val);
    }
    saveWorkingDays(workingDays);
}

function removeLocalStorageChecked(val) {
    let workingDays = getWorkingDays();
    if (workingDays.includes(val)) {
        let i = workingDays.findIndex(function(el){
            return parseInt(el,10) === parseInt(val,10);
        });
        workingDays.splice(i, 1);
    }
    saveWorkingDays(workingDays);
}

function appendMonthButton() {
    let btn = '<button class="fc-button fc-button-success btn-month-selection">mois</button>';
    $(".fc-left").append(btn);
}

function monthListenerButton() {
    $(".btn-month-selection").click(function () {
        daysAddWorkingClass();
    });
}
function appendRowButton() {
    $(".fc-widget-header table thead tr").append("<th></th>");
    $(".fc-row.fc-widget-content .fc-bg table tbody tr").append("<td></td>");
    let btn = '<td style="text-align: center;">';
    btn += '<button class="fc-button fc-button-success btn-row-selection">';
    btn += 'toute la semaine</button>';
    btn += '</td>';
    $(".fc-row.fc-widget-content .fc-content-skeleton table tbody tr:first-child").append(btn);
}

function rowListenerButton() {
    $(".btn-row-selection").off().click(function () {
        let parent = $(this).parents(".fc-row.fc-widget-content");
        daysAddWorkingClass(parent);
    });
}

function prevAndNextListenerFromCalendar() {
    $('.fc-today-button').off().click(function() {
        rebuildInteractionParts();
    });
    $('.fc-prev-button').off().click(function() {
        rebuildInteractionParts();
    });
    $('.fc-next-button').off().click(function() {
        rebuildInteractionParts();
    });
}

function rebuildInteractionParts() {
    appendDayCheckboxes();
    appendRowButton();
    rowListenerButton();
}

function daysAddWorkingClass(context) {
    let days = $(".fc-day", context);
    days.each(function (i, el) {
        addWorkingClass(el);
    })
}

function appendResetButton() {
    $(".fc-right").append("<button class='fc-button fc-button-reset btn-month-reset'>RESET</button>");
    $(".btn-month-reset").click(function () {
        const days = $(".fc-day.working-day");
        days.each(function (i, el) {
            $(el).removeClass("working-day");
        });
        populateWorkingDays();
    });
}

function populateWorkingDays(workingDays) {
    workingDays = workingDays || getWorkingDays();
    workingDays.map(function(val){
        autoChecked(val);
        changeColomnState(true, val);
    });
}

function createWorkingDays() {
    const workingDays = ['3', '6'];
    localStorage.setItem('working-days', JSON.stringify(workingDays));
    return workingDays;
}

function saveWorkingDays(workingDays) {
    localStorage.setItem('working-days', JSON.stringify(workingDays));
}

function getWorkingDays() {
    const workingDaysStr = localStorage.getItem('working-days');
    return JSON.parse(workingDaysStr) || createWorkingDays();
}

function appendSaveButton() {
    $(".fc-right").append("<button class='fc-button fc-button-send btn-month-send'>ENVOYER</button>");
    $(".btn-month-send").click(function () {
        getWorkingDaysClassified()
    });
}

function getWorkingDaysClassified() {
    const days = $(".fc-day.working-day");
    days.each(function (i, el) {
        sendMeToSave(el);
    });
}

function sendMeToSave(htmlEl) {
    if ($(htmlEl).hasClass("fc-future")) {
        if (!$(htmlEl).hasClass("fc-other-month")) {
            console.log($(htmlEl).attr('data-date'));
        }
    }
}

$(document).ready(function () {
    const workingDays = getWorkingDays();
    appendDayCheckboxes(workingDays);
    appendSaveButton();
    appendResetButton();
    appendRowButton();
    rowListenerButton();
    appendMonthButton();
    monthListenerButton();
    prevAndNextListenerFromCalendar();
});
