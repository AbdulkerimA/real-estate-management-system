// toggle button handler
document.addEventListener("DOMContentLoaded", () => {
    document.querySelectorAll(".toggle-input").forEach(toggle => {
        toggle.addEventListener("change", async (e) => {
            const checkbox = e.target;
            const url = checkbox.dataset.url;
            const status = checkbox.checked;

            try {
                const response = await fetch(url, {
                    method: "PUT",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content,
                    },
                    body: JSON.stringify({
                        setting: checkbox.name,
                        value: status ? 1 : 0
                    }),
                });

                if (response.ok) {
                    const data = await response.json();
                    console.log("Preference updated:", data);
                } else {
                    console.error("Update failed:", await response.text());
                }
            } catch (error) {
                console.error("Error sending request:", error);
            }
        });
    });
});