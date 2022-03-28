function uploadAvatar() {
    const actualBtn = document.getElementById('avatar');
  
    const fileChosen = document.getElementById('fichier');
  
    actualBtn.addEventListener('change', function(){
      fileChosen.textContent = this.files[0].name
    })
}

///////////////////

