window.onload = function() {
    if (window.jQuery) {
        // jQuery is loaded  
        console.log("Yeah jQuery works!");
    } else {
        // jQuery is not loaded
        alert("Doh, jQuery doesn't Work");
    }
}