  // Function to hide success and error messages after 5 seconds
  function hideMessage() {
    setTimeout(function() {
      const messages = document.querySelectorAll('.message');
      messages.forEach(message => {
        message.style.display = 'none';
      });
    }, 5000);
  }

  // Call the function to hide messages after page load
  window.onload = hideMessage;



