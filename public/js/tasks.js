document.addEventListener("DOMContentLoaded", () => {
    const el = document.getElementById("task-list");
    if (!el) return;

    function renumberTasks() {
        Array.from(el.children).forEach((li, index) => {
            const priorityEl = li.querySelector(".priority");
            if (priorityEl) {
                priorityEl.textContent = index + 1;
            }
        });
    }
    
    renumberTasks();

    new Sortable(el, {
        animation: 150,
        dataIdAttr: "data-id",

        onEnd: () => {
            renumberTasks();

            const order = Array.from(el.children).map((li, index) => ({
                id: li.getAttribute("data-id"),
                position: index + 1,
            }));

            fetch("/tasks/reorder", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": document
                        .querySelector('meta[name="csrf-token"]')
                        .getAttribute("content"),
                },
                body: JSON.stringify({ order }),
            });
        },
    });

    window.addEventListener("task-added", () => renumberTasks());
});
