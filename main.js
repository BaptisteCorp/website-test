// Boite de dialogue create dir
var updateButton = document.getElementById('dirButton');
var dirDialog = document.getElementById('dirDialog');
var outputBox = document.getElementsByTagName('output')[1];
var selectEl = document.getElementById('select');
var confirmBtn = document.getElementById('confirmBtn');
// Le bouton "mettre à jour les détails" ouvre la boîte de dialogue
updateButton.addEventListener('click', function onOpen() {
  if (typeof dirDialog.showModal === "function") {
    dirDialog.showModal();
  } else {
    console.error("L'API dialog n'est pas prise en charge par votre navigateur");
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
    outputBox.value = "Création du dossier \"" +selectEl.value + "\"";
    selectEl.value=="";
  }
});

// Boite de dialogue upload file
var fileButton = document.getElementById('fileButton');
var fileDialog = document.getElementById('fileDialog');
var outputBoxfile = document.getElementsByTagName('output')[0];
const url = 'add_file.php';
var form2 = document.getElementById('form_file');
const cancelButton = document.getElementById('cancelButton');


fileButton.addEventListener('click', function onOpen() {
  if (typeof dirDialog.showModal === "function") {
    fileDialog.showModal();
  } else {
    console.error("L'API dialog n'est pas prise en charge par votre navigateur");
  }
});

form2.addEventListener('submit', e => {
  e.preventDefault();

  const files = document.querySelector('[type=file]').files;
  const formData = new FormData();

  for (let i = 0; i < files.length; i++) {
    let file = files[i];

    formData.append('files[]', file);
  }

  fetch(url, {
    method: 'POST',
    body: formData,
  }).then(response => { console.log(response) })
  document.location.href="dashboard.php"; 
})

cancelButton.addEventListener('click', function() {
  fileDialog.close('Annulé');
});

var fileIcon = document.getElementsByClassName('actionFileButton')[0];
var dirIcon = document.getElementsByClassName('actionDirButton')[0];
var actionFileDialog= document.getElementById('actionFileDialog');
var actionDirDialog= document.getElementById('actionDirDialog');

fileIcon.addEventListener('click', function onOpen() {
  if (typeof actionFileDialog.showModal === "function") {
    actionFileDialog.showModal();
  } else {
    console.error("L'API dialog n'est pas prise en charge par votre navigateur");
  }
});

dirIcon.addEventListener('click', function onOpen() {
  if (typeof actionDirDialog.showModal === "function") {
    actionDirDialog.showModal();
  } else {
    console.error("L'API dialog n'est pas prise en charge par votre navigateur");
  }
});