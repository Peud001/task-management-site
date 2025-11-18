// Elements
const dropdownBtn = document.getElementById('projectDropdownBtn');
const dropdownPanel = document.getElementById('projectDropdownPanel');
const projectList = document.getElementById('projectList');
const projectSelect = document.getElementById('project_id');
const selectedLabel = document.getElementById('selectedProjectLabel');

const newProjectInput = document.getElementById('newProjectInput');
const addBtn = document.getElementById('addProjectBtn');
const savingTag = document.getElementById('savingTag');

// Toggle dropdown 
dropdownBtn?.addEventListener('click', () => {
    dropdownPanel.classList.toggle('hidden');
});

// Close when user picks a project
function closePanel() {
    dropdownPanel.classList.add('hidden');
}

// Selecting an existing project
projectList?.addEventListener('click', (e) => {
    const id = e.target.dataset.id;
    const name = e.target.textContent.trim();

    projectSelect.value = id;
    selectedLabel.textContent = id ? name : "None";

    closePanel();
});

// Add new project via AJAX
addBtn?.addEventListener('click', async () => {
    const name = newProjectInput.value.trim();
    if (!name) return;

    // Close dropdown  
    closePanel();

    savingTag.classList.remove("hidden");
    addBtn.disabled = true;

    const csrf = document.querySelector('meta[name="csrf-token"]').content;

    try {
        const res = await fetch("/projects", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": csrf,
                "Accept": "application/json"
            },
            body: JSON.stringify({ name })
        });

        const data = await res.json();

        if (res.ok) {
            const opt = document.createElement("option");
            opt.value = data.id;
            opt.textContent = data.name;
            projectSelect.appendChild(opt);

            projectSelect.value = data.id;
            selectedLabel.textContent = data.name;
        } else {
            alert("Could not add project");
        }

    } catch (error) {
        alert("Network error");
    } finally {
        savingTag.classList.add("hidden");
        addBtn.disabled = false;
        newProjectInput.value = "";
    }
});
