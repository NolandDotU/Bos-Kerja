// Update slider value display
const salaryRange = document.getElementById('salaryRange');
const salaryRangeValue = document.getElementById('salaryRangeValue');

// Update salary range display dynamically
salaryRange.addEventListener('input', () => {
  const value = salaryRange.value;
  salaryRangeValue.textContent = `$${value.toLocaleString()} - $20,000`;
  filterJobs(); // Call filterJobs when slider is changed
});

// Get job category checkboxes
const jobCategoryCheckboxes = document.querySelectorAll('.jobCategory');

// Array of job titles and companies for better variety
const jobs = [
  { title: 'UX Designer', company: 'Google', salary: 7500, category: 'uxDesigner' },
  { title: 'Frontend Developer', company: 'Meta', salary: 2000, category: 'developer' },
  { title: 'Data Analyst', company: 'Amazon', salary: 1800, category: 'analyst' },
  { title: 'Product Manager', company: 'Airbnb', salary: 2500, category: 'developer' },
  { title: 'Motion Designer', company: 'Dribbble', salary: 8600, category: 'designer' },
  { title: 'Full Stack Developer', company: 'Microsoft', salary: 6100, category: 'developer' },
  { title: 'Graphic Designer', company: 'Adobe', salary: 1400, category: 'designer' },
  { title: 'Backend Developer', company: 'IBM', salary: 9600, category: 'developer' },
  { title: 'SEO Specialist', company: 'Shopify', salary: 10400, category: 'analyst' },
  { title: 'Cloud Engineer', company: 'Oracle', salary: 8400, category: 'developer' },
  { title: 'DPR', company: 'Goverment', salary: 15700, category: 'developer' },
];

// Function to filter and display job cards based on salary and category
function filterJobs() {
  // Get the selected salary value
  const selectedSalary = parseInt(salaryRange.value);

  // Get the checked categories
  const checkedCategories = Array.from(jobCategoryCheckboxes)
    .filter(checkbox => checkbox.checked)
    .map(checkbox => checkbox.id);

  // Filter jobs based on selected salary and category
  const filteredJobs = jobs.filter(job => {
    return job.salary >= selectedSalary && checkedCategories.includes(job.category);
  });

  // Generate job cards based on filtered jobs
  document.getElementById('jobCardsContainer').innerHTML = generateJobCards(filteredJobs);
}

// Function to generate job cards based on jobs array
function generateJobCards(filteredJobs) {
  let cards = '';
  filteredJobs.forEach(job => {
    cards += `
      <div class="col-md-6 col-lg-4 mb-4">
        <div class="card job-card">
          <div class="card-body d-flex flex-column">
            <h6 class="card-title mb-2 text-dark">${job.title}</h6>
            <p class="card-subtitle text-muted">${job.company}</p>
            <div class="mt-auto d-flex justify-content-between align-items-center">
              <span class="fw-bold text-dark">$${job.salary}/hr</span>
              <button class="btn btn-sm btn-outline-dark">Details</button>
            </div>
          </div>
        </div>
      </div>
    `;
  });
  return cards;
}

// Initial call to populate job cards
filterJobs();

// Add event listener to filter jobs when checkbox changes
jobCategoryCheckboxes.forEach(checkbox => {
  checkbox.addEventListener('change', filterJobs);
});
