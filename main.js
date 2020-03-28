(function() {
    var updateButton = document.getElementById('updateDetails');
    var favDialog = document.getElementById('favDialog');
    var outputBox = document.getElementsByTagName('output')[0];
    var selectEl = document.getElementById('select');
    var confirmBtn = document.getElementById('confirmBtn');
  
    // Le bouton "mettre à jour les détails" ouvre la boîte de dialogue
    updateButton.addEventListener('click', function onOpen() {
      if (typeof favDialog.showModal === "function") {
        favDialog.showModal();
      } else {
        console.error("L'API dialog n'est pas prise en charge par votre navigateur");
      }
    });
    // Récupèration du nom choisi
    selectEl.addEventListener('change', function onSelect(e) {
      confirmBtn.value = selectEl.value;
    });
    // Le bouton "Confirmer" déclenche l'évènement "close" sur le dialog avec [method="dialog"]
    favDialog.addEventListener('close', function onClose() {
      outputBox.value = "Création du dossier \"" + favDialog.returnValue + "\"";
    });
  })();