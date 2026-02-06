document.addEventListener('DOMContentLoaded', () => {
    const addBtn = document.getElementById("addDocumentBtn");
    if (addBtn) {
        addBtn.addEventListener("click", () => {
            window.location.href = "add_document.php";
        });
    }
});
