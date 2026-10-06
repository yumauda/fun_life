"use strict";

document.addEventListener("DOMContentLoaded", () => {
  const settings = window.funLifeWorksFields;

  if (!settings) return;

  const groupSelector = `[data-key="${settings.groupKey}"], #acf-${settings.groupKey}`;
  let previousState = null;

  const getSelectedCategories = () => {
    const editorStore = window.wp?.data?.select("core/editor");
    const editorCategories = editorStore?.getEditedPostAttribute("categories");

    if (Array.isArray(editorCategories)) {
      return editorCategories.map(Number);
    }

    return Array.from(document.querySelectorAll('input[name="post_category[]"]:checked')).map((input) => Number(input.value));
  };

  const updateFields = () => {
    const group = document.querySelector(groupSelector);

    if (!group) return;

    const isWorks = getSelectedCategories().includes(Number(settings.categoryId));

    if (isWorks === previousState && group.dataset.worksFieldsReady === "true") return;

    const fields = group.querySelector(".acf-fields");

    if (!fields) return;

    let notice = group.querySelector(".fun-life-works-fields__notice");

    if (!notice) {
      notice = document.createElement("p");
      notice.className = "fun-life-works-fields__notice";
      notice.textContent = "施工事例カテゴリーを選択すると画像を設定できます。";
      fields.before(notice);
    }

    group.classList.toggle("is-disabled", !isWorks);
    group.setAttribute("aria-disabled", String(!isWorks));
    fields.inert = !isWorks;
    group.dataset.worksFieldsReady = "true";
    previousState = isWorks;
  };

  document.addEventListener("change", (event) => {
    if (event.target.matches('input[name="post_category[]"]')) {
      updateFields();
    }
  });

  if (window.wp?.data?.subscribe) {
    window.wp.data.subscribe(updateFields);
  }

  const observer = new MutationObserver(updateFields);
  observer.observe(document.body, { childList: true, subtree: true });
  updateFields();
});
