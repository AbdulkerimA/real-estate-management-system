console.log(appointments);

function showDetails(id) {
    const apt = appointments.find((a) => a.id === id);
    if (!apt) return;

    document.getElementById("modalImage").src = `/storage/${apt.icon}`;
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
    ).innerHTML = `<span class="status-badge rounded-lg px-2 py-1 status-${apt.status}">${apt.status}</span>`;

    document.getElementById("apmodal").classList.add("active");
}

document.getElementById('closeModal').addEventListener('click',()=>{
    document.getElementById("apmodal").classList.remove("active");
});

window.showDetails = showDetails;