document.addEventListener("DOMContentLoaded", function () {
  const paymentForm = document.getElementById("payment-form");
  const payButton = document.querySelector(".btn-pay");
  const toast = document.getElementById("toast");
  const toastMessage = document.getElementById("toast-message");

  //toast thông báo
  function showToast(message) {
    toastMessage.textContent = message;
    toast.classList.add("show");
    setTimeout(() => {
      toast.classList.remove("show");
    }, 3000);
  }

  // thông báo xữ lí
  if (paymentForm && payButton) {
    paymentForm.addEventListener("submit", function () {
      payButton.disabled = true;
      payButton.textContent = "Đang xử lý...";
    });
  }

  //shoow toast thông báo
  if (document.querySelector(".qr-code-container")) {
    showToast("Mã QR đã được tạo. Vui lòng quét để thanh toán.");
  } else if (document.querySelector(".error-message")) {
    showToast("Có lỗi xảy ra. Vui lòng thử lại.");
  }
});
