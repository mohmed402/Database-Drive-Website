// Function to start the timer
function startTimer(duration, callback) {
  var timer = duration;
  setInterval(function () {
    if (--timer < 0) {
      callback();
    }
  }, 1000);
}

// Start the timer when the page is loaded
window.onload = function () {
  var tenSeconds = 1800; // Change to desired duration in seconds
  startTimer(tenSeconds, function () {
    // When the timer expires, send an AJAX request to a PHP script to end the session
    var xhr = new XMLHttpRequest();
    xhr.open("get", "../../actions/logout.php", true);
    xhr.send();
  });
};
