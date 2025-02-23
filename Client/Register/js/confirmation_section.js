document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('multiStepForm');
    const confirmationSection = document.querySelector('.form-section:last-child');
  
    form.addEventListener('input', function(event) {
      updateConfirmationSection();
    });
  
    function updateConfirmationSection() {
      const formData = new FormData(form);
  
      // Personal Information
      const firstName = formData.get('firstName');
      const lastName = formData.get('lastName');
      const middleName = formData.get('middleName');
      const suffix = formData.get('suffix');
      const birthday = formData.get('birthday');
      const sex = formData.get('sex');
      const province = formData.get('province');
      const city = formData.get('city');
      const barangay = formData.get('barangay');
      const streetAddress = formData.get('street_address');
      const phoneNumber = formData.get('phoneNumber');
  
      // Emergency Contact
      const emergencyContact = formData.get('emergencyContact');
      const emergencyContactNumber = formData.get('emergencyContactNumber');
      const emergencyContactRelationship = formData.get('emergencyContactRelationship');
  
      // Appointment Details
      const appointmentDate = formData.get('cal-day');
      const services = formData.get('services');
//      const dentist = formData.get('dentist');
//      const amountCharge = formData.get('amountCharge');
  
      // Update Personal Information in Confirmation Section
      confirmationSection.querySelector('.validation-section:nth-child(1)').innerHTML = `
        <h3>Personal Information</h3>
        <div><span>Patient Name:</span> ${lastName}, ${firstName} ${middleName} ${suffix}</div>
        <div><span>Age:</span> ${calculateAge(birthday)}</div>
        <div><span>Sex:</span> ${sex}</div>
        <div><span>Address:</span> ${streetAddress}, ${barangay}, ${city}, ${province}</div>
        <div><span>Phone Number:</span> ${phoneNumber}</div>
        <div><span>Birth Date:</span> ${formatDate(birthday)}</div>
      `;
  
      // Update Emergency Contact in Confirmation Section
      confirmationSection.querySelector('.validation-section:nth-child(2)').innerHTML = `
        <h3>Emergency Contact</h3>
        <div><span>In case of emergency, please contact:</span> ${emergencyContact}</div>
        <div><span>Phone Number:</span> ${emergencyContactNumber}</div>
        <div><span>Relationship:</span> ${emergencyContactRelationship}</div>
      `;
  
      // Update Appointment Details in Confirmation Section
      confirmationSection.querySelector('.validation-section:nth-child(3)').innerHTML = `
        <h3>Appointment Details</h3>
        <div><span>Appointment Date:</span> ${formatDate(appointmentDate)}</div>
        <div><span>Procedure/s:</span> ${services}</div>
        <div><span>Dentist:</span>  </div>
        <div><span>Amount Charge:</span> </div>
      `;
    }
  
    function calculateAge(birthday) {
      const birthDate = new Date(birthday);
      const difference = Date.now() - birthDate.getTime();
      const ageDate = new Date(difference);
      return Math.abs(ageDate.getUTCFullYear() - 1970);
    }
  
    function formatDate(date) {
      const d = new Date(date);
      const month = '' + (d.getMonth() + 1);
      const day = '' + d.getDate();
      const year = d.getFullYear();
  
      return [month, day, year].join('/');
    }
  });