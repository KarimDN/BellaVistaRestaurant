@extends('layouts.app')

@section('title', 'Chat')

@section('content')
<style>
    body {
        background: #f5f5f5;
    }

    .chat-wrapper {
        max-width: 800px;
        height: 80vh;
        margin: 40px auto;
        background: white;
        display: flex;
        flex-direction: column;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 10px 30px rgba(0,0,0,0.15);
    }

    .chat-header {
        background: #1a1a1a;
        color: #c9a84c;
        padding: 15px;
        font-weight: bold;
        letter-spacing: 1px;
    }

    .chat-box {
        flex: 1;
        padding: 15px;
        overflow-y: auto;
        display: flex;
        flex-direction: column;
        gap: 10px;
    }

    .msg {
        padding: 10px 14px;
        border-radius: 10px;
        max-width: 75%;
        word-wrap: break-word;
        font-family: Arial, sans-serif;
        font-size: 14px;
    }

    .user {
        background: #c9a84c;
        color: #1a1a1a;
        align-self: flex-end;
    }

    .bot {
        background: #eee;
        align-self: flex-start;
    }

    .input-area {
        display: flex;
        border-top: 1px solid #ddd;
    }

    .input-area input {
        flex: 1;
        padding: 12px;
        border: none;
        outline: none;
        font-size: 14px;
    }

    .input-area button {
        background: #1a1a1a;
        color: #c9a84c;
        border: none;
        padding: 12px 20px;
        cursor: pointer;
        font-weight: bold;
    }

    .typing {
        font-size: 12px;
        color: #888;
        font-style: italic;
    }
</style>

<div class="chat-wrapper">

    <div class="chat-header">
        💬 BellaVista AI Assistant
    </div>

    <div id="chatBox" class="chat-box">
        <div class="msg bot">Hello 👋 How can I help you today?</div>
    </div>

    <div class="input-area">
        <input id="input" type="text" placeholder="Type your message..." />
        <button onclick="sendMessage()">Send</button>
    </div>

</div>

<script>
const chatBox = document.getElementById("chatBox");
const input = document.getElementById("input");

function addMessage(text, type) {
    const div = document.createElement("div");
    div.classList.add("msg", type);
    div.innerText = text;
    chatBox.appendChild(div);
    chatBox.scrollTop = chatBox.scrollHeight;
}

function setTyping(state) {
    let existing = document.getElementById("typing");

    if (state) {
        if (!existing) {
            const div = document.createElement("div");
            div.id = "typing";
            div.classList.add("typing");
            div.innerText = "BellaVista AI is typing...";
            chatBox.appendChild(div);
            chatBox.scrollTop = chatBox.scrollHeight;
        }
    } else {
        if (existing) existing.remove();
    }
}

async function sendMessage() {
    const text = input.value.trim();
    if (!text) return;

    addMessage(text, "user");
    input.value = "";

    setTyping(true);

    try {
        const res = await fetch("/api/chat", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "Accept": "application/json"
            },
            body: JSON.stringify({ message: text })
        });

        const data = await res.json();

        setTyping(false);

        if (!res.ok) {
            addMessage("Server error 😢", "bot");
            console.error(data);
            return;
        }

        addMessage(data.reply ?? "No response from server", "bot");

    } catch (err) {
        setTyping(false);
        console.error(err);
        addMessage("Network error 😢", "bot");
    }
}

input.addEventListener("keypress", function(e) {
    if (e.key === "Enter") sendMessage();
});
</script>

@endsection