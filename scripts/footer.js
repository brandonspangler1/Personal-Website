const form = document.getElementById('contactForm');
window.onload = function(){form.reset()};

formSubmitButton = document.getElementById("submit");

function submitLockout() {
    formSubmitButton.value = 'Submitting';
    formSubmitButton.disabled = true;
    formSubmitButton.style.cursor = "not-allowed";
}

function submitOpen() {
    document.getElementById("contactForm").reset();
    formSubmitButton.value = 'Submit';
    formSubmitButton.disabled = false;
    formSubmitButton.style.cursor = "pointer";
}

$(document).ready(function(){
    $("#contactForm").submit(function(event) {
        event.preventDefault();
        submitLockout();
        var form = $("#contactForm");
        var url = form.attr('action');
        $.ajax({
            type: "POST",
            timeout: 10000,
            url: url,
            data: form.serialize(),
            success: function(data) {
                // Ajax call completed successfully
                alert("Message Sent Successfully");
                submitOpen();
            },
            error:  function(data) {
                        alert("Message failed to send. Please try again later.");
                        submitOpen();
                    }
        });
    });
});