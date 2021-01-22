function getMessages() {
  // Créer une requête AJAX pour se connecter au serveur
  const requeteAjax = new XMLHttpRequest();
  requeteAjax.open("GET", "?json=true");

  // Quand elle reçoit les données, il faut qu'elle les traite (en exploitant le JSON) et il faut qu'elle affiche ces données au format HTML
  requeteAjax.onload = function () {
    const resultat = JSON.parse(requeteAjax.responseText);
    const html = resultat
      .reverse()
      .map(function (message) {
        return `
          <div class="message">
            <span class="date">${message.dateMsg}</span>
            <span class="author">${message.nom} ${message.prenom}</span> : 
            <span class="content">${message.message}</span>
          </div>
        `;
      })
      .join("");

    const messages = document.querySelector(".messages");

    messages.innerHTML = html;
    messages.scrollTop = messages.scrollHeight;
  };

  // On envoie la requête
  requeteAjax.send();
}

/**
 * Envoyer le nouveau message au serveur et rafraichir les messages
 */

function postMessage(event) {
  // 1. Stoper le submit du formulaire
  event.preventDefault();

  // 2. Récupérer les données du formulaire
  const content = document.querySelector("#content");

  // 3. Conditionner les données
  const data = new FormData();
  data.append("message", content.value);

  // 4. Configurer une requête ajax en POST et envoyer les données
  const requeteAjax = new XMLHttpRequest();
  requeteAjax.open("POST", "");

  requeteAjax.onload = function () {
    content.value = "";
    content.focus();
    getMessages();
  };
  requeteAjax.send(data);
}

document.querySelector("#envoiMessage").addEventListener("submit", postMessage);

/**
 * Intervale qui demande le rafraichissement
 * des messages toutes les 3 secondes et qui donne
 * l'illusion du temps réel.
 */
const interval = window.setInterval(getMessages, 3000);
getMessages();
