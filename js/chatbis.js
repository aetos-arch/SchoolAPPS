function getMessages() {
  $.get("?json=true", (json) => {
      console.log(json);
    let message = $(".messages").html(
      json
        .reverse()
        .map(
          (msg) => `
            <div class="message">
                <span class="date">${msg.dateMsg}</span>
                <span class="author">${msg.nom} ${msg.prenom}</span> : 
                <span class="content">${msg.message}</span>
            </div>
        `
        )
        .join("")
    );
    message.scrollTop(message[0].scrollHeight);
  });
}

$("#envoiMessage").submit((e) => {
  e.preventDefault();
  let msg = $("#content");
  $.post("", { message: msg.val() }, () => {
    msg.val("");
    msg.focus();
    getMessages();
  });
});

setInterval(getMessages, 3000);

getMessages();
