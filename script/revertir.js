//Autoclose
window.setTimeout(function () {
  $(".alert")
    .fadeTo(1500, 0)
    .slideDown(1000, function () {
      $(this).remove();
    });
}, 3000); //2 segundos y desaparece
