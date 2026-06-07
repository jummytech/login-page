const passwordInputs = document.querySelectorAll("input[type=password]");

if (passwordInputs.length > 0) {
  passwordInputs.forEach(function (el) {
    const showHide = el.parentElement.querySelector(".show-hide");
    if (!showHide) return;
    const show = showHide.querySelector("#show"),
      hide = showHide.querySelector("#hide");
    showHide.addEventListener("click", function () {
      if (el.type == "password") {
        el.type = "text";
        hide.style.display="block";
        show.style.display="none";
    } else {
        el.type = "password";
        hide.style.display="none";
        show.style.display="block";
      }
    });
  });
}
