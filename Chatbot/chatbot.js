window.textChao = false;
document.addEventListener("DOMContentLoaded", function () {
  const chatbot = document.querySelector(".chatbot-container");
  const chatbotBody = document.querySelector(".chatbot-body");
  const messagesDiv = document.getElementById("chatMessages");

  // Lời chào đầu tiên
  function loiChaoDauTien() {
    if (!textChao) {
      messagesDiv.innerHTML += `<div class="message bot-message">Chào bạn! Mình là chatbot chuyên về cà phê của Kalita Cafe. Hãy hỏi mình bất cứ điều gì về cà phê, bộ sản phẩm, hoặc cửa hàng nhé!</div>`;
      requestAnimationFrame(() => {
        messagesDiv.scrollTop = messagesDiv.scrollHeight;
      });
      textChao = true;
    }
  }

  // Hàm chuyển đổi trạng thái chatbot
  window.toggleChatbot = function () {
    if (chatbot.classList.contains("minimized")) {
      chatbot.classList.remove("minimized");
      chatbotBody.style.display = "flex";
      loiChaoDauTien();
    } else {
      chatbot.classList.add("minimized");
      chatbotBody.style.display = "none";
      textChao = true;
    }
  };

  // Sự kiện nhấp vào header để phóng to/thu nhỏ
  chatbot
    .querySelector(".chatbot-header")
    .addEventListener("click", window.toggleChatbot);
  document.getElementById("closeChatbot").addEventListener("click", (e) => {
    e.stopPropagation();
    chatbot.classList.add("minimized");
    chatbotBody.style.display = "none";
    textChao = true;
  });

  document.getElementById("sendMessage").addEventListener("click", sendMessage);
  document.getElementById("chatInput").addEventListener("keypress", (e) => {
    if (e.key === "Enter") sendMessage();
  });

  // Gửi tin nhắn
  async function sendMessage() {
    const input = document.getElementById("chatInput");
    const message = input.value.trim();
    if (!message) return;
    const messagesDiv = document.getElementById("chatMessages");
    messagesDiv.innerHTML += `<div class="message user-message">${message}</div>`;
    input.value = "";
    messagesDiv.scrollTop = messagesDiv.scrollHeight;
    try {
      const response = await fetch("Chatbot/chatbot.php", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({ query: message }),
      });
      const data = await response.json();
      messagesDiv.innerHTML += `<div class="message bot-message">${data.reply}</div>`;
      messagesDiv.scrollTop = messagesDiv.scrollHeight;
    } catch (error) {
      messagesDiv.innerHTML += `<div class="message bot-message">Có lỗi xảy ra: ${error.message}</div>`;
    }
  }

  chatbot.classList.add("minimized");
  chatbotBody.style.display = "none";
});
