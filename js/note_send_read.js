const frn_cre_btn = document.querySelector("#fr_bt");
const frn_cre_modal = document.querySelector("#frn_cre");
const frn_submit = document.querySelector("#frn_submit");
const frn_cancel = document.querySelector("#frn_cancel");

function ModalClose() {
  frn_cre_modal.style.display = "none";
}

frn_cre_btn.addEventListener("click", function () {
  frn_cre_modal.style.display = "block";
});

frn_cancel.addEventListener("click", ModalClose);
