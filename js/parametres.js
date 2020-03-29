var mdpButton = document.getElementById('changer_mdp');
var mdpButtonDialog= document.getElementById('mdpDialog');
var cancelButton = document.getElementById('cancel');

mdpButton.addEventListener('click', function onOpen() {
    if (typeof mdpButtonDialog.showModal === "function") {
      mdpButtonDialog.showModal();
    } else {
      window.alert("L'API dialog n'est pas prise en charge par votre navigateur");
    }
  });

cancelButton.addEventListener('click', function() {
  mdpButtonDialog.close('Annulé');
});