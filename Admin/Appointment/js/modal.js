document.addEventListener('DOMContentLoaded', function () {
    const cancelAppointmentModal = document.getElementById('cancelAppointmentModal');
    const openModalBtn = document.getElementById('openCancelAppointmentModal');
    const closeModal = document.getElementById('closeCancelAppointmentModal');
    const otherReasonContainer = document.getElementById('otherReasonContainer');
    const reasonRadios = document.querySelectorAll('input[name="reason"]');
  
    // Show the modal
    openModalBtn.addEventListener('click', function () {
      cancelAppointmentModal.style.display = 'block';
    });
  
    // Hide the modal
    closeModal.addEventListener('click', function () {
      cancelAppointmentModal.style.display = 'none';
    });
  
    // Toggle "Other Reasons" input field
    reasonRadios.forEach((radio) => {
      radio.addEventListener('change', function () {
        if (this.value === 'other') {
          otherReasonContainer.style.display = 'block';
        } else {
          otherReasonContainer.style.display = 'none';
          document.getElementById('otherReason').value = ''; // Clear input
        }
      });
    });
  
    // Additional modal logic for other modals
    const modals = {
      existingAccountModal: document.getElementById('existingAccountModal'),
      newAccountModal: document.getElementById('newAccountModal'),
      proceedModal: document.getElementById('proceedModal'),
      deleteNewProgressModal: document.getElementById('deleteNewProgressModal'),
      deleteExistingProgressModal: document.getElementById('deleteExistingProgressModal'),
      appointmentDoneModal: document.getElementById('appointmentDoneModal'),
    };
  
    const buttons = {
      closeDone: document.getElementById('closeDone'),
      newAccount: document.getElementById('newAccount'),
      cancelSubmitNewBtn: document.getElementById('cancelSubmitNewBtn'),
      deleteNewProgressBtn: document.getElementById('deleteNewProgressBtn'),
      cancelNewDeleteBtn: document.getElementById('cancelNewDeleteBtn'),
      existingAccount: document.getElementById('existingAccount'),
      cancelSubmitExistingBtn: document.getElementById('cancelSubmitExistingBtn'),
      deleteExistingProgressBtn: document.getElementById('deleteExistingProgressBtn'),
      cancelExistingDeleteBtn: document.getElementById('cancelExistingDeleteBtn'),
      submitExistingBtn: document.getElementById('submitExistingBtn'),
      submitNewBtn: document.getElementById('submitNewBtn'),
      getAppointmentBtn: document.getElementById('getAppointmentBtn'),
      cancelProceedBtn: document.getElementById('cancelProceedBtn'),
    };
  
    if (buttons.getAppointmentBtn) {
      buttons.getAppointmentBtn.addEventListener('click', function () {
        modals.proceedModal.style.display = 'block';
      });
    }
  
    if (buttons.cancelProceedBtn) {
      buttons.cancelProceedBtn.addEventListener('click', function () {
        modals.proceedModal.style.display = 'none';
      });
    }
  
    if (buttons.closeDone) {
      buttons.closeDone.addEventListener('click', function () {
        modals.appointmentDoneModal.style.display = 'none';
      });
    }
  
    if (buttons.newAccount) {
      buttons.newAccount.addEventListener('click', function () {
        modals.newAccountModal.style.display = 'block';
      });
    }
  
    if (buttons.cancelSubmitNewBtn) {
      buttons.cancelSubmitNewBtn.addEventListener('click', function () {
        modals.newAccountModal.style.display = 'none';
        modals.deleteNewProgressModal.style.display = 'block';
      });
    }
  
    if (buttons.existingAccount) {
      buttons.existingAccount.addEventListener('click', function () {
        modals.existingAccountModal.style.display = 'block';
      });
    }
  
    if (buttons.cancelSubmitExistingBtn) {
      buttons.cancelSubmitExistingBtn.addEventListener('click', function () {
        modals.existingAccountModal.style.display = 'none';
        modals.deleteExistingProgressModal.style.display = 'block';
      });
    }
  
    if (buttons.submitExistingBtn) {
      buttons.submitExistingBtn.addEventListener('click', function () {
        modals.existingAccountModal.style.display = 'none';
      });
    }
  
    if (buttons.submitNewBtn) {
      buttons.submitNewBtn.addEventListener('click', function () {
        modals.newAccountModal.style.display = 'none';
      });
    }
  
    if (buttons.deleteNewProgressBtn) {
      buttons.deleteNewProgressBtn.addEventListener('click', function () {
        modals.deleteNewProgressModal.style.display = 'block';
        modals.newAccountModal.style.display = 'none';
      });
    }
  
    if (buttons.deleteExistingProgressBtn) {
      buttons.deleteExistingProgressBtn.addEventListener('click', function () {
        modals.deleteExistingProgressModal.style.display = 'block';
        modals.existingAccountModal.style.display = 'none';
      });
    }
  
    if (buttons.cancelNewDeleteBtn) {
      buttons.cancelNewDeleteBtn.addEventListener('click', function () {
        modals.deleteNewProgressModal.style.display = 'none';
        modals.newAccountModal.style.display = 'block';
      });
    }
  
    if (buttons.cancelExistingDeleteBtn) {
      buttons.cancelExistingDeleteBtn.addEventListener('click', function () {
        modals.deleteExistingProgressModal.style.display = 'none';
        modals.existingAccountModal.style.display = 'block';
      });
    }
  });
  