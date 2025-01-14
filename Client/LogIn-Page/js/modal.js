document.addEventListener('DOMContentLoaded', () => {

    // Open the modal when "Set Appointment" is clicked
    document.getElementById('getAppointmentBtn').addEventListener('click', () => {
        document.getElementById('registerModal').style.display = 'flex';
      });
      
      // Close the modal when "Cancel" is clicked
      document.querySelector('.btn.cancel').addEventListener('click', () => {
        document.getElementById('registerModal').style.display = 'none';
      });
      
      // Redirect to a URL when "Proceed" is clicked
      document.querySelector('.btn.proceed').addEventListener('click', () => {
        const targetUrl = 'https://smilesync.site/SmileSync/Client/Register/Register-Page.php'; // Replace with your desired URL
        window.location.href = targetUrl;
      });
      
      // Optional: Close the modal if clicked outside the modal content
      window.addEventListener('click', (e) => {
        const modal = document.getElementById('registerModal');
        if (e.target === modal) {
          modal.style.display = 'none';
        }
      });
      
    });