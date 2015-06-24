

/**
 * Created by pascal on 31.05.15.
 */

(function(){
    var treskBtn = document.getElementById("tresk_button");
    var wilhBtn = document.getElementById("wilh_button");
    var treskDropdown = document.getElementById("tresk_dropdown");
    var wilhDropdown = document.getElementById("wilh_dropdown");
    var treskDropdownLabel = document.getElementById("tresk_dropdown_label");
    var wilhDropdownLabel = document.getElementById("wilh_dropdown_label");
    var treskDropdownElements = document.getElementsByClassName("tresk_dropdown_elem");
    var wilhDropdownElements = document.getElementsByClassName("wilh_dropdown_elem");
    var searchBtn = document.getElementById("search_btn");
    var spinner = new Spinner(spinnerOptions());
    var currBuilding;


    setupSpinner();
    setPickerTime();
    makeWilhelmDefault();

    function makeWilhelmDefault() {
        $("#wilh_button").addClass("active");
    }

    function setPickerTime() {
        $("#datetimepicker").val(moment().format().substring(0, 16));
    }

    function setupSpinner() {
        //http://fgnass.github.io/spin.js/
        hideSpinner();
        var target = document.getElementById("spinner-wrapper");
        spinner.spin(target);
    }


    //      ____                                  ____        _   _
    //     / ___|__ _ _ __ ___  _ __  _   _ ___  | __ ) _   _| |_| |_ ___  _ __
    //    | |   / _` | '_ ` _ \| '_ \| | | / __| |  _ \| | | | __| __/ _ \| '_ \
    //    | |__| (_| | | | | | | |_) | |_| \__ \ | |_) | |_| | |_| || (_) | | | |
    //     \____\__,_|_| |_| |_| .__/ \__,_|___/ |____/ \__,_|\__|\__\___/|_| |_|
    //                         |_|

    treskBtn.addEventListener('click', function (event) {
        event.preventDefault();
        treskDropdown.style.display = "inline-block";
        wilhDropdown.style.display = "none";
        $("#tresk_button").addClass("active");
        $("#wilh_button").removeClass("active");
    });

    wilhBtn.addEventListener('click', function (event) {
        event.preventDefault();
        treskDropdown.style.display = "none";
        wilhDropdown.style.display = "inline-block";
        $("#wilh_button").addClass("active");
        $("#tresk_button").removeClass("active");
    });

    //     ____  _   _ ___ _     ____ ___ _   _  ____
    //    | __ )| | | |_ _| |   |  _ \_ _| \ | |/ ___|
    //    |  _ \| | | || || |   | | | | ||  \| | |  _
    //    | |_) | |_| || || |___| |_| | || |\  | |_| |
    //    |____/ \___/|___|_____|____/___|_| \_|\____|
    //
    //     ____  ____   ___  ____  ____   _____        ___   _
    //    |  _ \|  _ \ / _ \|  _ \|  _ \ / _ \ \      / / \ | |
    //    | | | | |_) | | | | |_) | | | | | | \ \ /\ / /|  \| |
    //    | |_| |  _ <| |_| |  __/| |_| | |_| |\ V  V / | |\  |
    //    |____/|_| \_\\___/|_|   |____/ \___/  \_/\_/  |_| \_|


    for (var i = 0; i < treskDropdownElements.length; i++) {
        treskDropdownElements[i].addEventListener('click', function (event) {
            var txt = event.srcElement.innerText;
            treskDropdownLabel.innerText = txt;
            $('#tresk_dropdown_btn').css('background-color', '#fff');
            $('#wilh_dropdown_btn').css('background-color', '#fff');
            currBuilding = txt;
        });
    }

    for (var i = 0; i < wilhDropdownElements.length; i++) {
        wilhDropdownElements[i].addEventListener('click', function (event) {
            var txt = event.srcElement.innerText;
            wilhDropdownLabel.innerText = txt;
            $('#tresk_dropdown_btn').css('background-color', '#fff');
            $('#wilh_dropdown_btn').css('background-color', '#fff');
            currBuilding = txt;
        });
    }


    //   ____  _____    _    ____   ____ _   _   ____  _   _ _____ _____ ___  _   _
    //  / ___|| ____|  / \  |  _ \ / ___| | | | | __ )| | | |_   _|_   _/ _ \| \ | |
    //  \___ \|  _|   / _ \ | |_) | |   | |_| | |  _ \| | | | | |   | || | | |  \| |
    //  _ __) | |___ / ___ \|  _ <| |___|  _  | | |_) | |_| | | |   | || |_| | |\  |
    //  |____/|_____/_/   \_\_| \_\\____|_| |_| |____/ \___/  |_|   |_| \___/|_| \_|

    function spinnerOptions() {
        //http://fgnass.github.io/spin.js/
        return {
            lines: 13 // The number of lines to draw
            , length: 28 // The length of each line
            , width: 14 // The line thickness
            , radius: 42 // The radius of the inner circle
            , scale: 0.15 // Scales overall size of the spinner
            , corners: 1 // Corner roundness (0..1)
            , color: '#000' // #rgb or #rrggbb or array of colors
            // #rgb or #rrggbb or array of colors
            , opacity: 0.3 // Opacity of the lines
            , rotate: 0 // The rotation offset
            , direction: 1 // 1: clockwise, -1: counterclockwise
            , speed: 0.9 // Rounds per second
            , trail: 60 // Afterglow percentage
            , fps: 20 // Frames per second when using setTimeout() as a fallback for CSS
            , zIndex: 2e9 // The z-index (defaults to 2000000000)
            , className: 'spinner' // The CSS class to assign to the spinner
            , top: '50%' // Top position relative to parent
            , left: '0%' // Left position relative to parent
            , shadow: false // Whether to render a shadow
            , hwaccel: false // Whether to use hardware acceleration
            , position: 'relative' // Element positioning
        }
    }

    function hideSpinner() {
        $('#spinner-wrapper').css('display', 'none');
    }

    function showSpinner() {
        $('#spinner-wrapper').css('display', 'block');
    }

    searchBtn.addEventListener('click', function (event) {
        var date = $('#datetimepicker').val().substring(0, 10);
        var time = $('#datetimepicker').val().substring(11);
        searchBtn.style.backgroundColor = 'rgba(23, 199, 70, 0.63)';


        if (!currBuilding) {
            $('#tresk_dropdown_btn').css('background-color', 'rgba(215, 0, 8, 0.35)');
            $('#wilh_dropdown_btn').css('background-color', 'rgba(215, 0, 8, 0.35)');
        }
        else {
            showSpinner();
            $('#result').empty();
            $('#result').load("room_finder/availableRooms/" + encodeURIComponent(currBuilding) + "/" + date + "/" + time, hideSpinner());
        }
    })
})();