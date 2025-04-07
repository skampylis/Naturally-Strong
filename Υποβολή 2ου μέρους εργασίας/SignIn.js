document.getElementById("submit-button").onclick = function() {

    var properRedirection = document.getElementById("usernameField").value;
    var admin = properRedirection.localeCompare("admin");
    var creator = properRedirection.localeCompare("creator");
    
    if (admin==0) {
        location.href = "Administrator.html";
    }
    else if (creator==0) {
        location.href = "Creator.html";
    }
    else {
        location.href = "SimpleUser.html";
    }
    
}