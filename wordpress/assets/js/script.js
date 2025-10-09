function custom_chatbot_contexts_toggle_overlay() {
    btn = jQuery("#wps-custom_chatbot_contexts #open-overlay")[0]
    chat_window = jQuery("#wps-custom_chatbot_contexts #chat-window")[0]

    if(btn == null) return
    if(btn.style.display == "none") {
        btn.style.display = ""
        chat_window.style.display = "none"
    } else {
        btn.style.display = "none"
        chat_window.style.display = ""
    }
}
function custom_chatbot_contexts_append_msg(txt, user) {
    const box = jQuery("#wps-custom_chatbot_contexts #chat-window .box");

    const item = jQuery('<div class="item"><div class="msg"><p></p></div></div>');

    item.find("p").text(txt);

    if (user) {
        item.addClass("right");
    }

    if (box.children(".item").length > 0) {
        box.append('<br clear="both">');
    }

    box.append(item);

    box.scrollTop(box[0].scrollHeight);
}
async function custom_chatbot_contexts_onmessage() {
    formData = new FormData()
    text = jQuery("#wps-custom_chatbot_contexts #chat-form input").first().val()
    formData.append("msg", text)
    
    const messages = [];

    jQuery("#wps-custom_chatbot_contexts #chat-window .box .item").each(function (index, element) {
        const is_user = element.classList.contains("right");
        const msgEl = element.querySelector(".msg p");

        if (msgEl) {
            messages.push({
                role: is_user ? "user" : "bot",
                text: msgEl.textContent.trim()
            });
        }
    });

    formData.append("history", JSON.stringify(messages));

    console.log("FormData contents:");
    for (const [key, value] of formData.entries()) {
        console.log(key, value);
    }
    custom_chatbot_contexts_append_msg(text, true)
    try {
        const response = await fetch("/wp-content/plugins/custom_chatbot_contexts/completion.php", {
            method: "POST",
            body: formData,
        });

        if (!response.ok) throw new Error(`HTTP error ${response.status}`);

        const chatWindow = jQuery("#chat-window .box");
        const result = await response.json();

        if(result.msg)
            custom_chatbot_contexts_append_msg(result.msg, false)
        jQuery("#wps-custom_chatbot_contexts #chat-form input").first().val("");
    } catch (err) {
        console.error("Error sending message:", err);
    }

    // 7️⃣ Clear input
}
jQuery(document).ready(function(){
    jQuery("#wps-custom_chatbot_contexts #chat-form").on("submit", (event) => {
        event.preventDefault();
        custom_chatbot_contexts_onmessage();
    });
})