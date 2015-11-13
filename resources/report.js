/**
 * Created by Milind Gour on 9/23/15.
 */

$(function() {

    checkAndEnableSessions();
    $('#idRegion').change(function () {

        disableSession(true);
        updateSessionList();
        checkAndEnableSessions();

    });
    $('#idDate').change(function() {
        resetRegionSelection();
        checkAndEnableSessions();
    });
});

function resetRegionSelection() {
    $('#idRegion').prop('value', 0);
}
function resetSessionSelection() {
    $('#idSession').prop('value', 0);
}

function disableSession(disable) {
    $('#idSession').prop('disabled', disable).prop('value', 0);
}

function checkAndEnableSessions() {
    var regionIndex = $('#idRegion').val();
    //alert(regionIndex);
    if (regionIndex <= 0) {
        disableSession(true);
    } else {
        disableSession(false);
    }
}
function updateSessionList() {

    var innerHTMLText = "<option value='0'>All</option>";
    var dateSelected = $('#idDate').val();
    //alert(dateSelected);
    var regionSelected = $('#idRegion').val();
    //alert(region);
    $.get("report.php", { date: dateSelected, region: regionSelected }, function (d,s,x) {

        if (s == 'success') {
            var json = JSON.parse(d);
            var success = json['success'];
            if (success) {
                var list = json['response'];

                for (var i =0; i<list.length; i++) {
                    var str = list[i]['sched_activity'];
                    var schedId = list[i]['sched_id'];
                    innerHTMLText += "<option value='" + schedId + "'>" + schedId + ": " + str + "</option>";
                }

                $('#idSession').html(innerHTMLText);
            }
        }

        resetSessionSelection();
    });
}