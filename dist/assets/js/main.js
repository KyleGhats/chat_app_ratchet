$(document).ready(function () {
    let conn = new WebSocket("ws://localhost:8080");
    let chatForm = $(".chatForm"), 
        messageInputField = chatForm.find("#message"), 
        messagesList = $(".message_list");

    chatForm.on("submit", function(e){
        e.preventDefault();
        let message = messageInputField.val();
        conn.send(message);

        messagesList.prepend(`<li>${message}</li>`);
    });
    conn.onopen = function (e) {
        console.log("Connection established!");
    };
    conn.onmessage = function (e) {
        console.log(e.data)
        messagesList.prepend(`<li>${e.data}</li>`);
    }
});
