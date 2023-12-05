function validateForm() {
  var name = document.forms["contact-form"]["name"].value;
  var email = document.forms["contact-form"]["email"].value;
  var subject = document.forms["contact-form"]["subject"].value;
  var message = document.forms["contact-form"]["message"].value;

  if (name == "" || email == "" || subject == "" || message == "") {
    alert("Todos los campos deben ser llenados.");
    return false;
  }

  // Show the success message
  document.getElementById("success-message").style.display = "block";

  // Hide the message and refresh the form after 3 seconds
  setTimeout(function () {
    document.getElementById("success-message").style.display = "none";
    document.forms["contact-form"].reset();
  }, 3000);
}
