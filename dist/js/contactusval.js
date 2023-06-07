window.onload = function validateForm() {
    const name = document.getElementById("name").value;
    const email = document.getElementById("email").value;
    const phone = document.getElementById("phone").value;
    const subject = document.getElementById("subject").value;
    const message = document.getElementById("message").value;
  
    if (name === "") {
      alert("Name field cannot be left empty");
      return false;
    }
  
    if (!validateEmail(email)) {
      alert("Email field must contain a valid email address");
      return false;
    }
  
    if (!validatePhone(phone)) {
      alert("Phone field must contain 10 digits and start with 98");
      return false;
    }
  
    if (subject === "") {
      alert("Subject field cannot be left empty");
      return false;
    }
  
    if (message === "") {
      alert("Message field cannot be left empty");
      return false;
    }
  
    return true;
  }
  
  function validateEmail(email) {
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return emailRegex.test(email);
  }
  
  function validatePhone(phone) {
    const phoneRegex = /^98\d{8}$/;
    return phoneRegex.test(phone);
  }
  