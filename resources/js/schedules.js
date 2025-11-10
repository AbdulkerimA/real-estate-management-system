const defaultConfig = {
    page_title: "My Appointments",
    page_subtitle: "Track and manage your scheduled property viewings",
    empty_state_message:
        "No appointments yet. Schedule your first property viewing!",
    empty_state_button: "Book Now",
    footer_copyright: "© 2024 PropertyHub. All rights reserved.",
    primary_color: "#00ff88",
    background_color: "#1c252e",
    surface_color: "#1f2937",
    text_color: "#e0e0e0",
    secondary_action_color: "#a0a0a0",
    font_family: "Inter",
    font_size: 16,
};

// Sample appointment data
// const appointments = [
// {
//     id: 1,
//     property: "Modern Apartment in Bole",
//     icon: "🏢",
//     agent: "Sarah Johnson",
//     phone: "+251 911 234 567",
//     email: "sarah.j@propertyhub.com",
//     date: "2024-01-15",
//     time: "2:00 PM",
//     status: "confirmed",
//     price: "ETB 8,500,000",
//     location: "Bole, Addis Ababa",
// },
// {
//     id: 2,
//     property: "Luxury Condo in Sarbet",
//     icon: "🏙️",
//     agent: "Michael Chen",
//     phone: "+251 911 345 678",
//     email: "michael.c@propertyhub.com",
//     date: "2024-01-14",
//     time: "10:00 AM",
//     status: "pending",
//     price: "ETB 12,000,000",
//     location: "Sarbet, Addis Ababa",
// },
// {
//     id: 3,
//     property: "Family Villa in CMC",
//     icon: "🏡",
//     agent: "Emma Williams",
//     phone: "+251 911 456 789",
//     email: "emma.w@propertyhub.com",
//     date: "2024-01-10",
//     time: "3:30 PM",
//     status: "completed",
//     price: "ETB 15,500,000",
//     location: "CMC, Addis Ababa",
// },
// {
//     id: 4,
//     property: "Studio Apartment in Kazanchis",
//     icon: "🏠",
//     agent: "David Brown",
//     phone: "+251 911 567 890",
//     email: "david.b@propertyhub.com",
//     date: "2024-01-08",
//     time: "11:00 AM",
//     status: "cancelled",
//     price: "ETB 4,200,000",
//     location: "Kazanchis, Addis Ababa",
// },
// {
//     id: 5,
//     property: "Penthouse in Megenagna",
//     icon: "🌆",
//     agent: "Lisa Anderson",
//     phone: "+251 911 678 901",
//     email: "lisa.a@propertyhub.com",
//     date: "2024-01-18",
//     time: "4:00 PM",
//     status: "confirmed",
//     price: "ETB 22,000,000",
//     location: "Megenagna, Addis Ababa",
// },
// ];

console.log(appointments);
let filteredAppointments = [...appointments];

function renderAppointments() {
const container = document.getElementById("appointmentsList");
const emptyState = document.getElementById("emptyState");

if (filteredAppointments.length === 0) {
    container.style.display = "none";
    emptyState.style.display = "block";
    return;
}

container.style.display = "grid";
emptyState.style.display = "none";

container.innerHTML = filteredAppointments
    .map(
    (apt) => `
<div class="appointment-card">
    <div class="property-image">
        <img src="/storage/${apt.icon}" alt="${apt.property}" />
    </div>

    <div class="appointment-details">
    <div class="property-title">${apt.property}</div>
    <div class="detail-row">
        <span class="icon">👤</span>
        <span>${apt.agent}</span>
    </div>
    <div class="detail-row">
        <span class="icon">📞</span>
        <span>${apt.phone}</span>
    </div>
    <div class="detail-row">
        <span class="icon">📅</span>
        <span>${apt.date} at ${apt.time}</span>
    </div>
    <div>
        <span class="status-badge status-${apt.status}">${
        apt.status
    }</span>
    </div>
    </div>
    <div class="appointment-actions">
    <button class="btn btn-primary" onclick="showDetails(${
        apt.id
    })">View Details</button>
    ${
        apt.status !== "completed" && apt.status !== "cancelled"
        ? `
        <button class="btn btn-secondary" onclick="reschedule(${apt.id})">Reschedule</button>
        <button class="btn btn-danger" onclick="cancelAppointment(${apt.id})">Cancel</button>
    `
        : ""
    }
    </div>
</div>
`
    )
    .join("");
}

function showDetails(id) {
    const apt = appointments.find((a) => a.id === id);
    if (!apt) return;

    document.getElementById("modalImage").src = `storage/${apt.icon}`;
    document.getElementById("modalPropertyName").textContent = apt.property;
    document.getElementById("modalPrice").textContent = apt.price;
    document.getElementById("modalLocation").textContent = apt.location;
    document.getElementById("modalAgent").textContent = apt.agent;
    document.getElementById("modalPhone").textContent = apt.phone;
    document.getElementById("modalEmail").textContent = apt.email;
    document.getElementById(
        "modalDateTime"
    ).textContent = `${apt.date} at ${apt.time}`;
    document.getElementById(
        "modalStatus"
    ).innerHTML = `<span class="status-badge status-${apt.status}">${apt.status}</span>`;

    document.getElementById("detailsModal").classList.add("active");
}

function reschedule(id) {
    const messageDiv = document.createElement("div");
    messageDiv.style.cssText =
        "position: fixed; top: 20px; left: 50%; transform: translateX(-50%); background: #00ff88; color: #12181f; padding: 1rem 2rem; border-radius: 8px; font-weight: 600; z-index: 2000; box-shadow: 0 4px 12px rgba(0, 255, 136, 0.4);";
    messageDiv.textContent = "Reschedule feature coming soon!";
    document.body.appendChild(messageDiv);
    setTimeout(() => messageDiv.remove(), 3000);
}

function changeStatusToComplete(id){
    const apt = appointments.find((a) => a.id === id);
    if (apt) {
        // change  request to completed 
    }
}

function cancelAppointment(id) {
    const apt = appointments.find((a) => a.id === id);
    if (!apt) return;

    const card = event.target.closest(".appointment-card");
    const actionsDiv = card.querySelector(".appointment-actions");

    actionsDiv.innerHTML = `
    <div style="display: flex; flex-direction: column; gap: 0.75rem; width: 100%;">
        <p style="color: #f44336; font-weight: 600; margin-bottom: 0.5rem;">Confirm cancellation?</p>
        <button class="btn btn-danger" onclick="confirmCancel(${id})">Yes, Cancel</button>
        <button class="btn btn-secondary" onclick="renderAppointments()">No, Keep It</button>
    </div>
    `;
}

function confirmCancel(id) {
    const apt = appointments.find((a) => a.id === id);
    if (apt) {
        // send the canclation request here 
        apt.status = "cancelled";
        renderAppointments();

        const messageDiv = document.createElement("div");
        messageDiv.style.cssText =
        "position: fixed; top: 20px; left: 50%; transform: translateX(-50%); background: #f44336; color: white; padding: 1rem 2rem; border-radius: 8px; font-weight: 600; z-index: 2000; box-shadow: 0 4px 12px rgba(244, 67, 54, 0.4);";
        messageDiv.textContent = "Appointment cancelled successfully";
        document.body.appendChild(messageDiv);
        setTimeout(() => messageDiv.remove(), 3000);
    }
}

function filterAppointments() {
    const searchTerm = document
        .getElementById("searchInput")
        .value.toLowerCase();
    const statusFilter = document.getElementById("statusFilter").value;

    filteredAppointments = appointments.filter((apt) => {
        const matchesSearch =
        apt.property.toLowerCase().includes(searchTerm) ||
        apt.agent.toLowerCase().includes(searchTerm);
        const matchesStatus =
        statusFilter === "all" || apt.status === statusFilter;

        return matchesSearch && matchesStatus;
    });

    renderAppointments();
}

document
.getElementById("searchInput")
.addEventListener("input", filterAppointments);
document
.getElementById("statusFilter")
.addEventListener("change", filterAppointments);
document
.getElementById("dateFilter")
.addEventListener("change", filterAppointments);

document.getElementById("closeModal").addEventListener("click", () => {
    document.getElementById("detailsModal").classList.remove("active");
});

document.getElementById("detailsModal").addEventListener("click", (e) => {
    if (e.target.id === "detailsModal") {
        document.getElementById("detailsModal").classList.remove("active");
    }
});

async function onConfigChange(config) {
    const customFont = config.font_family || defaultConfig.font_family;
    const baseSize = config.font_size || defaultConfig.font_size;
    const baseFontStack =
        '-apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif';

    document.body.style.fontFamily = `${customFont}, ${baseFontStack}`;
    document.body.style.fontSize = `${baseSize}px`;

    const primaryColor =
        config.primary_color || defaultConfig.primary_color;
    const backgroundColor =
        config.background_color || defaultConfig.background_color;
    const surfaceColor =
        config.surface_color || defaultConfig.surface_color;
    const textColor = config.text_color || defaultConfig.text_color;
    const secondaryActionColor =
        config.secondary_action_color || defaultConfig.secondary_action_color;

    document.documentElement.style.setProperty(
        "--primary-color",
        primaryColor
    );
    document.documentElement.style.setProperty(
        "--background-color",
        backgroundColor
    );
    document.documentElement.style.setProperty(
        "--surface-color",
        surfaceColor
    );
    document.documentElement.style.setProperty("--text-color", textColor);
    document.documentElement.style.setProperty(
        "--secondary-action-color",
        secondaryActionColor
    );

    document.body.style.background = `linear-gradient(135deg, ${backgroundColor} 0%, #12181f 100%)`;
    document.body.style.color = textColor;

    document
        .querySelectorAll(
        ".overview-card .number, .status-confirmed, .btn-primary"
        )
        .forEach((el) => {
        el.style.color = primaryColor;
        });

    document
        .querySelectorAll(".overview-card, .appointment-card, .filter-bar")
        .forEach((el) => {
        el.style.background = surfaceColor;
        });

    document
        .querySelectorAll(
        ".detail-row, .footer-links a, .overview-card .label"
        )
        .forEach((el) => {
        el.style.color = secondaryActionColor;
        });

    document.getElementById("page-title").textContent =
        config.page_title || defaultConfig.page_title;
    document.getElementById("page-subtitle").textContent =
        config.page_subtitle || defaultConfig.page_subtitle;
    document.getElementById("empty-state-message").textContent =
        config.empty_state_message || defaultConfig.empty_state_message;
    document.getElementById("empty-state-button").textContent =
        config.empty_state_button || defaultConfig.empty_state_button;
    document.getElementById("footer-copyright").textContent =
        config.footer_copyright || defaultConfig.footer_copyright;
}


renderAppointments();

window.cancelAppointment  = cancelAppointment;
window.reschedule = reschedule;
window.cancelAppointment = cancelAppointment;
window.confirmCancel = confirmCancel;
window.showDetails = showDetails;
window.renderAppointments = renderAppointments;