//  var  setInter = null;
function MyFunction()
{

        const form = document.querySelector(".typing-area"),
        incoming_id = form.querySelector('input[name=incoming_id]').value,
            inputField = form.querySelector(".input-field"),
            sendBtn = form.querySelector("button"),
            chatBox = document.querySelector(".chat-box");

        form.onsubmit = (e) => {
            e.preventDefault();
        }

        inputField.focus();
        inputField.onkeyup = () => {
            if (inputField.value != "") {
                sendBtn.classList.add("active");
            } else {
                sendBtn.classList.remove("active");
            }
        }

        sendBtn.onclick = () => {
            let xhr = new XMLHttpRequest();
            xhr.open("POST", "../php_conversation/insert-conversation.php", true);
            xhr.onload = () => {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        inputField.value = "";
                        scrollToBottom();
                    }
                }
            }
            let formData = new FormData(form);
            xhr.send(formData);
        }
        chatBox.onmouseenter = () => {
            chatBox.classList.add("active");
            console.log('mouseenter')
        }


        chatBox.onmouseleave = () => {
            chatBox.classList.remove("active");
            console.log('mouseleave')
        }
        // setInter = 
       setInterval(() => {
            console.log("incomming",incoming_id);
            let xhr = new XMLHttpRequest();
            xhr.open("POST", "../php_conversation/get-conversation.php", true);
            xhr.onload = () => {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        let data = xhr.response;
                        chatBox.innerHTML = data;
                        if (!chatBox.classList.contains("active")) {
                            scrollToBottom();
                        }
                        
                    }
                }
            }
            xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhr.send("incoming_id=" + incoming_id);
        }, 500);
     
        function scrollToBottom() {
            chatBox.scrollTop = chatBox.scrollHeight;
        }
   
}
