document.addEventListener('DOMContentLoaded', function () {
    const niveauSelect = document.getElementById('niveau');
    const ueSelect = document.getElementById('ue_id');
    const etudiantSelect = document.getElementById('etudiant_id');
    const ecSelect = document.getElementById('ec_id');

    // Récupérer les anciennes valeurs injectées dans le script Blade
    const oldNiveau = oldValues.niveau;
    const oldEtudiantId = oldValues.etudiant_id;
    const oldUeId = oldValues.ue_id;
    const oldEcId = oldValues.ec_id;

    // Charger les étudiants si un niveau a été sélectionné précédemment
    if (oldNiveau) {
        fetch('/etudiants/parNiveau/' + oldNiveau)
            .then(response => response.json())
            .then(data => {
                etudiantSelect.innerHTML = '<option value="">Sélectionner un étudiant</option>';
                data.forEach(function (etudiant) {
                    const option = document.createElement('option');
                    option.value = etudiant.id;
                    option.textContent = etudiant.nom + ' ' + etudiant.prenom;
                    if (etudiant.id == oldEtudiantId) {
                        option.selected = true;
                    }
                    etudiantSelect.appendChild(option);
                });
            });
    }

    // Charger les EC si une UE a été sélectionnée précédemment
    if (oldUeId) {
        fetch('/notes/getEcsByUe/' + oldUeId)
            .then(response => response.json())
            .then(data => {
                ecSelect.innerHTML = '<option value="">Sélectionnez un EC</option>';
                data.forEach(function (ec) {
                    const option = document.createElement('option');
                    option.value = ec.id;
                    option.textContent = ec.nom;
                    if (ec.id == oldEcId) {
                        option.selected = true;
                    }
                    ecSelect.appendChild(option);
                });
            });
    }

    // Charger les étudiants dynamiquement en fonction du niveau sélectionné
    niveauSelect.addEventListener('change', function () {
        const niveau = this.value;
        if (niveau) {
            fetch('/etudiants/parNiveau/' + niveau)
                .then(response => response.json())
                .then(data => {
                    etudiantSelect.innerHTML = '<option value="">Sélectionner un étudiant</option>';
                    data.forEach(function (etudiant) {
                        const option = document.createElement('option');
                        option.value = etudiant.id;
                        option.textContent = etudiant.nom + ' ' + etudiant.prenom;
                        etudiantSelect.appendChild(option);
                    });
                });
        }
    });

    // Charger les EC dynamiquement en fonction de l'UE sélectionnée
    ueSelect.addEventListener('change', function () {
        const ueId = this.value;
        if (ueId) {
            fetch('/notes/getEcsByUe/' + ueId)
                .then(response => response.json())
                .then(data => {
                    ecSelect.innerHTML = '<option value="">Sélectionnez un EC</option>';
                    data.forEach(function (ec) {
                        const option = document.createElement('option');
                        option.value = ec.id;
                        option.textContent = ec.nom;
                        ecSelect.appendChild(option);
                    });
                });
        }
    });
});