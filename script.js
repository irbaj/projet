function editUser(user) {
    // Remplir les champs
    document.getElementById('userId').value = user.id;
    document.getElementById('name').value = user.name;
    document.getElementById('email').value = user.email;

    // Changer les boutons
    document.getElementById('saveBtn').style.display = 'none';
    document.getElementById('updateBtn').style.display = 'inline-block';

    // Ajouter des messages sous les champs
    let nameField = document.getElementById('name');
    let emailField = document.getElementById('email');

    // Supprimer les anciens messages s'ils existent
    let oldNameMsg = document.getElementById('nameMsg');
    let oldEmailMsg = document.getElementById('emailMsg');
    if (oldNameMsg) oldNameMsg.remove();
    if (oldEmailMsg) oldEmailMsg.remove();

    // Créer et afficher les nouveaux messages
    let nameMsg = document.createElement('small');
    nameMsg.id = 'nameMsg';
    nameMsg.style.color = 'orange';
    nameMsg.innerText = 'Nom modifié : ' + user.name;
    nameField.after(nameMsg);

    let emailMsg = document.createElement('small');
    emailMsg.id = 'emailMsg';
    emailMsg.style.color = 'orange';
    emailMsg.innerText = 'Email modifié : ' + user.email;
    emailField.after(emailMsg);
}
