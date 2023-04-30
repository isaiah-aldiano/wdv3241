

$(document).ready(function() {
    // Handle form submission
    $("#submit").click(function(event) {
      // Prevent the default form submission behavior
      event.preventDefault();
      let name = $('#name').val()
      let email = $('$email').val()
      let message = $('message').val()

      // Send an AJAX request to the server
      $.ajax({
        url: "Contact-Response.php",
        type: "POST",
        data: {name: name, email: email, message: message},
        success: function() {
          // Handle the response from the server
          $("#FormSection").html("")
          $("$ThankYouResponse").css("display", "contents")
          $("#ThankYouResponse").html("<h1>Thank you " + name + " for contacting us. We'll get back to you as soon as possible.</h1>")
        }
      });
    });
  });
  