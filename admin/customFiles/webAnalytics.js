async function setTimelyWebAnalytics() {
    // Today
    console.log("Fetching (today)");
    await $.getJSON("customFiles/php/google/getWebAnalytics_timely.php", null,
    function (data, textStatus, jqXHR) {
        displayTimelyWebAnalytics(data, 0);
        console.group("Today");
        console.log(data);
        console.groupEnd("Today");
    });
    // 5d
    console.log("Fetching (5 days ago)");
    $.getJSON("customFiles/php/google/getWebAnalytics_timely.php?range=1", null,
    function (data, textStatus, jqXHR) {
        displayTimelyWebAnalytics(data, 1);
        console.group("5 days");
        console.log(data);
        console.groupEnd("5 days");
    });
    // 1m
    console.log("Fetching (1 month ago)");
    $.getJSON("customFiles/php/google/getWebAnalytics_timely.php?range=2", null,
    function (data, textStatus, jqXHR) {
        displayTimelyWebAnalytics(data, 2);
        console.group("1 Month");
        console.log(data);
        console.groupEnd("1 Month");
    });
    // 1y
    console.log("Fetching (1 year ago)");
    $.getJSON("customFiles/php/google/getWebAnalytics_timely.php?range=3", null,
    function (data, textStatus, jqXHR) {
        displayTimelyWebAnalytics(data, 3);
        console.group("1 Year");
        console.log(data);
        console.groupEnd("1 Year");
    });
    // Max
    console.log("Fetching (Max)");
    $.getJSON("customFiles/php/google/getWebAnalytics_timely.php?range=4", null,
    function (data, textStatus, jqXHR) {
        displayTimelyWebAnalytics(data, 4);
        console.group("Max");
        console.log(data);
        console.groupEnd("Max");
    });
}

function displayTimelyWebAnalytics(data, tabIndex = 0) {
    let content_analytics_session =  $("#analytics-sessions > .inner .timetabCardContent")[tabIndex];
    let content_analytics_session_average =  $("#analytics-session-average > .inner .timetabCardContent")[tabIndex];
    let analytics_page_views_per_session =  $("#analytics-page_views-per_session > .inner .timetabCardContent")[tabIndex];

    let content_analytics_user =  $("#analytics-users > .inner .timetabCardContent")[tabIndex];
    let content_analytics_user_new =  $("#analytics-users-new > .inner .timetabCardContent")[tabIndex];
    let content_analytics_bounce_rate =  $("#analytics-bounce_rate > .inner .timetabCardContent")[tabIndex];
    //console.log(analytics_user);
    $(content_analytics_session).html(data['ga:sessions']);
    let avgSessionDuration = parseFloat(data['ga:avgSessionDuration'])/60;
    console.log()
    avgSessionDuration = Math.round((avgSessionDuration + Number.EPSILON) * 100) / 100
    $(content_analytics_session_average).html(avgSessionDuration);

    $(content_analytics_user).html(data['ga:users']);
    $(content_analytics_user_new).html(data['ga:newUsers']);
    $(content_analytics_user_new).html(data['ga:newUsers']);
    $(content_analytics_bounce_rate).html(data['ga:bounceRate']);
    $(analytics_page_views_per_session).html(data['ga:pageviewsPerSession']);
}

$(function () {
    setTimelyWebAnalytics();    
});