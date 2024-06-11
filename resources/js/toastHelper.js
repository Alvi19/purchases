// resources/js/toastHelper.js
export function showToast(message, type = "success") {
    let toastContainer = document.getElementById("toast-container");
    if (!toastContainer) {
        toastContainer = document.createElement("div");
        toastContainer.id = "toast-container";
        toastContainer.className =
            "fixed inset-0 flex items-center justify-center";
        document.body.appendChild(toastContainer);
    }

    const toast = document.createElement("div");
    toast.className = `toast toast-center toast-middle alert alert-${type}`;
    toast.innerHTML = `<span>${message}</span>`;

    toastContainer.appendChild(toast);
    toastContainer.classList.remove("hidden");

    setTimeout(() => {
        toastContainer.removeChild(toast);
        if (toastContainer.childElementCount === 0) {
            toastContainer.classList.add("hidden");
        }
    }, 3000);
}
