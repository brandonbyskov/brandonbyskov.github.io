function header_get_focus(event) {
    document.getElementById(event.currentTarget.id).style.color = "black";
    document.getElementById(event.currentTarget.id).style.background = "#8CDAF1";
}
function header_lost_focus(event) {
    if (event.currentTarget.id == "thisPage") {
        document.getElementById(event.currentTarget.id).style.color = "black";
        document.getElementById(event.currentTarget.id).style.background = "#E8E8E8";
    }
    else {
        document.getElementById(event.currentTarget.id).style.color = "#00ADE0";
        document.getElementById(event.currentTarget.id).style.background = "#505050";
    }
}