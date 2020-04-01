var suppButton = document.getElementById('suppButton');
var suppDialog= document.getElementById('suppDialog');
var cancelButton = document.getElementById('cancel');

suppButton.addEventListener('click', function onOpen() {
    if (typeof suppDialog.showModal === "function") {
      suppDialog.showModal();
    } else {
      window.alert("L'API dialog n'est pas prise en charge par votre navigateur");
    }
  });

cancelButton.addEventListener('click', function() {
  suppDialog.close('Annulé');
});