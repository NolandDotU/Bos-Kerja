// Sampel data Jobs
const jobs = [
  { title: 'UX Designer', company: 'Google', salary: 7500, location: 'Mountain View, CA', employmentType: 'Full-time', workStyle: 'Hybrid', isFavorite: false },
  { title: 'Frontend Developer', company: 'Meta', salary: 6000, location: 'Menlo Park, CA', employmentType: 'Part-time', workStyle: 'Remote', isFavorite: false },
  { title: 'Data Analyst', company: 'Amazon', salary: 8000, location: 'Seattle, WA', employmentType: 'Full-time', workStyle: 'Hybrid', isFavorite: false },
  { title: 'Product Manager', company: 'Airbnb', salary: 2500, location: 'San Francisco, CA', employmentType: 'Full-time', workStyle: 'Office', isFavorite: false },
  { title: 'Motion Designer', company: 'Dribbble', salary: 8600, location: 'San Francisco, CA', employmentType: 'Full-time', workStyle: 'Hybrid', isFavorite: false },
  { title: 'Full Stack Developer', company: 'Microsoft', salary: 6100, location: 'Redmond, WA', employmentType: 'Full-time', workStyle: 'Office', isFavorite: false },
  { title: 'Graphic Designer', company: 'Adobe', salary: 7400, location: 'San Jose, CA', employmentType: 'Part-time', workStyle: 'Remote', isFavorite: false },
  { title: 'Backend Developer', company: 'IBM', salary: 9600, location: 'New York, NY', employmentType: 'Full-time', workStyle: 'Office', isFavorite: false },
  { title: 'SEO Specialist', company: 'Shopify', salary: 10400, location: 'Ottawa, ON', employmentType: 'Full-time', workStyle: 'Hybrid', isFavorite: false },
  { title: 'Cloud Engineer', company: 'Oracle', salary: 8400, location: 'Austin, TX', employmentType: 'Full-time', workStyle: 'Remote', isFavorite: false },
];
// buat generate card job
const generateJobCards = (filteredJobs) => {
  const jobCardsContainer = document.getElementById('jobCardsContainer');
  jobCardsContainer.innerHTML = ''; 
  if (filteredJobs.length === 0) {
    jobCardsContainer.innerHTML = '<p>No jobs found matching your criteria.</p>';
    return;
  }

  filteredJobs.forEach(job => {
    const favoriteClass = job.isFavorite ? 'text-danger' : 'text-muted'; 
    const heartIcon = job.isFavorite ? 'bi-heart-fill' : 'bi-heart'; 

    const jobCard = `
      <div class="col-lg-4 col-md-6 mb-3" data-aos="zoom-in-up" data-aos-duration="500">
        <div class="job-card bg-white shadow p-4 rounded">
          <div class="d-flex justify-content-between align-items-center">
            <h3 class="text-salary">$${job.salary}/<small>month</small></h3>
            <i class="bi ${heartIcon} ${favoriteClass}" style="font-size: 1.5rem; cursor: pointer;" onclick="toggleFavorite(${job.salary})"></i>
          </div>
          <p class="fw-bold">${job.title}</p>
          <p>${job.company}</p>
          <p class="text-muted">${job.location}</p>
          <p class="badge bg-primary">${job.employmentType}</p>
          <p class="badge bg-info">${job.workStyle}</p>
          <button class="card-btn">Apply Now</button>
        </div>
      </div>
    `;
    jobCardsContainer.innerHTML += jobCard;
  });
};


const toggleFavorite = (salary) => {
  const job = jobs.find(job => job.salary === salary); //Cari Jobs berdasarkan salary
  if (job) {
    if (job.isFavorite) {
      // Modal di show jiika mau hapus fav
      const removeFavoriteModal = new bootstrap.Modal(document.getElementById('removeFavoriteModal'));
      removeFavoriteModal.show();

      const confirmRemoveBtn = document.getElementById('confirmRemoveBtn');
      confirmRemoveBtn.onclick = () => {
        job.isFavorite = false; 

        filterJobs(); 
        removeFavoriteModal.hide(); // Sembunyiin Modal 
      };
    } else {
      
      job.isFavorite = !job.isFavorite; 
      filterJobs();
    }
  }
};


// Buat update display gaji
const updateSalaryDisplay = () => {
  const salaryValue = document.getElementById('salaryRange').value;
  document.getElementById('salaryValue').innerText = `$${salaryValue}`;
};

// tambah event listener
document.getElementById('salaryRange').addEventListener('input', updateSalaryDisplay);
// buat filter jobs
const filterJobs = () => {
  const searchQuery = document.getElementById('searchInput').value.toLowerCase();
  const salaryValue = document.getElementById('salaryRange').value;
  const fullTimeChecked = document.getElementById('full-time').checked;
  const partTimeChecked = document.getElementById('part-time').checked;
  const internshipChecked = document.getElementById('internship').checked;

  const officeChecked = document.getElementById('office').checked;
  const hybridChecked = document.getElementById('hybrid').checked;
  const remoteChecked = document.getElementById('remote').checked;

  const showFavoritesOnly = document.getElementById('showFavorites').checked;

  const filteredJobs = jobs.filter(job => {
    const matchesSearch = job.title.toLowerCase().includes(searchQuery) || job.company.toLowerCase().includes(searchQuery);
    const matchesSalary = job.salary >= salaryValue;
    const matchesEmploymentType = (fullTimeChecked && job.employmentType === 'Full-time') ||
                                  (partTimeChecked && job.employmentType === 'Part-time') ||
                                  (internshipChecked && job.employmentType === 'Internship');
    const matchesWorkStyle = (officeChecked && job.workStyle === 'Office') ||
                             (hybridChecked && job.workStyle === 'Hybrid') ||
                             (remoteChecked && job.workStyle === 'Remote');

    const matchesFavorites = showFavoritesOnly ? job.isFavorite : true;

    return matchesSearch && matchesSalary && matchesEmploymentType && matchesWorkStyle && matchesFavorites;
  });

  generateJobCards(filteredJobs);
};


window.onload = () => {
  generateJobCards(jobs); // ngeload semua ke deffault
  document.getElementById('salaryRange').addEventListener('input', filterJobs);
  document.getElementById('searchInput').addEventListener('input', filterJobs);
  document.getElementById('full-time').addEventListener('change', filterJobs);
  document.getElementById('part-time').addEventListener('change', filterJobs);
  document.getElementById('internship').addEventListener('change', filterJobs);
  document.getElementById('office').addEventListener('change', filterJobs);
  document.getElementById('hybrid').addEventListener('change', filterJobs);
  document.getElementById('remote').addEventListener('change', filterJobs);
  document.getElementById('showFavorites').addEventListener('change', filterJobs);
};

// ngereset filter
const resetFilters = () => {
  document.getElementById('searchInput').value = '';
  document.getElementById('salaryRange').value = 0;
  document.getElementById('full-time').checked = true;
  document.getElementById('part-time').checked = true;
  document.getElementById('internship').checked = true;
  document.getElementById('office').checked = true;
  document.getElementById('hybrid').checked = true;
  document.getElementById('remote').checked = true;
  document.getElementById('showFavorites').checked = false; 
  filterJobs();
};



