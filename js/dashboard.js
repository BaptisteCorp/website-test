// Boite de dialogue create dir
var updateButton = document.getElementById('dirButton');
var dirDialog = document.getElementById('dirDialog');
var outputBox = document.getElementsByTagName('output')[0];
var selectEl = document.getElementById('select');
var confirmBtn = document.getElementById('confirmBtn');
// Le bouton "mettre à jour les détails" ouvre la boîte de dialogue
updateButton.addEventListener('click', function onOpen() {
  if (typeof dirDialog.showModal === "function") {
    dirDialog.showModal();
  } else {
    window.alert("L'API dialog n'est pas prise en charge par votre navigateur");
  }
});

 //Le bouton "Confirmer" déclenche l'évènement "close" sur le dialog avec [method="dialog"]
dirDialog.addEventListener('close', function onClose() {
  if (selectEl.value==""){
    outputBox.value = "Vous n'avez pas renseigné de nom";
  }else{
    const xhttp = new XMLHttpRequest();
    const destination='add_dir.php?nom_dossier='+selectEl.value;
    
    xhttp.open("GET",destination);
    xhttp.send();
    document.location.href="dashboard.php";
  }
  
});

// Upload file
var fileButton = document.getElementById('fileButton');
var fileDialog = document.getElementById('fileDialog');
var cancelfileDialog = document.getElementById('cancelfileDialog');

fileButton.addEventListener('click', function onOpen() {
  if (typeof dirDialog.showModal === "function") {
    fileDialog.showModal();
  } else {
    window.alert("L'API dialog n'est pas prise en charge par votre navigateur");
  }
});

cancelfileDialog.addEventListener('click',function(){
  fileDialog.close();
})


//Afficher le sous-menu nouveau
$(function(){
  $('#nouveauBtn').on('click touch', function(e){
      $('#nouveau').slideToggle();
  });
});

// script pour déplacer un fichier dans le dossier parent
var returnBtn = document.getElementById('returnBtn');
returnBtn.addEventListener('drop', function(e) {
  e.preventDefault(); // Annule l'interdiction de dragover

  //alert('Fonction non disponible');
  console.log(draggedElement);
  const xhttp = new XMLHttpRequest();
  const destination='deplacement.php?fichier='+draggedElement;
  
  xhttp.open("GET",destination);
  xhttp.send();
  document.location.href="dashboard.php";
});
returnBtn.addEventListener('dragover', function(e) {
  e.preventDefault(); // Annule l'interdiction de drop
  
});
