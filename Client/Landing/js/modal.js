document.addEventListener('DOMContentLoaded', () => {
  const setAppointmentBtn = document.getElementById('setAppointmentBtn');
  const registerModal = document.getElementById('registerModal');
  const cancelBtn = document.querySelector('.btn.cancel');
  const proceedBtn = document.querySelector('.btn.proceed');

  // Check if elements exist before adding event listeners
  if (setAppointmentBtn && registerModal && cancelBtn && proceedBtn) {
    // Open the modal when "Set Appointment" is clicked
    setAppointmentBtn.addEventListener('click', () => {
      registerModal.style.display = 'flex';
    });

    // Close the modal when "Cancel" is clicked
    cancelBtn.addEventListener('click', () => {
      registerModal.style.display = 'none';
    });

    // Redirect to a URL when "Proceed" is clicked
    proceedBtn.addEventListener('click', () => {
      const targetUrl = '../Register/Register-Page.php'; // Replace with your desired URL
      window.location.href = targetUrl;
    });

    // Optional: Close the modal if clicked outside the modal content
    window.addEventListener('click', (e) => {
      if (e.target === registerModal) {
        registerModal.style.display = 'none';
      }
    });
  } else {
    console.error('One or more elements not found!');
  }
});