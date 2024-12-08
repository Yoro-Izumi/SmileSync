
$('.icon').click(function () {
  if ($('#password').attr('type') == 'text') {
    $('#password').attr('type', 'password');
    $('#show-password').removeClass('fa-eye-slash').addClass('fa-eye');
  } else {
    $('#password').attr('type', 'text');
    $('#show-password').removeClass('fa-eye').addClass('fa-eye-slash');
  }
});
