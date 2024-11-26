let jobs = [
    {
        title: "Frontend Developer",
        description: "Build user-friendly interfaces with HTML, CSS, and JavaScript.",
        schedule: "Full Time",
        style: "Office",
        salary: 50000,
        applicants: ["John Doe (john@example.com)", "Jane Smith (jane@example.com)"]
    },
    
];

const jobCards = document.getElementById("jobCards");
let jobToDelete = null;

function renderJobs() {
    jobCards.innerHTML = "";
    jobs.forEach((job, index) => {
        const card = document.createElement("div");
        card.className = "col";
        card.innerHTML = `
            <div class="card shadow-sm h-100">
                <div class="card-body">
                    <h5 class="card-title">${job.title}</h5>
                    <p class="card-text text-truncate">${job.description}</p>
                    <p><strong>Schedule:</strong> ${job.schedule}</p>
                    <p><strong>Work Style:</strong> ${job.style}</p>
                    <p><strong>Salary:</strong> $${job.salary}</p>
                    <div class="d-flex justify-content-between">
                        <button class="btn btn-primary btn-sm" data-index="${index}">Details</button>
                        <button class="btn btn-danger btn-sm" data-index="${index}" data-bs-toggle="modal" data-bs-target="#deleteJobModal">Delete</button>
                    </div>
                </div>
            </div>
        `;

        card.querySelector(".btn-primary").addEventListener("click", (e) => {
            const jobIndex = e.target.dataset.index;
            const selectedJob = jobs[jobIndex];
            document.getElementById("modalJobTitle").textContent = selectedJob.title;
            document.getElementById("modalJobDescription").textContent = selectedJob.description;
            document.getElementById("modalJobApplicants").innerHTML = selectedJob.applicants
                .map(applicant => `<li>${applicant}</li>`)
                .join("");
            new bootstrap.Modal(document.getElementById("jobDetailModal")).show();
        });

        card.querySelector(".btn-danger").addEventListener("click", (e) => {
            jobToDelete = jobs[e.target.dataset.index];
        });

        jobCards.appendChild(card);
    });
}

document.getElementById("confirmDeleteJobBtn").addEventListener("click", () => {
    jobs = jobs.filter(job => job !== jobToDelete);
    renderJobs();
    new bootstrap.Modal(document.getElementById("deleteJobModal")).hide();
});

// Handle Add Job form submission
document.getElementById("addJobForm").addEventListener("submit", (e) => {
    e.preventDefault();
    const title = document.getElementById("jobTitle").value;
    const description = document.getElementById("jobDescription").value;
    const schedule = document.getElementById("workSchedule").value;
    const style = document.getElementById("workStyle").value;
    const salary = document.getElementById("salary").value;

    jobs.push({ title, description, schedule, style, salary, applicants: [] });
    document.getElementById("addJobForm").reset();
    new bootstrap.Modal(document.getElementById("addJobModal")).hide();
    renderJobs();
});

// Initial render
renderJobs();