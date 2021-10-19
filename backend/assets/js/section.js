!function(i) {
    "use strict";
    i("#section-date").flatpickr({
        // enableTime: false,
        dateFormat: "d.m.Y",
        locale: "ru"
    });
    i("#section-from, #section-to").flatpickr({
        enableTime: !0,
        noCalendar: !0,
        dateFormat: "H:i",
        time_24hr: !0
    })
}(window.jQuery)