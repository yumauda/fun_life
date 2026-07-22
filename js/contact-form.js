document.addEventListener("DOMContentLoaded", () => {
  const contactForm = document.querySelector(".p-contact__form .wpcf7-form");
  if (!contactForm) return;

  const inputArea = contactForm.querySelector(".js-contact-input");
  const confirmArea = contactForm.querySelector(".js-contact-confirm");
  const confirmButton = contactForm.querySelector(".js-contact-confirm-button");
  const backButton = contactForm.querySelector(".js-contact-back-button");
  const subtitle = document.querySelector(".js-contact-subtitle");
  const intro = document.querySelector(".js-contact-intro");
  const formElement = contactForm.closest("form");

  if (!inputArea || !confirmArea || !confirmButton || !backButton || !formElement) return;

  const getFieldValues = (name) => {
    const fields = Array.from(formElement.querySelectorAll(`[name="${name}"], [name="${name}[]"]`));
    if (!fields.length) return "";

    const firstField = fields[0];
    if (firstField.type === "checkbox" || firstField.type === "radio") {
      return fields.filter((field) => field.checked).map((field) => field.value).join("、");
    }

    return firstField.value.trim();
  };

  const updateConfirmValues = () => {
    confirmArea.querySelectorAll("[data-confirm-field], [data-confirm-output]").forEach((output) => {
      const fieldName = output.dataset.confirmField || output.dataset.confirmOutput;
      const value = getFieldValues(fieldName);
      output.textContent = value || "－";
    });
  };

  const validateForm = () => {
    const requiredFields = Array.from(new Set(inputArea.querySelectorAll("[aria-required='true'], [required], .wpcf7-validates-as-required input, input[name='privacy-consent']")));
    let firstInvalidField = null;

    requiredFields.forEach((field) => {
      if (field.type === "checkbox" || field.type === "radio") {
        const groupName = field.name.replace(/\[\]$/, "");
        const isChecked = getFieldValues(groupName) !== "";
        field.setCustomValidity(isChecked ? "" : "選択してください。");
      } else {
        field.setCustomValidity("");
      }

      if (!field.checkValidity() && !firstInvalidField) firstInvalidField = field;
    });

    if (firstInvalidField) {
      firstInvalidField.reportValidity();
      firstInvalidField.focus();
      return false;
    }

    return true;
  };

  const scrollToFormTop = () => {
    document.getElementById("contact-form")?.scrollIntoView({ behavior: "smooth", block: "start" });
  };

  confirmButton.addEventListener("click", () => {
    if (!validateForm()) return;

    updateConfirmValues();
    inputArea.hidden = true;
    confirmArea.hidden = false;
    contactForm.classList.add("is-confirming");
    if (subtitle) subtitle.textContent = subtitle.dataset.confirmTitle;
    if (intro) intro.hidden = true;
    scrollToFormTop();
  });

  backButton.addEventListener("click", () => {
    confirmArea.hidden = true;
    inputArea.hidden = false;
    contactForm.classList.remove("is-confirming");
    if (subtitle) subtitle.textContent = subtitle.dataset.inputTitle;
    if (intro) intro.hidden = false;
    scrollToFormTop();
  });

  document.addEventListener("wpcf7mailsent", (event) => {
    if (String(event.detail.contactFormId) !== "41") return;
    window.location.href = `${window.location.origin}/thanks/`;
  });
});
